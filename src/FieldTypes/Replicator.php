<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Fullscreen;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Enums\CollapseOption;
use Tdwesten\StatamicBuilder\Exceptions\BlueprintRenderException;

class Replicator extends Field
{
    use Fullscreen;
    use Makeble;

    protected $type = 'replicator';

    protected CollapseOption $collapse = CollapseOption::False;

    protected bool $previews = false;

    protected $max_sets;

    protected $setGroups;

    public function __construct(string $handle, array $setGroups = [])
    {
        parent::__construct($handle);

        $this->setGroups = collect($setGroups);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'type' => $this->type,
            'sets' => $this->setGroupsToArray(),
            'max_sets' => $this->max_sets,
            'collapse' => $this->collapse->toArray(),
            'previews' => $this->previews,
            'fullscreen' => $this->fullscreen,
        ]);
    }

    public function setGroupsToArray(): array
    {
        $this->setGroups = collect($this->setGroups);

        $this->setGroups = $this->setGroups->filter(function ($setGroup) {
            if (! $setGroup instanceof SetGroup) {
                throw new BlueprintRenderException('Replicator field only accepts SetGroups\s as children.');
            }

            return $setGroup;
        });

        $setGroups = collect($this->setGroups)->mapWithKeys(function (SetGroup $set) {
            return [$set->getHandle() => $set->toArray()];
        })->all();

        return $setGroups;
    }

    public function previews($previews = true)
    {
        $this->previews = $previews;

        return $this;
    }

    public function maxSets(int $max_sets)
    {
        $this->max_sets = $max_sets;

        return $this;
    }

    public function collapse(CollapseOption $collapse)
    {
        $this->collapse = $collapse;

        return $this;
    }
}
