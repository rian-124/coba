<?php

namespace App;

class BaseOrder {
    protected $db;

    public function __construct() {
        $this->db = (new DBConnection())->connect();
    }

    // Metode umum untuk mengecek stok item
    protected function checkStock($itemId) {
        $query = "SELECT quantity FROM inventory WHERE item_id = :item_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':item_id', $itemId);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ? $result['quantity'] : 0;
    }
}
