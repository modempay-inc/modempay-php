<?php

namespace ModemPay\Types;


/**
 * Response from transfer fee check.
 */
class TransferFeeCheckResponse
{
  /**
   * The fee amount charged for the transfer.
   */
  public float $fee;

  /**
   * The currency code for the fee amount (e.g., "GMD", "USD").
   */
  public string $currency;

  /**
   * The payment network used for the transfer (e.g., "afrimoney", "wave").
   */
  public string $network;

  /**
   * The total amount to be transferred including fees.
   */
  public float $amount;

  public static function fromArray(array $data): self
  {
    $response = new self();
    $response->fee = $data['fee'];
    $response->currency = $data['currency'];
    $response->network = $data['network'];
    $response->amount = $data['amount'];

    return $response;
  }
}