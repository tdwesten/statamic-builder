<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;

class Link extends Field
{
    use Makeble;

    protected $type = 'link';

    protected $collections;

    protected $container;

    public function __construct(string $handle)
    {
        parent::__construct($handle);

        $this->collections = collect([]);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'collections' => $this->collections->toArray(),
            'container' => $this->container,
        ]);
    }

    public function collections(array $collections)
    {
        $this->collections = collect($collections);

        return $this;
    }

    public function container(string $container)
    {
        $this->container = $container;

        return $this;
    }
}
