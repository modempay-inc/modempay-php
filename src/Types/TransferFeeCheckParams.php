<?php

namespace ModemPay\Types;


/**
 * Parameters for checking transfer fees.
 */
class TransferFeeCheckParams
{
  /**
   * The amount to be transferred.
   */
  public float $amount;

  /**
   * The currency code for the transfer amount (e.g., "GMD", "USD").
   */
  public string $currency;

  /**
   * The payment network to be used for the transfer (e.g., "afrimoney", "wave").
   */
  public string $network;

  public function toArray(): array
  {
    return [
      'amount' => $this->amount,
      'currency' => $this->currency,
      'network' => $this->network,
    ];
  }
}