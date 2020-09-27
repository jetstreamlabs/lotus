<?php

namespace App\Domain\Entities;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Finder\SplFileInfo;

class Page
{
    /**
     * Our local data property.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Build up a page model.
     *
     * @param  \Symfony\Component\Finder\SplFileInfo $file
     * @return self
     */
    public function make(SplFileInfo $file)
    {
        return $this->render($file);
    }

    /**
     * Build up a page collection.
     *
     * @param  \Symfony\Component\Finder\SplFileInfo $file
     * @param  string $collection
     * @return self
     */
    public function collect(SplFileInfo $file, $collection)
    {
        return $this->render($file, $collection);
    }

    /**
     * Generate our slug for the given file.
     *
     * @param  \Symfony\Component\Finder\SplFileInfo $file
     * @param  string $collection
     * @return string
     */
    protected function generateSlug(SplFileInfo $file, $collection = null)
    {
        $path = $file->getPath();
        $base = base_path(config('lotus.pages.path'));

        if (! is_null($collection)) {
            $path = $file->getPathname();
            $base = base_path(config('lotus.collections.path'));
        }

        $slug = str_replace($base, '', $path);
        $slug = preg_replace('/\.md$/', '', $slug);
        $slug = preg_replace('/(\/.*?\.)/', '/', $slug);

        if (! is_null($collection)) {
            $slug = '/' . $collection . $slug;
        }

        if (!$slug) {
            $slug = '/';
        }

        $this->slug = $slug;
    }

    /**
     * Render our model from the given markdown file.
     *
     * @param  \Symfony\Component\Finder\SplFileInfo $file
     * @param  string $collection
     * @return self
     */
    public function render($file, $collection = null)
    {
        $this->generateSlug($file, $collection);

        $content = file_get_contents($file->getPathname());
        list($meta, $markdown) = explode('---', $content, 2);

        $meta = Yaml::parse($meta);
        $html = markdown($markdown);

        if (!isset($meta['title'])) {
            $meta['title'] = '';
        }

        $this->meta = $meta;
        $this->html = $html;

        return $this;
    }

    /**
     * Dynamically set our model properties.
     *
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Dynamically get our model properties.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->data[$key];
    }
}
