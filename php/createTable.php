<?php
    include 'configuration.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    

    // Create account table
    $sql = "CREATE TABLE IF NOT EXISTS Account (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        student_teacher_id VARCHAR(50),
        acc_type VARCHAR(10),
        email VARCHAR(50),
        passwrd VARCHAR(255) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

    // Query sql request with response
    if ($conn->query($sql) === TRUE) {
        echo "Table Account created successfully";
    } else {
        echo "Error creating account table: " . $conn->error;
    }

    // Create student table
    $sql = "CREATE TABLE IF NOT EXISTS student (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        student_id VARCHAR(10),
        personal_details_id VARCHAR(10),
        year_level INT(10),
        student_course VARCHAR(10),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    
    // Query sql request with response
    if ($conn->query($sql) === TRUE) {
        echo ", Table Student created successfully";
    } else {
        echo ", Error creating student table: " . $conn->error;
    }

    // Create teacher table
    $sql = "CREATE TABLE IF NOT EXISTS teacher (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        teacher_id VARCHAR(10),
        personal_details_id VARCHAR(10),
        department VARCHAR(10),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    
    // Query sql request with response
    if ($conn->query($sql) === TRUE) {
        echo ", Table teacher created successfully";
    } else {
        echo ", Error creating teacher table: " . $conn->error;
    }

    // Create personal details table
    $sql = "CREATE TABLE IF NOT EXISTS personal_details (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50),
        middle_initial VARCHAR(1),
        last_name VARCHAR(50),
        gender VARCHAR(5),
        birthday TIMESTAMP,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    
    // Query sql request with response
    if ($conn->query($sql) === TRUE) {
        echo ", Table personal_details created successfully";
    } else {
        echo ", Error creating personal_details table: " . $conn->error;
    }

    // Create clearance table
    $sql = "CREATE TABLE IF NOT EXISTS clearance (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        semester_periods VARCHAR(50),
        office_name VARCHAR(50),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

    // Query sql request with response
    if ($conn->query($sql) === TRUE) {
        echo ", Table clearance table created successfully";
    } else {
        echo ", Error creating clearance table: " . $conn->error;
    }

    // Create student clearance table
    $sql = "CREATE TABLE IF NOT EXISTS student_clearance (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        student_id VARCHAR(10),
        semester INT(1),
        semester_year VARCHAR(20),
        semester_period VARCHAR(20),
        clearance_id INT(6),
        clearance_cleared BOOLEAN,
        remarks TEXT,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

    // Query sql request with response
    if ($conn->query($sql) === TRUE) {
        echo ", Table student clearance table created successfully";
    } else {
        echo ", Error creating student clearance table: " . $conn->error;
    }

    $conn->close();
?>