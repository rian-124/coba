<?php

use App\DBConnection;
use App\Inv;
require_once "DBConnection.php";

// class Order
class Ordr {
    public $orderId;
    public $custId;
    public $orderDate;
    public $items = [];

    // metode untuk mencetak detil order
    public function printOrderDetails() {
        echo "Order ID: " . $this->orderId;
    }

    // metode untuk memproses order
    public function processOrder($custName, $custAddress, $custPhone, $itemList) { 
        // Mengelola data pesanan, menggunakan banyak properti dari kelas lain
        $this->items = $itemList;
        
        // proses eksekusi basis data
        $db = (new DBConnection())->connect();
        $query = "INSERT INTO orders (customer_id, order_date) VALUES (:customer_id, :order_date)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':customer_id', $this->custId);
        $stmt->bindParam(':order_date', $this->orderDate);
        $stmt->execute();

        // mengambil order id yang baru saja di buat
        $this->orderId = $db->lastInsertId();

        // menyimpan data order
        $this->saveOrderItems($db, $itemList);


        // Menurunkan stok untuk setiap item yang dipesan
    $inventory = new Inv(); // Buat objek Inv untuk mengakses metode addStock
    foreach ($itemList as $item) {
        // Ambil item_id dan quantity
        $itemId = $item['id'];
        $quantityOrdered = $item['quantity'];

        // Cek apakah stok cukup sebelum mengurangi
        $currentQuantity = $this->checkStock($itemId, $db);
        if ($currentQuantity >= $quantityOrdered) {
            // Kurangi stok jika cukup
            $inventory->addStock($itemId, -$quantityOrdered);
        } else {
            // Anda bisa menambahkan logika untuk menangani jika stok tidak cukup
            echo "Stok tidak cukup untuk item ID: $itemId. Tersedia: $currentQuantity, Diminta: $quantityOrdered.";
        }
    }
    }


    private function checkStock($itemId, $db) {
        $query = "SELECT quantity FROM inventory WHERE item_id = :item_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':item_id', $itemId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result ? $result['quantity'] : 0; // Kembalikan quantity jika ada, atau 0 jika tidak ada
    }

    private function saveOrderItems($db, $items) {
        foreach ($items as $item) {
            $query = "INSERT INTO order_items (order_id, item_id, quantity) VALUES (:order_id, :item_id, :quantity)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':order_id', $this->orderId);
            $stmt->bindParam(':item_id', $item['id']);
            $stmt->bindParam(':quantity', $item['quantity']);
            $stmt->execute();
        }
    }
}