<?php

namespace ModemPay\Types;

/**
 * Representation of a payment intent.
 */
class PaymentIntent extends PaymentIntentParams
{
  /**
   * Unique identifier for the payment intent.
   *
   * @var string
   */
  public string $id;

  /**
   * The available payment gateway options for the payment method.
   *
   * @var PaymentGateway[]
   */
  public array $payment_method_options;

  /**
   * Customer associated with the payment intent.
   *
   * @var Customer|null
   */
  public ?Customer $Customer = null;

  /**
   * Secret key used to authenticate the payment intent.
   *
   * @var string
   */
  public string $intent_secret;

  /**
   * The current status of the payment intent. Possible values include:
   * "initialized", "processing", "requires_payment_method", "successful", "failed", and "cancelled".
   *
   * @var string
   */
  public string $status;

  /**
   * URL link to the payment intent, typically used for redirecting the customer.
   *
   * @var string
   */
  public string $link;

  /**
   * Custom values associated with the fields of the payment intent.
   *
   * @var object|array
   */
  public object|array $custom_fields_values;

  /**
   * Indicates if the payment intent is part of a session.
   *
   * @var bool
   */
  public bool $is_session;

  /**
   * Convert the payment intent to an array.
   *
   * @return array
   */
  public function toArray(): array
  {
    return [
      'id' => $this->id,
      'payment_method_options' => array_map(
        fn($gateway) => $gateway instanceof PaymentGateway ? $gateway->toArray() : $gateway,
        $this->payment_method_options
      ),
      'Customer' => $this->Customer?->toArray(),
      'intent_secret' => $this->intent_secret,
      'status' => $this->status,
      'link' => $this->link,
      'custom_fields_values' => $this->custom_fields_values,
      'is_session' => $this->is_session,
    ];
  }

  /**
   * Create a PaymentIntent instance from an array.
   *
   * @param array $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    $instance = new self();

    $instance->id = $data['id'] ?? '';
    $instance->payment_method_options = array_map(
      fn($gateway) => is_array($gateway) ? PaymentGateway::fromArray($gateway) : $gateway,
      $data['payment_method_options'] ?? []
    );
    $instance->Customer = isset($data['Customer']) && is_array($data['Customer'])
      ? Customer::fromArray($data['Customer'])
      : null;
    $instance->intent_secret = $data['intent_secret'] ?? '';
    $instance->status = $data['status'] ?? 'initialized';
    $instance->link = $data['link'] ?? '';
    $instance->custom_fields_values = $data['custom_fields_values'] ?? [];
    $instance->is_session = $data['is_session'] ?? false;

    return $instance;
  }
}