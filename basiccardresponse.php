<?php

namespace shgysk8zer0\PaymentAPI;

final class BasicCardResponse implements \JsonSerializable
{
  private $_name = '';
  private $_expiry_month = 0;
  private $_expiry_year = 0;
  private $_card_num = 0;
  private $_csc = 0;
  private $_billing = null;
  public function __construct(Array $data)
  {
    $this->_name = $data['cardHolderName'];
    $this->_expiryMonth = $data['expiryMonth'];
    $this->_expiry_year = $data['expiryYear'];
    $this->_csc = $data['cardSecurityCode'];
    $this->_card_num = $data['cardNumber'];
    $this->_billing = new PaymentAddress($data['billingAddress']);
  }

  public function jsonSerialize(): Array
  {
    return [];
  }
}
