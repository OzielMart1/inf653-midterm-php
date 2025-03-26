<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();
$quote = new Quote($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id) && !empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
    if (!$quote->validateAuthorCategory($data->author_id, $data->category_id)) {
        echo json_encode(['message' => 'author_id or category_id Not Found']);
        exit();
    }

    $quote->id = $data->id;
    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    echo json_encode(['message' => $quote->update() ? 'Quote Updated' : 'No Quotes Found']);
} else {
    echo json_encode(['message' => 'Missing Required Parameters']);
}
