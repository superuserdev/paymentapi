<?php

namespace SuperUserDev\PaymentAPI;

use \SuperUserDev\PaymentAPI\Traits\{Getter, Setter};

class DisplayItem implements \JsonSerializable
{
  use Getter;
  use Setter;

  private $_label = '';

  private $_amount = null;

  private $_pending = false;

  public function __construct(
    String $label,
    Amount $amount,
    Bool   $pending  = false
  )
  {
    $this->setLabel($label);
    $this->setAmount($amount);
    $this->setPending($pending);
  }

  public function jsonSerialize(): Array
  {
    return [
      'label'   => $this->getLabel(),
      'amount'  => $this->getAmount(),
      'pending' => $this->getPending(),
    ];
  }

  public function setLabel(String $label): Void
  {
    $this->_label = $label;
  }

  public function getLabel(): String
  {
    return $this->_label;
  }

  public function setAmount(Amount $amount): Void
  {
    $this->_amount = $amount;
  }

  public function getAmount(): Amount
  {
    return $this->_amount;
  }

  public function setPending(Bool $pending): Void
  {
    $this->_pending = $pending;
  }

  public function getPending(): Bool
  {
    return $this->_pending;
  }
}
