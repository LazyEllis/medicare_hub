CREATE DATABASE IF NOT EXISTS medicare_hub;

USE medicare_hub;

-- Table to store user sign-up information
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Table to store patient information
CREATE TABLE IF NOT EXISTS patients (
    patient_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    address TEXT NOT NULL,
    contact VARCHAR(255) NOT NULL,
    allergies TEXT,
    pre_existing_conditions TEXT,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Table to store diagnosis information
CREATE TABLE IF NOT EXISTS diagnoses (
    diagnosis_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    diagnosis_date DATE NOT NULL,
    diagnosis_details TEXT NOT NULL,
    notes TEXT,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
);

-- Table to store treatment information
CREATE TABLE IF NOT EXISTS treatments (
    treatment_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    treatment_date DATE NOT NULL,
    treatment_details TEXT NOT NULL,
    dosage_instructions TEXT,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
);
