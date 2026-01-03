<?php

namespace Tdwesten\StatamicBuilder\Console;

use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;

class MakeBlueprintCommand extends BaseGeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:blueprint';

    /**
     * @var string
     */
    protected $description = 'Create a new Statamic Builder blueprint';

    /**
     * @var string
     */
    protected $type = 'Statamic Builder Blueprint';

    /**
     * {@inheritDoc}
     */
    public function handle()
    {
        if (parent::handle() === false) {
            return false;
        }

        if (! config('statamic.builder.auto_registration', false)) {
            $this->info('Remember to register your new Blueprint in config/statamic/builder.php');
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/blueprint.stub';
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
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Blueprints';
    }
}
