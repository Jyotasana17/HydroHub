CREATE DATABASE hydrohub;
USE hydrohub;

-- USERS TABLE
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- DAM DETAILS TABLE
CREATE TABLE dam_details (
    dam_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    dam_name VARCHAR(255) NOT NULL UNIQUE,
    river_basin VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    altitude INT NOT NULL,
    width INT NOT NULL,
    length INT NOT NULL,
    number_of_gates INT NOT NULL,
    reservoir_capacity DECIMAL(10,2) NOT NULL,
    electricity_generation INT NOT NULL,
    year_construction INT NOT NULL,
    dam_type VARCHAR(100) NOT NULL,
    purpose VARCHAR(100) NOT NULL,
    operator VARCHAR(255) NOT NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
