<?php
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->category)) {
    $category->category = $data->category;
    if ($category->create()) {
        echo json_encode(['id' => $category->id, 'category' => $category->category]);
    } else {
        echo json_encode(['message' => 'Category Not Created']);
    }
} else {
    echo json_encode(['message' => 'Missing Required Parameters']);
}
