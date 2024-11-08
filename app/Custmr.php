<?php
namespace App;

require_once 'DBConnection.php';
// Customer class
class Custmr {
    public $id;
    public $name;
    public $adress;
    public $phone;

    public function __construct($id, $name, $adress, $phone) {
        $this->id = $id;
        $this->nm = $name;
        $this->adrs = $adress;
        $this->phn = $phone;
    }

    // Method simpan data customer ke database
    public function saveCustomerDataToDatabase() {
        $db = (new DBConnection())->connect();
        
        // Query untuk menyimpan data pelanggan
        $query = "INSERT INTO customers (name, address, phone) VALUES (:name, :address, :phone)";
        
        // kode untuk menyimpan data ke database
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $this->nm);
        $stmt->bindParam(':address', $this->adrs);
        $stmt->bindParam(':phone', $this->phn);
        
        // Eksekusi statement
        $stmt->execute();


        // mengambil id customer yang baru saja disimpan
        $this->id = $db->lastInsertId();
    }
}