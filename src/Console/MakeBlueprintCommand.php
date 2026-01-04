<?php

namespace Tdwesten\StatamicBuilder\Console;

class MakeBlueprintCommand extends GeneratorCommand
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
