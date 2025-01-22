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



-- Insert Categories
INSERT INTO categories (name) VALUES 
('Math'), 
('Science'), 
('History'), 
('Art'), 
('Programming');

-- Insert Tags
INSERT INTO tags (name) VALUES 
('Beginner'), 
('Intermediate'), 
('Advanced'), 
('AI'), 
('ML'), 
('Python'), 
('Design'), 
('Web'), 
('Database'), 
('Mobile');

-- Insert Users
INSERT INTO users (first_name, last_name, email, phone, image_profile, password, role, status) VALUES 
('Alice', 'Smith', 'alice@example.com', '1234567890', NULL, 'password123', 'teacher', 'active'),
('Bob', 'Jones', 'bob@example.com', '2345678901', NULL, 'password123', 'teacher', 'active'),
('Charlie', 'Brown', 'charlie@example.com', '3456789012', NULL, 'password123', 'admin', 'active'),
('David', 'Wilson', 'david@example.com', '4567890123', NULL, 'password123', 'student', 'active'),
('Ella', 'Johnson', 'ella@example.com', '5678901234', NULL, 'password123', 'student', 'active'),
('Fiona', 'Davis', 'fiona@example.com', '6789012345', NULL, 'password123', 'teacher', 'inactive'),
('George', 'Miller', 'george@example.com', '7890123456', NULL, 'password123', 'student', 'inactive'),
('Hannah', 'Moore', 'hannah@example.com', '8901234567', NULL, 'password123', 'student', 'active'),
('Ian', 'Taylor', 'ian@example.com', '9012345678', NULL, 'password123', 'teacher', 'active'),
('Judy', 'Anderson', 'judy@example.com', '0123456789', NULL, 'password123', 'student', 'inactive');

-- Insert Courses
INSERT INTO courses (title, description, content, cover, duration, nbr_page, category_id, teacher_id) VALUES 
('Math Basics', 'Introductory math course', 'Content of math basics', NULL, '10h', 50, 1, 1),
('Advanced Math', 'Deep dive into math', 'Content of advanced math', NULL, '15h', 100, 1, 1),
('Introduction to Python', 'Learn Python programming', 'Content of Python', NULL, '20h', 200, 5, 2),
('AI Fundamentals', 'Basics of AI', 'Content of AI', NULL, '25h', 150, 5, 2),
('Web Development', 'Learn to build websites', 'Content of Web Dev', NULL, '30h', 300, 5, 2),
('Art History', 'History of Art', 'Content of Art History', NULL, '12h', 75, 4, 1),
('Modern Art', 'Explore modern art', 'Content of Modern Art', NULL, '14h', 80, 4, 1),
('Database Systems', 'Basics of DB', 'Content of DB', NULL, '18h', 120, 5, 2),
('Mobile App Dev', 'Intro to Mobile Dev', 'Content of Mobile Dev', NULL, '20h', 150, 5, 2),
('Machine Learning', 'Basics of ML', 'Content of ML', NULL, '25h', 180, 5, 2);

-- Insert Enrollments
INSERT INTO enrollments (student_id, course_id) VALUES 
(4, 1),
(4, 2),
(5, 3),
(5, 4),
(6, 5),
(7, 6);

-- Insert Course Tags
INSERT INTO course_tags (course_id, tag_id) VALUES 
(1, 1), (1, 2), (2, 3),
(3, 4), (4, 5), (5, 6),
(6, 7), (7, 8), (8, 9),
(9, 10);
