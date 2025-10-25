<?php

namespace ModemPay\Types;

/**
 * Enumeration of the possible event types in the system.
 */
enum EventType: string
{
  case CUSTOMER_CREATED = "customer.created";
  case CUSTOMER_UPDATED = "customer.updated";
  case CUSTOMER_DELETED = "customer.deleted";
  case PAYMENT_INTENT_CREATED = "payment_intent.created";
  case PAYMENT_INTENT_CANCELLED = "payment_intent.cancelled";
  case CHARGE_CANCELLED = "charge.cancelled";
  case CHARGE_SUCCEEDED = "charge.succeeded";
  case CHARGE_CREATED = "charge.created";
  case CHARGE_UPDATED = "charge.updated";
  case CHARGE_FAILED = "charge.failed";
  case TRANSFER_FAILED = "transfer.failed";
  case TRANSFER_SUCCEEDED = "transfer.succeeded";
  case TRANSFER_REVERSED = "transfer.reversed";
}