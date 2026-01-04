<?php

namespace Tdwesten\StatamicBuilder\Console;

class MakeGlobalSetCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:global-set';

    /**
     * @var string
     */
    protected $description = 'Create a new Statamic Builder Global Set';

    /**
     * @var string
     */
    protected $type = 'Statamic Builder Global Set';

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/Global-Set.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Globals';
    }
}
