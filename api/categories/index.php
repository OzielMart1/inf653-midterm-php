<?php
//On top of all index files
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }


include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();
$category = new Category($db);

// Handle API request method
switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            require 'read_single.php';
        } else {
            require 'read.php';
        }
        break;
    case 'POST':
        require 'create.php';
        break;
    case 'PUT':
        require 'update.php';
        break;
    case 'DELETE':
        require 'delete.php';
        break;
    default:
        echo json_encode(['message' => 'Method Not Allowed']);
}
