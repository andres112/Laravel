<?php
/**
 * WHILE and DO-WHILE LOOPS
 * 
 * While loops execute code repeatedly as long as a condition is true.
 * Use cases: processing queues, reading files, polling APIs, retry logic.
 * 
 * Differences:
 * - while: Checks condition BEFORE executing (may not execute at all)
 * - do-while: Executes ONCE, then checks condition (always executes at least once)
 * 
 * Keywords:
 * - break: Exit the loop immediately
 * - continue: Skip to next iteration
 */

echo "=== WHILE AND DO-WHILE LOOPS ===\n\n";

// Real-world example: Database connection retry logic
echo "1. Database Connection with Retry Logic\n";
echo str_repeat("-", 50) . "\n";

$maxRetries = 5;
$attempt = 0;
$connected = false;

while ($attempt < $maxRetries && !$connected) {
    $attempt++;
    echo "Attempt $attempt: Connecting to database...\n";
    
    // Simulate connection attempt (30% success rate for demo)
    $connected = (rand(1, 10) <= 3);
    
    if ($connected) {
        echo "✓ Successfully connected to database!\n";
        echo "  Connection established on attempt $attempt\n";
    } else {
        if ($attempt < $maxRetries) {
            $waitTime = $attempt * 2; // Exponential backoff
            echo "✗ Connection failed. Waiting {$waitTime}s before retry...\n";
            sleep($waitTime);
        } else {
            echo "✗ Max retries reached. Connection failed.\n";
            echo "  Please check your database configuration.\n";
        }
    }
}

echo "\n";

// Real-world example: Processing a queue of tasks
echo "2. Task Queue Processing\n";
echo str_repeat("-", 50) . "\n";

$taskQueue = [
    ['id' => 1, 'type' => 'email', 'status' => 'pending'],
    ['id' => 2, 'type' => 'notification', 'status' => 'pending'],
    ['id' => 3, 'type' => 'report', 'status' => 'pending'],
    ['id' => 4, 'type' => 'backup', 'status' => 'pending'],
];

echo "Tasks in queue: " . count($taskQueue) . "\n\n";

$processed = 0;
while (count($taskQueue) > 0) {
    $task = array_shift($taskQueue); // Get first task
    $processed++;
    
    echo "Processing task #{$task['id']}: {$task['type']}...\n";
    
    // Simulate processing time
    usleep(500000); // 0.5 seconds
    
    // Simulate success/failure (90% success rate)
    $success = (rand(1, 10) <= 9);
    
    if ($success) {
        echo "  ✓ Task #{$task['id']} completed successfully\n";
    } else {
        echo "  ✗ Task #{$task['id']} failed, re-queuing...\n";
        $taskQueue[] = $task; // Add back to queue
    }
    
    echo "  Remaining tasks: " . count($taskQueue) . "\n\n";
    
    // Safety: Stop after 10 iterations for demo
    if ($processed >= 10) {
        echo "  Demo limit reached (10 iterations)\n";
        break;
    }
}

echo "Queue processing complete!\n\n";

// Real-world example: User input validation
echo "3. User Input Validation (DO-WHILE)\n";
echo str_repeat("-", 50) . "\n";

$validInput = false;
$attemptCount = 0;
$maxAttempts = 3;

// Simulate user inputs for demo
$simulatedInputs = ['abc', '-5', '150', '42'];
$inputIndex = 0;

do {
    $attemptCount++;
    
    // Simulate getting user input
    $userInput = $simulatedInputs[$inputIndex++] ?? '0';
    echo "Attempt $attemptCount: Please enter a number between 1-100: $userInput\n";
    
    $number = (int)$userInput;
    
    if ($number >= 1 && $number <= 100 && is_numeric($userInput)) {
        $validInput = true;
        echo "✓ Valid input received: $number\n";
    } else {
        echo "✗ Invalid input. ";
        if ($attemptCount < $maxAttempts) {
            echo "Please try again.\n";
        } else {
            echo "Max attempts reached.\n";
        }
    }
    
} while (!$validInput && $attemptCount < $maxAttempts);

echo "\n";

// Real-world example: Polling an API for status
echo "4. API Status Polling (DO-WHILE)\n";
echo str_repeat("-", 50) . "\n";

$jobId = "job-" . uniqid();
$maxPollAttempts = 5;
$pollCount = 0;
$jobStatus = 'processing';

echo "Job ID: $jobId\n";
echo "Polling for job completion...\n\n";

do {
    $pollCount++;
    echo "Poll #$pollCount: Checking job status...\n";
    
    // Simulate API response (20% chance of completion each poll)
    $responses = ['processing', 'processing', 'processing', 'processing', 'completed'];
    $jobStatus = $responses[rand(0, count($responses) - 1)];
    
    echo "  Status: $jobStatus\n";
    
    if ($jobStatus === 'completed') {
        echo "  ✓ Job completed successfully!\n";
    } elseif ($pollCount < $maxPollAttempts) {
        echo "  ⏳ Job still processing. Waiting 2s...\n";
        sleep(2);
    } else {
        echo "  ⚠ Max polling attempts reached. Job may still be processing.\n";
    }
    
    echo "\n";
    
} while ($jobStatus !== 'completed' && $pollCount < $maxPollAttempts);

echo "💡 Best Practice: Always set a maximum iteration limit to prevent\n";
echo "   infinite loops. Use 'break' and 'continue' for flow control.\n";
