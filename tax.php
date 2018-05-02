<?php

namespace shgysk8zer0\PaymentAPI;

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
