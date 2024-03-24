[![CI](https://github.com/tdwesten/statamic-builder/actions/workflows/ci.yml/badge.svg)](https://github.com/tdwesten/statamic-builder/actions/workflows/ci.yml)

# Statamic Builder

Statamic Builder is a fluent blueprint and fieldset builder for Statamic. This means this provides you with a fluent way of defening your Statamic blueprints and fieldsets.

For example, you can define a collection blueprint like this:

```php
<?php

namespace App\Blueprints;

use Tdwesten\StatamicBuilder\Blueprint;
use Tdwesten\StatamicBuilder\FieldTypes\Section;
use Tdwesten\StatamicBuilder\FieldTypes\Text;
use Tdwesten\StatamicBuilder\FieldTypes\Tab;

class PageBlueprint extends Blueprint
{
    public $title = 'Page';

    public $handle = 'page';

    public $hidden = false;

    public function registerTabs(): Array
    {
        return [
            Tab::make('General', [
                Section::make('General', [
                    Text::make('title')
                        ->displayName('Title')
                        ->instructions('The title of the page')
                        ->required()
                ]),
            ]),
        ];
    }
}
```

## Features

This addon allows you to create blueprints and fieldsets in a fluent way. Also you can register collections and taxonomies for your Statamic application.

## Supported Fieldtypes

All the default fieldtypes are supported. And you can also use the `Field` class to implement custom fieldtypes. For example:

```php
Field::make('custom_field')
    ->withAttributes([
        'type' => 'custom_type',
        'display' => 'Custom Field',
        'instructions' => 'This is a custom field',
        'required' => true,
        'options' => [
            'option1' => 'Option 1',
            'option2' => 'Option 2',
        ],
    ]);
```

## How to Install

You can install this addon via composer:

```bash
composer require tdwesten/statamic-builder
```

## How to create a blueprint

1. Create a new blueprint by running the following command:

```bash
php artisan make:blueprint PageBlueprint
```

2. Define your blueprint in the generated file. For example:

```php
<?php

namespace App\Blueprints;

use Tdwesten\StatamicBuilder\Blueprint;
use Tdwesten\StatamicBuilder\FieldTypes\Assets;
use Tdwesten\StatamicBuilder\FieldTypes\Section;
use Tdwesten\StatamicBuilder\FieldTypes\Text;
use Tdwesten\StatamicBuilder\FieldTypes\Tab;

class PageBlueprint extends Blueprint
{
    public $title = 'Page';

    public $handle = 'page';

    public $hidden = false;

    public function registerTabs(): Array
    {
        return [
            Tab::make('General', [
                Section::make('General', [
                    Text::make('title')
                        ->displayName('Title')
                        ->instructions('The title of the page')
                        ->required(),
                    Assets::make('image')
                        ->displayName('Image')
                        ->maxItems(1)
                        ->instructions('The image of the page')
                        ->required(),
                ]),
            ]),
        ];
    }
}
```

3. Register the blueprint in your `config/statamic/builder.php` file:

```php
<?php
    return [
        'blueprints' => [
            'collections.pages' => [
                'page' => \App\Blueprints\PageBlueprint::class,
            ],
        ],
        'fieldsets' => [],
    ];
```

4. That's it! You can now use your blueprint in your Statamic application.

## How to create a fieldset

1. Create a new fieldset by running the following command:

```bash
php artisan make:fieldset HeroFieldset
```

2. Define your fieldset in the generated file. For example:

```php
<?php

namespace App\Fieldsets;

use Tdwesten\StatamicBuilder\Fieldset;
use Tdwesten\StatamicBuilder\FieldTypes\Assets;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

class HeroFieldset extends Fieldset
{
    public function registerFields(): array
    {
        return [
            Text::make('title')
                ->displayName('Title')
                ->instructions('The title of the hero')
                ->required(),
            Assets::make('image')
                ->displayName('Image')
                ->maxItems(1)
                ->instructions('The image of the hero')
                ->required(),
        ];
    }
}
```

3. Register the fieldset in your `config/statamic/builder.php` file:

```php
<?php
    return [
        'blueprints' => [],
        'fieldsets' => [
            \App\Fieldsets\HeroFieldset::class,
        ],
    ];
```

4. Now you can use your fieldset in your blueprints. For example:

```php
<?php

namespace App\Blueprints;

use App\Fieldsets\HeroFieldset;
use Tdwesten\StatamicBuilder\Blueprint;

class PageBlueprint extends Blueprint
{
    public $title = 'Page';

    public $handle = 'page';

    public $hidden = false;

    public function registerTabs(): Array
    {
        return [
            Tab::make('General', [
                Section::make('General', [
                    HeroFieldset::make('hero'),
                ]),
            ]),
        ];
    }
}
```

5. That's it! You can now use your fieldset in your Statamic application.

## How to register a collection

1. Generate a new collection blueprint:

```bash
php artisan make:collection Articles
```

2. Define your collection:

```php
<?php

namespace App\Collections;

use Statamic\Facades\Site;
use Tdwesten\StatamicBuilder\BaseCollection;

class Articles extends BaseCollection
{
    /**
     * Return the handle for the collection
     *
     * Example: return 'blog';
     */
    public static function handle(): string
    {
        return 'articles';
    }

    /**
     * Return the title for the collection
     *
     * Example: return 'Blog';
     */
    public function title(): string
    {
        return 'Articles';
    }
    ...
}
```

3. Add the collection to the `config/statamic/builder.php` file:

```php
<?php
    return [
        'collections' => [
            \App\Collections\Articles::class,
        ],
    ];
```

## How to register a taxonomy

1. Generate a new taxonomy blueprint:

```bash
php artisan make:taxonomy Categories
```

2. Define your taxonomy:

```php
<?php

namespace App\Taxonomies;

use Statamic\Facades\Site;
use Tdwesten\StatamicBuilder\BaseTaxonomy;

class Categories extends BaseTaxonomy
{
    /**
     * Return the handle for the taxonomy
     *
     * Example: return 'tags';
     */
    public static function handle(): string
    {
        // TODO: Change to your taxonomy handle

        return 'categories';
    }

    /**
     * Return the title for the taxonomy
     *
     * Example: return 'Tags';
     */
    public function title(): string
    {
        // TODO: Change to your taxonomy title

        return 'Categories';
    }

    ...
}
```

3. Add the taxonomy to the `config/statamic/builder.php` file:

```php
<?php
    return [
        'taxonomies' => [
            \App\Taxonomies\Categories::class,
        ],
    ];
```
