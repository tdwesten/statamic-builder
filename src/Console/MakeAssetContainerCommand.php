<?php

namespace Tdwesten\StatamicBuilder\Console;

use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;

class MakeAssetContainerCommand extends BaseGeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:asset-container';

    /**
     * @var string
     */
    protected $description = 'Create a new Statamic Builder Asset Container';

    /**
     * @var string
     */
    protected $type = 'Statamic Builder Asset Container';

    /**
     * {@inheritDoc}
     */
    public function handle()
    {
        if (parent::handle() === false) {
            return false;
        }

        if (! config('statamic.builder.auto_registration', false)) {
            $this->info('Remember to register your new Asset Container in config/statamic/builder.php');
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/AssetContainer.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getNameInput()
    {
        $input = trim($this->argument('name'));

        return \Illuminate\Support\Str::studly($input);
    }

    /**
     * {@inheritDoc}
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        $handle = \Illuminate\Support\Str::of($name)->afterLast('\\')->snake();

        return str_replace(['{{ handle }}', '{{handle}}'], $handle, $stub);
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\AssetContainers';
    }
}
