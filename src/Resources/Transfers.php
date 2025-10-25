<?php

namespace ModemPay\Resources;

use ModemPay\Types\Transfer;
use ModemPay\Types\TransferFeeCheckResponse;

class Transfers extends BaseResource
{
  /**
   * Initiates a transfer.
   */
  public function initiate(array $data, string $idempotencyKey): Transfer
  {
    $response =  $this->client->request('POST', '/v1/transfers', $data, [
      'Idempotency-Key' => $idempotencyKey
    ]);
    return Transfer::fromArray($response);
  }

  /** Retrieves Transfer data. */
  public function retrieve(string $transferId): Transfer
  {
    $response =  $this->client->request('GET', "/v1/transfers/{$transferId}");
    return Transfer::fromArray($response);
  }

  /** Check the Transfer Fee */
  public function fee(array $data): TransferFeeCheckResponse
  {
    $response = $this->client->request('POST', "/v1/transfers/fees", $data);
    return TransferFeeCheckResponse::fromArray($response);
  }
}