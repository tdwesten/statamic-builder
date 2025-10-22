<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection;
use ReflectionClass;
use Statamic\Facades\Blink;
use Statamic\Fields\Blueprint as StatamicBlueprint;
use Statamic\Fields\BlueprintRepository as StatamicBlueprintRepository;
use Statamic\Support\Arr;
use Statamic\Support\Str;
use Tdwesten\StatamicBuilder\Blueprint;

class BlueprintRepository extends StatamicBlueprintRepository
{
    protected const BLINK_FROM_STATAMIC_BUILDER = 'statamic-builder-blueprint';

    /**
     * Get the blueprint directory, supporting both old (directory) and new (directories) property.
     * This ensures compatibility with Statamic v5.67.0+ where $directory was changed to $directories.
     */
    protected function getDirectory(): string
    {
        // Statamic v5.67.0+ uses $directories (array)
        if (property_exists($this, 'directories') && is_array($this->directories) && count($this->directories) > 0) {
            return $this->directories[0];
        }

        // Pre v5.67.0 uses $directory (string)
        if (property_exists($this, 'directory')) {
            return $this->directory;
        }

        // Fallback to default
        return 'resources/blueprints';
    }

    public function find($blueprint): ?StatamicBlueprint
    {
        [$namespace, $handle] = $this->getNamespaceAndHandle($blueprint);

        $builderBlueprint = $this->findBlueprint($namespace, $handle);

        if ($builderBlueprint) {
            $contents = $builderBlueprint->toArray();

            return $this->make($handle)
                ->setHidden(Arr::pull($contents, 'hide'))
                ->setOrder(Arr::pull($contents, 'order'))
                ->setNamespace($namespace ?? null)
                ->setContents($contents);
        }

        return parent::find($blueprint);
    }

    public static function findBlueprint($namespace, $handle): ?Blueprint
    {
        $registeredBlueprints = config('statamic.builder.blueprints', []);

        $namespace = str_replace('/', '.', $namespace);

        if (isset($registeredBlueprints[$namespace][$handle])) {
            return new $registeredBlueprints[$namespace][$handle]($handle);
        }

        if (isset($registeredBlueprints[$handle])) {
            if (is_string($registeredBlueprints[$handle])) {
                return new $registeredBlueprints[$handle]($handle);
            }
        }

        return null;
    }

    public static function findBlueprintPath($namespace, $handle): ?string
    {
        $blueprint = self::findBlueprint($namespace, $handle);

        if (! $blueprint) {
            return null;
        }

        $reflectionClass = new ReflectionClass($blueprint);
        $filePath = $reflectionClass->getFileName();

        return $filePath;

    }

    public static function findBlueprintInNamespace($namespace): Collection
    {
        $blink = 'statamic-builder-blueprints-'.$namespace;

        return Blink::store(self::BLINK_FROM_STATAMIC_BUILDER)->once($blink, function () use ($namespace) {

            $registeredBlueprints = collect(config('statamic.builder.blueprints', []));

            $namespace = str_replace('/', '.', $namespace);

            $blueprints = collect($registeredBlueprints->get($namespace, collect()));

            return $blueprints->map(function ($blueprint, $handle) {
                return new $blueprint($handle);
            });
        });
    }

    protected function makeBlueprintFromFile($path, $namespace = null)
    {
        // Support both old (directory) and new (directories) property names for Statamic v5.67.0+ compatibility
        $directory = $this->getDirectory();

        [$namespace, $handle] = $this->getNamespaceAndHandle(
            Str::after(Str::before($path, '.yaml'), $directory.'/')
        );

        $builderBlueprint = self::findBlueprint($namespace, $handle);

        if ($builderBlueprint) {
            $key = $namespace.'/'.$handle;

            return Blink::store(self::BLINK_FROM_FILE)->once($key, function () use ($path, $namespace, $builderBlueprint, $handle) {
                $contents = $builderBlueprint->toArray();

                return $this->make($handle)
                    ->setHidden(Arr::pull($contents, 'hide'))
                    ->setOrder(Arr::pull($contents, 'order'))
                    ->setInitialPath($path)
                    ->setNamespace($namespace ?? null)
                    ->setContents($contents);
            });
        }

        return parent::makeBlueprintFromFile($path, $namespace);
    }

    public function in(string $namespace)
    {
        $blueprints = parent::in($namespace);

        $builderBlueprints = self::findBlueprintInNamespace($namespace);

        $builderBlueprints = $builderBlueprints->map(function (Blueprint $blueprint, $handle) use ($namespace) {

            $contents = $blueprint->toArray();

            if (is_string($namespace)) {
                $namespace = str_replace('/', '.', $namespace);
            }

            return $this->make($handle)
                ->setHidden(Arr::pull($contents, 'hide'))
                ->setOrder(Arr::pull($contents, 'order'))
                ->setNamespace($namespace ?? null)
                ->setContents($contents);
        });

        return $blueprints->merge($builderBlueprints);
    }
}
