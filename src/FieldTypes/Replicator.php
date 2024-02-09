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
            'handle' => $this->handle,
            'sets' => $this->setsToArray(),
            'max_sets' => $this->max_sets,
            'collapse' => $this->collapse->value,
            'previews' => $this->previews,
        ]);
    }

    public function setsToArray(): array
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
}
