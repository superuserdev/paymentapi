<?php

namespace SuperUserDev\PaymentAPI;

class ShippingOption extends DisplayItem
{
  private $_id = '';

  private $_selected = false;

  public function __construct(
    String $id,
    String $label,
    Amount $amount,
    Bool   $pending  = true,
    Bool   $selected = false
  )
  {
    parent::__construct($label, $amount, $pending);
    $this->setId($id);
    $this->setSelected($selected);
  }

  public function jsonSerialize(): Array
  {
    $data = parent::jsonSerialize();
    $data['id'] = $this->getId();
    $data['selected'] = $this->getSelected();
    return $data;
  }

  public function setId(String $id): Void
  {
    $this->_id = $id;
  }

  public function getId(): String
  {
    return $this->_id;
  }

  public function setSelected(Bool $selected = true): Void
  {
    $this->_selected = $selected;
  }

  public function getSelected(): Bool
  {
    return $this->_selected;
  }

}
