[![CI](https://github.com/tdwesten/statamic-builder/actions/workflows/ci.yml/badge.svg)](https://github.com/tdwesten/statamic-builder/actions/workflows/ci.yml)

> [!WARNING]
> This addon is still in Alpha and should not be used in production environments.

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

This addon allows you to create:

- [x] Collection blueprints
- [x] Global blueprints
- [x] Fieldsets
- [ ] Taxonomy blueprints (comming!)
- [ ] Navigation blueprints (comming!)
- [ ] Asset container blueprints (comming!)
- [ ] User blueprints (comming!)

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

More documentation will be added soon.
