<?php


    class VideoCourse extends Course {
    private $duration;
 
    public function __construct($conn, $title, $description, $cover, $content, $duration, $category_id, $teacher_id) {
        parent::__construct($conn, null, $title, $cover, $description, $content, $category_id, $teacher_id);
        $this->duration = $duration;
    }     
            

        public function add_course() {
            try {
                $sql = "INSERT INTO courses (title, description, cover, content, duration, category_id, teacher_id)
                VALUES (:title, :description, :cover, :content, :duration, :category_id, :teacher_id)";
        

                $query = $this->getConn()->prepare($sql);

                $title = $this->getTitle();
                $description = $this->getDescription();
                $cover = $this->getCover();
                $content = $this->getContent();
                $duration = $this->duration;
                $category_id = $this->getCategoryId();
                $teacher_id = $this->getTeacherId();
    
                $query->bindParam(':title', $title, PDO::PARAM_STR);
                $query->bindParam(':description', $description, PDO::PARAM_STR);
                $query->bindParam(':cover', $cover, PDO::PARAM_STR);
                $query->bindParam(':content', $content, PDO::PARAM_STR);
                $query->bindParam(':duration', $duration, PDO::PARAM_STR);
                $query->bindParam(':category_id', $category_id, PDO::PARAM_INT);
                $query->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);

                $query->execute();
            } catch (PDOException $error) {
                die("Error adding video course: " . $error->getMessage());
            }
    }
}
    
?>