<?php
/**
 * STRINGS & STRING MANIPULATION
 * 
 * Strings are sequences of characters used extensively in web applications.
 * PHP provides rich string manipulation functions for processing text data.
 * 
 * Key concepts:
 * - Single vs double quotes: ' ' (literal) vs " " (variable interpolation)
 * - Heredoc/Nowdoc: Multi-line strings
 * - Common functions: substr, strlen, str_replace, trim, explode, implode
 * - String searching: strpos, strstr, str_contains (PHP 8+)
 * 
 * Use cases: Data formatting, validation, parsing, sanitization, templating.
 */

echo "=== STRINGS & STRING MANIPULATION ===\n\n";

// Real-world example: User profile formatting
echo "1. User Profile Data Formatting\n";
echo str_repeat("-", 50) . "\n";

$firstName = "john";
$lastName = "doe";
$email = "  JOHN.DOE@EXAMPLE.COM  ";
$bio = "I'm a software developer passionate about creating amazing applications.";

// Format name properly
$formattedFirstName = ucfirst(strtolower($firstName));
$formattedLastName = ucfirst(strtolower($lastName));
$fullName = "$formattedFirstName $formattedLastName";

// Clean and format email
$cleanEmail = strtolower(trim($email));

// Create username from name
$username = strtolower(str_replace(' ', '_', $fullName));

// Generate initials
$initials = strtoupper($firstName[0] . $lastName[0]);

echo "Profile Information:\n";
echo "  Full Name: $fullName\n";
echo "  Initials: $initials\n";
echo "  Username: $username\n";
echo "  Email: $cleanEmail\n";
echo "  Bio: " . ucfirst($bio) . "\n";
echo "  Bio Length: " . strlen($bio) . " characters\n\n";

// Real-world example: URL slug generation
echo "2. URL Slug Generator\n";
echo str_repeat("-", 50) . "\n";

$articleTitles = [
    "How to Learn PHP Programming in 2024!",
    "10 Best Practices for Web Development",
    "Understanding Laravel's Eloquent ORM",
];

foreach ($articleTitles as $title) {
    // Convert to lowercase
    $slug = strtolower($title);
    
    // Replace spaces with hyphens
    $slug = str_replace(' ', '-', $slug);
    
    // Remove special characters
    $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
    
    // Remove multiple consecutive hyphens
    $slug = preg_replace('/-+/', '-', $slug);
    
    // Trim hyphens from ends
    $slug = trim($slug, '-');
    
    echo "Title: $title\n";
    echo "  Slug: $slug\n";
    echo "  URL: https://example.com/blog/$slug\n\n";
}

// Real-world example: Email template with heredoc
echo "3. Email Template System\n";
echo str_repeat("-", 50) . "\n";

$customerName = "John Doe";
$orderNumber = "ORD-2024-1001";
$orderTotal = 299.99;
$trackingNumber = "1Z999AA1234567890";

// The notation <<<EMAIL starts a heredoc string
// It allows multi-line strings with variable interpolation
$emailTemplate = <<<EMAIL
Dear $customerName,

Thank you for your order!

Order Details:
  Order Number: $orderNumber
  Total Amount: \$$orderTotal
  Tracking Number: $trackingNumber

Your order has been shipped and should arrive within 3-5 business days.

Track your package: https://tracking.example.com/$trackingNumber

Best regards,
The Example Store Team
EMAIL;

echo "Generated Email:\n";
echo "\n".$emailTemplate . "\n\n";

// Real-world example: String validation and sanitization
echo "4. Input Sanitization & Validation\n";
echo str_repeat("-", 50) . "\n";

$userInputs = [
    'username' => '  JohnDoe123!@  ',
    'comment' => '<script>alert("xss")</script>Hello World!',
    'phone' => '(555) 123-4567',
    'zip_code' => 'ABC-12345',
];

echo "Sanitizing user inputs:\n\n";

// Username: Remove whitespace and special chars
$cleanUsername = trim($userInputs['username']);
$cleanUsername = preg_replace('/[^a-zA-Z0-9_]/', '', $cleanUsername);
echo "Username: '{$userInputs['username']}'\n";
echo "  Sanitized: '$cleanUsername'\n\n";

// Comment: Strip HTML tags
$cleanComment = strip_tags($userInputs['comment']);
$cleanComment = htmlspecialchars($cleanComment, ENT_QUOTES, 'UTF-8');
echo "Comment: '{$userInputs['comment']}'\n";
echo "  Sanitized: '$cleanComment'\n\n";

// Phone: Extract digits only
$cleanPhone = preg_replace('/[^0-9]/', '', $userInputs['phone']);
echo "Phone: '{$userInputs['phone']}'\n";
echo "  Sanitized: '$cleanPhone'\n";
echo "  Formatted: " . substr($cleanPhone, 0, 3) . "-" . 
     substr($cleanPhone, 3, 3) . "-" . substr($cleanPhone, 6) . "\n\n";

// Zip code: Extract valid format
$cleanZip = preg_replace('/[^0-9]/', '', $userInputs['zip_code']);
echo "Zip Code: '{$userInputs['zip_code']}'\n";
echo "  Sanitized: '$cleanZip'\n\n";

// Real-world example: Text truncation for previews
echo "5. Smart Text Truncation\n";
echo str_repeat("-", 50) . "\n";

$articles = [
    [
        'title' => 'Introduction to PHP',
        'content' => 'PHP is a popular general-purpose scripting language that is especially suited to web development. Fast, flexible, and pragmatic, PHP powers everything from your blog to the most popular websites in the world. In this comprehensive guide, we will explore the fundamentals of PHP programming.'
    ],
    [
        'title' => 'Advanced Laravel Techniques',
        'content' => 'Laravel provides expressive, elegant syntax to build robust web applications. This article covers advanced-patterns and best practices for professional Laravel development.'
    ],
];

foreach ($articles as $article) {
    $maxLength = 120;
    $preview = $article['content'];
    
    if (strlen($preview) > $maxLength) {
        // Find last space before max length
        $preview = substr($preview, 0, $maxLength);
        $lastSpace = strrpos($preview, ' ');
        echo 'Last space position: ' . $lastSpace . "\n";
        if ($lastSpace !== false) {
            $preview = substr($preview, 0, $lastSpace);
        }
        $preview .= '...';
    }
    
    echo "Article: {$article['title']}\n";
    echo "  Full Length: " . strlen($article['content']) . " chars\n";
    echo "  Preview: $preview\n\n";
}

// Real-world example: String search and replace
echo "6. Content Moderation & Search\n";
echo str_repeat("-", 50) . "\n";

$userComment = "This product is amazing! You can reach me at john@example.com or call 555-1234.";
$bannedWords = ['amazing', 'incredible', 'unbelievable'];

echo "Original Comment:\n  $userComment\n\n";

// Mask email addresses
$moderatedComment = preg_replace('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', '[EMAIL HIDDEN]', $userComment);

// Mask phone numbers
$moderatedComment = preg_replace('/\d{3}[\-]?\d{4}/', '[PHONE HIDDEN]', $moderatedComment);

// Check for banned words
$foundBannedWords = [];
foreach ($bannedWords as $word) {
    if (stripos($userComment, $word) !== false) {
        $foundBannedWords[] = $word;
        $moderatedComment = str_ireplace($word, str_repeat('*', strlen($word)), $moderatedComment);
    }
}

echo "Moderated Comment:\n  $moderatedComment\n\n";

if (!empty($foundBannedWords)) {
    echo "⚠ Flagged words: " . implode(', ', $foundBannedWords) . "\n";
}

echo "\n";

// Real-world example: CSV parsing
echo "7. CSV Data Parsing\n";
echo str_repeat("-", 50) . "\n";

$csvData = "John,Doe,john@example.com,Developer\nJane,Smith,jane@example.com,Designer\nBob,Johnson,bob@example.com,Manager";

echo "Parsing CSV data:\n\n";

$lines = explode("\n", $csvData);
foreach ($lines as $index => $line) {
    $fields = explode(",", $line);
    $recordNumber = $index + 1;
    
    echo "Record #$recordNumber:\n";
    echo "  Name: {$fields[0]} {$fields[1]}\n";
    echo "  Email: {$fields[2]}\n";
    echo "  Role: {$fields[3]}\n\n";
}

// Real-world example: String search operations
echo "8. Advanced String Searching\n";
echo str_repeat("-", 50) . "\n";

$documentContent = "The quick brown fox jumps over the lazy dog. The dog was sleeping under a tree.";
$searchTerms = ["fox", "cat", "dog", "tree"];

echo "Document: $documentContent\n\n";
echo "Search Results:\n";

foreach ($searchTerms as $term) {
    $position = strpos($documentContent, $term);
    $count = substr_count($documentContent, $term);
    
    if ($position !== false) {
        echo "✓ '$term' found at position $position (appears $count time(s))\n";
        
        // Extract context around the term
        $start = max(0, $position - 20);
        $length = min(strlen($documentContent) - $start, strlen($term) + 40);
        $context = substr($documentContent, $start, $length);
        echo "  Context: ...$context...\n";
    } else {
        echo "✗ '$term' not found\n";
    }
    echo "\n";
}

echo "💡 Best Practice: Always sanitize user input, use appropriate string\n";
echo "   functions for the task, and consider UTF-8 encoding for international text.\n";

// Real-world example: Using string padding for formatting
echo "9. String Padding for Formatting\n";
echo str_repeat("-", 50) . "\n";

$documentContent = "Chapter 1: Introduction to PHP\nChapter 2: Advanced PHP Techniques\nChapter 3: PHP and Web Development\nChapter 4: PHP Best Practices and Patterns in 2025";
$chapterIndexes = [1, 20, 33, 45];
$lines = explode("\n", $documentContent);
foreach ($lines as $line) {
    // Pad chapter titles to align numbers
    $paddedLine = str_pad($line, 100, '.', STR_PAD_RIGHT);
    echo $paddedLine . ' '. $chapterIndexes[array_search(substr($line, 8, 1), array_map(fn($i) => (string)$i, range(1, count($lines))))] . "\n";
}
echo "\n";

// Real-world example: Advanced stuff
echo "10. Advanced String Handling\n";
echo str_repeat("-", 50) . "\n";

$chineseText = "汉字是中文的书写系统。它们有着悠久的历史和丰富的文化内涵。";
$wrongLength = strlen($chineseText);
$correctLength = mb_strlen($chineseText, 'UTF-8');
echo "Chinese Text: $chineseText\n";
echo "Length (bytes): $wrongLength\n";
echo "Length (characters): $correctLength\n";

$url= "https://example.com/search?query=php+字符串&lang=zh-cn";
$encodedUrl = rawurlencode($url);
$decodedUrl = rawurldecode($encodedUrl);
echo "Original URL: $url\n";
echo "Encoded URL: $encodedUrl\n";
echo "Decoded URL: $decodedUrl\n\n";
var_dump($encodedUrl);

$htmlString = "<div><h1>Title</h1><p>This is a <strong>bold</strong> statement.</p></div>";
$plainText = strip_tags($htmlString);
echo "HTML String: $htmlString\n";
echo "Plain Text: $plainText\n\n";

$textToEncode = "Encode this string to Base64!";
$base64String = base64_encode($textToEncode);
$decodedBase64 = base64_decode($base64String);
echo "Base64 Encoded: $base64String\n";
echo "Base64 Decoded: $decodedBase64\n";
