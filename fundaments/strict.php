<?php

declare(strict_types=1);

echo "************************************\n";
echo "STRICT MODE FUNCTIONS\n";

function sub(int $a, int $b): int
{
    return $a - $b;
}

echo 'The subtraction is =' . sub(1, 2) . "\n";
// Following: Argument '2' passed to sum() is expected to be of type int, float given
// echo sum(1.5, 2.5) . "\n";

echo "=== Use of dynamic arguments ===\n";
function sum(int ...$values): int
{
    return array_sum($values);
}

echo 'The sum is =' . sum(1, 2, 3, 4, 5) . "\n";

function introduceTeams(string $teamName,  string ...$players): void
{
    $players = array_map(function($player) {
        return "⚽ " . $player;
    }, $players);
    echo "Team: $teamName\n";
    echo "Players: " . implode(', ', $players) . "\n";
}

$realMadrid = ['Courtois', 'Carvajal', 'Varane', 'Ramos', 'Marcelo', 'Casemiro', 'Kroos', 'Modric', 'Benzema', 'Vinicius', 'Rodrygo'];
introduceTeams('Real Madrid', ...$realMadrid);

echo "************************************\n";
echo "UNION TYPES\n";

function identifyPayload(int|float|string $payload): string{
    return match(true) {
        is_int($payload) => "- Integer: " .  $payload * 2,
        is_float($payload) => "- Float: " .  round($payload, 2),
        is_string($payload) => "- String: " .  strtoupper($payload),
        default => "Unknown payload"
    };
}

echo identifyPayload(20) . "\n";
echo identifyPayload(20.5365) . "\n";
echo identifyPayload("twenty") . "\n";