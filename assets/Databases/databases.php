<?php

class Database {
    private $host = 'localhost'; // Ubah dengan host database Anda
    private $db_name = 'nama_database'; // Ubah dengan nama database Anda
    private $username = 'root'; // Ubah dengan username database Anda
    private $password = ''; // Ubah dengan password database Anda
    private $conn;

    // Metode untuk koneksi ke database
    public function koneksi() {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }

    // Metode untuk mengambil data dari database
    public function ambil_data($query) {
        $this->koneksi(); // Memastikan koneksi terbuka
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        // Mengembalikan hasil sebagai array asosiatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Metode untuk modifikasi data di database (INSERT, UPDATE, DELETE)
    public function modifikasi($query) {
        $this->koneksi(); // Memastikan koneksi terbuka
        $stmt = $this->conn->prepare($query);

        // Mengembalikan true jika query berhasil dieksekusi, false jika gagal
        return $stmt->execute();
    }
}

?>