<?php

namespace SuperUserDev\PaymentAPI;

use \SuperUserDev\PaymentAPI\Traits\{Getter, Setter};

final class PaymentRequest implements \JsonSerializable
{
  use Getter;
  use Setter;

  private $_id = '';

  private $_card_requests = [];

  private $_items = [];

  private $_shipping_opts = [];

  private $_shipping = null;

  private $_tax = null;

  private $_request_name = false;

  private $_request_phone = false;

  private $_request_email = false;

  private $_include_shipping = false;

  private $_include_tax = false;

  public function __construct(BasicCardRequest $card_req, DisplayItem ...$items)
  {
    $this->addCardRequest($card_req);
    $this->addItems(...$items);
  }

  public function setIncludeShipping(Bool $include = true): Void
  {
    $this->_include_shipping = $include;
  }

  public function setIncludeTax(Bool $include = true): Void
  {
    $this->_include_tax = $include;
  }

  public function jsonSerialize(): Array
  {
    $data = [
      'supportedInstruments' => $this->_card_requests,
      'details' => [
        'total'        => $this->getTotal(),
        'displayItems' => $this->getDisplayItems(),
      ],
      'options' => [
        'requestShipping'   => $this->getRequestShipping(),
        'requestPayerName'  => $this->getRequestPayerName(),
        'requestPayerEmail' => $this->getRequestPayerEmail(),
        'requestPayerPhone' => $this->getRequestPayerPhone(),
      ],
    ];

    if ($this->getRequestShipping()) {
      $data['details']['shippingOptions'] = $this->getShippingOptions();
    }

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

  public function getDisplayItems(): Array
  {
    $items = array_map(
      function(DisplayItem $item): DisplayItem
      {
        return new DisplayItem(
          $item->getLabel(),
          $item->getAmount(),
          $item->getPending()
        );
      },
      $this->_items
    );

    if ($this->_include_tax and $this->hasTax()) {
      $tax = $this->getTax();
      $items[] = new DisplayItem(
        $tax->getLabel(),
        $tax->getAmount()
      );
    }

    if ($this->_include_shipping and $this->hasShipping()) {
      $items[] = $this->getShipping();
    }

    return $items;
  }

  public function getTotal(
    String $label       = 'Total',
    Bool   $include_tax = false,
    String $currency    = 'USD'
  ): \StdClass
  {
    $cost = array_reduce(
      $this->getDisplayItems(),
      function(Float $total, DisplayItem $item): Float
      {
        return $total + $item->getAmount()->getValue();
      },
      0
    );
    $total = new \StdClass();
    $total->label = $label;
    $total->amount = new \StdClass();
    $total->amount->value = number_format($cost, 2);
    $total->amount->currency = $currency;

    return $total;
  }

  public function setShipping(String $id): Void
  {
    foreach ($this->_shipping_opts as $opt) {
      if ($opt->getId() === $id) {
        $this->_shipping = $opt;
        break;
      }
    }
  }

  public function getShipping(): shippingOption
  {
    return $this->_shipping;
  }

  public function hasShipping(): Bool
  {
    return isset($this->_shipping);
  }

  public function setTax(Tax $tax): Void
  {
    $this->_tax = $tax;
  }

  public function getTax(): Tax
  {
    return $this->_tax;
  }

  public function hasTax(): Bool
  {
    return isset($this->_tax);
  }

  public function addCardRequest(BasicCardRequest $req): Void
  {
    $this->_card_requests[] = $req;
  }

  public function getCardRequest(): BasicCardRequest
  {
    return $this->_card_request;
  }

  public function addItem(DisplayItem $item): Void
  {
    $this->_items[] = $item;
  }

  public function addItems(DisplayItem ...$items): Void
  {
    foreach ($items as $item) {
      $this->addItem($item);
    }
  }

  public function addShippingOption(ShippingOption $opt): Void
  {
    $this->_shipping_opts[] = $opt;
  }

  public function addShippingOptions(ShippingOption ...$opts): Void
  {
    foreach ($opts as $opt) {
      $this->addShippingOption($opt);
    }
  }

  public function getShippingOptions(): Array
  {
    return $this->_shipping_opts;
  }

  public function setRequestPayerName(Bool $req = true): Void
  {
    $this->_request_name = $req;
  }

  public function getRequestPayerName(): Bool
  {
    return $this->_request_name;
  }

  public function setRequestPayerEmail(Bool $req = true): Void
  {
    $this->_request_email = $req;
  }

  public function getRequestPayerEmail(): Bool
  {
    return $this->_request_email;
  }

  public function setRequestPayerPhone(Bool $req = true): Void
  {
    $this->_request_phone = $req;
  }

  public function getRequestPayerPhone(): Bool
  {
    return $this->_request_phone;
  }

  public function getRequestShipping(): Bool
  {
    return ! empty($this->_shipping_opts);
  }
}
