<?php

namespace Tdwesten\StatamicBuilder;

abstract class BaseSite
{
    abstract public function handle(): string;

    abstract public function name(): string;

    abstract public function url(): string;

    abstract public function locale(): string;

    abstract public function attributes(): array;

    public function toArray(): array
    {
        return [
            'name' => $this->name(),
            'url' => $this->url(),
            'locale' => $this->locale(),
            'attributes' => $this->attributes(),
        ];
    }
}
