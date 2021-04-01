<?php

namespace App\Domain\Services;

use Serenity\Lotus\Core\Service;
use Illuminate\Http\Request;
use App\Domain\Entities\Page;
use App\Domain\Payloads\PagePayload;
use App\Domain\Payloads\EmptyPayload;
use App\Domain\Repositories\Contracts\PageRepositoryInterface;

class PageService extends Service
{
    /**
     * Our local repository instance.
     *
     * @var \App\Domain\Repositories\Contracts\PageRepositoryInterface
     */
    protected $repository;

    /**
     * Instantiate the service.
     *
     * @param  \App\Domain\Repositories\Contracts\PageRepositoryInterface $repository
     * @return void
     */
    public function __construct(PageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle incoming data from your action.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function handle(Request $request)
    {
        $page = $this->repository->find(
            $this->mapSlug($request)
        );

        if ($page instanceof Page) {
            return new PagePayload([
                'meta'    => $page->meta,
                'content' => $page->html,
            ]);
        }

        return new EmptyPayload();
    }

    /**
     * Map our slug from the request to make sure we
     * have an opening slash.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    protected function mapSlug(Request $request)
    {
        if (! is_null($request->slug)) {
            return DIRECTORY_SEPARATOR . $request->slug;
        }

        return DIRECTORY_SEPARATOR;
    }
}
