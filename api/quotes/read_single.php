<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();
$quote = new Quote($db);

$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

$result = $quote->read_single();
if ($result) {
    echo json_encode($result);
} else {
    echo json_encode(['message' => 'No Quotes Found']);
}
