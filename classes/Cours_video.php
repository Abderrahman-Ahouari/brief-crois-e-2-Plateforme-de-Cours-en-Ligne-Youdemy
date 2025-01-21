<?php


    class VideoCourse extends Course {
    private $duration;
 
    public function __construct($conn, $title, $description, $cover, $content, $duration, $category_id, $teacher_id) {
        parent::__construct($conn, null, $title, $cover, null, $duration, $description, $content, $category_id, $teacher_id);
        $this->duration = $duration;
    }     
            

    public function add_course() {
        try {
            $sql = "INSERT INTO courses (title, description, cover, content, duration, category_id, teacher_id)
            VALUES (:title, :description, :cover, :content, :duration, :category_id, :teacher_id)";
    

            $query = $this->getConn()->prepare($sql);

            $query->bindParam(':title', $this->getTitle(), PDO::PARAM_STR);
            $query->bindParam(':description', $this->getDescription(), PDO::PARAM_STR);
            $query->bindParam(':cover', $this->getcover(), PDO::PARAM_STR);
            $query->bindParam(':content', $this->getContent(), PDO::PARAM_STR);
            $query->bindParam(':duration', $this->duration, PDO::PARAM_STR);
            $query->bindParam(':category_id', $this->getCategoryId(), PDO::PARAM_INT);
            $query->bindParam(':teacher_id', $this->getTeacherId(), PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException $error) {
            die("Error adding video course: " . $error->getMessage());
        }
    }
}
    
?>