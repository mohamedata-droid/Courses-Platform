CREATE DATABASE IF NOT EXISTS codepath_academy;
USE codepath_academy;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    image VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    level VARCHAR(50) NOT NULL,
    duration VARCHAR(50) NOT NULL
);

CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    enrolled_at DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id),
    UNIQUE KEY user_course (user_id, course_id)
);

INSERT INTO courses (title, image, description, price, level, duration) VALUES
('HTML & CSS Foundations', 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=900&q=80', 'Build well-structured web pages and style them with modern, responsive CSS.', 750.00, 'Beginner', '6 Weeks'),
('JavaScript Essentials', 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=900&q=80', 'Learn the JavaScript basics needed to add interaction to web pages.', 900.00, 'Beginner', '8 Weeks'),
('PHP & MySQL Development', 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=900&q=80', 'Create database-driven PHP websites using forms, sessions, and MySQL.', 1100.00, 'Intermediate', '8 Weeks'),
('Responsive Web Design', 'https://images.unsplash.com/photo-1559028012-481c04fa702d?auto=format&fit=crop&w=900&q=80', 'Design layouts that look great on phones, tablets, and desktop screens.', 650.00, 'Beginner', '4 Weeks'),
('SQL for Web Developers', 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?auto=format&fit=crop&w=900&q=80', 'Practice database design, queries, joins, and relationships for web projects.', 800.00, 'Intermediate', '5 Weeks'),
('Frontend Portfolio Project', 'https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?auto=format&fit=crop&w=900&q=80', 'Plan and build a polished responsive portfolio website from start to finish.', 950.00, 'Intermediate', '6 Weeks');
