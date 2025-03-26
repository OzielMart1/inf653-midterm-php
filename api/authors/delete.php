<?php
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    $author->id = $data->id;
    echo json_encode(['message' => $author->delete() ? 'Author Deleted' : 'No Authors Found']);
} else {
    echo json_encode(['message' => 'No ID Provided']);
}
