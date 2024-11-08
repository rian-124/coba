<?php
// class untuk konektivitas basis data
namespace App;

class DBConnection {
    public function connect() {
        return new \PDO('mysql:host=127.0.0.1;dbname=store', 'root', '');
    }

}
