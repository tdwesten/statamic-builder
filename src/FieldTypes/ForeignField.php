<?php

declare(strict_types=1);

namespace Tdwesten\StatamicBuilder\FieldTypes;

class ForeignField
{
    protected ?array $config;

    public function __construct(protected string $handle, protected string $field) {}

    public static function make(string $handle, string $field): self
    {
        return new static($handle, $field);
    }

    public function toArray(): array
    {
        return [
            'handle' => $this->handle,
            'field' => $this->field,
            'config' => $this->config ?? [],
        ];
    }

    public function field(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function config(?array $config): self
    {
        $this->config = $config;

        return $this;
    }
}
