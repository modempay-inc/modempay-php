<?php

namespace ModemPay\Exceptions;

use Exception;

class ModemPayException extends Exception
{
  protected ?array $details;

  public function __construct(string $message = "", int $code = 0, ?array $details = null, ?Exception $previous = null)
  {
    parent::__construct($message, $code, $previous);
    $this->details = $details;
  }


  public function getDetails(): ?array
  {
    return $this->details;
  }
}