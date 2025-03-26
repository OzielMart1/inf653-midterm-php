<?php
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->author)) {
    $author->author = $data->author;
    if ($author->create()) {
        echo json_encode(['id' => $author->id, 'author' => $author->author]);
    } else {
        echo json_encode(['message' => 'Author Not Created']);
    }
} else {
    echo json_encode(['message' => 'Missing Required Parameters']);
}
