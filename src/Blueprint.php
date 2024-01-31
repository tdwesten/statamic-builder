<?php

namespace Tdwesten\StatamicBuilder;

use Tdwesten\StatamicBuilder\Contracts\Blueprint as BlueprintInterface;
use Tdwesten\StatamicBuilder\FieldTypes\Tab;

class Blueprint implements BlueprintInterface
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

    public function toArray()
    {
        return [
            'title' => $this->title,
            'hide' => $this->hidden,
            'tabs' => $this->tabsToArray(),
        ];
    }

    public function tabsToArray()
    {
        $tabs = $this->tabs->mapWithKeys(function (Tab $tab) {
            return [$tab->getHandle() => $tab->toArray()];
        })->toArray();

        return $tabs;
    }

    public function register()
    {
        // (placeholder) Silence is golden
    }

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

    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }

    public function hidden(bool $hidden = true)
    {
        $this->hidden = $hidden;

        return $this;
    }
}
