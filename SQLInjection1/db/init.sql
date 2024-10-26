CREATE DATABASE IF NOT EXISTS sql_injection1;
USE sql_injection1;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    rental VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password, rental) VALUES
    ('Bob', 'ZmlnaHQ', 'Harry Potter'),
    ('Alice', 'iYXNzZQ', 'The Lord of the Rings'),
    ('Eve', 'c2VjcmV0', 'The Hobbit'),
    ('Mallory', 'bWFsbG9yeQ', 'The Chronicles of Narnia'),
    ('Trudy', 'dHJ1ZHk', 'The Hunger Games'),
    ('Charlie', 'Y2hhcmxlcw', 'jurassic Park'),
    ('David', 'ZGF2aWQ', 'The Da Vinci Code'),
    ('admin', 'a2l0c2Vje3NxbF9Jbl9qZWNfdGlPbjF9', 'kitsec{sql_In_jec_tiOn1}');