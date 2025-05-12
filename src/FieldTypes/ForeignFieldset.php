<?php

declare(strict_types=1);

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Tdwesten\StatamicBuilder\Contracts\Makeble;

class ForeignFieldset
{
    use Makeble;

    protected ?string $prefix;

    public function __construct(protected string $handle){}

    public static function make(string $handle): self
    {
        return new static($handle);
    }

    public function toArray(): array
    {
        return [
            'import' => $this->handle,
            'prefix' => $this->prefix ?? null,
        ];
    }

    public function prefix(string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }
}
