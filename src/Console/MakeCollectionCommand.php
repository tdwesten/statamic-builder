<?php

namespace Tdwesten\StatamicBuilder\Console;

use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;

class MakeCollectionCommand extends BaseGeneratorCommand
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
        return __DIR__.'/../../stubs/collection.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Collections';
    }
}
