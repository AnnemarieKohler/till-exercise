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

  public function calculateNetPrice()
  {
    $price = 0;
    foreach ($this->order as $order) {
      foreach ($order as $item => $amount) {
        $price += $this->prices[$item] * $amount;
      }
    }
    return $price;
  }

  public function calculateTotalPrice()
  {
    $netPrice = $this->calculateNetPrice();
    $this->totalPrice = $netPrice + $this->calculateTax($netPrice);
    return $this->totalPrice;
  }

  private function calculateTax($netPrice)
  {
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
