<?php

require_once "Custmr.php";
require_once "Ordr.php";
require_once "Inv.php";

$customer = new Custmr(1, "Joko Raswono", "Lohbener Lama 8", "1235467809");
$customer->saveCustomerDataToDatabase();

$order = new Ordr();
$order->orderId = 1;
$order->custId = 1;
$order->orderDate = date("Y-m-d");
$orderItems = [
    ["id" => 101, "quantity" => 2],
    ["id" => 102, "quantity" => 1]
];
$order->processOrder("Joko Raswono", "Lohbener Lama 8", "1235467809", $orderItems);