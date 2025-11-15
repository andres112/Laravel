<?php

/**
 * GENERATORS
 * 
 * Generators provide an efficient way to iterate over data without loading
 * everything into memory. They generate values on-the-fly using the yield
 * keyword, making them perfect for large datasets or infinite sequences.
 * 
 * Key features:
 * - Memory efficient: Values generated one at a time
 * - Lazy evaluation: Values computed only when needed
 * - Can represent infinite sequences
 * - Implements Iterator interface automatically
 * - Can send values back to generator using send()
 * 
 * Real-world uses: Processing large files, pagination, streaming data,
 * database result sets, API responses, CSV processing, log file parsing.
 * 
 * Benefits: Reduced memory usage, improved performance, cleaner code.
 */

echo "=== GENERATORS ===\n\n";

// Real-world example: Reading large files efficiently
echo "1. Memory-Efficient File Reading\n";
echo str_repeat("-", 50) . "\n";

function readLargeFile(string $filename): Generator
{
  $handle = fopen($filename, 'r');
  if (!$handle) {
    throw new RuntimeException("Cannot open file: $filename");
  }
  while (($line = fgets($handle)) !== false) {
    yield rtrim($line, "\r\n");
  }
  fclose($handle);
}

echo "Processing log file (line by line):\n";
$errorCount = 0;
foreach (readLargeFile('app.log') as $lineNumber => $line) {
  if (str_contains($line, 'ERROR')) {
    $errorCount++;
    echo "  Line " . ($lineNumber + 1) . ": {$line}\n";
  }
}
echo "\nTotal errors found: {$errorCount}\n\n";

// Real-world example: CSV processing
echo "2. CSV Data Processing\n";
echo str_repeat("-", 50) . "\n";

enum Status:string {
  case Active = 'active';
  case Inactive = 'inactive';
}

function processCsvData(Status $status = Status::Active): Generator
{
  $filename = __DIR__ . '/../users.csv';
  $handle = fopen($filename, 'r');
  if (!$handle) {
    throw new RuntimeException("Cannot open file: $filename");
  }
  $header = fgetcsv($handle);
  while (($row = fgetcsv($handle)) !== false) {
    $data = array_combine($header, $row);
    if (($data['status'] ?? 'active') === $status->value) {
      yield [
        'name' => strtoupper($data['name']),
        'email' => $data['email'],
        'age' => (int)$data['age']
      ];
    }
  }
  fclose($handle);
}

echo "Processing CSV (inactive users only):\n";
foreach (processCsvData(Status::Inactive) as $index => $user) {
  echo "  " . ($index + 1) . ". {$user['name']} ({$user['email']}) - Age: {$user['age']}\n";
}

echo "Processing CSV (active users only):\n";
foreach (processCsvData() as $index => $user) {
  echo "  " . ($index + 1) . ". {$user['name']} ({$user['email']}) - Age: {$user['age']}\n";
}

echo "\n";

// Real-world example: Pagination generator
echo "3. Database Pagination\n";
echo str_repeat("-", 50) . "\n";

function fetchPaginatedResults(int $totalRecords, int $pageSize = 10): Generator
{
  $totalPages = ceil($totalRecords / $pageSize);

  for ($page = 1; $page <= $totalPages; $page++) {
    $offset = ($page - 1) * $pageSize;
    $limit = min($pageSize, $totalRecords - $offset);

    // Simulate database query
    $results = [];
    for ($i = 0; $i < $limit; $i++) {
      $results[] = [
        'id' => $offset + $i + 1,
        'title' => 'Record ' . ($offset + $i + 1)
      ];
    }

    yield [
      'page' => $page,
      'total_pages' => $totalPages,
      'results' => $results
    ];
  }
}

echo "Fetching 25 records in batches of 10:\n";
foreach (fetchPaginatedResults(25, 10) as $page) {
  echo "  Page {$page['page']}/{$page['total_pages']}: ";
  echo count($page['results']) . " records (IDs: ";
  $ids = array_map(fn($r) => $r['id'], $page['results']);
  echo implode(', ', $ids) . ")\n";
}

echo "\n";

// Real-world example: Infinite sequence generator
echo "4. Infinite Sequence Generator\n";
echo str_repeat("-", 50) . "\n";

function generateIds(string $prefix = 'ID'): Generator
{
  while (true) {
    $counter = rand(0,999999);
    yield $prefix . str_pad($counter, 6, '0', STR_PAD_LEFT);
  }
}

echo "Generating unique IDs:\n";
$idGenerator = generateIds('ORD');
$orders = [];
for ($i = 0; $i < 500; $i++) {
  $orders[] = $idGenerator->current();
  $idGenerator->next();
}
echo "  " . implode(', ', $orders) . "\n\n";

// Real-world example: Range with custom step
echo "5. Custom Range Generator\n";
echo str_repeat("-", 50) . "\n";

function range_step(int $start, int $end, int $step = 1): Generator
{
  if ($step === 0) {
    throw new InvalidArgumentException('Step cannot be zero');
  }

  if ($step > 0) {
    for ($i = $start; $i <= $end; $i += $step) {
      yield $i;
    }
  } else {
    for ($i = $start; $i >= $end; $i += $step) {
      yield $i;
    }
  }
}

echo "Even numbers from 0 to 20:\n  ";
foreach (range_step(0, 20, 2) as $num) {
  echo "$num ";
}

echo "\n\nCountdown from 10 to 0 (step -2):\n  ";
foreach (range_step(10, 0, -2) as $num) {
  echo "$num ";
}

echo "\n\n";

// Real-world example: Data transformation pipeline
echo "6. Data Transformation Pipeline\n";
echo str_repeat("-", 50) . "\n";

function filterNumbers(iterable $numbers, callable $condition): Generator
{
  foreach ($numbers as $number) {
    if ($condition($number)) {
      yield $number;
    }
  }
}

function transformNumbers(iterable $numbers, callable $transformer): Generator
{
  foreach ($numbers as $number) {
    yield $transformer($number);
  }
}

$data = range(1, 20);

// Pipeline: Filter even numbers → Square them → Only show results > 50
$pipeline = transformNumbers(
  filterNumbers($data, fn($n) => $n % 2 === 0),
  fn($n) => $n * $n
);

echo "Even numbers squared (> 50):\n  ";
foreach ($pipeline as $result) {
  if ($result > 50) {
    echo "$result ";
  }
}

echo "\n\n";

// Real-world example: API response streaming
echo "7. Streaming API Responses\n";
echo str_repeat("-", 50) . "\n";

function fetchApiPages(int $totalItems, int $itemsPerPage = 20): Generator
{
  $totalPages = ceil($totalItems / $itemsPerPage);

  for ($page = 1; $page <= $totalPages; $page++) {
    // Simulate API delay
    $remainingItems = $totalItems - (($page - 1) * $itemsPerPage);
    $itemsInThisPage = min($itemsPerPage, $remainingItems);

    yield [
      'page' => $page,
      'items' => $itemsInThisPage,
      'has_more' => $page < $totalPages
    ];
  }
}

echo "Streaming 100 items from API:\n";
$processedItems = 0;
foreach (fetchApiPages(100, 20) as $response) {
  $processedItems += $response['items'];
  echo "  Page {$response['page']}: {$response['items']} items";
  echo " (Total processed: {$processedItems})";
  echo $response['has_more'] ? " → More available" : " → Complete";
  echo "\n";
}

echo "\n";

// Real-world example: Generator with send()
echo "8. Two-Way Generator Communication\n";
echo str_repeat("-", 50) . "\n";

function processQueue(): Generator
{
  $processed = [];
  echo "  Queue processor started...\n";

  while (true) {
    $task = yield $processed;

    if ($task === null) {
      break;
    }

    // Process task
    $result = strtoupper($task);
    $processed[] = $result;
    echo "  Processed: {$task} → {$result}\n";
  }

  return $processed;
}

$processor = processQueue();
$processor->current(); // Start the generator

// Send tasks to process
$tasks = ['task1', 'task2', 'task3'];
foreach ($tasks as $task) {
  $processor->send($task);
}

// Close the generator
$processor->send(null);
echo "  Queue processor stopped.\n\n";

// Real-world example: Memory comparison
echo "9. Memory Usage Comparison\n";
echo str_repeat("-", 50) . "\n";

// Traditional array approach
function getAllRecordsArray(int $count): array
{
  $records = [];
  for ($i = 1; $i <= $count; $i++) {
    $records[] = [
      'id' => $i,
      'data' => str_repeat('x', 100)
    ];
  }
  return $records;
}

// Generator approach
function getAllRecordsGenerator(int $count): Generator
{
  for ($i = 1; $i <= $count; $i++) {
    yield [
      'id' => $i,
      'data' => str_repeat('x', 100)
    ];
  }
}

echo "Processing 1000 records:\n";

// Array approach
$memBefore = memory_get_usage();
$arrayData = getAllRecordsArray(1000);
$count1 = 0;
foreach ($arrayData as $record) {
  $count1++;
}
$memArray = memory_get_usage() - $memBefore;

// Generator approach
$memBefore = memory_get_usage();
$count2 = 0;
foreach (getAllRecordsGenerator(1000) as $record) {
  $count2++;
}
$memGenerator = memory_get_usage() - $memBefore;

echo "  Array approach: " . number_format($memArray / 1024, 2) . " KB\n";
echo "  Generator approach: " . number_format($memGenerator / 1024, 2) . " KB\n";
echo "  Memory saved: " . number_format(($memArray - $memGenerator) / 1024, 2) . " KB\n";

$savings = (($memArray - $memGenerator) / $memArray) * 100;
echo "  Efficiency gain: " . number_format($savings, 1) . "%\n";

echo "\n💡 Best Practice: Use generators for large datasets, file processing,\n";
echo "   or when you don't need all data at once. Significant memory savings!\n";
