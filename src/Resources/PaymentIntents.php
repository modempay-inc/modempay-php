<?php

namespace ModemPay\Resources;

use ModemPay\Types\PaymentIntentResponse;
use ModemPay\Types\PaymentIntent;


class PaymentIntents extends BaseResource
{

  /**
   * Creates a payment intent.
   */
  public function create(array $params): PaymentIntentResponse
  {
    $body = [
      'data' => array_merge($params, ['from_sdk' => false])
    ];

    $response = $this->client->request('POST', '/v1/payments', $body);

    return PaymentIntentResponse::fromArray($response);
  }


  /**
   * Retrieves a payment intent by its intent secret.
   */
  public function retrieve(string $intentSecret): PaymentIntent
  {
    $response = $this->client->request('GET', "/v1/payments/verify?intent_secret={$intentSecret}");

    return PaymentIntent::fromArray($response);
  }

  /**
   * Cancels the payment intent.
   */
  public function cancel(string $id): PaymentIntent
  {
    $response = $this->client->request('PATCH', "/v1/payments/{$id}");

    return PaymentIntent::fromArray($response);
  }

  /**
   * Returns a list of payment intents.
   */
  public function list(array $options = ['limit' => 10]): array
  {
    $params = array_merge(['offset' => 0], $options);

    $queryString = http_build_query($params);
    $uri = "/v1/payments?{$queryString}";

    $data = $this->client->request('GET', $uri);

    return $data;
  }
}