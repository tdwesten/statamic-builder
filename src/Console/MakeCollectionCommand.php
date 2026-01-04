<?php

namespace Tdwesten\StatamicBuilder\Console;

class MakeCollectionCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:collection';

    /**
     * @var string
     */
    protected $description = 'Create a new Statamic Builder Collection';

    /**
     * @var string
     */
    protected $type = 'Statamic Builder Collection';

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/Collection.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Collections';
    }
}
