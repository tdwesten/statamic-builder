<?php

namespace Tdwesten\StatamicBuilder;

use Tdwesten\StatamicBuilder\Fields\Tab;

class Blueprint
{
    protected $tabs;

    protected $handle;

    protected $title;

    protected $hidden = false;

    public function __construct(string $handle)
    {
        $this->handle = $handle;
        $this->tabs = collect();

        $this->register();
    }

    public static function make(string $handle)
    {
        return new static($handle);
    }

    public function register()
    {
        // Silence is golden
    }

    public function toArray()
    {
        $array = [
            'title' => $this->title,
            'hide' => $this->hidden,
            'tabs' => $this->tabsToArray(),
        ];

        ray($array);

        return $array;
    }

    public function tabsToArray()
    {
        $tabs = $this->tabs->mapWithKeys(function (Tab $tab) {
            return [$tab->getHandle() => $tab->toArray()];
        })->toArray();

        ray($tabs);

        return $tabs;
    }

    /**
     * Add a tab to the blueprint.
     *
     * @param  string  $handle
     * @param  callable<Tab>  $callback
     * @return \Illuminate\Support\Collection
     */
    public function addTab($handle, $content = [], $displayName = null)
    {
        $tab = new Tab($handle, $content);

        if ($displayName) {
            $tab->displayName($displayName);
        }

        $this->tabs->push($tab);

        return $this;
    }

    public function getHandle()
    {
        return $this->handle;
    }

    public function getTabs()
    {
        return $this->tabs;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }
}
