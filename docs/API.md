# API Reference

## Payment Intents

### List Payment Intents

```php
$modemPay->paymentIntents()->list([
    'limit' => 10,
    'offset' => 0
]);
```

### Get Payment Intent

```php
$modemPay->paymentIntents()->retrieve('hash');
```

### Create Payment Intent

```php
$modemPay->paymentIntents()->create([
    'amount' => 1000,
    'currency' => 'GMD'
]);
```

## Transfers

### Create Transfer

```php
$modemPay->transfers()->create([
    'amount' => 1000,
    'account_number' => '7012345',
    'network' => 'wave',
    'currency' => 'GMD',
    'beneficiary_name' => 'John Doe'
], 'idempotency-key');
```

## Webhooks

### Validate Webhook

```php
$event = $modemPay->webhooks()->composeEventDetails(
    $payload,      // Raw request body (string)
    $signature,    // x-modem-signature header
    $secret        // Your webhook secret
);
```

### Event Types

```php
use ModemPay\Types\EventType;

EventType::CUSTOMER_CREATED
EventType::CUSTOMER_UPDATED
EventType::CUSTOMER_DELETED
EventType::PAYMENT_INTENT_CREATED
EventType::PAYMENT_INTENT_CANCELLED
EventType::CHARGE_CANCELLED
EventType::CHARGE_SUCCEEDED
EventType::CHARGE_CREATED
EventType::CHARGE_UPDATED
EventType::CHARGE_FAILED
EventType::TRANSFER_FAILED
EventType::TRANSFER_SUCCEEDED
EventType::TRANSFER_REVERSED
```

### Access Event Data

```php
$event->event;    // EventType enum
$event->payload;  // Event payload data

// Example
echo $event->event->value;  // "payment_intent.created"
print_r($event->payload);   // ['id' => 'pi_123', ...]
```

## Error Handling

```php
use ModemPay\Exceptions\ModemPayException;

try {
    $payment = $modemPay->paymentIntents()->create([...]);
} catch (ModemPayException $e) {
    echo "Error: " . $e->getMessage();
    echo "Code: " . $e->getCode();
}
```
