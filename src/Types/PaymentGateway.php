<?php

namespace ModemPay\Types;

/**
 * Represents a payment gateway that can be used in a payment transaction.
 */
class PaymentGateway
{
  /**
   * A unique tag identifying the payment gateway.
   *
   * @var string
   */
  public string $tag;

  /**
   * The group to which this payment gateway belongs (e.g., "bank", "wallet", etc.).
   *
   * @var string
   */
  public string $group;

  /**
   * The logo of the payment gateway, typically in URL form.
   *
   * @var string
   */
  public string $logo;

  /**
   * Unique identifier for the payment gateway.
   *
   * @var string
   */
  public string $id;

  /**
   * Convert the payment gateway to an array.
   *
   * @return array
   */
  public function toArray(): array
  {
    return [
      'tag' => $this->tag,
      'group' => $this->group,
      'logo' => $this->logo,
      'id' => $this->id,
    ];
  }

  /**
   * Create a PaymentGateway instance from an array.
   *
   * @param array $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    $gateway = new self();
    $gateway->tag = $data['tag'] ?? '';
    $gateway->group = $data['group'] ?? '';
    $gateway->logo = $data['logo'] ?? '';
    $gateway->id = $data['id'] ?? '';
    return $gateway;
  }
}