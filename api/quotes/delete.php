<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();
$quote = new Quote($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    $quote->id = $data->id;
    echo json_encode(['message' => $quote->delete() ? 'Quote Deleted' : 'No Quotes Found']);
} else {
    echo json_encode(['message' => 'No ID Provided']);
}
