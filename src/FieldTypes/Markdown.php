<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\DefaultValue;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Enums\MarkdownButtonOption;

class Markdown extends Field
{
    use DefaultValue;
    use Makeble;

    protected $type = 'markdown';

    protected $container;

    protected $folder;

    protected $restrict;

    protected $buttons = [
        MarkdownButtonOption::Bold,
        MarkdownButtonOption::Italic,
        MarkdownButtonOption::Unorderedlist,
        MarkdownButtonOption::Orderedlist,
        MarkdownButtonOption::Quote,
        MarkdownButtonOption::Link,
        MarkdownButtonOption::Image,
        MarkdownButtonOption::Table,
    ];

    protected $automatic_line_breaks = true;

    protected $automatic_links = false;

    protected $escape_markup = false;

    protected $heading_anchors = false;

    protected $smartypants = false;

    protected $table_of_contents = false;

    protected $parser;

    public function __construct(string $handle)
    {
        parent::__construct($handle);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'container' => $this->container,
            'folder' => $this->folder,
            'restrict' => $this->restrict,
            'buttons' => $this->buttonsToArray(),
            'automatic_line_breaks' => $this->automatic_line_breaks,
            'automatic_links' => $this->automatic_links,
            'escape_markup' => $this->escape_markup,
            'heading_anchors' => $this->heading_anchors,
            'smartypants' => $this->smartypants,
            'table_of_contents' => $this->table_of_contents,
            'parser' => $this->parser,
        ]);
    }

    protected function buttonsToArray(): array
    {
        return collect($this->buttons)->map(function ($button) {
            return $button->value;
        })->toArray();
    }

    public function container(string $container): self
    {
        $this->container = $container;

        return $this;
    }

    public function folder(string $folder): self
    {
        $this->folder = $folder;

        return $this;
    }

    public function restrict(string $restrict): self
    {
        $this->restrict = $restrict;

        return $this;
    }

    public function buttons(array $buttons): self
    {
        $this->buttons = $buttons;

        return $this;
    }

    public function automaticLineBreaks(bool $automatic_line_breaks = true): self
    {
        $this->automatic_line_breaks = $automatic_line_breaks;

        return $this;
    }

    public function automaticLinks(bool $automatic_links = true): self
    {
        $this->automatic_links = $automatic_links;

        return $this;
    }

    public function escapeMarkup(bool $escape_markup = true): self
    {
        $this->escape_markup = $escape_markup;

        return $this;
    }

    public function headingAnchors(bool $heading_anchors = true): self
    {
        $this->heading_anchors = $heading_anchors;

        return $this;
    }

    public function smartypants(bool $smartypants = true): self
    {
        $this->smartypants = $smartypants;

        return $this;
    }

    public function tableOfContents(bool $table_of_contents = true): self
    {
        $this->table_of_contents = $table_of_contents;

        return $this;
    }

    public function parser(string $parser): self
    {
        $this->parser = $parser;

        return $this;
    }
}
