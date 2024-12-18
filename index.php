<?php
require_once 'vendor/autoload.php';
require_once 'lib.php';

use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Data\RawCodeCoverageData;
use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Driver\Selector;

xdebug_start_code_coverage();
RandomClass::method1();
$data = xdebug_get_code_coverage();

// If no coverage stored yet, create a new one
$filter = new Filter();
$filter->includeFile('lib.php');

$coverage = new CodeCoverage(
    (new Selector)->forLineCoverage($filter),
    $filter
);

$coverage->append(RawCodeCoverageData::fromXdebugWithoutPathCoverage($data), 'session');



// Generate the final report
$report = new \SebastianBergmann\CodeCoverage\Report\Html\Facade();
$report->process($coverage, 'report');
