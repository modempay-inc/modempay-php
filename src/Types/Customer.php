<?php

namespace ModemPay\Types;

/**
 * Representation of a customer.
 */
class Customer
{
  /**
   * Unique identifier for the customer.
   *
   * @var string
   */
  public string $id;

  /**
   * Customer's name.
   *
   * @var string
   */
  public string $name;

  /**
   * Customer's email address.
   *
   * @var string
   */
  public string $email;

  /**
   * Customer's phone number. Optional field.
   *
   * @var string|null
   */
  public ?string $phone = null;

  /**
   * Current balance associated with the customer. Optional field.
   *
   * @var float|null
   */
  public ?float $balance = null;

  /**
   * Convert the customer instance to an array.
   *
   * @return array
   */
  public function toArray(): array
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'email' => $this->email,
      'phone' => $this->phone,
      'balance' => $this->balance,
    ];
  }

  /**
   * Create a Customer instance from an array.
   *
   * @param array $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    $customer = new self();
    $customer->id = $data['id'];
    $customer->name = $data['name'];
    $customer->email = $data['email'];
    $customer->phone = $data['phone'] ?? null;
    $customer->balance = isset($data['balance']) ? (float) $data['balance'] : null;
    return $customer;
  }
}