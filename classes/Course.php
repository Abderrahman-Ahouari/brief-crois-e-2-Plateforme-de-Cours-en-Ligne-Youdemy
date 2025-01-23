<?php

class Course {
    private $course_id;
    private $title;
    private $description;
    private $content;
    private $cover; 
    private $category_id; 
    private $teacher_id;
    private $status;
    private $conn;

    public function __construct($conn = null, $course_id = null, $title = null, $cover = null, $description = null, $content = null, $category_id = null, $teacher_id = null, $status = null) {
        $this->conn = $conn;
        $this->course_id = $course_id;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->category_id = $category_id;
        $this->teacher_id = $teacher_id;
        $this->status = $status;
        $this->cover = $cover;
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

    public function getcover() {
        return $this->cover;
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

    public function setCover($cover) {
        $this->cover = $cover;
    }



    public function add_course() {}


    public function modifyCourse() {}
    
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



    
    public function read_course_details() {
        try {
            $sql = "SELECT courses.*, 
                           categories.name AS category_name, 
                           users.first_name AS teacher_first_name, 
                           users.last_name AS teacher_last_name, 
                           users.phone AS teacher_phone, 
                           users.image_profile AS teacher_profile_image
                    FROM courses
                    LEFT JOIN categories ON categories.categorie_id = courses.category_id
                    LEFT JOIN users ON users.user_id = courses.teacher_id
                    WHERE courses.course_id = :course_id";
    
            $query = $this->conn->prepare($sql);
    
            $query->bindParam(':course_id', $this->course_id, PDO::PARAM_INT);
    
            $query->execute();
    
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            die("Error reading course details: " . $error->getMessage());
        }
    }

    

    
    public function read_teacher_courses() {
        try {

            $sql = "SELECT courses.*, categories.name FROM courses
INNER JOIN categories ON categories.categorie_id = courses.category_id
WHERE courses.teacher_id = :teacher_id;";
            
            $query = $this->conn->prepare($sql);
            
            $query->bindParam(':teacher_id', $this->teacher_id, PDO::PARAM_INT);
            
            $query->execute();
            
            return $query->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            die("Error reading courses by teacher: " . $error->getMessage());
        }
    }



    public function read_courses($status = null) {
        try {
            $sql = "SELECT courses.*, users.*, categories.name
                    FROM courses
                    INNER JOIN categories ON categories.categorie_id = courses.category_id
                    INNER JOIN users ON users.user_id = courses.teacher_id";
            
            if ($status) {
                $sql .= " WHERE courses.cours_status = :status";
            }
    
            $query = $this->conn->prepare($sql);
    

            if ($status) {
                $query->bindParam(':status', $status, PDO::PARAM_STR);
            }
    
            $query->execute();
    
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            die("Error reading courses: " . $error->getMessage());
        }
    }
    
    



    public function search_courses($search_name) {
        try {
            $sql = "SELECT courses.*, users.*, categories.name
                    FROM courses
                    inner JOIN categories ON categories.categorie_id = courses.category_id
                    inner JOIN users ON users.user_id = courses.teacher_id  
                    WHERE courses.title LIKE :search_name OR courses.description LIKE :search_name";
    
            $query = $this->conn->prepare($sql);
            $search_term = '%' . $search_name . '%';
            $query->bindParam(':search_name', $search_term, PDO::PARAM_STR);
    
            $query->execute();
    
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            die("Error searching courses: " . $error->getMessage());
        }
    }
    


    public function enroll_student($user_id, $course_id) {
        try {
            $sql = "INSERT INTO enrollments (student_id, course_id) VALUES (:user_id, :course_id)";
            
            $query = $this->conn->prepare($sql);
    
            $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $query->bindParam(':course_id', $course_id, PDO::PARAM_INT);
    
            $query->execute();
            return true; // Return true if the enrollment was successful
        } catch (PDOException $error) {
            die("Error enrolling student: " . $error->getMessage());
        }
    }




        public function get_enrolled_courses($user_id) {
            try {
                $sql = "SELECT courses.* 
                        FROM enrollments
                        INNER JOIN courses ON enrollments.course_id = courses.course_id
                        WHERE enrollments.student_id = :user_id";
        
                $query = $this->conn->prepare($sql);
        
                $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        
                $query->execute();
        
                return $query->fetchAll(PDO::FETCH_ASSOC); // Fetch all enrolled courses
            } catch (PDOException $error) {
                die("Error fetching enrolled courses: " . $error->getMessage());
            }
        }




        public function accept_reject_course($course_id, $status) {
            try {
                $sql = "UPDATE courses SET cours_status = :status WHERE course_id = :course_id";
                $query = $this->getconn()->prepare($sql);
                $query->bindParam(':status', $status, PDO::PARAM_STR);
                $query->bindParam(':course_id', $course_id, PDO::PARAM_INT);
                $query->execute();
            } catch (PDOException $error) {
                die("Error updating user status: " . $error->getMessage());
            }
        }
    



        
  
    
    }
    
    
    




?>
