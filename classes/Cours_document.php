<?php


class DocumentCourse extends Course {
    private $nbr_page;

    public function __construct($conn, $title, $description, $cover, $content, $nbr_page, $category_id, $teacher_id) {
        parent::__construct($conn, null, $title, $cover, $description, $content, $category_id, $teacher_id);
        $this->nbr_page = $nbr_page;
    }

    public function add_course() {
        try {
            $sql = "INSERT INTO courses (title, description, cover, content, nbr_page, category_id, teacher_id)
                    VALUES (:title, :description, :cover, :content, :nbr_page, :category_id, :teacher_id)";

            $query = $this->getConn()->prepare($sql);

            $query->bindParam(':title', $this->title, PDO::PARAM_STR);
            $query->bindParam(':description', $this->description, PDO::PARAM_STR);
            $query->bindParam(':cover', $this->cover, PDO::PARAM_STR);
            $query->bindParam(':content', $this->content, PDO::PARAM_STR);
            $query->bindParam(':nbr_page', $this->nbr_page, PDO::PARAM_INT);
            $query->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
            $query->bindParam(':teacher_id', $this->teacher_id, PDO::PARAM_INT);

            $query->execute();

            $course_id = $this->getConn()->lastInsertId();
            return $course_id;
        } catch (PDOException $error) {
            die("Error adding document course: " . $error->getMessage());
        }
    }

    public function modifyCourse() {
        try {
            $sql = "UPDATE courses 
                    SET title = :title, description = :description, content = :content, nbr_page = :nbr_page, duration = NULL, category_id = :category_id, cover = :cover, status = 'pending'
                    WHERE course_id = :course_id";

            $query = $this->conn->prepare($sql);

            $query->bindParam(':title', $this->title, PDO::PARAM_STR);
            $query->bindParam(':description', $this->description, PDO::PARAM_STR);
            $query->bindParam(':content', $this->content, PDO::PARAM_STR);
            $query->bindParam(':nbr_page', $this->nbr_page, PDO::PARAM_INT);
            $query->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
            $query->bindParam(':cover', $this->cover, PDO::PARAM_STR);
            $query->bindParam(':course_id', $this->course_id, PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException $error) {
            die("Error modifying document course: " . $error->getMessage());
        }
    }
}

?>