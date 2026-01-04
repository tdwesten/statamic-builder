<?php

namespace Tdwesten\StatamicBuilder;

use Tdwesten\StatamicBuilder\Contracts\Blueprint as BlueprintInterface;
use Tdwesten\StatamicBuilder\Exceptions\BlueprintRenderException;
use Tdwesten\StatamicBuilder\FieldTypes\Tab;

abstract class Blueprint implements BlueprintInterface
{
    protected $tabs;

    protected $handle;

    protected $title;

    protected $hidden = false;

    public function __construct(?string $handle = null)
    {
        $this->handle = $handle ?? static::handle();
        $this->tabs = collect($this->registerTabs());
    }

    public static function handle(): string
    {
        return '';
    }

    public static function blueprintNamespace(): string
    {
        return '';
    }

    public static function make(?string $handle = null)
    {
        return new static($handle);
    }

    public function toArray()
    {
        $blueprint = [
            'title' => $this->title,
            'hide' => $this->hidden,
            'tabs' => $this->tabsToArray(),
        ];

        return $blueprint;
    }

    public function tabsToArray()
    {
        if ($this->tabs->isEmpty()) {
            return [];
        }

        $tabs = $this->tabs->filter(function ($field) {
            return ! ($field instanceof Tab);
        });

        if ($tabs->isNotEmpty()) {
            throw new BlueprintRenderException('Only tabs are allowed in the register function of a blueprint');
        }

        return $this->tabs->mapWithKeys(function (Tab $tab) {
            return [$tab->getHandle() => $tab->toArray()];
        })->toArray();
    }

    abstract public function registerTabs(): array;

    public function addTab(Tab $tab)
    {
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
