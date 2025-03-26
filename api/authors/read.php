<?php
$result = $author->read();
$num = $result->rowCount();

if ($num > 0) {
    $authors_arr = ['data' => []];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $authors_arr['data'][] = ['id' => $id, 'author' => $author];
    }

    echo json_encode($authors_arr);
} else {
    echo json_encode(['message' => 'No Authors Found']);
}
