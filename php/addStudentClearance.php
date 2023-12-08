<?php
    // Database Configuration values
    include 'configuration.php';

    // Post method
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collection of values
        $student_id = $_POST["student_id"];
        $clearance_id = $_POST["clearance_id"];
        $semester = $_POST["semester"];
        $semester_year = $_POST["semester_year"];
        $semester_period = $_POST["semester_period"];
        $clearance_cleared = $_POST["clearance_cleared"];
        $remarks = $_POST["remarks"];
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL Query
        $sql = "SELECT * FROM student_clearance WHERE student_id = '$student_id' AND semester='$semester' AND semester_year = '$semester_year' AND clearance_id = '$clearance_id' 
        and semester_period = '$semester_period' LIMIT 1;";
        // Query
        $res = $conn->query($sql);
        
        // No duplication
        if ($res->num_rows == 0) {
            // SQL Insert Clearance Details
            $sql = "INSERT INTO student_clearance (student_id, clearance_id, semester, semester_year, semester_period, clearance_cleared, remarks) 
            VALUES ('$student_id','$clearance_id','$semester', '$semester_year', '$semester_period', '$clearance_cleared','$remarks')";

            // Query
            if ($conn->query($sql) === TRUE) {
                echo "Student Clearance Added. ";
            } else {    
                echo "Error Inserting Clearance: " . $conn->error;
            }
        }
        // Check if already exist
        else{
            // UPDATE data
            $sql = "UPDATE student_clearance SET clearance_cleared = '$clearance_cleared', remarks = '$remarks'
            WHERE student_id = '$student_id' AND semester='$semester' AND semester_year = '$semester_year' AND clearance_id = '$clearance_id' 
            and semester_period = '$semester_period' LIMIT 1;";
            // Query
            if ($conn->query($sql) === TRUE) {
                echo "Student Clearance Updated";
            } else {    
                echo "Error Updating Clearance: " . $conn->error;
            }
        }
    
        
        
        $conn->close();
    }
?>