<?php

namespace ModemPay\Resources;

use ModemPay\Http\Client;

abstract class BaseResource
{
  protected Client $client;

  public function __construct(Client $client)
  {
    $this->client = $client;
  }
}