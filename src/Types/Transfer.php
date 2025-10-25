<?php

namespace ModemPay\Types;

/**
 * Representation of a transfer transaction.
 */
class Transfer
{
  /**
   * Unique identifier for the transfer.
   */
  public string $id;

  /**
   * ID of the business initiating the transfer.
   */
  public string $business_id;

  /**
   * ID of the account from which the transfer is made.
   */
  public string $account_id;

  /**
   * ID of the merchant associated with the transfer.
   */
  public ?string $merchant_id = null;

  /**
   * ID of the recipient business, if applicable.
   */
  public ?string $recipient_business_id = null;

  /**
   * Amount to be transferred.
   */
  public float $amount;

  /**
   * Fee charged for the transfer.
   */
  public float $fee;

  /**
   * Currency code for the transfer (e.g., "GMD", "USD").
   */
  public string $currency;

  /**
   * Type of transfer (self, modem-pay, mobile-money, or bank).
   */
  public string $type;

  /**
   * Current status of the transfer.
   */
  public string $status;

  /**
   * Account balance before the transfer.
   */
  public float $balance_before;

  /**
   * Account balance after the transfer.
   */
  public float $balance_after;

  /**
   * Name of the account holder.
   */
  public ?string $account_name = null;

  /**
   * Payment network used for the transfer.
   */
  public ?string $network = null;

  /**
   * Bank name for bank transfers.
   */
  public ?string $bank = null;

  /**
   * Amount received by the beneficiary.
   */
  public ?float $amount_received = null;

  /**
   * Mobile number for mobile money transfers.
   */
  public ?string $mobile_number = null;

  /**
   * Account number for bank transfers.
   */
  public ?string $account_number = null;

  /**
   * Reason the transfer failed
   */
  public ?string $failure_reason = null;

  /**
   * Unique reference number for the transfer.
   */
  public string $transfer_reference;

  /**
   * Indicates if the transfer is in test mode.
   */
  public bool $test_mode;

  /**
   * Record of events related to the transfer.
   */
  public array $events;

  /**
   * Additional notes about the transfer.
   */
  public ?string $note = null;

  /**
   * One-time password for transfer verification.
   */
  public ?string $otp = null;

  /**
   * The URL to which Modem Pay will send a callback or webhook notification after payout processing.
   */
  public ?string $callback_url = null;

  /**
   * Unique key for each transfer to avoid duplicate processing
   */
  public ?string $idempotency_key = null;

  /**
   * Additional metadata associated with the transfer.
   */
  public array $metadata;

  public string $created_at;

  public string $updated_at;

  public static function fromArray(array $data): self
  {
    $transfer = new self();
    $transfer->id = $data['id'];
    $transfer->business_id = $data['business_id'];
    $transfer->account_id = $data['account_id'];
    $transfer->merchant_id = $data['merchant_id'] ?? null;
    $transfer->recipient_business_id = $data['recipient_business_id'] ?? null;
    $transfer->amount = $data['amount'];
    $transfer->fee = $data['fee'];
    $transfer->currency = $data['currency'];
    $transfer->type = $data['type'];
    $transfer->status = $data['status'];
    $transfer->balance_before = $data['balance_before'];
    $transfer->balance_after = $data['balance_after'];
    $transfer->account_name = $data['account_name'] ?? null;
    $transfer->network = $data['network'] ?? null;
    $transfer->bank = $data['bank'] ?? null;
    $transfer->amount_received = $data['amount_received'] ?? null;
    $transfer->mobile_number = $data['mobile_number'] ?? null;
    $transfer->account_number = $data['account_number'] ?? null;
    $transfer->transfer_reference = $data['transfer_reference'];
    $transfer->test_mode = $data['test_mode'];
    $transfer->events = $data['events'];
    $transfer->note = $data['note'] ?? null;
    $transfer->otp = $data['otp'] ?? null;
    $transfer->metadata = $data['metadata'];
    $transfer->callback_url = $data['callback_url'] ?? null;
    $transfer->idempotency_key = $data['idempotency_key'];
    $transfer->created_at = $data['createdAt'];
    $transfer->updated_at = $data['updatedAt'];
    $transfer->failure_reason = $data['failure_reason'] ?? null;

    return $transfer;
  }
}