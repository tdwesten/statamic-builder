#!/usr/bin/env php
<?php

/**
 * Standalone test script to validate Statamic v5.67.0 compatibility fix
 * This script tests the BlueprintRepository::getDirectory() method with various scenarios
 */

require __DIR__.'/vendor/autoload.php';

echo "=================================================\n";
echo "Statamic Builder v5.67.0 Compatibility Test Suite\n";
echo "=================================================\n\n";

$testsPassed = 0;
$testsFailed = 0;

function test($description, $callback)
{
    global $testsPassed, $testsFailed;

    try {
        $callback();
        echo "✓ PASS: {$description}\n";
        $testsPassed++;
    } catch (AssertionError $e) {
        echo "✗ FAIL: {$description}\n";
        echo "  Error: {$e->getMessage()}\n";
        $testsFailed++;
    } catch (Exception $e) {
        echo "✗ ERROR: {$description}\n";
        echo "  Error: {$e->getMessage()}\n";
        $testsFailed++;
    }
}

// Test 1: v5.67.0 style with directory() method
test('v5.67.0 with directory() method', function () {
    $repo = new class extends \Tdwesten\StatamicBuilder\Repositories\BlueprintRepository
    {
        protected $directories = ['default' => 'resources/blueprints'];

        public function directory()
        {
            return $this->directories['default'];
        }

        public function testGetDirectory()
        {
            return $this->getDirectory();
        }
    };

    assert($repo->testGetDirectory() === 'resources/blueprints', 'Should use directory() method');
});

// Test 2: v5.67.0 style without directory() method
test('v5.67.0 accessing directories[default] directly', function () {
    $repo = new class extends \Tdwesten\StatamicBuilder\Repositories\BlueprintRepository
    {
        protected $directories = ['default' => 'custom/blueprints'];

        public function testGetDirectory()
        {
            return $this->getDirectory();
        }
    };

    assert($repo->testGetDirectory() === 'custom/blueprints', 'Should access directories[default]');
});

// Test 3: Old style (pre v5.67.0)
test('Pre v5.67.0 with directory property', function () {
    $repo = new class extends \Tdwesten\StatamicBuilder\Repositories\BlueprintRepository
    {
        protected $directory = 'old/blueprints';

        public function testGetDirectory()
        {
            return $this->getDirectory();
        }
    };

    assert($repo->testGetDirectory() === 'old/blueprints', 'Should use old directory property');
});

// Test 4: Simple array style (alternative format)
test('Simple array format (first element)', function () {
    $repo = new class extends \Tdwesten\StatamicBuilder\Repositories\BlueprintRepository
    {
        protected $directories = ['first/path', 'second/path'];

        public function testGetDirectory()
        {
            return $this->getDirectory();
        }
    };

    assert($repo->testGetDirectory() === 'first/path', 'Should use first element');
});

// Test 5: Fallback when nothing is set
test('Fallback to default when no properties set', function () {
    $repo = new class extends \Tdwesten\StatamicBuilder\Repositories\BlueprintRepository
    {
        public function testGetDirectory()
        {
            return $this->getDirectory();
        }
    };

    assert($repo->testGetDirectory() === 'resources/blueprints', 'Should use default path');
});

// Test 6: Empty directories array falls back to directory
test('Empty directories array falls back to directory', function () {
    $repo = new class extends \Tdwesten\StatamicBuilder\Repositories\BlueprintRepository
    {
        protected $directory = 'fallback/path';

        protected $directories = [];

        public function testGetDirectory()
        {
            return $this->getDirectory();
        }
    };

    assert($repo->testGetDirectory() === 'fallback/path', 'Should fallback to directory when directories is empty');
});

// Test 7: Multiple directories in associative array
test('Multiple directories in associative array', function () {
    $repo = new class extends \Tdwesten\StatamicBuilder\Repositories\BlueprintRepository
    {
        protected $directories = [
            'default' => 'resources/blueprints',
            'vendor' => 'vendor/blueprints',
            'custom' => 'custom/blueprints',
        ];

        public function testGetDirectory()
        {
            return $this->getDirectory();
        }
    };

    assert($repo->testGetDirectory() === 'resources/blueprints', 'Should use default key from associative array');
});

// Test 8: Verify no syntax errors in actual file
test('No PHP syntax errors in BlueprintRepository', function () {
    $output = [];
    $returnCode = 0;
    exec('php -l '.__DIR__.'/src/Repositories/BlueprintRepository.php', $output, $returnCode);

    assert($returnCode === 0, 'BlueprintRepository should have no syntax errors');
});

echo "\n";
echo "=================================================\n";
echo "Test Results:\n";
echo "  Passed: {$testsPassed}\n";
echo "  Failed: {$testsFailed}\n";
echo "=================================================\n";

if ($testsFailed > 0) {
    exit(1);
}

echo "\n✅ All tests passed! The fix is compatible with both Statamic v5.56.0 and v5.67.0+\n\n";
exit(0);
