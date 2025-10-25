<?php

namespace ModemPay\Types;


/**
 * The data associated with the created payment intent.
 */
class PaymentIntentResponseData
{
  /**
   * Unique identifier for the payment intent.
   *
   * @var string
   */
  public string $payment_intent_id;

  /**
   * The secret key for the payment intent used to complete the payment.
   * (Not your API secret key)
   *
   * @var string
   */
  public string $intent_secret;

  /**
   * The payment link that allows the customer to complete the payment.
   *
   * @var string
   */
  public string $payment_link;

  /**
   * The amount involved in the payment intent (in the smallest unit of the currency).
   *
   * @var int|float
   */
  public int|float $amount;

  /**
   * The currency used for the payment intent (e.g., "GMD", "XOF").
   *
   * @var string
   */
  public string $currency;

  /**
   * The expiration time for the payment intent. The user must complete the payment before this time.
   *
   * @var string
   */
  public string $expires_at;

  /**
   * The current status of the payment intent (e.g., "initialized", "processing", etc.).
   *
   * @var string
   */
  public string $status;

  /**
   * Convert the PaymentIntentResponseData instance to an array.
   *
   * @return array
   */
  public function toArray(): array
  {
    return [
      'payment_intent_id' => $this->payment_intent_id,
      'intent_secret' => $this->intent_secret,
      'payment_link' => $this->payment_link,
      'amount' => $this->amount,
      'currency' => $this->currency,
      'expires_at' => $this->expires_at,
      'status' => $this->status,
    ];
  }

  /**
   * Create a PaymentIntentResponseData instance from an array.
   *
   * @param array $array
   * @return self
   */
  public static function fromArray(array $array): self
  {
    $data = new self();
    $data->payment_intent_id = $array['payment_intent_id'];
    $data->intent_secret = $array['intent_secret'];
    $data->payment_link = $array['payment_link'];
    $data->amount = $array['amount'];
    $data->currency = $array['currency'];
    $data->expires_at = $array['expires_at'];
    $data->status = $array['status'];
    return $data;
  }
}