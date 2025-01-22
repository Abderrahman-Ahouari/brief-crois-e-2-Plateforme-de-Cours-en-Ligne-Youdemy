<?php


class DocumentCourse extends Course {
    private $nbr_page;

    public function __construct($conn, $cours_id, $title, $description, $cover, $content, $nbr_page, $category_id, $teacher_id) {
        parent::__construct($conn, $cours_id, $title, $cover, $description, $content, $category_id, $teacher_id);
        $this->nbr_page = $nbr_page;
    }

    public function add_course() {
        try {
            $sql = "INSERT INTO courses (title, description, cover, content, nbr_page, category_id, teacher_id)
                    VALUES (:title, :description, :cover, :content, :nbr_page, :category_id, :teacher_id)";

            $query = $this->getConn()->prepare($sql);

            $title = $this->getTitle();
            $description = $this->getDescription();
            $cover = $this->getCover();
            $content = $this->getContent();
            $nbr_page = $this->nbr_page;
            $category_id = $this->getCategoryId();
            $teacher_id = $this->getTeacherId();
    
            $query->bindParam(':title', $title, PDO::PARAM_STR);
            $query->bindParam(':description', $description, PDO::PARAM_STR);
            $query->bindParam(':cover', $cover, PDO::PARAM_STR);
            $query->bindParam(':content', $content, PDO::PARAM_STR);
            $query->bindParam(':nbr_page', $nbr_page, PDO::PARAM_INT);
            $query->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $query->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);

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
                    SET title = :title, 
                        description = :description, 
                        content = :content, 
                        nbr_page = :nbr_page, 
                        duration = NULL, 
                        category_id = :category_id, 
                        cover = :cover, 
                        cours_status = 'pending'
                    WHERE course_id = :course_id";
    
            $query = $this->getConn()->prepare($sql);


            $title = $this->getTitle();
            $description = $this->getDescription();
            $content = $this->getContent();
            $nbr_page = $this->nbr_page;
            $category_id = $this->getCategoryId();
            $cover = $this->getCover();
            $course_id = $this->getCourseId();
    

            $query->bindParam(':title', $title, PDO::PARAM_STR);
            $query->bindParam(':description', $description, PDO::PARAM_STR);
            $query->bindParam(':content', $content, PDO::PARAM_STR);
            $query->bindParam(':nbr_page', $nbr_page, PDO::PARAM_INT);
            $query->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $query->bindParam(':cover', $cover, PDO::PARAM_STR);
            $query->bindParam(':course_id', $course_id, PDO::PARAM_INT);
    
            $query->execute();
        } catch (PDOException $error) {
            die("Error modifying document course: " . $error->getMessage());
        }
    }
    
    
}
?>