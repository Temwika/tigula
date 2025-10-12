# Tigula SMS Gateway Setup

The `NotificationService` supports two SMS providers: **Twilio** (recommended) and **Generic HTTP Gateway**.

## 🚀 Quick Setup with Twilio (Recommended)

Twilio offers a generous free tier ($15 USD credit) and reliable delivery worldwide.

### Step 1: Create Twilio Account
1. Go to [twilio.com](https://twilio.com) and sign up
2. Get a free Twilio phone number
3. Find your Account SID and Auth Token in the Console

### Step 2: Configure .env
Add these to your `.env` file:

```bash
# Enable SMS sending
SMS_ENABLED=true

# Use Twilio provider
SMS_PROVIDER=twilio

# Twilio credentials (from your Twilio Console)
TWILIO_SID=your-account-sid-here
TWILIO_TOKEN=your-auth-token-here
TWILIO_FROM=+1234567890  # Your Twilio phone number

# Optional: Custom sender ID
SMS_SENDER_ID=TIGULA
```

## 🔧 Alternative: Generic HTTP Gateway

For custom SMS providers or APIs:

```bash
# Enable SMS sending
SMS_ENABLED=true

# Use HTTP provider
SMS_PROVIDER=http

# HTTP gateway settings
SMS_GATEWAY_URL=https://your-sms-gateway.example.com/send
SMS_API_KEY=your-api-key-here
SMS_SENDER_ID=TIGULA
```

## 🧪 Testing SMS

1. **Test Route**: Log in as admin and visit `/test-sms`
2. **Quick Purchase**: Use `/transactions/quick-create` to trigger real SMS
3. **Check Logs**: View `storage/logs/laravel.log` for SMS results
4. **Database**: Check `notifications` table for delivery status

## 📱 Supported Features

- **Farmer Notifications**: Transaction confirmations, payment alerts
- **Admin Alerts**: New purchases, approval requests
- **Welcome Messages**: New farmer onboarding
- **Payment Confirmations**: Mobile money transfer confirmations

## 🔒 Security Notes

- Keep credentials in `.env`, never commit them
- Twilio uses HTTPS by default
- Phone numbers are automatically formatted for Zambia (+260)
- Failed sends are logged and tracked in database

## 💡 Provider Comparison

| Feature | Twilio | HTTP Gateway |
|---------|--------|--------------|
| Free Tier | $15 USD credit | Varies |
| Global Reach | Excellent | Varies |
| Reliability | Very High | Varies |
| Setup | Easy | Custom |
| Cost | Pay-per-SMS | Varies |

**Recommendation**: Start with Twilio for development, then switch to local provider for production if needed.