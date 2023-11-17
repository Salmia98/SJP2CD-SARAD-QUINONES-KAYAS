<?php
    include 'configuration.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $student_teacher_id= $_POST['student_teacher_id'];
        $passwrd= $_POST['passwrd'];
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT acc_type FROM account 
        WHERE student_teacher_id='$student_teacher_id' AND passwrd='$passwrd' LIMIT 1;";

        $res = $conn->query($sql);
        if ($res->num_rows == 0) {
            echo "Login Failed!";
        }else{
            $row = $res->fetch_assoc();
            echo $row["acc_type"];
        }

        $conn->close();

    }



?>