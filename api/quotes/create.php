<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();
$quote = new Quote($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
    if (!$quote->validateAuthorCategory($data->author_id, $data->category_id)) {
        echo json_encode(['message' => 'author_id or category_id Not Found']);
        exit();
    }

    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    if ($quote->create()) {
        echo json_encode([
            'id' => $quote->id,
            'quote' => $quote->quote,
            'author_id' => $quote->author_id,
            'category_id' => $quote->category_id
        ]);
    } else {
        echo json_encode(['message' => 'Quote Not Created']);
    }
} else {
    echo json_encode(['message' => 'Missing Required Parameters']);
}
