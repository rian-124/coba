<?php
// class untuk konektivitas basis data
namespace App;

class DBConnection {
    public function connect() {
        // Gunakan IP 127.0.0.1 atau 'mysql' jika Anda memakai container MySQL dengan nama 'mysql' di GitHub Actions
        $host = '127.0.0.1';  // Ganti 'localhost' dengan '127.0.0.1' atau nama service Docker jika menggunakan container
        $dbname = 'store';
        $username = 'root';    // Default MySQL root user
        $password = '';        // Jika tidak ada password, kosongkan

        try {
            // Membuat koneksi PDO
            return new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        } catch (\PDOException $e) {
            // Menangani kesalahan koneksi
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
    }
}
