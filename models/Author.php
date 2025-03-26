<?php
class Author {
    private $conn;
    private $table = 'authors';

    public $id;
    public $author;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all authors
    public function read() {
        $query = 'SELECT id, author FROM ' . $this->table . ' ORDER BY author ASC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read a single author by ID
    public function read_single() {
        $query = 'SELECT id, author FROM ' . $this->table . ' WHERE id = :id LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new author
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (author) VALUES (:author)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':author', $this->author);
        return $stmt->execute();
    }

    // Update an existing author
    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET author = :author WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Delete an author
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}