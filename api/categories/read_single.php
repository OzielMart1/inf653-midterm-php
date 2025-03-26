<?php
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

$category_data = $category->read_single();
if ($category_data) {
    echo json_encode($category_data);
} else {
    echo json_encode(['message' => 'category_id Not Found']);
}
