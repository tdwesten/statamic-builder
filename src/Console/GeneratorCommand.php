<?php

namespace Tdwesten\StatamicBuilder\Console;

use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;
use Illuminate\Support\Str;

abstract class GeneratorCommand extends BaseGeneratorCommand
{
    /**
     * {@inheritDoc}
     */
    public function handle()
    {
        if (parent::handle() === false) {
            return false;
        }

        if (! config('statamic.builder.auto_registration', false)) {
            $this->info("Remember to register your new {$this->getShortType()} in config/statamic/builder.php");
        }
    }

    /**
     * Get the short type name for the registration message.
     *
     * @return string
     */
    protected function getShortType()
    {
        return str_replace('Statamic Builder ', '', $this->type);
    }

    /**
     * {@inheritDoc}
     */
    protected function getNameInput()
    {
        $input = trim($this->argument('name'));

        return Str::studly($input);
    }

    /**
     * {@inheritDoc}
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        $handle = Str::of($name)->afterLast('\\')->snake();

        return str_replace(['{{ handle }}', '{{handle}}'], $handle, $stub);
    }
}
