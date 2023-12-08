<?php
    // Database Configuration values
    include 'configuration.php';

    // Post method
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collection of values
        $semester_periods = $_POST["semester_periods"];
        $office_name = $_POST["office_name"];
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if already exist
        $sql = "SELECT office_name FROM clearance WHERE semester_periods='$semester_periods' AND office_name = '$office_name' LIMIT 1;";
        // Query
        $res = $conn->query($sql);
        
        // No duplication
        if ($res->num_rows == 0) {
            // SQL Insert Clearance Details
            $sql = "INSERT INTO clearance (semester_periods, office_name) 
            VALUES ('$semester_periods', '$office_name')";
        
            if ($conn->query($sql) === TRUE) {
                echo "success";
            } else {    
                echo "Error Inserting Clearance: " . $conn->error;
            }
        }else{
            echo $office_name . " Clearance already exist";
        }
    
        
        
        $conn->close();
    }
?>