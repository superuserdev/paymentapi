<?php
namespace shgysk8zer0\PaymentAPI;

spl_autoload_register('spl_autoload');
set_include_path(dirname(__DIR__, 2));

$req = new PaymentRequest(
  new BasicCardRequest(),
  new DisplayItem('Label', new Amount(14.99)),
  new DisplayItem('Label 2', new Amount(4.95)),
  new Discount('$5 off', new Amount(5))
);
$shipping = new ShippingOption('ship', 'Shipping', new Amount(2));
$req->addShippingOptions($shipping, new ShippingOption('no-ship', 'Not used shipping', new Amount(100)));
$req->setShipping('no-ship');
$req->setTax(new Tax('Tax', new Amount(1)));
$req->setIncludeShipping(true);
$req->setIncludeTax(true);
$req->setRequestPayerName(true);
$req->setRequestPayerEmail(true);
$req->setRequestPayerPhone(true);

echo json_encode($req, JSON_PRETTY_PRINT) . PHP_EOL;
