<?php

namespace Tdwesten\StatamicBuilder\Repositories;

use Illuminate\Support\Collection;
use Statamic\Facades\Blink;
use Statamic\Facades\File;
use Statamic\Facades\YAML;
use Statamic\Fields\Blueprint as StatamicBlueprint;
use Statamic\Fields\BlueprintRepository as StatamicBlueprintRepository;
use Statamic\Support\Arr;
use Statamic\Support\Str;
use Tdwesten\StatamicBuilder\Blueprint;

class BlueprintRepository extends StatamicBlueprintRepository
{
    public function find($blueprint): ?StatamicBlueprint
    {
        Blink::store(self::BLINK_FOUND)->forget($blueprint);

        return Blink::store(self::BLINK_FOUND)->once($blueprint, function () use ($blueprint) {
            [$namespace, $handle] = $this->getNamespaceAndHandle($blueprint);
            if (! $blueprint) {
                return null;
            }

            $builderBlueprint = $this->findBlueprint($namespace, $handle);

            if (! $builderBlueprint) {
                // Fall back to the standard blueprint find method.
                $parts = explode('::', $blueprint);

                $path = count($parts) > 1
                    ? $this->findNamespacedBlueprintPath($blueprint)
                    : $this->findStandardBlueprintPath($blueprint);

                return $path !== null && File::exists($path)
                    ? $this->makeBlueprintFromFile($path, count($parts) > 1 ? $parts[0] : null)
                    : $this->findFallback($blueprint);
            }

            $contents = $builderBlueprint->toArray();

            return $this->make($handle)
                ->setHidden(Arr::pull($contents, 'hide'))
                ->setOrder(Arr::pull($contents, 'order'))
                ->setInitialPath('')
                ->setNamespace($namespace ?? null)
                ->setContents($contents);
        });
    }

    public static function findBlueprint($namespace, $handle): ?Blueprint
    {
        $registeredBlueprints = config('statamic.builder.blueprints', []);

        if (! isset($registeredBlueprints[$namespace][$handle])) {
            return null;
        }

        return new $registeredBlueprints[$namespace][$handle]($handle);
    }

    public static function findBlueprintInNamespace($namespace): Collection
    {
        $registeredBlueprints = collect(config('statamic.builder.blueprints', []));

        $namespace = str_replace('/', '.', $namespace);

        $blueprints = collect($registeredBlueprints->get($namespace, collect()));

        return $blueprints->map(function ($blueprint, $handle) {
            return new $blueprint($handle);
        });
    }

    protected function makeBlueprintFromFile($path, $namespace = null)
    {
        return Blink::store(self::BLINK_FROM_FILE)->once($path, function () use ($path, $namespace) {
            if (! $namespace || ! isset($this->additionalNamespaces[$namespace])) {
                [$namespace, $handle] = $this->getNamespaceAndHandle(
                    Str::after(Str::before($path, '.yaml'), $this->directory.'/')
                );
            } else {
                $handle = Str::of($path)->afterLast('/')->before('.');
            }

            $builderBlueprint = self::findBlueprint($namespace, $handle);

            if (! $builderBlueprint) {
                $contents = YAML::file($path)->parse();
            } else {
                $contents = $builderBlueprint->toArray();
            }

            return $this->make($handle)
                ->setHidden(Arr::pull($contents, 'hide'))
                ->setOrder(Arr::pull($contents, 'order'))
                ->setInitialPath($path)
                ->setNamespace($namespace ?? null)
                ->setContents($contents);
        });
    }

    public function in(string $namespace)
    {
        $blueprints = parent::in($namespace);

        $builderBlueprints = self::findBlueprintInNamespace($namespace);

        $builderBlueprints = $builderBlueprints->map(function (Blueprint $blueprint, $handle) use ($namespace) {

            $contents = $blueprint->toArray();

            return $this->make($handle)
                ->setHidden(Arr::pull($contents, 'hide'))
                ->setOrder(Arr::pull($contents, 'order'))
                ->setNamespace($namespace ?? null)
                ->setContents($contents);
        });

        return $blueprints->merge($builderBlueprints);
    }
}
