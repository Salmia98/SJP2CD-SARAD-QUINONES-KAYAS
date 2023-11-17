<?php
    include 'configuration.php';

     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

     // sql INSERT table
    $sql = "INSERT INTO account (student_teacher_id, acc_type, email, passwrd)
    VALUES ('20181073', 'student', 'salmiakayas@gmail.com','123456789')";


    if ($conn->query($sql) === TRUE) {
        echo "Insert Table Account successfully";
    } else {
        echo "Error inserting table: " . $conn->error;
    }


    $conn->close();
?>