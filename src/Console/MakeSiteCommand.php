<?php

namespace Tdwesten\StatamicBuilder\Console;

class MakeSiteCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:site';

    /**
     * @var string
     */
    protected $description = 'Create a new Statamic Builder Site';

    /**
     * @var string
     */
    protected $type = 'Statamic Builder Site';

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/Site.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Sites';
    }
}
