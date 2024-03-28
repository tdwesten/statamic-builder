<?php

namespace Tdwesten\StatamicBuilder\FieldTypes;

use Illuminate\Support\Collection;
use Tdwesten\StatamicBuilder\Contracts\Fullscreen;
use Tdwesten\StatamicBuilder\Contracts\Makeble;
use Tdwesten\StatamicBuilder\Enums\BardButton;
use Tdwesten\StatamicBuilder\Enums\BardInlineOption;
use Tdwesten\StatamicBuilder\Enums\BardToolbarMode;
use Tdwesten\StatamicBuilder\Exceptions\BlueprintRenderException;

class Bard extends Field
{
    use Fullscreen;
    use Makeble;

    protected $type = 'bard';

    protected Collection $buttons;

    protected bool $smart_typography = false;

    protected bool $save_html = false;

    protected $inline;

    protected $toolbar_mode;

    protected $reading_time = false;

    protected $word_count = false;

    protected $allow_source = true;

    protected $enable_input_rules = true;

    protected $enable_paste_rules = true;

    protected $remove_empty_nodes = false;

    protected $character_limit;

    protected $link_noopener = false;

    protected $link_noreferrer = false;

    protected $target_blank = false;

    protected $link_collections = false;

    protected $container;

    protected $always_show_set_button = false;

    protected $collapse = false;

    protected $previews = true;

    protected $setGroups;

    public function __construct(string $handle, array $setGroups = [])
    {
        parent::__construct($handle);

        $this->setGroups = collect($setGroups);

        $this->buttons = collect([]);
    }

    public function fieldToArray(): Collection
    {
        return collect([
            'buttons' => $this->buttonsToArray(),
            'smart_typography' => $this->smart_typography,
            'fullscreen' => $this->fullscreen,
            'save_html' => $this->save_html,
            'inline' => $this->inline?->toArray(),
            'toolbar_mode' => $this->toolbar_mode?->value(),
            'reading_time' => $this->reading_time,
            'word_count' => $this->word_count,
            'allow_source' => $this->allow_source,
            'enable_input_rules' => $this->enable_input_rules,
            'enable_paste_rules' => $this->enable_paste_rules,
            'remove_empty_nodes' => $this->remove_empty_nodes,
            'character_limit' => $this->character_limit,
            'link_noopener' => $this->link_noopener,
            'link_noreferrer' => $this->link_noreferrer,
            'target_blank' => $this->target_blank,
            'link_collections' => $this->link_collections,
            'container' => $this->container,
            'always_show_set_button' => $this->always_show_set_button,
            'collapse' => $this->collapse,
            'previews' => $this->previews,
            'sets' => $this->setGroupsToArray(),
        ]);
    }

    public function buttonsToArray(): array
    {
        return $this->buttons->map(function ($button) {
            return $button instanceof BardButton ? $button?->value : $button;
        })->all();
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

    public function validateField()
    {
        if (
            ($this->buttons->contains(BardButton::Anchor) || $this->buttons->contains(BardButton::Image)) &&
            $this->container === null
        ) {
            throw new BlueprintRenderException('Bard field with anchor or image buttons must have a container');
        }
    }

    /**
     * @param  BardButton[]|string[]  $buttons
     * @return $this
     */
    public function buttons(array $buttons)
    {
        $this->buttons->push(...$buttons);

        return $this;
    }

    public function smartTypography(bool $smart_typography = true)
    {
        $this->smart_typography = $smart_typography;

        return $this;
    }

    public function saveHtml(bool $save_html = true)
    {
        $this->save_html = $save_html;

        return $this;
    }

    public function inline(BardInlineOption $inline)
    {
        $this->inline = $inline;

        return $this;
    }

    public function toolbarMode(BardToolbarMode $toolbar_mode)
    {
        $this->toolbar_mode = $toolbar_mode;

        return $this;
    }

    public function readingTime(bool $reading_time = true)
    {
        $this->reading_time = $reading_time;

        return $this;
    }

    public function wordCount(bool $word_count = true)
    {
        $this->word_count = $word_count;

        return $this;
    }

    public function allowSource(bool $allow_source = true)
    {
        $this->allow_source = $allow_source;

        return $this;
    }

    public function enableInputRules(bool $enable_input_rules = true)
    {
        $this->enable_input_rules = $enable_input_rules;

        return $this;
    }

    public function enablePasteRules(bool $enable_paste_rules = true)
    {
        $this->enable_paste_rules = $enable_paste_rules;

        return $this;
    }

    public function removeEmptyNodes(bool $remove_empty_nodes = true)
    {
        $this->remove_empty_nodes = $remove_empty_nodes;

        return $this;
    }

    public function characterLimit(int $character_limit)
    {
        $this->character_limit = $character_limit;

        return $this;
    }

    public function linkNoopener(bool $link_noopener = true)
    {
        $this->link_noopener = $link_noopener;

        return $this;
    }

    public function linkNoreferrer(bool $link_noreferrer = true)
    {
        $this->link_noreferrer = $link_noreferrer;

        return $this;
    }

    public function targetBlank(bool $target_blank = true)
    {
        $this->target_blank = $target_blank;

        return $this;
    }

    public function linkCollections(bool $link_collections = true)
    {
        $this->link_collections = $link_collections;

        return $this;
    }

    public function container(string $container)
    {
        $this->container = $container;

        return $this;
    }

    public function alwaysShowSetButton(bool $always_show_set_button = true)
    {
        $this->always_show_set_button = $always_show_set_button;

        return $this;
    }

    public function collapse(bool $collapse = true)
    {
        $this->collapse = $collapse;

        return $this;
    }

    public function previews(bool $previews = true)
    {
        $this->previews = $previews;

        return $this;
    }
}
