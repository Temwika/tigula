<?php
// app/Services/NotificationService.php
namespace App\Services;

use App\Models\Transaction;
use App\Models\Payment;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client as TwilioClient;

class NotificationService
{
    protected $smsConfig;
    protected $twilioClient;

    public function __construct()
    {
        $this->smsConfig = config('services.sms');
        
        // Initialize Twilio client if using Twilio provider
        if ($this->smsConfig['provider'] === 'twilio' && $this->smsConfig['twilio']['sid']) {
            $this->twilioClient = new TwilioClient(
                $this->smsConfig['twilio']['sid'],
                $this->smsConfig['twilio']['token']
            );
        }
    }

    /**
     * Send SMS notification to farmer after transaction (Tigula branded)
     */
    public function sendFarmerTransactionSMS(Transaction $transaction)
    {
        $farmer = $transaction->farmer;
        $grainType = $transaction->grainType;

        $message = sprintf(
            "Dear %s, thank you for using Tigula! You have sold %.2f kg of %s. " .
            "Transaction: %s. Amount: ZMW %.2f. Your payment is being processed. " .
            "Track your transaction on Tigula platform.",
            $farmer->full_name,
            $transaction->weight_kg,
            $grainType->name,
            $transaction->transaction_number,
            $transaction->total_amount
        );

        return $this->sendSMS($farmer->phone_number, $message, $transaction->id);
    }

    /**
     * Send notification to admin for payment approval (Tigula branded)
     */
    public function sendAdminPaymentNotification(Transaction $transaction)
    {
        $admins = User::where('role', 'admin')
            ->where('status', 'active')
            ->get();

        $message = sprintf(
            "[TIGULA] Payment Approval Required: %s for %s (ZMW %.2f). " .
            "Farmer: %s from %s. Grain: %s (%.2f kg). Please review on Tigula platform.",
            $transaction->transaction_number,
            $transaction->farmer->full_name,
            $transaction->total_amount,
            $transaction->farmer->full_name,
            $transaction->farmer->village,
            $transaction->grainType->name,
            $transaction->weight_kg
        );

        foreach ($admins as $admin) {
            $this->sendSMS($admin->phone_number ?? $admin->phone, $message, $transaction->id);
        }

        return true;
    }

    /**
     * Send payment completion notification (Tigula branded)
     */
    public function sendPaymentCompletionSMS(Payment $payment)
    {
        $transaction = $payment->transaction;
        $farmer = $payment->farmer;

        $message = sprintf(
            "Dear %s, great news from Tigula! Your payment of ZMW %.2f has been successfully sent to %s. " .
            "Payment Ref: %s. Thank you for trusting Tigula - Smart Grain Trading Platform by Uplift Services Limited.",
            $farmer->full_name,
            $payment->amount,
            $farmer->phone_number,
            $payment->payment_reference
        );

        return $this->sendSMS($farmer->phone_number, $message, $transaction->id);
    }

    /**
     * Send welcome SMS to newly registered farmer (Tigula branded)
     */
    public function sendWelcomeSMS($farmer)
    {
        $message = sprintf(
            "Welcome to Tigula, %s! You are now part of Zambia's smartest grain trading platform. " .
            "Sell your grains, track transactions, and get paid instantly via mobile money. " .
            "For support, contact us. Happy trading!",
            $farmer->full_name
        );

        return $this->sendSMS($farmer->phone_number, $message);
    }

    /**
     * Send farmer registration with grain delivery SMS
     */
    public function sendFarmerRegistrationWithGrainSMS($farmer, $transaction)
    {
        $grainType = $transaction->grainType;
        
        // SMS to farmer
        $farmerMessage = sprintf(
            "Welcome to Tigula, %s! Your registration is complete and we've recorded your %s delivery of %.2f kg. " .
            "Transaction: %s. Amount: ZMW %.2f. Payment will be processed after approval. Thank you for choosing Tigula!",
            $farmer->full_name,
            $grainType->name,
            $transaction->weight_kg,
            $transaction->transaction_number,
            $transaction->total_amount
        );

        // SMS to admin about new farmer with grain
        $adminMessage = sprintf(
            "[TIGULA] New Farmer Registration: %s from %s, %s has joined with %s delivery. " .
            "Grain: %s (%.2f kg), Amount: ZMW %.2f, Transaction: %s. Please review and approve payment.",
            $farmer->full_name,
            $farmer->village,
            $farmer->district,
            $grainType->name,
            $grainType->name,
            $transaction->weight_kg,
            $transaction->total_amount,
            $transaction->transaction_number
        );

        // Send SMS to farmer
        $farmerResult = $this->sendSMS($farmer->phone_number, $farmerMessage, $transaction->id);
        
        // Send SMS to admins
        $admins = User::where('role', 'admin')->where('status', 'active')->get();
        foreach ($admins as $admin) {
            $this->sendSMS($admin->phone_number ?? $admin->phone, $adminMessage, $transaction->id);
        }

        return $farmerResult;
    }

    /**
     * Send daily summary to administrators (Tigula branded)
     */
    public function sendDailySummary($stats)
    {
        $admins = User::where('role', 'admin')
            ->where('status', 'active')
            ->get();

        $message = sprintf(
            "[TIGULA] Daily Summary:\n" .
            "Transactions: %d\n" .
            "Total Sales: ZMW %.2f\n" .
            "Total Weight: %.2f kg\n" .
            "New Farmers: %d\n" .
            "Pending Approvals: %d\n" .
            "Platform: Tigula by Uplift Services",
            $stats['transactions'],
            $stats['amount'],
            $stats['weight'],
            $stats['new_farmers'] ?? 0,
            $stats['pending']
        );

        foreach ($admins as $admin) {
            $this->sendSMS($admin->phone_number ?? $admin->phone, $message);
        }

        return true;
    }

    /**
     * Send payment initiation notification
     */
    public function sendPaymentInitiationSMS(Payment $payment)
    {
        $farmer = $payment->farmer;
        
        $message = sprintf(
            "Dear %s, Tigula is processing your payment of ZMW %.2f to %s via %s Money. " .
            "You will receive confirmation shortly. Ref: %s",
            $farmer->full_name,
            $payment->amount,
            $payment->phone_number,
            strtoupper($payment->payment_method),
            $payment->payment_reference
        );

        return $this->sendSMS($farmer->phone_number, $message, $payment->transaction_id);
    }

    /**
     * Send SMS via configured provider (Twilio or HTTP gateway)
     */
    protected function sendSMS($phoneNumber, $message, $transactionId = null)
    {
        try {
            // Clean phone number
            $phoneNumber = $this->formatPhoneNumber($phoneNumber);

            // Log notification in database
            $notification = Notification::create([
                'type' => 'sms',
                'recipient' => $phoneNumber,
                'message' => $message,
                'transaction_id' => $transactionId,
                'status' => 'pending'
            ]);

            // Check if SMS is enabled
            if (!$this->smsConfig['enabled']) {
                Log::info("SMS disabled - Would send to {$phoneNumber}: {$message}");
                $notification->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                    'response' => 'SMS gateway disabled in config'
                ]);
                return true;
            }

            // Send via configured provider
            if ($this->smsConfig['provider'] === 'twilio') {
                $response = $this->sendViaTwilio($phoneNumber, $message);
            } elseif ($this->smsConfig['provider'] === 'zamtel') {
                $response = $this->sendViaZamtel($phoneNumber, $message);
            } else {
                $response = $this->sendViaHttp($phoneNumber, $message);
            }

            if ($response['success']) {
                $notification->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                    'response' => $response['message']
                ]);

                Log::info("Tigula SMS sent successfully to {$phoneNumber} via {$this->smsConfig['provider']}");
                return true;
            }

            throw new \Exception($response['message']);

        } catch (\Exception $e) {
            Log::error("Tigula SMS failed: " . $e->getMessage());
            
            if (isset($notification)) {
                $notification->update([
                    'status' => 'failed',
                    'response' => $e->getMessage()
                ]);
            }

            return false;
        }
    }

    /**
     * Send SMS via Twilio
     */
    protected function sendViaTwilio($phoneNumber, $message)
    {
        try {
            if (!$this->twilioClient) {
                throw new \Exception('Twilio client not initialized - check TWILIO_SID and TWILIO_TOKEN');
            }

            $message = $this->twilioClient->messages->create(
                $phoneNumber, // To number
                [
                    'from' => $this->smsConfig['twilio']['from'],
                    'body' => $message
                ]
            );

            return [
                'success' => true,
                'message' => "Twilio message sent. SID: {$message->sid}"
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => "Twilio error: " . $e->getMessage()
            ];
        }
    }

    /**
     * Send SMS via Zamtel Bulk SMS Gateway (Zambia)
     *
     * Uses the REST API format:
     * POST https://bulksms.zamtel.co.zm/api/v2.1/action/send/api_key/{api_key}/contacts/[{contacts}]/senderId/{sender_id}/message/{message}
     */
    protected function sendViaZamtel($phoneNumber, $message)
    {
        try {
            $zamtelConfig = $this->smsConfig['zamtel'];

            if (!$zamtelConfig['api_key']) {
                \Log::warning('Zamtel SMS API key not configured');
                throw new \Exception('Zamtel SMS API key not configured');
            }

            // Zamtel expects an array of contacts
            $contacts = [$phoneNumber];
            $urlEncodedMessage = urlencode($message);

            // Build the Zamtel REST API URL
            $zamtelUrl = "https://bulksms.zamtel.co.zm/api/v2.1/action/send/"
                        . "api_key/{$zamtelConfig['api_key']}/"
                        . "contacts/[" . implode(',', $contacts) . "]/"
                        . "senderId/{$zamtelConfig['sender_id']}/"
                        . "message/{$urlEncodedMessage}";

            \Log::info('Attempting SMS via Zamtel gateway', [
                'url' => $zamtelUrl,
                'phone_count' => count($contacts),
                'sender_id' => $zamtelConfig['sender_id'],
                'message_length' => strlen($message),
                'encoded_message_length' => strlen($urlEncodedMessage)
            ]);

            // Zamtel uses GET request for this API format
            $response = Http::timeout(30)->get($zamtelUrl);

            \Log::info('Zamtel gateway response', [
                'status_code' => $response->status(),
                'response_body' => $response->body(),
                'is_successful' => $response->successful()
            ]);

            // Handle Zamtel's response based on their status codes
            $statusCode = $response->status();
            $responseBody = $response->body();

            // Zamtel returns different success codes
            if ($statusCode === 200) {
                return [
                    'success' => true,
                    'message' => "Zamtel SMS sent successfully. Status: {$statusCode}, Response: {$responseBody}"
                ];
            } elseif ($statusCode === 201) {
                return [
                    'success' => true,
                    'message' => "Zamtel SMS registered successfully. Status: {$statusCode}, Response: {$responseBody}"
                ];
            }

            // Handle error codes
            $errorMessages = [
                400 => 'Bad Request - insufficient balance or invalid parameters',
                401 => 'Unauthorized - invalid API key',
                422 => 'Validation Error',
                500 => 'Internal Server Error'
            ];

            $errorMessage = $errorMessages[$statusCode] ?? "Unknown error (Status: {$statusCode})";
            throw new \Exception("{$errorMessage}: {$responseBody}");

        } catch (\Exception $e) {
            \Log::error('Zamtel SMS gateway failed', [
                'error' => $e->getMessage(),
                'phone' => $phoneNumber,
                'api_key_configured' => !empty($zamtelConfig['api_key']) ? 'Yes' : 'No'
            ]);

            return [
                'success' => false,
                'message' => "Zamtel gateway error: " . $e->getMessage()
            ];
        }
    }

    /**
     * Send SMS via generic HTTP gateway
     */
    protected function sendViaHttp($phoneNumber, $message)
    {
        try {
            if (!$this->smsConfig['gateway_url'] || !$this->smsConfig['api_key']) {
                \Log::warning('SMS HTTP gateway not fully configured', [
                    'gateway_url' => $this->smsConfig['gateway_url'] ? 'Set' : 'Missing',
                    'api_key' => $this->smsConfig['api_key'] ? 'Set' : 'Missing'
                ]);
                throw new \Exception('HTTP gateway URL or API key not configured');
            }

            \Log::info('Attempting SMS via HTTP gateway', [
                'url' => $this->smsConfig['gateway_url'],
                'phone' => $phoneNumber,
                'message_length' => strlen($message)
            ]);

            $response = Http::timeout(10)->post($this->smsConfig['gateway_url'], [
                'api_key' => $this->smsConfig['api_key'],
                'phone' => $phoneNumber,
                'message' => $message,
                'sender_id' => $this->smsConfig['sender_id']
            ]);

            \Log::info('HTTP gateway response', [
                'status_code' => $response->status(),
                'response_body' => $response->body()
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "HTTP gateway response: " . $response->body()
                ];
            }

            throw new \Exception("HTTP gateway error (Status: {$response->status()}): " . $response->body());

        } catch (\Exception $e) {
            \Log::error('HTTP SMS gateway failed', [
                'error' => $e->getMessage(),
                'phone' => $phoneNumber
            ]);
            
            return [
                'success' => false,
                'message' => "HTTP gateway error: " . $e->getMessage()
            ];
        }
    }

    /**
     * Format phone number to international format for Zambia
     */
    protected function formatPhoneNumber($phone)
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Add country code if not present (Zambia: +260)
        if (strlen($phone) === 9) {
            $phone = '260' . $phone;
        } elseif (strlen($phone) === 10 && substr($phone, 0, 1) === '0') {
            $phone = '260' . substr($phone, 1);
        }

        return $phone;
    }

    /**
     * Send bulk SMS (for announcements)
     */
    public function sendBulkSMS($recipients, $message)
    {
        $results = [
            'sent' => 0,
            'failed' => 0,
            'total' => count($recipients)
        ];

        foreach ($recipients as $recipient) {
            $phone = is_array($recipient) ? $recipient['phone'] : $recipient;
            
            if ($this->sendSMS($phone, $message)) {
                $results['sent']++;
            } else {
                $results['failed']++;
            }

            // Rate limiting - sleep for 100ms between messages
            usleep(100000);
        }

        return $results;
    }

    /**
     * Send transaction status update
     */
    public function sendStatusUpdateSMS(Transaction $transaction, $newStatus)
    {
        $farmer = $transaction->farmer;
        
        $statusMessages = [
            'approved' => "Your Tigula transaction %s has been approved! Amount: ZMW %.2f. Payment will be processed shortly.",
            'paid' => "Success! Your Tigula payment of ZMW %.2f has been completed. Ref: %s. Thank you for using Tigula!",
            'cancelled' => "Your Tigula transaction %s has been cancelled. Please contact support for details."
        ];

        if (!isset($statusMessages[$newStatus])) {
            return false;
        }

        $message = sprintf(
            "Dear %s, " . $statusMessages[$newStatus],
            $farmer->full_name,
            $transaction->transaction_number,
            $transaction->total_amount
        );

        return $this->sendSMS($farmer->phone_number, $message, $transaction->id);
    }
}
