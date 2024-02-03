<?php

namespace Tdwesten\StatamicBuilder\Console;

use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;

class MakeBlueprint extends BaseGeneratorCommand
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
    protected function getStub()
    {
        return __DIR__.'/../../stubs/blueprint.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Blueprints';
    }
}
