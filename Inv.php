<?php

// class inventory
class Inv {
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