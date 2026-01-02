[![Latest Version on Packagist](https://img.shields.io/packagist/v/tdwesten/statamic-builder.svg?style=flat-square)](https://packagist.org/packages/tdwesten/statamic-builder)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/tdwesten/statamic-builder/ci.yml?branch=main&label=tests&style=flat-square)](https://github.com/tdwesten/statamic-builder/actions/workflows/ci.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/tdwesten/statamic-builder.svg?style=flat-square)](https://packagist.org/packages/tdwesten/statamic-builder)

![Github](https://github.com/tdwesten/statamic-builder/assets/224501/fb3da5da-6035-4ca4-9d70-3509c8b626c6)

# Statamic Builder

The Statamic Builder speeds up building Statamic sites. It offers a clear method to define sites, blueprints, fieldsets,
collections, navigations and taxonomies using PHP classes. This approach enhances code readability and maintainability
compared to writing YAML files.

For example, you can define a collection blueprint as follows:

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
                        ->localizable()
                        ->required()
                ]),
            ]),
        ];
    }
}
```

## Installation

You can install this addon with composer. Run the following command in your terminal to install the addon.

```bash
composer require tdwesten/statamic-builder
```

## Blueprints and Fieldsets

This addon allows you to create blueprints and fieldsets in a fluent way. This makes it easier to define and maintain your blueprints and fieldsets.

### How to create a blueprint

1. Create a new blueprint by running the following command for a page blueprint for example:

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
       ];
   ```

4. That's it! You can now use your blueprint in your Statamic application.

### How to create a fieldset

1. Create a new fieldset by running the following command for a hero fieldset for example:

   ```bash
   php artisan make:fieldset HeroFieldset
   ```

2. Define your fieldset in the generated file. For example add a title and image field to the hero fieldset:

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
           'blueprints' => [
               'collections.pages' => [
                   'page' => \App\Blueprints\PageBlueprint::class,
               ],
           ],
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
### Working with foreign fieldset
When working with a mixed Codebase or while using other Statamic plugins you can use their provided Fieldsets with the `ForeignFieldset` and `ForeignField` class which implement similar to the Statamic Standard Import.

```php
   <?php

   namespace App\Blueprints;

   use Tdwesten\StatamicBuilder\Blueprint;
   use Tdwesten\StatamicBuilder\FieldTypes\ForeignField;
   use Tdwesten\StatamicBuilder\FieldTypes\ForeignFieldset;

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
                        ForeignFieldset::make('statamic-peak-seo::seo_basic')
                            ->prefix('myseo_'),
                        ForeignField::make('mytext','foreign_fields.bard')
                            ->config([
                                'width'=>'25',
                                'display' => "My bard Field",
                                'validate' => 'required|string|max:3',
                            ])
                   ]),
               ]),
           ];
       }
   }
```

### Supported Fieldtypes

All default Statamic field types are supported. You can create custom field types by utilizing the `Field` class. For example to create a custom field type you can use the following code:

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
        // Add more attributes here...
    ]);
```

### Custom field generator

A custom field generator is available to quickly create new field types. Run the following command in your terminal:

```bash
composer generate-field MyField
```

This will create a new field class in `src/FieldTypes/` and a test class in `tests/Unit/`.

## How to register Collections, Taxonomies, Globals and Navigations

This addon enables you to define collections, taxonomies, globals and navigations in PHP classes, simplifying the
process of defining and managing them.

### How to register a collection

1. Generate a new collection, for example for an articles collection run the following command:

   ```bash
   php artisan make:collection Articles
   ```

2. Define your Articles collection in the generated file. For example:

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

       // Add more options here...
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

### How to register a taxonomy

1. Generate a new taxonomy, for example for a categories taxonomy run the following command:

   ```bash
   php artisan make:taxonomy Categories
   ```

2. Define your taxonomy in the generated file. For example:

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

       // Add more options here...
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

### How to register a global set

1. Generate a new global set, for example for a SiteSettings global set run the following command:

   ```bash
   php artisan make:global-set SiteSettings
   ```

2. Define your global set in the generated file. For example:

   ```php
   <?php

   namespace App\Globals;

   use Tdwesten\StatamicBuilder\BaseGlobalSet;

   class SiteSettings extends BaseGlobalSet
   {
       /**
        * Return the handle for the global set
        */
       public static function handle(): string
       {
           return 'site_settings';
       }

       /**
        * Return the title for the global set
        */
       public function title(): string
       {
           return 'Site Settings';
       }

       /**
        * Return the sites for the global set
        */
       public function sites(): array
       {
           return ['default'];
       }
   }
   ```

3. Add the global set to the `config/statamic/builder.php` file:

   ```php
   <?php
       return [
           'globals' => [
               \App\Globals\SiteSettings::class,
           ],
       ];
   ```

### How to register a navigation

1. Generate a new navigation, for example for a Main navigation run the following command:

   ```bash
   php artisan make:navigation Main
   ```

2. Define your navigation in the generated file. For example:

   ```php
   <?php

   namespace App\Navigations;

   use Tdwesten\StatamicBuilder\BaseNavigation;

   class Main extends BaseNavigation
   {
       /**
        * Return the handle for the navigation
        */
       public static function handle(): string
       {
           return 'main';
       }

       /**
        * Return the title for the navigation
        */
       public function title(): string
       {
           return 'Main Navigation';
       }

       public function collections(): array
       {
           return ['pages'];
       }

       public function expectsRoot(): bool
       {
           return true;
       }

       public function maxDepth(): ?int
       {
           return 3;
       }

       public function sites(): array
       {
           return ['default'];
       }
   }
   ```

3. Add the navigation to the `config/statamic/builder.php` file:

   ```php
   <?php
       return [
           'navigations' => [
               \App\Navigations\Main::class,
           ],
       ];
   ```

### How to create a Site

> [!WARNING]  
> The sites are cached forever. When adding a site, you need to clear the cache.

1. Create a new site by running the following command:

   ```bash
   php artisan make:site Blog
   ```

2. Define your site in the generated file. For example:

    ```php
    <?php

    namespace App\Sites;

    use Tdwesten\StatamicBuilder\BaseSite;

    class Blog extends BaseSite
    {
        /**
         * Return the handle for the site
         *
         * Example: return 'default';
         */
        public function handle(): string
        {
            return 'blog';
        }

        /**
         * Return the handle for the site
         *
         * Example: return 'Default';
         */
        public function name(): string
        {
            return 'Blog';
        }

        /**
         * Return the base url for the site
         *
         * Example: return '/';
         */
        public function url(): string
        {
            return '/blog';
        }

        /**
         * Return the locale of the site
         *
         * Example: return '/';
         */
        public function locale(): string
        {
            return 'en_US';
        }

        /**
         * Return the array of extra attributes for the site
         *
         * Example: return ['foo' => 'bar'];
         */
        public function attributes(): array
        {
            return [];
        }
    }
    ```

3. Register the Site in your `config/statamic/builder.php` file:

    ```php
    <?php
        return [
            'sites' => [
                \App\Sites\Blog::class
            ],
        ];
    ```

4. Clear the cache:
```bash
   php artisan cache:clear
```

## Exporting to YAML

If you want to export your PHP-defined blueprints, fieldsets, and collections to YAML files, you can use the following
command:

```bash
php artisan statamic-builder:export
```

This will generate the YAML files in the `resources/blueprints`, `resources/fieldsets`, and `resources/collections`
directories.
