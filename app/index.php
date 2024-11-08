<?php

require '../vendor/autoload.php';

use App\Custmr; 
use App\Inv;
use App\Ordr;

$customer = new Custmr(1, "Joko Raswono", "Lohbener Lama 8", "1235467809");
$customer->saveCustomerDataToDatabase();

$dataInv = new Inv();
$getAllDataInv = $dataInv->getAllInv();

foreach($getAllDataInv as $data) {
    echo "Item Id : " . $data['item_id']. "<br>";
    echo "Jumlah Quantity : " . $data['quantity']. "<br><br>";
}

$order = new Ordr();
$order->orderId = null;
$order->custId = $customer->id;
$order->orderDate = date("Y-m-d");
$orderItems = [
    ["id" => 101, "quantity" => 2],
    ["id" => 102, "quantity" => 1]
];
$order->processOrder("Joko Raswono", "Lohbener Lama 8", "1235467809", $orderItems);
