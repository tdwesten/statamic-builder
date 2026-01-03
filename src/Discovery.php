<?php

namespace Tdwesten\StatamicBuilder;

use Illuminate\Support\Facades\File;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

class Discovery
{
    public function discover()
    {
        if (! config('builder.auto_registration', false)) {
            return;
        }

        $this->discoverCollections();
        $this->discoverBlueprints();
        $this->discoverFieldsets();
        $this->discoverTaxonomies();
        $this->discoverGlobals();
        $this->discoverNavigations();
        $this->discoverSites();
    }

    protected function discoverCollections()
    {
        $path = config('builder.auto_discovery.collections');
        if (! $path || ! File::isDirectory($path)) {
            return;
        }

        $classes = $this->discoverClasses($path, BaseCollection::class);

        $collections = config('builder.collections', []);
        foreach ($classes as $class) {
            if (! in_array($class, $collections)) {
                $collections[] = $class;
            }
        }
        config(['builder.collections' => $collections]);
    }

    protected function discoverBlueprints()
    {
        $path = config('builder.auto_discovery.blueprints');
        if (! $path || ! File::isDirectory($path)) {
            return;
        }

        $classes = $this->discoverClasses($path, Blueprint::class);

        $blueprints = config('builder.blueprints', []);
        foreach ($classes as $class) {
            $handle = $class::handle();
            $namespace = $class::blueprintNamespace();

            if ($handle && $namespace) {
                $blueprints[$namespace][$handle] = $class;
            }
        }
        config(['builder.blueprints' => $blueprints]);
    }

    protected function discoverFieldsets()
    {
        $path = config('builder.auto_discovery.fieldsets');
        if (! $path || ! File::isDirectory($path)) {
            return;
        }

        $classes = $this->discoverClasses($path, Fieldset::class);

        $fieldsets = config('builder.fieldsets', []);
        foreach ($classes as $class) {
            if (! in_array($class, $fieldsets)) {
                $fieldsets[] = $class;
            }
        }
        config(['builder.fieldsets' => $fieldsets]);
    }

    protected function discoverTaxonomies()
    {
        $path = config('builder.auto_discovery.taxonomies');
        if (! $path || ! File::isDirectory($path)) {
            return;
        }

        $classes = $this->discoverClasses($path, BaseTaxonomy::class);

        $taxonomies = config('builder.taxonomies', []);
        foreach ($classes as $class) {
            if (! in_array($class, $taxonomies)) {
                $taxonomies[] = $class;
            }
        }
        config(['builder.taxonomies' => $taxonomies]);
    }

    protected function discoverGlobals()
    {
        $path = config('builder.auto_discovery.globals');
        if (! $path || ! File::isDirectory($path)) {
            return;
        }

        $classes = $this->discoverClasses($path, BaseGlobalSet::class);

        $globals = config('builder.globals', []);
        foreach ($classes as $class) {
            if (! in_array($class, $globals)) {
                $globals[] = $class;
            }
        }
        config(['builder.globals' => $globals]);
    }

    protected function discoverNavigations()
    {
        $path = config('builder.auto_discovery.navigations');
        if (! $path || ! File::isDirectory($path)) {
            return;
        }

        $classes = $this->discoverClasses($path, BaseNavigation::class);

        $navigations = config('builder.navigations', []);
        foreach ($classes as $class) {
            if (! in_array($class, $navigations)) {
                $navigations[] = $class;
            }
        }
        config(['builder.navigations' => $navigations]);
    }

    protected function discoverSites()
    {
        $path = config('builder.auto_discovery.sites');
        if (! $path || ! File::isDirectory($path)) {
            return;
        }

        $classes = $this->discoverClasses($path, BaseSite::class);

        $sites = config('builder.sites', []);
        foreach ($classes as $class) {
            if (! in_array($class, $sites)) {
                $sites[] = $class;
            }
        }
        config(['builder.sites' => $sites]);
    }

    protected function discoverClasses($path, $baseClass)
    {
        $classes = [];
        $finder = new Finder;
        $finder->files()->in($path)->name('*.php');

        foreach ($finder as $file) {
            $class = $this->getClassFromFile($file->getRealPath());
            if ($class && class_exists($class)) {
                $reflection = new ReflectionClass($class);
                if ($reflection->isSubclassOf($baseClass) && ! $reflection->isAbstract()) {
                    $classes[] = $class;
                }
            }
        }

        return $classes;
    }

    protected function getClassFromFile($path)
    {
        $contents = file_get_contents($path);
        $namespace = '';
        if (preg_match('/namespace\s+(.+?);/', $contents, $matches)) {
            $namespace = $matches[1];
        }

        $class = '';
        if (preg_match('/class\s+(\w+)/', $contents, $matches)) {
            $class = $matches[1];
        }

        return $namespace ? $namespace.'\\'.$class : $class;
    }
}
