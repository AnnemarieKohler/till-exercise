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
    $order = ["Cafe Latte", "Choc Mudcake"];
    $menu = json_encode($this->list);
    $this->receipt = new Receipt($order, $menu);
  }

  public function testCalculateNetPrice()
  {
    $this->assertSame(11.15, $this->receipt->calculateNetPrice());
  }

  public function testCalculateTotalPrice()
  {
    $totalExpected = round(12.11, 2);
    $this->assertSame($totalExpected, $this->receipt->calculateTotalPrice());
  }
}
