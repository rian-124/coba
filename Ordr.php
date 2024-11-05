<?php

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

        // menyimpan data order
        $this->saveOrderItems($db, $itemList);
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