<?php

namespace SuperUserDev\PaymentAPI\Traits;

trait Getter
{
  final public function __get(String $name)
  {
    $method = 'get' . $name[0] . substr($name, 1);
    
    if (method_exists($this, $method)) {
      return $this->{$method}();
    } else {
      throw new \Exception(sprintf('Undefined %s', $name));
    }
  }
}
