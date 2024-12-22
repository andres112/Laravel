<?php
declare(strict_types=1);

echo "************************************\n";
echo "STRICT MODE FUNCTION\n";

function sum(int $a, int $b): int
{
    return $a + $b;
}

echo 'The sum is =' . sum(1, 2) . "\n";
// Following: Argument '2' passed to sum() is expected to be of type int, float given
// echo sum(1.5, 2.5) . "\n";