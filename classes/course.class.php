<?php

class Course {
    private $course_id;
    private $title;
    private $description;
    private $content;
    private $category_id;
    private $teacher_id;
    private $status;
    private $conn;

    public function __construct($conn, $course_id = null, $title = null, $description = null, $content = null, $category_id = null, $teacher_id = null, $status = null) {
        $this->conn = $conn;
        $this->course_id = $course_id;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->category_id = $category_id;
        $this->teacher_id = $teacher_id;
        $this->status = $status;
    }



    public function getCourseId() {
        return $this->course_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCategoryId() {
        return $this->category_id;
    }

    public function getTeacherId() {
        return $this->teacher_id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getConn() {
        return $this->conn;
    }



    public function setCourseId($course_id) {
        $this->course_id = $course_id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }

    public function setTeacherId($teacher_id) {
        $this->teacher_id = $teacher_id;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setConn($conn) {
        $this->conn = $conn;
    }



    public function add_course() {
        try {
            $sql = "INSERT INTO courses (title, description, content, category_id, teacher_id,)
                    VALUES (:title, :description, :content, :category_id, :teacher_id)";

            $query = $this->conn->prepare($sql);

            $query->bindParam(':title', $this->title, PDO::PARAM_STR);
            $query->bindParam(':description', $this->description, PDO::PARAM_STR);
            $query->bindParam(':content', $this->content, PDO::PARAM_STR);
            $query->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
            $query->bindParam(':teacher_id', $this->teacher_id, PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException) {
            die("Error adding course: " . $error->getMessage());
        }
    }


    public function modifyCourse() {
      try {
          $sql = "UPDATE courses 
                  SET title = :title, description = :description, content = :content, category_id = :category_id 
                  WHERE course_id = :course_id";

          $query = $this->conn->prepare($sql);
  
          $query->bindParam(':title', $this->title, PDO::PARAM_STR);
          $query->bindParam(':description', $this->description, PDO::PARAM_STR);
          $query->bindParam(':content', $this->content, PDO::PARAM_STR);
          $query->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
          $query->bindParam(':course_id', $this->course_id, PDO::PARAM_INT);
  
          $query->execute();
      } catch (PDOException $error) {
          die("Error modifying course: " . $error->getMessage());
      }
  }


  public function deleteCourse() {
   try {
       $sql = "DELETE FROM courses WHERE course_id = :course_id";
       
       $query = $this->conn->prepare($sql);

       $query->bindParam(':course_id', $this->course_id, PDO::PARAM_INT);

       $query->execute();
   } catch (PDOException $error) {
       die("Error deleting course: " . $error->getMessage());
   }
}

  
}



?>
