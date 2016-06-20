<?php

require './src/Receipt.php';

use PHPUnit\Framework\TestCase;

class ReceiptTest extends TestCase
{
  public $list = [["prices" => [["Cafe Latte" => 4.75, "Choc Mudcake" => 6.40]]]
  ];
  public $receipt;

  public function setUp()
  {
    $order = [["Cafe Latte" => 2], ["Choc Mudcake" => 1]];
    $menu = json_encode($this->list);
    $this->receipt = new Receipt($order, $menu);
  }

  public function testCalculateNetPrice()
  {
    $this->assertSame(15.90, $this->receipt->calculateNetPrice());
  }

  public function testTotalPrice()
  {
    $this->receipt->calculateTotalPrice();
    $this->assertSame(17.27, $this->receipt->totalPrice);
  }

  public function testTax()
  {
    $this->receipt->calculateTotalPrice();
    $this->assertSame(1.37, $this->receipt->tax);
  }

}
