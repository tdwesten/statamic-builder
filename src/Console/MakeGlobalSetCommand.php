<?php

namespace Tdwesten\StatamicBuilder\Console;

use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;

class MakeGlobalSetCommand extends BaseGeneratorCommand
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
        return $rootNamespace.'\\Globals';
    }
}
