<?php
    include 'configuration.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Personal Details data
        $first_name = $_POST['first_name'];
        $middle_initial = $_POST['middle_initial'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];

        // Students data
        $student_id = $_POST['student_id'];
        $year_level = $_POST['year_level'];
        $student_course = $_POST['student_course'];
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // sql INSERT table
        $sql = "INSERT INTO personal_details (first_name, middle_initial, last_name, gender, birthday)
        VALUES ('$first_name', '$middle_initial', '$last_name', '$gender', '$birthday')";

        if ($conn->query($sql) === TRUE) {
            
            $personal_details_id = $conn->insert_id; 
            echo "Insert Table Personal Details successfully: $personal_details_id" ;
            

            // SQL INSERT Student's table
            $sql = "INSERT INTO student (student_id, personal_details_id, year_level, student_course)
            VALUES ('$student_id', '$personal_details_id', '$year_level', '$student_course')";

            if ($conn->query($sql) === TRUE) {
                echo ", Insert Table Student Details successfully";
            }else{
                echo ", Error inserting Student table: " . $conn->error;
            }

        } else {
            echo "Error inserting personal details table: " . $conn->error;
        }
        
        $conn->close();
    }
?>