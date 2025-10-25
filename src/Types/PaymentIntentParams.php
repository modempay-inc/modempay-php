<?php

namespace ModemPay\Types;

/**
 * Parameters for creating a payment intent.
 */
class PaymentIntentParams
{
  /**
   * The amount to be charged for the payment intent.
   */
  public float $amount;

  /**
   * The currency in which the payment will be processed (e.g., "XOF", "GMD").
   */
  public ?string $currency = null;

  /**
   * An array of payment method types to be used for processing the payment (e.g., "card", "bank", "wallet").
   */
  public ?array $payment_methods = null;

  /**
   * Title or name of the payment intent. It provides a label or description for the payment.
   */
  public ?string $title = null;

  /**
   * Detailed description of the payment intent.
   */
  public ?string $description = null;

  /**
   * The customer associated with the payment intent. Can be a customer ID.
   */
  public ?string $customer = null;

  /**
   * The name of the customer associated with the payment intent.
   */
  public ?string $customer_name = null;

  /**
   * The email address of the customer associated with the payment intent.
   */
  public ?string $customer_email = null;

  /**
   * The phone number of the customer associated with the payment intent.
   */
  public ?string $customer_phone = null;

  /**
   * Custom metadata associated with the payment intent.
   */
  public ?array $metadata = null;

  /**
   * URL to redirect the customer after successful payment.
   */
  public ?string $return_url = null;

  /**
   * URL to redirect the customer if the payment is cancelled.
   */
  public ?string $cancel_url = null;

  /**
   * The payment method ID selected for processing the payment.
   */
  public ?string $payment_method = null;

  /**
   * The ID of the coupon code to be applied to the payment intent for discounts or special offers.
   */
  public ?string $coupon = null;

  /**
   * The URL to which Modem Pay will send a callback or webhook notification after payment processing.
   */
  public ?string $callback_url = null;

  /**
   * The payment network to be used for the payment intent (e.g., "wave", "afrimoney", etc.).
   */
  public ?string $network = null;

  /**
   * The account number associated with the payment.
   */
  public ?string $account_number = null;

  /**
   * The sub-account ID specifying who to split the payment with.
   */
  public ?string $sub_account = null;

  public function toArray(): array
  {
    return array_filter([
      'amount'           => $this->amount,
      'currency'         => $this->currency,
      'payment_methods'  => $this->payment_methods,
      'title'            => $this->title,
      'description'      => $this->description,
      'customer'         => $this->customer,
      'customer_name'    => $this->customer_name,
      'customer_email'   => $this->customer_email,
      'customer_phone'   => $this->customer_phone,
      'metadata'         => $this->metadata,
      'return_url'       => $this->return_url,
      'cancel_url'       => $this->cancel_url,
      'payment_method'   => $this->payment_method,
      'coupon'           => $this->coupon,
      'callback_url'     => $this->callback_url,
      'network'          => $this->network,
      'account_number'   => $this->account_number,
      'sub_account'      => $this->sub_account,
    ], fn($value) => $value !== null);
  }
}