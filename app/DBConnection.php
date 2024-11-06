<?php
namespace App;
// class untuk konektivitas basis data
class DBConnection {
    public function connect() {
        return new \PDO('mysql:host=localhost;dbname=store', 'root', '');
    }
}