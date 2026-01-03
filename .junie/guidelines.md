### Project Guidelines

#### Purpose
The Statamic Builder speeds up building Statamic sites by providing a fluent, PHP-based API to define sites, blueprints, fieldsets, collections, navigations, and taxonomies. This approach enhances code readability and maintainability by replacing traditional YAML configuration with PHP classes.

#### Build and Configuration
This project is a Statamic addon that provides a fluent API for building blueprints and fieldsets.

- **Requirements**: PHP 8.2+, Statamic 5.4+, Laravel 10/11/12.
- **Installation**: Run `composer install` to install dependencies.
- **Service Provider**: `Tdwesten\StatamicBuilder\ServiceProvider` is automatically registered via Laravel's package discovery.

#### Testing
The project uses [Pest](https://pestphp.com/) for testing, along with `orchestra/testbench` for Laravel/Statamic integration.

- **Running Tests**: Execute `./vendor/bin/pest` to run the full test suite.
- **Adding Tests**: New tests should be placed in the `tests/Unit` or `tests/Feature` directories. Tests should use the Pest syntax.
- **Test Case**: Most tests should extend `Tests\TestCase`, which in turn extends `Statamic\Testing\AddonTestCase`.

**Example Test Case (Fluent Blueprint Building):**
```php
<?php

use Tdwesten\StatamicBuilder\Blueprint;
use Tdwesten\StatamicBuilder\FieldTypes\Section;
use Tdwesten\StatamicBuilder\FieldTypes\Tab;
use Tdwesten\StatamicBuilder\FieldTypes\Text;

test('it can build a simple blueprint', function () {
    $blueprint = new class('test_handle') extends Blueprint {
        public function registerTabs(): array
        {
            return [
                Tab::make('main', [
                    Section::make('General', [
                        Text::make('title')->displayName('Title'),
                    ]),
                ]),
            ];
        }
    };

    $array = $blueprint->toArray();

    expect($blueprint->getHandle())->toBe('test_handle');
    expect($array['tabs']['main']['sections'][0]['display'])->toBe('General');
});
```

#### Development Information
- **Code Style**: Follow PSR-12 and Laravel coding standards. `laravel/pint` is included for formatting.
- **Static Analysis/Refactoring**: Rector is used for automated refactoring. Run `./vendor/bin/rector` to check for improvements.
- **Fluent API**: Use the `make()` static method and chainable setters (e.g., `->displayName()`, `->instructions()`) for field configuration.
- **Custom Field Types**: New field types should extend `Tdwesten\StatamicBuilder\FieldTypes\Field`.
- **Field Generator**: A custom field generator is available via `composer generate-field`.

#### Auto Registration & Discovery

The addon supports auto-discovery and registration of components to avoid manual entry in the configuration file.

- **Enable**: Set `'auto_registration' => true` in `config/statamic/builder.php`.
- **Requirements**:
    - **Blueprints**: Must implement `public static function handle(): string` and
      `public static function blueprintNamespace(): string`.
    - **Collections, Taxonomies, Globals, Navigations**: Must implement `public static function handle(): string`.
    - **Sites**: Must implement `public function handle(): string`.
- **Default Paths**: Components are discovered in `app/Blueprints`, `app/Collections`, etc. These can be customized in
  the `auto_discovery` configuration.
