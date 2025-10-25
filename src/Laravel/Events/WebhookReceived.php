<?php

namespace ModemPay\Laravel\Events;

use ModemPay\Types\Event;

class WebhookReceived
{
  public Event $event;

  public function __construct(Event $event)
  {
    $this->event = $event;
  }
}