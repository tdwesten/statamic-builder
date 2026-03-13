<?php

namespace Tests\Helpers;

use Tdwesten\StatamicBuilder\Fieldset;
use Tdwesten\StatamicBuilder\FieldTypes\Link;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

class TestFieldset extends Fieldset
{
    public function registerFields(): array
    {
        return [
            Text::make('title')
                ->displayName('Title')
                ->instructions('This is a title'),
            Text::make('description')
                ->displayName('Description')
                ->instructions('This is a description'),
            Link::make('link')
                ->displayName('Link')
                ->instructions('This is a link'),
        ];
    }
}
