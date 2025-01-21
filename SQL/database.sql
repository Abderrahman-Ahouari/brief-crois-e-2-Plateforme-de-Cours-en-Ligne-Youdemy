-- Active: 1733842609457@@127.0.0.1@3306@platform_de_cours_youdemy
DROP TABLE users;
DROP TABLE categories;
DROP TABLE tags;
DROP TABLE courses;
DROP TABLE course_tags;
DROP TABLE enrollments  ;


    CREATE TABLE users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        phone VARCHAR(15) NOT NULL,
        image_profile TEXT,
        password VARCHAR(255) NOT NULL,
        role ENUM('student', 'teacher', 'admin') NOT NULL,
        status ENUM('active', 'inactive') DEFAULT 'inactive',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );



CREATE TABLE categories (
    categorie_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);



CREATE TABLE courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    content TEXT NOT NULL,
    cover TEXT, 
    duration VARCHAR(20),
    nbr_page INT,
    category_id INT,
    teacher_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    cours_status ENUM('accepted', 'rejected', 'pending') DEFAULT 'pending',
    FOREIGN KEY (category_id) REFERENCES categories(categorie_id) ON DELETE SET NULL,
    FOREIGN KEY (teacher_id) REFERENCES users(user_id) ON DELETE CASCADE
);



CREATE TABLE course_tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    tag_id INT NOT NULL,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id) ON DELETE CASCADE
);



CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    FOREIGN KEY (student_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
);




