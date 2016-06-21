<?php

class Receipt
{
  public $totalPrice;
  public $tax;

  public function __construct($order, $menu)
  {
    $this->order = $order;
    $this->menu = $this->convertPriceList($menu);
    $this->prices = $this->menu[0]["prices"][0];
    $this->taxPercentage = 8.64;
  }

  public function getTotalPrice() {
    if ($this->totalPrice !== NULL) {
      return $this->totalPrice;
    }
    $this->calculateTotalPrice();
    return $this->totalPrice;
  }

  public function getTax() {
    if ($this->tax !== NULL) {
      return $this->tax;
    }
    $this->calculateTax();
    return $this->tax;
  }

  public function calculateNetPrice()
  {
    $price = 0;
    foreach ($this->order as $order) {
      $itemAmount = $order['amount'];
      $itemName = $order['name'];
      $price += $this->prices[$itemName] * $itemAmount;
    }
    return $price;
  }

  public function calculateTotalPrice()
  {
    $netPrice = $this->calculateNetPrice();
    $this->totalPrice = $netPrice + $this->calculateTax();
    return $this->totalPrice;
  }

  private function calculateTax()
  {
    $netPrice = $this->calculateNetPrice();
    $tax = $this->taxPercentage / 100 * $netPrice;
    $this->tax = round($tax, 2);
    return $this->tax;
  }

  private function convertPriceList($data)
  {
    $formattedData = json_decode($data, true);
    return $formattedData;
  }



}
