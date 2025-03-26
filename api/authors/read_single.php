<?php
// read_single.php
try {
    // Check if ID is set, with more robust error handling
    if (!isset($_GET['id']) || trim($_GET['id']) === '') {
        http_response_code(400);
        echo json_encode([
            'error' => 'Bad Request',
            'message' => 'Author ID is required'
        ]);
        exit;
    }

    $author->id = $_GET['id'];
    
    $author_data = $author->read_single();
    
    if ($author_data) {
        echo json_encode($author_data);
    } else {
        http_response_code(404);
        echo json_encode([
            'error' => 'Not Found',
            'message' => 'Author Not Found'
        ]);
    }
} catch (Exception $e) {
    error_log('Read Single Author Error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'error' => 'Internal Server Error',
        'message' => $e->getMessage()
    ]);
}

// read.php
try {
    $result = $author->read();
    $num = $result->rowCount();

    if ($num > 0) {
        $authors_arr = ['data' => []];
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $authors_arr['data'][] = [
                'id' => $id, 
                'author' => $author
            ];
        }
        
        echo json_encode($authors_arr);
    } else {
        http_response_code(404);
        echo json_encode([
            'error' => 'Not Found',
            'message' => 'No Authors Found'
        ]);
    }
} catch (Exception $e) {
    error_log('Read Authors Error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'error' => 'Internal Server Error',
        'message' => $e->getMessage()
    ]);
}