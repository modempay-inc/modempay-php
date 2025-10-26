# ModemPay PHP SDK

Official PHP SDK for ModemPay payment processing.

[![Latest Version](https://img.shields.io/packagist/v/modempay/modempay-php.svg)](https://packagist.org/packages/modempay/modempay-php)
[![PHP Version](https://img.shields.io/packagist/php-v/modempay/modempay-php.svg)](https://packagist.org/packages/modempay/modempay-php)
[![License](https://img.shields.io/packagist/l/modempay/modempay-php.svg)](https://packagist.org/packages/modempay/modempay-php)

## Installation

```bash
composer require modempay/modempay-php
```

## Quick Start

```php
use ModemPay\ModemPay;

$modemPay = new ModemPay('your_api_key');

// List payment intents
$payments = $modemPay->paymentIntents()->list(['limit' => 10]);

// Create a transfer
$transfer = $modemPay->transfers()->create([
    'amount' => 1000,
    'account_number' => '7012345',
    'network' => 'wave',
    'currency' => 'GMD',
    'beneficiary_name' => 'John Doe'
], 'idempotency-key');

// Validate webhook
$event = $modemPay->webhooks()->composeEventDetails(
    file_get_contents('php://input'),
    $_SERVER['HTTP_X_MODEMPAY_SIGNATURE'],
    'your_webhook_secret'
);
```

## Laravel Integration

The SDK auto-registers with Laravel. [View Laravel documentation →](docs/LARAVEL.md)

```php
use ModemPay\Laravel\Facades\ModemPay;

ModemPay::paymentIntents()->list();
```

## Documentation

- [Laravel Integration](docs/LARAVEL.md)
- [API Reference](docs/API.md)
- [Webhook Handling](docs/WEBHOOKS.md)

## Requirements

- PHP 8.1 or higher
- Symfony HTTP Client

## License

MIT License - see [LICENSE](LICENSE) for details.

## Support

- Documentation: https://docs.modempay.com
- Email: info@modempay.com
