<?php


class DocumentCourse extends Course {
    private $nbr_page;

    public function __construct($conn, $title, $description, $cover, $content, $nbr_page, $category_id, $teacher_id) {
        parent::__construct($conn, null, $title, $cover, $nbr_page, null, $description, $content, $category_id, $teacher_id);
        $this->nbr_page = $nbr_page;
    }

    public function add_course() {
        try {
            $sql = "INSERT INTO courses (title, description, cover, content, nbr_page, category_id, teacher_id)
                    VALUES (:title, :description, :cover, :content, :nbr_page, :category_id, :teacher_id)";

            $query = $this->getConn()->prepare($sql);

            $query->bindParam(':title', $this->getTitle(), PDO::PARAM_STR);
            $query->bindParam(':description', $this->getDescription(), PDO::PARAM_STR);
            $query->bindParam(':cover', $this->getcover(), PDO::PARAM_STR);
            $query->bindParam(':content', $this->getContent(), PDO::PARAM_STR);
            $query->bindParam(':nbr_page', $this->nbr_page, PDO::PARAM_INT);
            $query->bindParam(':category_id', $this->getCategoryId(), PDO::PARAM_INT);
            $query->bindParam(':teacher_id', $this->getTeacherId(), PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException $error) {
            die("Error adding document course: " . $error->getMessage());
        }
    }
}
?>