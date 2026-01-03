### Project Guidelines

#### Purpose
The Statamic Builder speeds up building Statamic sites by providing a fluent, PHP-based API to define sites, blueprints, fieldsets, collections, navigations, and taxonomies. This approach enhances code readability and maintainability by replacing traditional YAML configuration with PHP classes.

#### Build and Configuration

This project is a Statamic addon that integrates deeply with Statamic's core systems and provides a fluent API for
building blueprints and fieldsets.

- **Requirements**: PHP 8.2+, Statamic 5.4+, Laravel 10/11/12.
- **Installation**:
  ```bash
  composer install
  ```
- **Service Provider**: `Tdwesten\StatamicBuilder\ServiceProvider` is automatically registered via Laravel's package
  discovery. It handles component discovery, repository binding, and command registration.
- **Configuration**:
  Publish the configuration file to customize discovery paths and register components manually:
  ```bash
  php artisan vendor:publish --tag=statamic
  ```
- **Exporting to YAML**:
  If you need to generate standard Statamic YAML files from your PHP definitions:
  ```bash
  php artisan statamic-builder:export
  ```

#### Testing
The project uses [Pest](https://pestphp.com/) for testing, along with `orchestra/testbench` for Laravel/Statamic integration.

- **Configuring Tests**:
    - Tests extend `Tests\TestCase`, which boots the Statamic environment.
    - No additional database configuration is typically required as it uses in-memory storage for testing.
- **Running Tests**:
  Execute the following command to run the full test suite:
  ```bash
  ./vendor/bin/pest
  ```
  To run tests and static analysis (Rector):
  ```bash
  composer test
  ```
- **Adding Tests**:
    - Place new tests in `tests/Unit` or `tests/Feature`.
    - For new field types, use the generator to create a starting test: `composer generate-field MyField`.

**Verified Example Test Case:**
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

- **Mandatory Tasks**: Always perform the following tasks when completing a task or before submitting a pull request:
    - **Update README**: Ensure `README.md` reflects any new features or changes.
    - **Format Code**: Run `vendor/bin/pint` to maintain consistent code style.
    - **Run Tests**: Ensure all tests pass by running `./vendor/bin/pest`.
- **Code Style**: Follow PSR-12 and Laravel coding standards. `laravel/pint` is included for formatting.
- **Static Analysis/Refactoring**: Rector is used for automated refactoring and code quality. Run it via:
  ```bash
  ./vendor/bin/rector
  ```
- **Fluent API Design**: Always use the `make()` static method for instantiating fields and chainable setters (e.g.,
  `->displayName()`, `->instructions()`, `->required()`) for configuration.
- **Custom Field Types**: New field types should extend `Tdwesten\StatamicBuilder\FieldTypes\Field`.
- **Field Generator**:
  ```bash
  composer generate-field MyFieldName
  ```
  This command populates `src/FieldTypes/` and `tests/Unit/` using templates in the `field-generator/` directory.

#### Auto Registration & Discovery

The addon supports auto-discovery to avoid manual registration in `config/statamic/builder.php`.

- **Enable**: Set `'auto_registration' => true` in the config.
- **Requirements**:
    - **Blueprints**: Must implement `public static function handle(): string` and
      `public static function blueprintNamespace(): string`.
    - **Collections, Taxonomies, Globals, Navigations**: Must implement `public static function handle(): string`.
    - **Sites**: Must implement `public function handle(): string`.
- **Default Paths**: Components are discovered in `app/Blueprints`, `app/Collections`, etc. These can be customized in
  the `auto_discovery` configuration.
