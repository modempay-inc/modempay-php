<?php

namespace ModemPay\Laravel;

use Illuminate\Support\ServiceProvider;
use ModemPay\ModemPay;

class ModemPayServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    // Merge config
    $this->mergeConfigFrom(
      __DIR__ . '/../../config/modempay.php',
      'modempay'
    );

    // Register ModemPay as a singleton
    $this->app->singleton(ModemPay::class, function ($app) {
      $apiKey = $app['config']->get('modempay.api_key');

      if (empty($apiKey)) {
        throw new \InvalidArgumentException(
          'ModemPay API key is not set. Please set MODEMPAY_API_KEY in your .env file.'
        );
      }

      return new ModemPay($apiKey);
    });

    // Register alias
    $this->app->alias(ModemPay::class, 'modempay');
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    // Publish config file
    if ($this->app->runningInConsole()) {
      $this->publishes([
        __DIR__ . '/../../config/modempay.php' => $this->app->configPath('modempay.php'),
      ], 'modempay-config');
    }
  }
}