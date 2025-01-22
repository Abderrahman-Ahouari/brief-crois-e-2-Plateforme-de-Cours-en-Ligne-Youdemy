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








INSERT INTO users (first_name, last_name, email, phone, image_profile, password, role, status)
VALUES 
('Admin', 'User', 'admin@example.com', '1234567890', NULL, 'adminpassword', 'admin', 'active'),
('John', 'Doe', 'john.doe@example.com', '9876543210', NULL, 'teacherpassword', 'teacher', 'active'),
('Jane', 'Smith', 'jane.smith@example.com', '5555555555', NULL, 'teacherpassword2', 'teacher', 'active'),
('Alice', 'Brown', 'alice.brown@example.com', '4444444444', NULL, 'studentpassword', 'student', 'active'),
('Bob', 'Green', 'bob.green@example.com', '3333333333', NULL, 'studentpassword2', 'student', 'inactive');

INSERT INTO categories (name)
VALUES 
('Science'),
('Mathematics'),
('Technology'),
('History'),
('Arts');

INSERT INTO tags (name)
VALUES 
('Physics'),
('Mathematics'),
('Programming'),
('History'),
('Art'),
('Advanced'),
('Basics'),
('Trends');

INSERT INTO courses (title, description, content, cover, duration, nbr_page, category_id, teacher_id, cours_status)
VALUES 
('Physics 101', 'Introduction to Physics', 'Physics content here', NULL, '3 hours', 50, 1, 2, 'accepted'),
('Calculus Basics', 'Learn the basics of calculus', 'Calculus content here', NULL, '2 hours', 40, 2, 2, 'accepted'),
('Introduction to Programming', 'Beginner programming course', 'Programming content here', NULL, '4 hours', 60, 3, 3, 'pending'),
('World History', 'Exploring major historical events', 'History content here', NULL, '5 hours', 70, 4, 2, 'rejected'),
('Digital Art', 'Create stunning digital artwork', 'Art content here', NULL, '6 hours', 80, 5, 3, 'accepted'),
('Advanced Physics', 'Dive deeper into physics topics', 'Advanced Physics content here', NULL, '3 hours', 50, 1, 2, 'pending'),
('Geometry Essentials', 'Essential concepts of geometry', 'Geometry content here', NULL, '2 hours', 45, 2, 3, 'accepted'),
('Modern Technology Trends', 'Latest in technology', 'Tech content here', NULL, '3 hours', 55, 3, 2, 'accepted');

INSERT INTO enrollments (student_id, course_id)
VALUES 
(4, 1), 
(4, 2), 
(5, 3), 
(5, 4), 
(4, 5), 
(5, 6), 
(4, 7), 
(5, 8);

INSERT INTO course_tags (course_id, tag_id)
VALUES 
(1, 1), 
(1, 6), 
(2, 2), 
(2, 7), 
(3, 3), 
(3, 7), 
(4, 4), 
(5, 5), 
(6, 1), 
(6, 6), 
(7, 2), 
(8, 3), 
(8, 8);

