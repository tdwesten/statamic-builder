<?php

namespace Tdwesten\StatamicBuilder\Console;

class MakeNavigationCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:navigation';

    /**
     * @var string
     */
    protected $description = 'Create a new Statamic Builder navigation';

    /**
     * @var string
     */
    protected $type = 'Statamic Builder Navigation';

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/navigation.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Navigations';
    }
}
