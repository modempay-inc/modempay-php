<?php

namespace ModemPay;

use ModemPay\Http\Client;
use ModemPay\Resources\PaymentIntents;
use ModemPay\Resources\Transfers;
use ModemPay\Resources\Webhooks;

/**
 * @property-read Transfers $transfers
 * @property-read PaymentIntents $payment_intents
 * @property-read Webhooks $webhooks
 */
class ModemPay
{
  private Client $client;
  private array $resources = [];

  private const RESOURCE_MAP = [
    'transfers' => Transfers::class,
    'payment_intents' => PaymentIntents::class,
    'webhooks' => Webhooks::class,
  ];

  public function __construct(string $apiKey)
  {
    $this->client = new Client($apiKey);
  }

  public function transfers(): Transfers
  {
    return $this->resources['transfers'] ??= new Transfers($this->client);
  }

  public function paymentIntents(): PaymentIntents
  {
    return $this->resources['payment_intents'] ??= new PaymentIntents($this->client);
  }

  public function webhooks(): Webhooks
  {
    return $this->resources['webhooks'] ??= new Webhooks($this->client);
  }

  public function __get(string $name)
  {
    if (!isset(self::RESOURCE_MAP[$name])) {
      throw new \InvalidArgumentException("Property '{$name}' does not exist");
    }

    if (!isset($this->resources[$name])) {
      $class = self::RESOURCE_MAP[$name];
      $this->resources[$name] = new $class($this->client);
    }

    return $this->resources[$name];
  }
}