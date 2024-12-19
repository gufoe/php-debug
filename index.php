<?php
require_once 'vendor/autoload.php';
require_once 'lib.php';

use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Data\RawCodeCoverageData;
use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Driver\Selector;


// If no coverage stored yet, create a new one
$filter = new Filter();
$filter->includeFile('lib.php');

$coverage = new CodeCoverage(
    (new Selector)->forLineCoverage($filter),
    $filter
);

$coverage->start('xx');
RandomClass::method1();
$data = $coverage->stop();

$coverage->append($data, 'session');



// Generate the final report
$report = new \SebastianBergmann\CodeCoverage\Report\Html\Facade();
$report->process($coverage, 'report');
