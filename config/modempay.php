<?php

return [
  /*
    |--------------------------------------------------------------------------
    | ModemPay API Key
    |--------------------------------------------------------------------------
    |
    | Your ModemPay API key. You can find this in your ModemPay dashboard.
    | It's recommended to store this in your .env file as MODEMPAY_API_KEY.
    |
    */
  'api_key' => env('MODEMPAY_API_KEY'),

  /*
    |--------------------------------------------------------------------------
    | Webhook Secret
    |--------------------------------------------------------------------------
    |
    | Your ModemPay webhook secret for validating webhook signatures.
    | Store this in your .env file as MODEMPAY_WEBHOOK_SECRET.
    |
    */
  'webhook_secret' => env('MODEMPAY_WEBHOOK_SECRET'),
];