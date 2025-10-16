<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class NotificationService
{
    /**
     * SMS Gateway Configuration
     */
    private $smsGatewayUrl;
    private $smsApiKey;
    private $senderName;

    public function __construct()
    {
        $this->smsGatewayUrl = config('services.sms.gateway_url', 'https://api.smsgateway.example.com/send');
        $this->smsApiKey = config('services.sms.api_key', 'your-api-key');
        $this->senderName = config('services.sms.sender_name', 'GrainTrade');
    }

    /**
     * Send SMS notification
     */
    public function sendSMS(string $phoneNumber, string $message): array
    {
        try {
            // Clean phone number (remove spaces, hyphens)
            $cleanNumber = preg_replace('/[\s\-\(\)]/', '', $phoneNumber);
            
            // Ensure Zambian format (+260)
            if (!str_starts_with($cleanNumber, '+260') && !str_starts_with($cleanNumber, '260')) {
                if (str_starts_with($cleanNumber, '0')) {
                    $cleanNumber = '+260' . substr($cleanNumber, 1);
                } else {
                    $cleanNumber = '+260' . $cleanNumber;
                }
            }

            // Add branding to message
            $brandedMessage = $this->addBranding($message);

            // For development - log the SMS instead of sending
            if (config('app.env') === 'local') {
                Log::info('SMS Notification', [
                    'to' => $cleanNumber,
                    'message' => $brandedMessage,
                    'timestamp' => now()->toISOString(),
                ]);

                return [
                    'success' => true,
                    'message' => 'SMS logged successfully (dev mode)',
                    'reference' => 'DEV_' . time(),
                ];
            }

            // Send via SMS Gateway
            $response = Http::timeout(30)->post($this->smsGatewayUrl, [
                'api_key' => $this->smsApiKey,
                'sender' => $this->senderName,
                'to' => $cleanNumber,
                'message' => $brandedMessage,
                'type' => 'text',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('SMS Sent Successfully', [
                    'to' => $cleanNumber,
                    'reference' => $data['reference'] ?? 'unknown',
                ]);

                return [
                    'success' => true,
                    'message' => 'SMS sent successfully',
                    'reference' => $data['reference'] ?? 'SMS_' . time(),
                ];
            } else {
                Log::error('SMS Gateway Error', [
                    'to' => $cleanNumber,
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);

                return [
                    'success' => false,
                    'message' => 'SMS gateway error: ' . $response->status(),
                    'reference' => null,
                ];
            }

        } catch (\Exception $e) {
            Log::error('SMS Sending Failed', [
                'to' => $phoneNumber,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'SMS sending failed: ' . $e->getMessage(),
                'reference' => null,
            ];
        }
    }

    /**
     * Send bulk SMS notifications
     */
    public function sendBulkSMS(array $recipients): array
    {
        $results = [];
        $successCount = 0;
        $failCount = 0;

        foreach ($recipients as $recipient) {
            $result = $this->sendSMS($recipient['phone'], $recipient['message']);
            $results[] = [
                'phone' => $recipient['phone'],
                'success' => $result['success'],
                'reference' => $result['reference'] ?? null,
                'message' => $result['message'],
            ];

            if ($result['success']) {
                $successCount++;
            } else {
                $failCount++;
            }
        }

        return [
            'total' => count($recipients),
            'success' => $successCount,
            'failed' => $failCount,
            'results' => $results,
        ];
    }

    /**
     * Add branding to SMS messages
     */
    private function addBranding(string $message): string
    {
        // Add footer with branding
        $footer = "\n\n🌾 " . config('app.name', 'GrainTrade') . " - Your trusted grain trading partner";
        
        return $message . $footer;
    }

    /**
     * Send farmer welcome SMS
     */
    public function sendFarmerWelcome(string $phoneNumber, string $farmerName, string $depotName): array
    {
        $message = "Welcome to our grain trading platform, {$farmerName}! You have been assigned to {$depotName} depot. Start trading with confidence and transparency.";
        
        return $this->sendSMS($phoneNumber, $message);
    }

    /**
     * Send transaction notification
     */
    public function sendTransactionAlert(string $phoneNumber, string $farmerName, string $transactionNumber, float $amount, string $grainType): array
    {
        $message = "Dear {$farmerName}, your grain transaction #{$transactionNumber} for {$grainType} worth K{$amount} has been recorded successfully. Payment will be processed shortly.";
        
        return $this->sendSMS($phoneNumber, $message);
    }

    /**
     * Send payment confirmation
     */
    public function sendPaymentConfirmation(string $phoneNumber, string $farmerName, float $amount, string $reference): array
    {
        $message = "Payment Confirmed! Dear {$farmerName}, K{$amount} has been sent to your mobile money account. Reference: {$reference}. Thank you for your business!";
        
        return $this->sendSMS($phoneNumber, $message);
    }

    /**
     * Send system notifications to admins
     */
    public function sendAdminAlert(string $message, array $adminNumbers = []): array
    {
        if (empty($adminNumbers)) {
            // Get admin phone numbers from config or database
            $adminNumbers = config('notifications.admin_numbers', []);
        }

        $recipients = array_map(function ($phone) use ($message) {
            return ['phone' => $phone, 'message' => '[ADMIN ALERT] ' . $message];
        }, $adminNumbers);

        return $this->sendBulkSMS($recipients);
    }

    /**
     * Send low stock alerts
     */
    public function sendLowStockAlert(string $depotName, string $grainType, float $currentStock): array
    {
        $message = "⚠️ LOW STOCK ALERT: {$depotName} depot has low stock of {$grainType} - Current: {$currentStock}kg. Please arrange for restocking.";
        
        return $this->sendAdminAlert($message);
    }

    /**
     * Send daily summary to depot managers
     */
    public function sendDailySummary(string $phoneNumber, string $managerName, array $summary): array
    {
        $message = "Daily Summary for {$managerName}:\n";
        $message .= "Transactions: {$summary['transactions']}\n";
        $message .= "Total Amount: K{$summary['amount']}\n";
        $message .= "New Farmers: {$summary['new_farmers']}\n";
        $message .= "Payments: {$summary['payments']}";
        
        return $this->sendSMS($phoneNumber, $message);
    }
}