<?php

namespace Tdwesten\StatamicBuilder;

use Statamic\Facades\Collection as StatamicCollection;
use Statamic\Facades\Site;

abstract class BaseCollection
{
    abstract public static function handle(): string;

    public function title(): string
    {
        return (string) \Statamic\Support\Str::of(static::handle())->title()->replace('_', ' ');
    }

    public function route(): null|string|array
    {
        return null;
    }

    public function slugs(): bool
    {
        return true;
    }

    public function titleFormat(): null|string|array
    {
        return null;
    }

    public function mount(): ?string
    {
        return null;
    }

    public function date(): bool
    {
        return false;
    }

    public function sites(): array
    {
        return [Site::default()->handle()];
    }

    public function template(): ?string
    {
        return null;
    }

    public function layout(): ?string
    {
        return null;
    }

    public function inject(): array
    {
        return [];
    }

    public function searchIndex(): ?string
    {
        return null;
    }

    public function revisionsEnabled(): bool
    {
        return false;
    }

    public function defaultPublishState(): bool
    {
        return true;
    }

    public function originBehavior(): string
    {
        return 'select';
    }

    public function structure(): ?array
    {
        return null;
    }

    public function sortBy(): ?string
    {
        return null;
    }

    public function sortDir(): ?string
    {
        return null;
    }

    public function taxonomies(): array
    {
        return [];
    }

    public function propagate(): ?bool
    {
        return null;
    }

    public function previewTargets(): array
    {
        return [];
    }

    public function autosave(): bool|int|null
    {
        return null;
    }

    public function futureDateBehavior(): ?string
    {
        return null;
    }

    public function pastDateBehavior(): ?string
    {
        return null;
    }

    public function visible(): bool
    {
        return true;
    }

    public function register()
    {
        /** @var \Statamic\Entries\Collection */
        $collection = StatamicCollection::make($this->handle())
            ->title($this->title())
            ->routes($this->route())
            ->requiresSlugs($this->slugs())
            ->titleFormats($this->titleFormat())
            ->mount($this->mount())
            ->dated($this->date())
            ->sites($this->sites())
            ->template($this->template())
            ->layout($this->layout())
            ->cascade($this->inject())
            ->searchIndex($this->searchIndex())
            ->revisionsEnabled($this->revisionsEnabled())
            ->defaultPublishState($this->defaultPublishState())
            ->originBehavior($this->originBehavior())
            ->structureContents($this->structure())
            ->sortField($this->sortBy())
            ->sortDirection($this->sortDir())
            ->taxonomies($this->taxonomies())
            ->propagate($this->propagate())
            ->previewTargets($this->previewTargets())
            ->autosaveInterval($this->autosave())
            ->futureDateBehavior($this->futureDateBehavior())
            ->pastDateBehavior($this->pastDateBehavior());

        return $collection;
    }
}
