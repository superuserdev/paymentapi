<?php

namespace SuperUserDev\PaymentAPI;

class Tax extends DisplayItem
{
  public function __construct(
    String $label,
    Amount $amount,
    Bool   $pending = true
  )
  {
    parent::__construct($label, $amount, $pending);
  }
}
