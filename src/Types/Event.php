<?php

namespace ModemPay\Types;

/**
 * Represents an event in the payment system, triggered by specific actions or state changes.
 */
class Event
{
  /**
   * The type of event (e.g., "customer.created", "payment_intent.created").
   *
   * @var EventType
   */
  public EventType $event;

  /**
   * The payload data associated with the event.
   *
   * @var object|array
   */
  public object|array $payload;

  /**
   * Convert the event to an array.
   *
   * @return array
   */
  public function toArray(): array
  {
    return [
      'event' => $this->event->value,
      'payload' => $this->payload,
    ];
  }

  /**
   * Create an Event instance from an array.
   *
   * @param array $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    $instance = new self();

    $instance->event = is_string($data['event'])
      ? EventType::from($data['event'])
      : $data['event'];
    $instance->payload = $data['payload'] ?? [];

    return $instance;
  }
}