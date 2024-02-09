<?php

namespace Tdwesten\StatamicBuilder\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Statamic\Facades\YAML;
use Statamic\Filesystem\FlysystemAdapter;
use Tdwesten\StatamicBuilder\Blueprint;

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
        $namespace = new \Nette\PhpGenerator\PhpNamespace('App\Blueprints');

        $title = $contents['title'];
        $handle = Str::slug($title);
        $hidden = $contents['hidden'];

        $className = $this->generateClassName($title);
        $filename = $this->generateFilename($title);

        $class = $namespace->addClass($className);
        $class->setExtends(Blueprint::class);

        // Add properties
        $class->addProperty('title', $title);
        $class->addProperty('handle', $handle);
        $class->addProperty('hidden', $hidden);

        // Add register function

        $registerMethod = $class->addMethod('register')
            ->setReturnType('Blueprint')
            ->setBody($this->generateRegisterBody($contents));
        $registerMethod->addBody('test');

        $printer = new \Nette\PhpGenerator\Printer;

        ray($printer->printClass($class));

    }

    private function generateUseStatements()
    {
        $this->useStatements = collect($this->useStatements);

        return $this->useStatements->map(function ($useStatement) {
            return "use {$useStatement};";
        })->implode("\n");
    }

    private function generateRegisterBody($fields): string
    {
        return '';
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
