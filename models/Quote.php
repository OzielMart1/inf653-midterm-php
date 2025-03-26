<?php
class Quote {
    private $conn;
    public $id, $quote, $author_id, $category_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read($author_id = null, $category_id = null) {
        $query = "SELECT q.id, q.quote, a.author, c.category
                  FROM quotes q
                  JOIN authors a ON q.author_id = a.id
                  JOIN categories c ON q.category_id = c.id";
        
        if ($author_id) $query .= " WHERE q.author_id = :author_id";
        if ($category_id) $query .= ($author_id ? " AND" : " WHERE") . " q.category_id = :category_id";
        
        $stmt = $this->conn->prepare($query);
        if ($author_id) $stmt->bindParam(':author_id', $author_id);
        if ($category_id) $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $stmt;
    }

    public function validateAuthorCategory($author_id, $category_id) {
        $stmt = $this->conn->prepare("SELECT id FROM authors WHERE id = :author_id");
        $stmt->bindParam(':author_id', $author_id);
        $stmt->execute();
        if ($stmt->rowCount() == 0) return false;

        $stmt = $this->conn->prepare("SELECT id FROM categories WHERE id = :category_id");
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
