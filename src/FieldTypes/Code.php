<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Enums\CodeIndentTypeOption;
use Tdwesten\StatamicBuilder\Enums\CodeKeyMapOption;
use Tdwesten\StatamicBuilder\Enums\CodeModeOption;

class Code extends Field
{
    use Makeble;

    protected $type = 'code';

    protected $mode = CodeModeOption::HTML;

    protected $mode_selectable = true;

    protected $indent_type = CodeIndentTypeOption::Spaces;

    protected $indent_size = 4;

    protected $key_map = CodeKeyMapOption::Default;

    protected $line_numbers = true;

    protected $line_wrapping = true;

    protected $rulers = [];

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'mode' => $this->mode->value,
            'mode_selectable' => $this->mode_selectable,
            'indent_type' => $this->indent_type->value,
            'indent_size' => $this->indent_size,
            'key_map' => $this->key_map->value,
            'line_numbers' => $this->line_numbers,
            'line_wrapping' => $this->line_wrapping,
            'rulers' => $this->rulers,
        ]);
    }

    public function mode(CodeModeOption $mode)
    {
        $this->mode = $mode;

        return $this;
    }

    public function modeSelectable(bool $mode_selectable)
    {
        $this->mode_selectable = $mode_selectable;

        return $this;
    }

    public function indentType(CodeIndentTypeOption $indent_type)
    {
        $this->indent_type = $indent_type;

        return $this;
    }

    public function indentSize(int $indent_size)
    {
        $this->indent_size = $indent_size;

        return $this;
    }

    public function keyMap(CodeKeyMapOption $key_map)
    {
        $this->key_map = $key_map;

        return $this;
    }

    public function lineNumbers(bool $line_numbers = true)
    {
        $this->line_numbers = $line_numbers;

        return $this;
    }

    public function lineWrapping(bool $line_wrapping = true)
    {
        $this->line_wrapping = $line_wrapping;

        return $this;
    }

    public function rulers(array $rulers)
    {
        $this->rulers = $rulers;

        return $this;
    }
}
