<?php

namespace shgysk8zer0\PaymentAPI;

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
