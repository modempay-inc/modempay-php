<?php

namespace ModemPay\Resources;

use ModemPay\Exceptions\ModemPayException;
use ModemPay\Types\Event;

class Webhooks extends BaseResource
{
  /**
   * Builds and validates an Event signature based on the provided details.
   * @throws ModemPayException
   */
  public function composeEventDetails(
    string|array|object $payload,
    string $signature,
    string $secret
  ): Event {
    // Convert payload to string if it's not already
    $payloadString = is_string($payload)
      ? $payload
      : json_encode($payload);

    // Generate HMAC-SHA512 hash for comparison
    $computedSignature = hash_hmac('sha512', $payloadString, $secret);

    // Check signature length for a quick validation step
    if (strlen($computedSignature) !== strlen($signature)) {
      throw new ModemPayException('Invalid signature length');
    }

    // Perform timing-safe comparison for added security
    if (!hash_equals($computedSignature, $signature)) {
      throw new ModemPayException('Invalid signature!');
    }

    // Parse the payload if it's a JSON string
    try {
      $parsedPayload = is_string($payload)
        ? json_decode($payload, true, 512, JSON_THROW_ON_ERROR)
        : (array) $payload;
    } catch (\JsonException $e) {
      throw new ModemPayException('Invalid Payload!');
    }

    // Return the event object with event type and payload
    return Event::fromArray([
      'event' => $parsedPayload['event'] ?? '',
      'payload' => $parsedPayload['payload'] ?? []
    ]);
  }
}