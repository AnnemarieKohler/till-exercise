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
    $order = [["name" => "Cafe Latte", "amount" => 2],
              ["name" => "Choc Mudcake", "amount" => 1]];

    $menu = json_encode($this->list);
    $this->receipt = new Receipt($order, $menu);
  }

  public function testCalculateNetPrice()
  {
    $this->assertSame(15.90, $this->receipt->calculateNetPrice());
  }

  public function testGetTotalPrice()
  {
    $this->receipt->calculateTotalPrice();
    $this->assertSame(17.27, $this->receipt->getTotalPrice());
  }

  public function testGetTax()
  {
    $this->receipt->calculateTotalPrice();
    $this->assertSame(1.37, $this->receipt->getTax());
  }

}
