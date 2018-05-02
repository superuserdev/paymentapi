<?php

namespace shgysk8zer0\PaymentAPI;

use \shgysk8zer0\PaymentAPI\Traits\{Getter, Setter};

class Amount implements \JsonSerializable
{
  use Getter;
  use Setter;

  private $_value = 0;

  private $_currency = 'USD';

  public function __construct(Float $value, String $currency = 'USD')
  {
      $this->_value = $value;
      $this->_currency = $currency;
  }

  public function jsonSerialize(): Array
  {
    return [
      'value'    => $this->getFormattedValue(),
      'currency' => $this->getCurrency(),
    ];
  }

  public function getValue(): Float
  {
    return $this->_value;
  }

  public function getFormattedValue(): String
  {
    return number_format($this->getValue(), 2);
  }

  public function getCurrency(): String
  {
    return $this->_currency;
  }
}
