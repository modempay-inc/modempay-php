<?php

namespace ModemPay\Types;

/**
 * Represents the structure of the response returned after creating a payment intent.
 */
class PaymentIntentResponse
{
  /**
   * Indicates whether the payment intent creation was successful.
   * `true` means success, `false` would indicate an error or failure.
   *
   * @var bool
   */
  public bool $status;

  /**
   * A message providing additional details about the result of the payment intent creation.
   *
   * @var string
   */
  public string $message;

  /**
   * The data associated with the created payment intent.
   *
   * @var PaymentIntentResponseData|null
   */
  public ?PaymentIntentResponseData $data = null;

  /**
   * Convert the PaymentIntentResponse instance to an array.
   *
   * @return array
   */
  public function toArray(): array
  {
    return [
      'status' => $this->status,
      'message' => $this->message,
      'data' => $this->data?->toArray(),
    ];
  }

  /**
   * Create a PaymentIntentResponse instance from an array.
   *
   * @param array $array
   * @return self
   */
  public static function fromArray(array $array): self
  {
    $instance = new self();
    $instance->status = $array['status'];
    $instance->message = $array['message'];
    $instance->data = isset($array['data']) && is_array($array['data'])
      ? PaymentIntentResponseData::fromArray($array['data'])
      : null;

    return $instance;
  }
}