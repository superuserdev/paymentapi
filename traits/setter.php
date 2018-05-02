<?php

namespace SuperUserDev\PaymentAPI\Traits;

trait Setter
{
  final public function __set(String $name, $value)
  {
    $method = 'set' . $name[0] . substr($name, 1);
    if (method_exists($this, $method)) {
      $this->{$method}($value);
    } else {
      throw new \Exception(sprintf('Undefined %s', $name));
    }
  }
}
