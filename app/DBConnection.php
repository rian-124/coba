<?php
// class untuk konektivitas basis data
namespace App;

class DBConnection {
    public function connect() {
       return new \PDO('mysql:host=localhost;dbname=store', 'root', '');
    }

}
