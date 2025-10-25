# Webhook Handling

## Setup

1. Add your webhook secret to `.env`:

```env
MODEMPAY_WEBHOOK_SECRET=whsec_your_secret_here
```

2. Create a webhook endpoint that validates the signature.

## Vanilla PHP Example

```php
<?php
require 'vendor/autoload.php';

use ModemPay\ModemPay;

$modemPay = new ModemPay('your_api_key');

$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_MODEMPAY_SIGNATURE'] ?? '';
$secret = 'your_webhook_secret';

try {
    $event = $modemPay->webhooks()->composeEventDetails(
        $payload,
        $signature,
        $secret
    );

    // Handle event
    match($event->event) {
        \ModemPay\Types\EventType::PAYMENT_INTENT_CREATED => handlePaymentCreated($event),
        \ModemPay\Types\EventType::CHARGE_SUCCEEDED => handleChargeSucceeded($event),
        default => null,
    };

    http_response_code(200);
    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}

function handlePaymentCreated($event) {
    $paymentId = $event->payload['id'];
    // Process payment...
}

function handleChargeSucceeded($event) {
    $chargeId = $event->payload['id'];
    // Process charge...
}
```

## Laravel Example

See [Laravel Integration](LARAVEL.md#webhook-handling) for complete Laravel examples.

## Security

- **Always validate signatures** - Never process webhooks without validation
- **Use HTTPS** - Webhooks should only be sent to HTTPS endpoints
- **Idempotency** - Handle duplicate webhook deliveries gracefully
- **Verify payload** - Check that payload data matches expected structure

## Testing Webhooks

Use curl to test locally:

```bash
curl -X POST http://localhost:8000/webhooks/modempay \
  -H "Content-Type: application/json" \
  -H "X-ModemPay-Signature: computed_signature_here" \
  -d '{"event":"payment_intent.created","payload":{"id":"pi_123"}}'
```

## Event Types

All available webhook events:

- `customer.created` - Customer created
- `customer.updated` - Customer updated
- `customer.deleted` - Customer deleted
- `payment_intent.created` - Payment intent created
- `payment_intent.cancelled` - Payment intent cancelled
- `charge.created` - Charge created
- `charge.updated` - Charge updated
- `charge.succeeded` - Charge succeeded
- `charge.failed` - Charge failed
- `charge.cancelled` - Charge cancelled
- `transfer.succeeded` - Transfer succeeded
- `transfer.failed` - Transfer failed
- `transfer.reversed` - Transfer reversed
