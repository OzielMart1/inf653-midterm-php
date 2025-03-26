<?php
    class Database{
        private $conn;
        private $host;
        private $port;
        private $dbname;
        private $username;
        private $password;
        
        public function __construct(){
            $this->username = getenv('USERNAME');
            $this->password = getenv('PASSWORD');
            $this->dbname = getenv('DBNAME');
            $this->host = getenv('HOST');
            $this->port = getenv('PORT');

        }

        public function connect() {
            try {
                $host = getenv('HOST') ?: 'localhost';
                $port = getenv('PORT') ?: '5432';
                $dbname = getenv('DBNAME') ?: 'quotesdb';
                $username = getenv('USERNAME') ?: 'postgres';
                $password = getenv('PASSWORD') ?: 'postgres';
        
                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
                $this->conn = new PDO($dsn, $username, $password);
                
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                error_log('Database connection successful');
                
                return $this->conn;
            } catch (PDOException $e) {
                // Log the full error details
                error_log('Database Connection Error: ' . $e->getMessage());
                error_log('Connection Details - Host: ' . $host . ', Port: ' . $port . ', DB: ' . $dbname);
                
                throw new Exception('Database connection failed: ' . $e->getMessage());
            }
        }
    }
            
