<?php
require_once 'vendor/autoload.php';
require_once 'lib.php';

use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Driver\Selector;

function report_code()
{
    // If no coverage stored yet, create a new one
    $filter = new Filter();
    $filter->includeFile('lib.php');

    // Create a new coverage object
    $coverage = new CodeCoverage(
        (new Selector)->forLineCoverage($filter),
        $filter
    );

    // Start coverage
    $coverage->start('xx');

    // Execute the code to be tested
    RandomClass::method1();

    // Stop and generate report
    $coverage->stop();

    // Generate the final report
    $report = new \SebastianBergmann\CodeCoverage\Report\Html\Facade();
    $report->process($coverage, 'report');
}


// Run a coverage report
report_code();

// Run a coverage report again: this will be broken
// report_code();
