<?php

namespace SuperUserDev\PaymentAPI;

class Discount extends DisplayItem
{
  public function __construct(
    String $label,
    Amount $amount
  )
  {
    $discount = new Amount(-$amount->getvalue(), $amount->getCurrency());
    parent::__construct($label, $discount);
  }
}
