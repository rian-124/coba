<?php

namespace App;

require_once 'BaseOrder.php';
require_once 'Inventory.php';

class Order extends BaseOrder {
    public $orderId;
    public $custId;
    public $orderDate;
    public $items = [];

    public function printOrderDetails() {
        echo "Order ID: " . $this->orderId;
    }

    public function processOrder(Customers $custmr, $itemList) { 
        $this->items = $itemList;

        $query = "INSERT INTO orders (customer_id, order_date) VALUES (:customer_id, :order_date)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':customer_id', $this->custId);
        $stmt->bindParam(':order_date', $this->orderDate);
        $stmt->execute();

        $this->orderId = $this->db->lastInsertId();
        $this->saveOrderItems($itemList);

        $inventory = new Inventory();
        foreach ($itemList as $item) {
            $itemId = $item['id'];
            $quantityOrdered = $item['quantity'];
            $currentQuantity = $this->checkStock($itemId);

            if ($currentQuantity >= $quantityOrdered) {
                $inventory->addStock($itemId, -$quantityOrdered);
            } else {
                echo "Stok tidak cukup untuk item ID: $itemId. Tersedia: $currentQuantity, Diminta: $quantityOrdered.";
            }
        }
    }

    private function saveOrderItems($items) {
        foreach ($items as $item) {
            $query = "INSERT INTO order_items (order_id, item_id, quantity) VALUES (:order_id, :item_id, :quantity)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':order_id', $this->orderId);
            $stmt->bindParam(':item_id', $item['id']);
            $stmt->bindParam(':quantity', $item['quantity']);
            $stmt->execute();
        }
    }
}
