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
}

?>
