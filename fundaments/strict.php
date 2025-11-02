<?php

# Enable strict mode. This enforces strict type checking for function arguments and return types.
declare(strict_types=1);

echo "===============strict.php===============\n";
echo "************************************\n";
echo "STRICT MODE FUNCTIONS\n";

function sub(int $a, int $b): int
{
  return $a - $b;
}

echo 'The subtraction is =' . sub(1, 2) . "\n";
// Following: Argument '2' passed to sum() is expected to be of type int, float given
// echo sum(1.5, 2.5) . "\n";

echo "************************************\n";
echo " Use of dynamic arguments \n";
function suma(int ...$values): int
{
  return array_sum($values);
}

echo 'The sum is =' . suma(1, 2, 3, 4, 5) . "\n";

function introduceTeams(string $teamName,  string ...$players): void
{
  $players = array_map(function ($player) {
    return "⚽ " . $player;
  }, $players);
  echo "Team: $teamName\n";
  echo "Players: " . implode(', ', $players) . "\n";
}

$seleccionColombia = ['Ospina', 'Arias', 'Mina', 'Davinson', 'Cuadrado', 'Barrios', 'James', 'Duvan', 'Luis Diaz'];
introduceTeams('Seleccion Colombia de Fútbol :', ...$seleccionColombia);

echo "************************************\n";
echo "UNION TYPES\n";

function identifyPayload(int|float|string $payload): string
{
  return match (true) {
    is_int($payload) => "- Integer: " .  $payload * 2,
    is_float($payload) => "- Float: " .  round($payload, 2),
    is_string($payload) => "- String: " .  strtoupper($payload),
    default => "Unknown payload"
  };
}

echo identifyPayload(20) . "\n";
echo identifyPayload(20.5365) . "\n";
echo identifyPayload("twenty") . "\n";

echo "===============end strict.php===============\n";
