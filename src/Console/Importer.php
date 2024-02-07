<?php

namespace Tdwesten\StatamicBuilder\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Statamic\Filesystem\FlysystemAdapter;

class Importer extends Command
{
    protected $signature = 'statamic-builder:import';

    protected $description = 'Import YAML files to Statamic blueprints and fieldsets';

    protected $name = 'Statamic Builder Importer';

    public function handle()
    {
        $this->info('Importing blueprints and fieldsets...');

        $this->getBlueprints();
    }

    private function getBlueprints()
    {
        $filesystem = Storage::build([
            'driver' => 'local',
            'root' => base_path('resources/blueprints'),
        ]);

        $fs = new FlysystemAdapter($filesystem);

        $files = $fs->getFilesRecursively('/');

        dd($files);
    }
}
