<?php
// test-zamtel.php - Direct SMS test for Zamtel configuration

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

// Bootstrap Laravel
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Services\NotificationService;
use App\Models\Notification;

echo "=== Tigula Zamtel SMS Test ===\n\n";

// Initialize notification service
$service = app(NotificationService::class);

$phoneNumber = '260979770547';
$message = 'Hello! This is a test SMS from your Tigula platform via Zamtel SMS Gateway. Time: ' . now()->format('Y-m-d H:i:s') . '. Testing with formatted number.';

// Format the phone number (using reflection since it's protected)
$reflectionClass = new ReflectionClass($service);
$formatMethod = $reflectionClass->getMethod('formatPhoneNumber');
$formatMethod->setAccessible(true);
$formattedPhone = $formatMethod->invoke($service, $phoneNumber);

echo "Original phone: {$phoneNumber}\n";
echo "Formatted phone: {$formattedPhone}\n";
echo "Message: {$message}\n\n";

try {
    echo "Sending SMS...\n";

    // Create a simple test wrapper to access protected method
    $reflection = new ReflectionClass($service);
    $method = $reflection->getMethod('sendSMS');
    $method->setAccessible(true);

    $result = $method->invoke($service, $formattedPhone, $message, null);

    echo "SMS Result: " . ($result ? "SUCCESS" : "FAILED") . "\n\n";

    // Get the latest notification for details
    $latest = Notification::latest()->first();

    if ($latest) {
        echo "=== Notification Details ===\n";
        echo "Type: {$latest->type}\n";
        echo "Recipient: {$latest->recipient}\n";
        echo "Status: {$latest->status}\n";
        echo "Response: {$latest->response}\n";
        echo "Sent At: {$latest->sent_at}\n";
    }

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "\n=== Test Complete ===\n";
