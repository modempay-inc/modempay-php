<?php

namespace ModemPay\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \ModemPay\Resources\Transfers transfers()
 * @method static \ModemPay\Resources\PaymentIntents paymentIntents()
 * @method static \ModemPay\Resources\Webhooks webhooks()
 * 
 * @see \ModemPay\ModemPay
 */
class ModemPay extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor()
  {
    return \ModemPay\ModemPay::class;
  }
}