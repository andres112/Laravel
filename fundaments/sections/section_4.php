<?php
/**
 * FOR LOOPS
 * 
 * For loops are ideal when you know the exact number of iterations needed.
 * Use cases: iterating arrays, generating reports, batch processing, pagination.
 * 
 * Syntax: for (init; condition; increment) { code }
 * 
 * Components:
 * - Initialization: Executed once at start
 * - Condition: Checked before each iteration
 * - Increment: Executed after each iteration
 */

echo "=== FOR LOOPS ===\n\n";

// Real-world example: Pagination system
echo "1. Database Pagination System\n";
echo str_repeat("-", 50) . "\n";

$totalRecords = 247;
$recordsPerPage = 20;
$totalPages = ceil($totalRecords / $recordsPerPage);

echo "Total Records: $totalRecords\n";
echo "Records per Page: $recordsPerPage\n";
echo "Total Pages: $totalPages\n\n";

echo "Page Links: ";
for ($page = 1; $page <= $totalPages; $page++) {
    $startRecord = (($page - 1) * $recordsPerPage) + 1;
    $endRecord = min($page * $recordsPerPage, $totalRecords);
    
    if ($page <= 3 || $page > $totalPages - 2) {
        echo "[$page]";
        if ($page == 3 && $totalPages > 7) {
            echo " ... ";
        }
    }
}
echo "\n\n";

// Real-world example: Report generation
echo "2. Monthly Sales Report Generation\n";
echo str_repeat("-", 50) . "\n";

$monthlySales = [
    15420.50, 18230.75, 16890.00, 22150.25,
    19870.50, 21430.00, 25680.75, 23450.00,
    20120.50, 24890.25, 26730.00, 28950.75
];

$months = [
    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
];

$totalSales = 0;
$highestSale = 0;
$highestMonth = '';

echo "Sales Report for 2024:\n\n";

for ($i = 0; $i < count($monthlySales); $i++) {
    $sale = $monthlySales[$i];
    $totalSales += $sale;
    
    // Track highest sale
    if ($sale > $highestSale) {
        $highestSale = $sale;
        $highestMonth = $months[$i];
    }
    
    // Create visual bar chart
    $barLength = (int)(($sale / 30000) * 30);
    $bar = str_repeat('█', $barLength);
    
    printf("%3s: $%9.2f %s\n", $months[$i], $sale, $bar);
}

$averageSales = $totalSales / count($monthlySales);

echo "\n" . str_repeat("-", 50) . "\n";
echo "Total Sales: $" . number_format($totalSales, 2) . "\n";
echo "Average Sales: $" . number_format($averageSales, 2) . "\n";
echo "Highest Month: $highestMonth ($" . number_format($highestSale, 2) . ")\n\n";

// Real-world example: Batch email sending
echo "3. Batch Email Sending System\n";
echo str_repeat("-", 50) . "\n";

$emailList = [
    'user1@example.com', 'user2@example.com', 'user3@example.com',
    'user4@example.com', 'user5@example.com', 'user6@example.com',
    'user7@example.com', 'user8@example.com', 'user9@example.com',
];

$batchSize = 3;
$delayBetweenBatches = 1; // seconds
$totalEmails = count($emailList);
$sent = 0;
$failed = 0;

echo "Sending $totalEmails emails in batches of $batchSize...\n\n";

for ($i = 0; $i < $totalEmails; $i++) {
    $email = $emailList[$i];
    
    // Simulate sending (90% success rate)
    $success = (rand(1, 10) <= 8);
    
    if ($success) {
        echo "✓ Sent to: $email\n";
        $sent++;
    } else {
        echo "✗ Failed: $email\n";
        $failed++;
    }
    
    // Add delay after each batch
    if (($i + 1) % $batchSize === 0 && $i < $totalEmails - 1) {
        echo "  Batch complete. Waiting {$delayBetweenBatches}s...\n\n";
        sleep($delayBetweenBatches);
    }
}

echo "\n" . str_repeat("-", 50) . "\n";
echo "Email Summary:\n";
echo "  Total: $totalEmails\n";
echo "  Sent: $sent (" . round(($sent / $totalEmails) * 100) . "%)\n";
echo "  Failed: $failed\n\n";

// Real-world example: Progress bar
echo "4. File Processing with Progress Bar\n";
echo str_repeat("-", 50) . "\n";

$totalFiles = 50;
$progressBarWidth = 40;

echo "Processing $totalFiles files...\n\n";

for ($i = 1; $i <= $totalFiles; $i++) {
    // Calculate progress
    $progress = ($i / $totalFiles) * 100;
    $completedWidth = (int)(($i / $totalFiles) * $progressBarWidth);
    
    // Build progress bar
    $bar = str_repeat('█', $completedWidth);
    $empty = str_repeat('░', $progressBarWidth - $completedWidth);
    
    // Display progress (use \r to overwrite line)
    printf("\rProgress: [%s%s] %3d%% (%d/%d files)", 
        $bar, $empty, (int)$progress, $i, $totalFiles);
    
    // Simulate file processing
    usleep(rand(30000, 500000)); // 0.03 to 0.5 seconds
}

echo "\n✓ All files processed successfully!\n\n";

// Real-world example: Nested loops for table generation
echo "5. Multiplication Table Generator\n";
echo str_repeat("-", 50) . "\n";

$tableSize = 10;

// Header
echo "     ";
for ($i = 1; $i <= $tableSize; $i++) {
  // %4d means print integer in width of 4 it means ___1 __10
    printf("%4d", $i);
}
echo "\n" . str_repeat("-", ($tableSize + 1) * 4 + 5) . "\n";

// Table rows
for ($row = 1; $row <= $tableSize; $row++) {
  // %2d | means print integer in width of 2 followed by " | "
    printf("%2d | ", $row);
    for ($col = 1; $col <= $tableSize; $col++) {
        printf("%4d", $row * $col);
    }
    echo "\n";
}

echo "\n💡 Best Practice: Use for loops when you know the iteration count.\n";
echo "   For unknown iterations, use while/do-while loops instead.\n";
