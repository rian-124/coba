<?php

namespace App;

// class inventory
class Inv {

    public function getAllInv() {
        $db = (new DBConnection())->connect();

        $query = "SELECT * FROM inventory";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $results;
    }

    public function addItem($itemid, $quantity) {
        $db = (new DBConnection())->connect();
    
        $query = "INSERT INTO inventory (item_id, quantity) VALUES (:item_id, :quantity)";
        $stmt = $db->prepare($query);
    
        // Bind parameter
        $stmt->bindParam(':item_id', $itemid);
        $stmt->bindParam(':quantity', $quantity);
    
        // Eksekusi statement
        $stmt->execute();
    }

    public function addStock($itemId, $quantity) {
        // konektivitas basis data
        $db = (new DBConnection())->connect();
        
        $query = "UPDATE inventory SET quantity = quantity + :quantity WHERE item_id = :item_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':item_id', $itemId);
        $stmt->execute();
    }
}