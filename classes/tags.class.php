<?php
class Tags {
    private $name;
    private $id;
    private $conn;

    public function __construct($conn = null, $name = null, $id = null) {
        $this->name = $name;
        $this->id = $id;
        $this->conn = $conn;
    }

    public function add_tag() {
        try {
            $sql = "INSERT INTO tags (name) VALUES (:name)";
            $query = $this->conn->prepare($sql);
            $query->bindParam(':name', $this->name, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $error) {
            die("Error adding tag: " . $error->getMessage());
        }
    }

    public function delete_tag() {
        try {
            $sql = "DELETE FROM tags WHERE tag_id = :id";
            $query = $this->conn->prepare($sql);
            $query->bindParam(':id', $this->id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $error) {
            die("Error deleting tag: " . $error->getMessage());
        }
    }

    public function read_tags() {
        try {
            $sql = "SELECT tag_id, name FROM tags";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $tags = $query->fetchAll(PDO::FETCH_ASSOC);
            return $tags;
        } catch (PDOException $error) {
            die("Error fetching tags: " . $error->getMessage());
        }
    }
}
?>
