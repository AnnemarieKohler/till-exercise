<?php
  require 'vendor/autoload.php';
  require './src/Receipt.php';

  $options =  array('extension' => '.html');

  $m = new Mustache_Engine(array(
      'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/views', $options),
  ));


  $order = [["name" => "Cafe Latte", "amount" => 2],
            ["name" => "Choc Mudcake", "amount" => 1]];

  $menu = file_get_contents('./src/pricelist.json');
  $receipt = new Receipt($order, $menu);

  echo $m->render('till', array('order' => $order, 'receipt' => $receipt));
