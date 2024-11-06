<?php
namespace App;

require_once 'DBConnection.php';
// Customer class
class Custmr {
    public $id;
    public $nm;
    public $adrs;
    public $phn;

    public function __construct($id, $nm, $adrs, $phn) {
        $this->id = $id;
        $this->nm = $nm;
        $this->adrs = $adrs;
        $this->phn = $phn;
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