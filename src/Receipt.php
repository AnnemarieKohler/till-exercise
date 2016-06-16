<?php

class Receipt
{

  public function __construct($order, $menu)
  {
    $this->order = $order;
    $this->menu = $this->convertPriceList($menu);
    $this->prices = $this->menu[0]["prices"][0];
  }

  public function calculatePrice()
  {
    return array_reduce($this->order, function($carry, $item){
      return $carry + $this->prices[$item];
    });
  }

  private function convertPriceList($data)
  {
    $formattedData = json_decode($data, true);
    return $formattedData;
  }



}
