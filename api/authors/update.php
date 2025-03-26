<?php
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id) && !empty($data->author)) {
    $author->id = $data->id;
    $author->author = $data->author;
    echo json_encode(['message' => $author->update() ? 'Author Updated' : 'No Authors Found']);
} else {
    echo json_encode(['message' => 'Missing Required Parameters']);
}
