<?php

namespace Tdwesten\StatamicBuilder\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Statamic\Facades\YAML;
use Statamic\Filesystem\FlysystemAdapter;
use Touhidurabir\StubGenerator\Facades\StubGenerator;

class Importer extends Command
{
    protected $signature = 'statamic-builder:import';

    protected $description = 'Import YAML files to Statamic blueprints and fieldsets';

    protected $name = 'Statamic Builder Importer';

    protected FlysystemAdapter $filesystem;

    protected Collection $useStatements;

    public function handle()
    {
        $this->info('Importing blueprints and fieldsets...');

        $adapter = Storage::build([
            'driver' => 'local',
            'root' => base_path('resources/blueprints'),
        ]);

        $this->filesystem = new FlysystemAdapter($adapter);

        $this->importBlueprints();
    }

    private function importBlueprints()
    {
        $blueprints = $this->getBlueprints();

        $blueprints->each(function ($path) {
            $contents = $this->getContents($path);

            $this->importBlueprint($contents);
        });
    }

    private function importBlueprint($contents)
    {
        $title = $contents['title'];
        $fields = $contents['fields'];

        $className = $this->generateClassName($title);
        $filename = $this->generateFilename($title);

        StubGenerator::from('../../stubs/BlueprintImport.stub')
            ->to(app_path("/Blueprints/{$filename}"))
            ->as($className)
            ->ext('php')
            ->withReplacers([
                'title' => $title,
                'namespace' => 'App\Blueprints',
                'className' => $className,
                'handle' => Str::snake($title),
                'hidden' => $contents['hide'] ?? false,
                'useStatements' => $this->generateUseStatements(),
                'contents' => $this->generateContents($fields),
            ])
            ->save();
    }

    private function generateUseStatements()
    {
        $this->useStatements = collect($this->useStatements);

        return $this->useStatements->map(function ($useStatement) {
            return "use {$useStatement};";
        })->implode("\n");
    }

    private function generateContents($fields)
    {
        $contents = collect($fields)->map(function ($field) {
            $type = $field['type'];
            $handle = $field['handle'];
            $fieldType = $this->getFieldType($type);

            $this->useStatements->push($fieldType);

            return [
                'handle' => $handle,
                'field' => $this->generateField($field),
            ];
        });

        return $contents->map(function ($content) {
            return $this->generateFieldContent($content);
        })->implode("\n");
    }

    private function generateClassName($title)
    {
        return Str::studly($title).'Blueprint';

    }

    private function getContents($path)
    {
        $contents = $this->filesystem->get($path);

        return YAML::parse($contents);
    }

    private function getBlueprints()
    {
        $filePaths = $this->filesystem->getFilesRecursively('/');

        return collect($filePaths);
    }
}
