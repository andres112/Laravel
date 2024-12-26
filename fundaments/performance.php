<?php

// first increase the memory limit
ini_set('memory_limit', '320M');

$startTime = microtime(true);
$startMemory = memory_get_usage();
$startMemoryPeak = memory_get_peak_usage();

// $largeArray = range(1, 100_000_000); // the user of the _ is to make the number more readable

// Use a generator to handle large ranges efficiently
function generateRange($start, $end) {
    for ($i = $start; $i <= $end; $i++) {
        yield $i;
    }
}

$factorial = 0;

foreach (generateRange(1, 100_000_000) as $value) {
    $factorial += $value;
}

echo "The factorial of 1,000,000 is $factorial\n";

$endMemory = memory_get_usage();
$endMemoryPeak = memory_get_peak_usage();
$endTime = microtime(true);

unset($largeArray); // free up memory

echo "Memory used: " . number_format(($endMemory - $startMemory) / 1024 / 1024, 2) . " MB\n";
echo "Memory peak used: " . number_format(($endMemoryPeak - $startMemoryPeak) / 1024 / 1024, 2) . " MB\n";
echo "Time taken: " . number_format($endTime - $startTime, 10) . " seconds\n";