<?php

class DBConnect {
    //connecting to the database
    private $host = "localhost";  
    private $db_name = "bddexop5";
    private $username = "root";
    private $password = "root";
    private $pdo = null;

    // Method to get the PDO instance
    public function getPDO() {
        // Check if the PDO instance is already created
        if ($this->pdo === null) {
            try {
                // Create a new PDO instance
                $this->pdo = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                    $this->username, 
                    $this->password
                );

                // Set the PDO error mode to exception
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exception) {
                // Handle connection errors
                echo "Connection error: " . $exception->getMessage();
                // Optionally, you can set $this->pdo to null to ensure it isn't used
                $this->pdo = null;
            }
        }
        // Return the PDO instance
        return $this->pdo;
    }
}