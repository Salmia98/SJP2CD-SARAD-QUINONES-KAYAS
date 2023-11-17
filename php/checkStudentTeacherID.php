<?php
    include 'configuration.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // collect value of input field
        $student_teacher_id = $_POST['student_teacher_id'];
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check ID Duplication
        $sql = "SELECT student_teacher_id FROM account WHERE student_teacher_id='$student_teacher_id' LIMIT 1;";
        $res = $conn->query($sql);
        
        if ($res->num_rows == 0) {
            // Check if found in student 
            $sql = "SELECT student_id FROM student WHERE student_id='$student_teacher_id' LIMIT 1;";
            $res = $conn->query($sql);

            // Check if ID found
            if ($res->num_rows > 0) {
                echo "student"; 

            }else{
                // Check if found in teacher
                $sql = "SELECT teacher_id FROM teacher WHERE teacher_id='$student_teacher_id' LIMIT 1;";
                $res = $conn->query($sql);

                // Check if found
                if ($res->num_rows > 0) {
                    echo "teacher";
                }else{
                    echo "ID do not exist.";
                }
            }
        }else{
            echo "Account Already Exist";
        }
        
        $conn->close();
    }
?>