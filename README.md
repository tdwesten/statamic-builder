[![Latest Version on Packagist](https://img.shields.io/packagist/v/tdwesten/statamic-builder.svg?style=flat-square)](https://packagist.org/packages/tdwesten/statamic-builder)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/tdwesten/statamic-builder/ci.yml?branch=main&label=tests&style=flat-square)](https://github.com/tdwesten/statamic-builder/actions/workflows/ci.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/tdwesten/statamic-builder.svg?style=flat-square)](https://packagist.org/packages/tdwesten/statamic-builder)

![Github](https://github.com/tdwesten/statamic-builder/assets/224501/fb3da5da-6035-4ca4-9d70-3509c8b626c6)

# Statamic Builder

The Statamic Builder speeds up building Statamic sites. It offers a clear method to define sites, blueprints, fieldsets, collections, naviations and taxonomies using PHP classes. This approach enhances code readability and maintainability compared to writing YAML files.

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

## How to register Collections and Taxonomies

This addon enables you to define collections and taxonomies in PHP classes, simplifying the process of defining and managing them.

### How to register a collection

1. Generate a new collection blueprint, for example for an articles collection blueprint run the following command:

   ```bash
   php artisan make:collection Articles
   ```

2. Define your Articles collection blueprint in the generated file. For example, the file has all options available to define a collection blueprint. For example:

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

1. Generate a new taxonomy blueprint, for example for a categories taxonomy blueprint run the following command:

   ```bash
   php artisan make:taxonomy Categories
   ```

2. Define your taxonomy in the generated file. For example, the file has all options available to define a taxonomy. For example:

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


       public function title(): string
       {
           return 'Site Settings';
       }

       // Add more options here...
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

### How to create a Site

> [!WARNING]  
The sites are cached forever. When adding a site, you need to clear the cache.

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
