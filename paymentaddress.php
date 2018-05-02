<?php

namespace shgysk8zer0\PaymentAPI;

class PaymentAddress implements \JsonSerializable
{
  private $_country = '';
  private $_addressLine = [];
  private $_region = '';
  private $_region_code = '';
  private $_city = '';
  private $_dependent_locality = '';
  private $_postal_code = 0;
  private $_sorting_code = '';
  private $_language_code = '';
  private $_organization = null;
  private $_recipient = '';
  private $_phone = 0;

  public function __construct(Array $data)
  {
    //
  }

  public function jsonSerialize(): Array
  {
    return [];
  }
}
