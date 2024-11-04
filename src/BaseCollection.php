<?php

namespace Tdwesten\StatamicBuilder;

use Statamic\Facades\Collection as StatamicCollection;

abstract class BaseCollection
{
    abstract public function title(): string;

    abstract public static function handle(): string;

    abstract public function route(): null|string|array;

    abstract public function slugs(): bool;

    abstract public function titleFormat(): null|string|array;

    abstract public function mount(): ?string;

    abstract public function date(): bool;

    abstract public function sites(): array;

    abstract public function template(): ?string;

    abstract public function layout(): ?string;

    abstract public function inject(): array;

    abstract public function searchIndex(): string;

    abstract public function revisionsEnabled(): bool;

    abstract public function defaultPublishState(): bool;

    abstract public function originBehavior(): string;

    abstract public function structure(): ?array;

    abstract public function sortBy(): ?string;

    abstract public function sortDir(): ?string;

    abstract public function taxonomies(): array;

    abstract public function propagate(): ?bool;

    abstract public function previewTargets(): array;

    abstract public function autosave(): bool|int|null;

    abstract public function futureDateBehavior(): ?string;

    abstract public function pastDateBehavior(): ?string;

    public function visible(): bool
    {
        return true;
    }

    public function register()
    {
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
