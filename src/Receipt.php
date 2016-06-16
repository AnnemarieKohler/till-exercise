<?php

class Receipt
{

  public function __construct($order, $menu)
  {
    $this->order = $order;
    $this->menu = $this->convertPriceList($menu);
    $this->prices = $this->menu[0]["prices"][0];
    $this->tax = 8.64;
  }

  public function calculateNetPrice()
  {
    return array_reduce($this->order, function($carry, $item){
      return $carry + $this->prices[$item];
    });
  }

  public function calculateTotalPrice()
  {
    $netPrice = $this->calculateNetPrice();
    $tax = $this->calculateTax($netPrice);
    return $netPrice + $tax;
  }

  private function calculateTax($netPrice)
  {
    $tax = $this->tax / 100 * $netPrice;
    return round($tax, 2);
  }

  private function convertPriceList($data)
  {
    $formattedData = json_decode($data, true);
    return $formattedData;
  }



}
