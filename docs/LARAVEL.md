# Laravel Integration

ModemPay SDK integrates seamlessly with Laravel via auto-discovery.

## Installation

```bash
composer require modempay/modempay-php
```

## Configuration

Add to your `.env`:

```env
MODEMPAY_API_KEY=your_api_key_here
MODEMPAY_WEBHOOK_SECRET=your_webhook_secret_here
```

Optionally publish the config:

```bash
php artisan vendor:publish --tag=modempay-config
```

## Usage

### Using Facade

```php
use ModemPay\Laravel\Facades\ModemPay;

// List payment intents
$payments = ModemPay::paymentIntents()->list(['limit' => 10]);

// Create transfer
$transfer = $modemPay->transfers()->initiate([
    'amount' => 1000,
    'account_number' => '7012345',
    'network' => 'wave',
    'currency' => 'GMD',
    'beneficiary_name' => 'John Doe'
], 'idempotency-key');
```

### Using Dependency Injection

```php
use ModemPay\ModemPay;

class PaymentController extends Controller
{
    public function __construct(private ModemPay $modemPay) {}

    public function index()
    {
        $payments = $this->modemPay->paymentIntents()->list();
        return view('payments', compact('payments'));
    }
}
```

## Webhook Handling

### Route

In `routes/api.php`:

```php
Route::post('/webhooks/modempay', [WebhookController::class, 'handle']);
```

### Controller

```php
use ModemPay\Laravel\Facades\ModemPay;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $event = ModemPay::webhooks()->composeEventDetails(
            $request->getContent(),
            $request->header('x-modem-signature'),
            config('modempay.webhook_secret')
        );

        match($event->event) {
            \ModemPay\Types\EventType::PAYMENT_INTENT_CREATED => $this->handlePayment($event),
            \ModemPay\Types\EventType::CHARGE_SUCCEEDED => $this->handleCharge($event),
            default => null,
        };

        return response()->json(['status' => 'success']);
    }

    private function handlePayment($event)
    {
        // Handle payment intent created
    }

    private function handleCharge($event)
    {
        // Handle charge succeeded
    }
}
```

### Event Listeners (Optional)

Listen to webhook events using Laravel's event system:

```php
// EventServiceProvider.php
protected $listen = [
    \ModemPay\Laravel\Events\WebhookReceived::class => [
        \App\Listeners\ProcessModemPayWebhook::class,
    ],
];
```

```php
// app/Listeners/ProcessModemPayWebhook.php
use ModemPay\Laravel\Events\WebhookReceived;

class ProcessModemPayWebhook
{
    public function handle(WebhookReceived $event)
    {
        // Access event data
        $eventType = $event->event->event;
        $payload = $event->event->payload;

        // Process webhook...
    }
}
```

## Available Methods

### Payment Intents

```php
ModemPay::paymentIntents()->list(['limit' => 10]);
ModemPay::paymentIntents()->retrieve('hash');
ModemPay::paymentIntents()->create([...]);
```

### Transfers

```php
ModemPay::transfers()->retrieve('tr_id');
ModemPay::transfers()->initiate([...], 'idempotency-key');
```

### Webhooks

```php
ModemPay::webhooks()->composeEventDetails($payload, $signature, $secret);
```

## Testing

Disable CSRF for webhook routes in `VerifyCsrfToken.php`:

```php
protected $except = [
    'webhooks/modempay',
];
```

Test with Tinker:

```bash
php artisan tinker
```

```php
ModemPay::paymentIntents()->list();
```
