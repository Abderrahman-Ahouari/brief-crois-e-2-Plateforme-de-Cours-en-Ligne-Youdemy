<?php
class Categorie {
    private $name;
    private $id;
    private $conn;

    public function __construct($conn = null, $name = null, $id = null) {
        $this->name = $name;
        $this->id = $id;
        $this->conn = $conn;
    }


	 public function add_categorie() {
        try {
            $sql = "INSERT INTO categories (name) VALUES (:name)";
            $query = $this->conn->prepare($sql);
            $query->bindParam(':name', $this->name, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $error) {
            die("Error adding category: " . $error->getMessage());
        }
    }

    public function delete_categorie() {
        try {
            $sql = "DELETE FROM categories WHERE categorie_id = :id";
            $query = $this->conn->prepare($sql);
            $query->bindParam(':id', $this->id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $error) {
            die("Error deleting category: " . $error->getMessage());
        }
    }

    public function read_categories() {
        try {
            $sql = "SELECT categorie_id, name FROM categories";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $categories = $query->fetchAll(PDO::FETCH_ASSOC);
            return $categories;
        } catch (PDOException $error) {
            die("Error reading categories: " . $error->getMessage());
        }
    }

    public function update_categorie() {
        try {
            $sql = "UPDATE categories SET name = :name WHERE categorie_id = :id";
            $query = $this->conn->prepare($sql);
            $query->bindParam(':name', $this->name, PDO::PARAM_STR);
            $query->bindParam(':id', $this->id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $error) {
            die("Error updating category: " . $error->getMessage());
        }
    }
}
?>
