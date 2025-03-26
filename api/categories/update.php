<?php
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id) && !empty($data->category)) {
    $category->id = $data->id;
    $category->category = $data->category;
    echo json_encode(['message' => $category->update() ? 'Category Updated' : 'No Categories Found']);
} else {
    echo json_encode(['message' => 'Missing Required Parameters']);
}
