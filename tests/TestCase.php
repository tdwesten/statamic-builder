<?php

namespace Tests;

use Statamic\Testing\AddonTestCase;
use Tdwesten\StatamicBuilder\ServiceProvider;

abstract class TestCase extends AddonTestCase
{
    protected string $addonServiceProvider = ServiceProvider::class;
}
