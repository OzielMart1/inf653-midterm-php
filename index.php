<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    echo "PHP is working!";
    
    // Test database connection if applicable
    // $pdo = new PDO('pgsql:host=your_host;dbname=your_database', 'username', 'password');
    // echo "Database connection successful!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>