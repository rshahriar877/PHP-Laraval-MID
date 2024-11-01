CREATE DATABASE studentdb;

USE studentdb;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    studentname VARCHAR(255) NOT NULL,
    rollnumber VARCHAR(50) NOT NULL UNIQUE,
    mobile VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL
);
