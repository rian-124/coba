<?php

// Pastikan Anda sudah menjalankan composer autoload untuk memuat semua class
require '../vendor/autoload.php';

use App\Customers;
use App\Inventory;
use App\Order;

// Membuat objek customer baru
$customer = new Customers(1, "Joko Raswono", "Lohbener Lama 8", "1235467809");

// Menyimpan data customer ke database
$customer->saveCustomerDataToDatabase();

// Mengambil data inventory
$dataInv = new Inventory();
$getAllDataInv = $dataInv->getAllInv();

// Menampilkan semua data inventory
foreach($getAllDataInv as $data) {
    echo "Item Id : " . $data['item_id'] . "<br>";
    echo "Jumlah Quantity : " . $data['quantity'] . "<br><br>";
}

// Membuat objek Order dan memproses pesanan baru
$order = new Order();
$order->orderId = null; // Menginisialisasi orderId dengan null
$order->custId = $customer->id;
$order->orderDate = date("Y-m-d");

// Daftar item yang akan dipesan
$orderItems = [
    ["id" => 101, "quantity" => 2],
    ["id" => 102, "quantity" => 1]
];

// Memproses order
$order->processOrder($customer, $orderItems);

// Menambahkan stok jika diperlukan (contoh penggunaan addStock pada Inventory)
// Uncomment jika Anda ingin menambah stok secara langsung
// $dataInv->addStock(101, 500);
// $dataInv->addStock(102, 500);

echo "Proses order selesai.";
