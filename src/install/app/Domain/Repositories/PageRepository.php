<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Page;
use Serenity\Lotus\Core\Repository;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use App\Domain\Repositories\Contracts\PageRepositoryInterface;

class PageRepository extends Repository implements PageRepositoryInterface
{
    /**
     * Path the pages.
     *
     * @var string
     */
    protected $pagePath;

    /**
     * Path to collections.
     *
     * @var string
     */
    protected $collectionPath;

    /**
     * Local property to hold all of our pages.
     *
     * @var array
     */
    protected $pages = [];

    /**
     * Local static instance of our entity model.
     *
     * @var \App\Domain\Entities\Page
     */
    protected static $instance;

    /**
     * Our route collection.
     *
     * @var \Illuminate\Support\Collection
     */
    public $routes;

    /**
     * Instantiate the repository.
     */
    public function __construct()
    {
        parent::__construct();

        self::$instance = $this->entity;

        $this->pagePath = base_path(config('lotus.pages.path'));
        $this->collectionPath = base_path(config('lotus.collections.path'));
    }

    /**
     * Set the repository entity.
     *
     * @return \App\Domain\Entities\Page
     */
    public static function entity()
    {
        return Page::class;
    }

    /**
     * Return both pages and collections.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        $this->makePages();
        $this->makeCollections();
        $this->generateRoutes();

        return $this->pages = collect($this->pages);
    }

    /**
     * Search our cached pages and return match.
     *
     * @param  string $slug
     * @return \App\Domain\Entities\Page
     */
    public function find($slug)
    {
        $pages = app('static.pages');

        foreach($pages as $page) {
            if ($page->slug == $slug) {
                return $page;
            }
        }

        abort(404);
    }

    /**
     * Build up all of our regular static pages.
     *
     * @return void
     */
    public function makePages()
    {
        $files = (new Finder())->in($this->pagePath)->files()->name('index.md');

        foreach ($files as $file) {
            $this->pages[] = (new static::$instance)->make($file);
        }
    }

    /**
     * Build up all of our collection pages.
     *
     * @return void
     */
    public function makeCollections()
    {
        $directories = (new Finder())->in($this->collectionPath)->directories();

        foreach ($directories as $directory) {
            $entries = [];

            $files = (new Finder())
                ->in($directory->getPathname())
                ->files()
                ->name('*.md')
                ->sort(function(SplFileInfo $a, SplFileInfo $b) {
                    return strcmp($b->getRealPath(), $a->getRealPath());
            });

            foreach ($files as $file) {
                $this->pages[] = (new static::$instance)->collect($file, $directory->getBasename());
            }
        }
    }

    /**
     * Generate routes from our pages.
     *
     * @return \Illuminate\Support\Collection
     */
    public function generateRoutes()
    {
        $routes = [];

        foreach ($this->pages as $page) {
            $routes[$page->slug] = $page;
        }

        $this->routes = collect($routes);
    }
}
