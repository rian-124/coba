<?php

namespace App;

// class inventory
class Inventory {

    private $db;

    public function __construct(){
        $this->db = (new DBConnection())->connect();
    }

    public function getAllInv() {

        $query = "SELECT * FROM inventory";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $results;
    }

    public function addItem($itemid, $quantity) {
    
        $query = "INSERT INTO inventory (item_id, quantity) VALUES (:item_id, :quantity)";
        $stmt = $this->db->prepare($query);
    
        // Bind parameter
        $stmt->bindParam(':item_id', $itemid);
        $stmt->bindParam(':quantity', $quantity);
    
        // Eksekusi statement
        $stmt->execute();
    }

    public function addStock($itemId, $quantity) {
        // konektivitas basis data
        
        $query = "UPDATE inventory SET quantity = quantity + :quantity WHERE item_id = :item_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':item_id', $itemId);
        $stmt->execute();
    }
}