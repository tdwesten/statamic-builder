<?php

namespace Tdwesten\StatamicBuilder\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Statamic\Facades\YAML;
use Tdwesten\StatamicBuilder\BaseCollection;

class Export extends Command
{
    protected $signature = 'statamic-builder:export';

    protected $description = 'Export blueprints and fieldsets from the Statamic Builder to YAML.';

    protected $name = 'Statamic Builder Export';

    public function handle()
    {
        BaseCollection::$isExporting = true;

        $this->line('Exporting blueprints and fieldsets...');

        $this->newLine();

        $this->exportBlueprints();

        $this->exportFieldSets();

        $this->exportCollections();

        $this->newLine();

        $this->info('All done!');
    }

    private function exportCollections()
    {
        $namespaces = collect(config('statamic.builder.collections', []));

        $namespaces->each(function ($collections): void {
            $collections = collect($collections);

            $collections->each(function ($collection): void {
                $this->exportCollection($collection);
            });
        });
    }

    private function exportCollection($collection)
    {
        $filesystem = Storage::build([
            'driver' => 'local',
            'root' => base_path('resources/collections'),
        ]);

        $data = (new $collection)->register();

        $path = base_path("resources/collections/{$data->handle()}.yaml");

        $yaml = YAML::dump($data->toArray());

        $this->line("Exporting collection [{$data->handle()}] to [{$path}]");

        $filesystem->put("{$data->handle()}.yaml", $yaml);
    }

    private function exportBlueprints()
    {
        $namespaces = collect(config('statamic.builder.blueprints', []));

        $namespaces->each(function ($blueprints, $namespace): void {
            $blueprints = collect($blueprints);

            $blueprints->each(function ($blueprint, $handle) use ($namespace): void {
                $this->exportBlueprint($namespace, $handle, $blueprint);
            });
        });
    }

    private function exportBlueprint($namespace, $handle, $blueprint)
    {
        $namespace = str_replace('.', '/', $namespace);

        $filesystem = Storage::build([
            'driver' => 'local',
            'root' => base_path('resources/blueprints'),
        ]);

        $path = base_path("resources/blueprints/{$namespace}/{$handle}.yaml");

        $yaml = YAML::dump((new $blueprint($handle))->toArray());

        $this->line("Exporting blueprint [{$namespace}.{$handle}] to [{$path}]");

        $filesystem->put("{$namespace}/{$handle}.yaml", $yaml);
    }

    private function exportFieldSets()
    {
        $namespaces = collect(config('statamic.builder.fieldsets', []));

        $namespaces->each(function ($fieldset): void {
            $this->exportFieldset($fieldset);
        });
    }

    private function exportFieldset($fieldset)
    {

        $fieldset = new $fieldset;

        $handle = $fieldset->getSlug();

        $filesystem = Storage::build([
            'driver' => 'local',
            'root' => base_path('resources/fieldsets'),
        ]);

        $path = base_path("resources/fieldsets/{$handle}.yaml");

        $yaml = YAML::dump($fieldset->fieldsetToArray());

        $this->line("Exporting fieldset [{$handle}] to [{$path}]");

        $filesystem->put("{$handle}.yaml", $yaml);
    }
}
