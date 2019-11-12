<?php
class Database
{

    // Spécification des informations pour se connecter à sa base de données
    private $host = "localhost";
    private $db_name = "notice";
    private $username = "root";
    private $password = "";
    public $conn;

    // Création de la base de données
    public function getConnection()
    {

        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function getProduct()
    {

        $query = 'SELECT * FROM users';

        $stmt = $this->conn->query($query)->fetchAll();

        return $stmt;
    }
}
?>