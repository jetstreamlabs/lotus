<?php

namespace Serenity\Lotus\Providers;

use Inertia\Inertia;
use Godruoyi\Snowflake\Snowflake;
use Illuminate\Support\Collection;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Godruoyi\Snowflake\RandomSequenceResolver;
use Illuminate\Pagination\LengthAwarePaginator;

class LotusServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (!is_file(config_path('lotus.php'))) {
            $this->mergeConfigFrom(
                __DIR__ . '/../config/lotus.php',
                'lotus'
            );
        }

        if (!is_file(app_path('Domain/Middleware/MuteActions.php'))) {
            $router = $this->app['router'];
            $router->pushMiddlewareToGroup('web', \Serenity\Lotus\Middleware\MuteActions::class);
        }

        $this->app->singleton(Snowflake::class, function () {
            return (new Snowflake())
                ->setStartTimeStamp(time() * 1000)
                ->setSequenceResolver(new RandomSequenceResolver(time()));
        });
    }

    public function boot()
    {
        $this->registerInertia();
        $this->registerLengthAwarePaginator();

        Collection::macro('then', function ($callback) {
            return $callback($this);
        });

        Collection::macro('pipe', function ($callback) {
            return $this->then($callback);
        });

        Collection::macro('toAssoc', function () {
            return $this->reduce(function ($assoc, $keyAndValue) {
                list($key, $value) = $keyAndValue;
                $assoc[$key] = $value;

                return $assoc;
            }, new static);
        });

        Collection::macro('mapToAssoc', function ($callback) {
            return $this->map($callback)->toAssoc();
        });

        Collection::macro('transpose', function () {
            $items = array_map(function (...$items) {
                return $items;
            }, ...$this->values());

            return new static($items);
        });

        Builder::macro('scope', function ($scope) {
            return $scope->getQuery($this);
        });
    }

    /**
     * Register our Inertia app.
     *
     * @return void
     */
    public function registerInertia()
    {
        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });

        Inertia::share([
            'app' => [
                'name' => config('app.name'),
                'social_login' => false,
                'social_register' => false,
                'previous' => url()->previous(),
                'copyright' => date('Y'),
            ],
            'auth' => function () {
                return [
                    'user' => auth()->user() ? [
                        'id' => auth()->user()->id,
                        'username' => auth()->user()->username,
                        'first_name' => auth()->user()->first_name,
                        'last_name' => auth()->user()->last_name,
                        'email' => auth()->user()->email,
                        'avatar' => auth()->user()->avatar,
                        'roles' => auth()->user()->getRoleNames(),
                        'permissions' => auth()->user()->getPermissionNames(),
                    ] : null
                ];
            },
            'flash' => function () {
                return [
                    'success' => session()->get('success'),
                    'error' => session()->get('error'),
                    'warning' => session()->get('warning'),
                    'info' => session()->get('info'),
                    'status' => session()->get('status'),
                ];
            },
            'errors' => function () {
                $messageBag = [];

                if (session()->get('errors')) {
                    $messages = session()->get('errors')->getBag('default')->getMessages();

                    foreach ($messages as $key => $value) {
                        $messageBag[str_replace('.', '_', $key)] = $value;
                    }
                }

                return (object) $messageBag;
            },
        ]);
    }

    /**
     * Register an Inertia compatible paginator.
     *
     * @return void
     */
    protected function registerLengthAwarePaginator()
    {
        $this->app->bind(LengthAwarePaginator::class, function ($app, $values) {
            return new class(...array_values($values)) extends LengthAwarePaginator
            {
                public function only(...$attributes)
                {
                    return $this->transform(function ($item) use ($attributes) {
                        return $item->only($attributes);
                    });
                }

                public function transform($callback)
                {
                    $this->items->transform($callback);

                    return $this;
                }

                public function toArray()
                {
                    return [
                        'data' => $this->items->toArray(),
                        'links' => $this->links(),
                    ];
                }

                public function links($view = null, $data = [])
                {
                    $this->appends(Request::all());

                    $window = UrlWindow::make($this);

                    $elements = array_filter([
                        $window['first'],
                        is_array($window['slider']) ? '...' : null,
                        $window['slider'],
                        is_array($window['last']) ? '...' : null,
                        $window['last'],
                    ]);

                    return collect($elements)->flatMap(function ($item) {
                        if (is_array($item)) {
                            return collect($item)->map(function ($url, $page) {
                                return [
                                    'url' => $url,
                                    'label' => $page,
                                    'active' => $this->currentPage() === $page,
                                ];
                            });
                        } else {
                            return [
                                [
                                    'url' => null,
                                    'label' => '...',
                                    'active' => false,
                                ],
                            ];
                        }
                    })->prepend([
                        'url' => $this->previousPageUrl(),
                        'label' => 'Previous',
                        'active' => false,
                    ])->push([
                        'url' => $this->nextPageUrl(),
                        'label' => 'Next',
                        'active' => false,
                    ]);
                }
            };
        });
    }
}
