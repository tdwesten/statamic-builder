<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Exceptions\BlueprintRenderException;

class SetGroup extends Field
{
    use Makeble;

    protected $type = 'set_group';

    protected $sets;

    public function __construct(string $handle, array $sets = [])
    {
        parent::__construct($handle);

        $this->sets = collect($sets);
    }

    public function toArray()
    {
        $content = collect([
            'display' => $this->displayName,
            'instructions' => $this->instructions,
            'icon' => $this->icon,
            'sets' => $this->setsToArray(),
        ]);

        // Sort keys
        $content['sets'] = collect($content['sets'])->sortKeys()->all();

        return $content->toArray();
    }

    public function setsToArray(): array
    {
        $this->sets = collect($this->sets);

        $this->sets = $this->sets->filter(function ($set) {
            if (! $set instanceof Set) {
                throw new BlueprintRenderException('SetGroups only accepts Set\'s as children.');
            }

            return $set;
        });

        $sets = collect($this->sets)->mapWithKeys(function (Set $set) {
            return [$set->getHandle() => $set->toArray()];
        })->all();

        return $sets;
    }

    public function displayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;

    }
}
