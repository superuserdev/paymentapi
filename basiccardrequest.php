<?php

namespace SuperUserDev\PaymentAPI;

final class BasicCardRequest implements \JsonSerializable
{
  const METHODS = [
    'basic-card',
  ];

  const NETWORKS = [
    'visa',
    'mastercard',
    'amex',
    'jcb',
    'diners',
    'discover',
    'mir',
    'unionpay',
  ];

  const TYPES = [
    'credit',
    'debit',
  ];

  private $_methods  = [];

  private $_networks = [];

  private $_types    = [];

  public function __construct(
    Array  $supported_methods  = self::METHODS,
    Array  $supported_networks = self::NETWORKS,
    Array  $supported_types    = self::TYPES
  )
  {
    $this->_methods  = $supported_methods;
    $this->_networks = $supported_networks;
    $this->_types    = $supported_types;
  }

  public function addSupportedMethod(String $method): Void
  {
    $this->_methods[] = $method;
  }

  public function addSupportedNetwork(String $network): Void
  {
    $this->_networks[] = $network;
  }

  public function addSupportedType(String $type): Void
  {
    $this->_types[] = $type;
  }

  public function jsonSerialize(): Array
  {
    return [
      'supportedMethods' => join(', ', $this->_methods),
      'data' => [
        'supportedNetwords' => $this->_networks,
        'supportedTypes'    => $this->_types,
      ],
    ];
  }
}
