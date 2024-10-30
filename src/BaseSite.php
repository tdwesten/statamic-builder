<?php

namespace Tdwesten\StatamicBuilder;

abstract class BaseSite
{
    abstract function handle(): string;

    abstract function name(): string;

    abstract function url(): string;

    abstract function locale(): string;

    abstract function attributes(): array;

    public function toArray(): array
    {
        return  [
            'name' => $this->name(),
            'url' => $this->url(),
            'locale' => $this->locale(),
            'attributes' => $this->attributes(),   
        ];
    }
}