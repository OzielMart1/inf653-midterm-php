<?php
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    $category->id = $data->id;
    echo json_encode(['message' => $category->delete() ? 'Category Deleted' : 'Category Not Deleted']);
} else {
    echo json_encode(['message' => 'No ID Provided']);
}
