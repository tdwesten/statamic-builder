<?php

$templateFile = __DIR__.'/FieldTemplate.php';
$testTemplateFile = __DIR__.'/FieldTestTemplate.php';
$newClassName = $argv[1];

// Check if the class name is provided
if (empty($newClassName)) {
    echo "Please provide a class name.\n";
    exit(1);
}

// Set the output directories
$outputDirectory = __DIR__.'/../src/FieldTypes/';
$testOutputDirectory = __DIR__.'/../tests/Unit/';

// Read the template file
$templateContent = file_get_contents($templateFile);

// Read the template file
$testTemplateContent = file_get_contents($testTemplateFile);

// Replace the placeholder values
$templateContent = str_replace('__Field__', $newClassName, $templateContent);

// Replace the placeholder values
$testTemplateContent = str_replace('__Field__', $newClassName, $testTemplateContent);

// Create the class file
$newClassFileName = $outputDirectory.$newClassName.'.php';

// Create the test class file
$newTestFileName = $testOutputDirectory.$newClassName.'Test.php';

// Write the new class file
file_put_contents($newClassFileName, $templateContent);

// Write the new test class file
file_put_contents($newTestFileName, $testTemplateContent);

// Output the result
echo "New field class created successfully at $newClassFileName.";
echo "New field test class created successfully at $newTestFileName.";
