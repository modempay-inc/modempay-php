<?php

namespace ModemPay\Types;


/**
 * Parameters for creating a transfer.
 */
class TransferParams
{
  /**
   * The amount to be transferred.
   */
  public float $amount;

  /**
   * The currency code for the transfer (e.g., "GMD", "USD").
   */
  public string $currency;

  /**
   * Optional description or note for the transfer.
   */
  public ?string $narration = null;

  /**
   * The payment network to use for the transfer (e.g., "afrimoney", "wave").
   */
  public string $network;

  /**
   * Name of the beneficiary receiving the transfer.
   */
  public string $beneficiary_name;

  /**
   * Optional additional metadata associated with the transfer.
   */
  public ?array $metadata = null;

  /**
   * The account number of the beneficiary.
   */
  public string $account_number;

  /**
   * The URL to which Modem Pay will send a callback or webhook notification after payout processing.
   */
  public ?string $callback_url = null;

  public function toArray(): array
  {
    return array_filter([
      'amount' => $this->amount,
      'currency' => $this->currency,
      'narration' => $this->narration,
      'network' => $this->network,
      'beneficiary_name' => $this->beneficiary_name,
      'metadata' => $this->metadata,
      'account_number' => $this->account_number,
      'callback_url' => $this->callback_url,
    ], fn($value) => $value !== null);
  }
}