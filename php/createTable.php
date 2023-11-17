<?php
    include 'configuration.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    // sql to create account table
    $sql = "CREATE TABLE IF NOT EXISTS Account (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_teacher_id VARCHAR(50),
    acc_type BOOLEAN,
    email VARCHAR(50),
    passwrd VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table Account created successfully";
    } else {
        echo "Error creating account table: " . $conn->error;
    }

    // sql to create student table
    $sql = "CREATE TABLE IF NOT EXISTS student (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        students_id VARCHAR(10),
        personal_details_id VARCHAR(10),
        year_level INT(10),
        students_course VARCHAR(10),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    
    if ($conn->query($sql) === TRUE) {
        echo ", Table Student created successfully";
    } else {
        echo ", Error creating student table: " . $conn->error;
    }

    $sql = "CREATE TABLE IF NOT EXISTS teacher (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        teachers_id VARCHAR(10),
        personal_details_id VARCHAR(10),
        department VARCHAR(10),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    
    if ($conn->query($sql) === TRUE) {
        echo ", Table teacher created successfully";
    } else {
        echo ", Error creating teacher table: " . $conn->error;
    }

    $sql = "CREATE TABLE IF NOT EXISTS personal_details (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50),
        middle_initial VARCHAR(1),
        last_name VARCHAR(50),
        gender VARCHAR(5),
        birthday TIMESTAMP,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    
    if ($conn->query($sql) === TRUE) {
        echo ", Table tpersonal_details created successfully";
    } else {
        echo ", Error creating personal_details table: " . $conn->error;
    }

    $conn->close();
?>