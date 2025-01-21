<?php

class tags_courses {
    private $course_id;
    private $tags;

    public function __construct($course_id, $tags = []) {
        $this->course_id = $course_id;
        $this->tags = $tags;
    }

    public function getCourseId() {
        return $this->course_id;
    }

    public function setCourseId($course_id) {
        $this->course_id = $course_id;
    }

    public function getTags() {
        return $this->tags;
    }

    public function setTags($tags) {
        $this->tags = $tags;
    }
}

class taged_courses {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function insertCourseTags($courseTags) {
        try {
            $sql = "INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)";
            $query = $this->connection->prepare($sql);

            $query->bindParam(':course_id', $course_id, PDO::PARAM_INT);
            $query->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);

            $course_id = $courseTags->getCourseId();
            foreach ($courseTags->getTags() as $tag_id) {
                $query->execute();
            }

        } catch (PDOException $error) {
            die("Error inserting course tags: " . $error->getMessage());
        }
    }
}

?>
