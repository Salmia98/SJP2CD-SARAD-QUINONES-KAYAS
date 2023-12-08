<?php
    // Database Configuration values
    include 'configuration.php';

    // Post method
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collection of values
        $student_id = $_POST["student_id"];
        $semester = $_POST["semester"];
        $semester_year = $_POST["semester_year"];
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if already exist
        $sql = "SELECT * FROM student_clearance WHERE student_id = '$student_id' AND semester='$semester' AND semester_year = '$semester_year' ";
        // Query
        $res = $conn->query($sql);
        
        // No duplication
        if ($res->num_rows > 0) {
            $rows = [];
            while($row = mysqli_fetch_assoc($res)) {
                $rows[] = [
                    "clearance_id" => $row["clearance_id"],
                    "semester_period" => $row["semester_period"],
                    "clearance_cleared" => $row["clearance_cleared"],
                    "remarks" => $row["remarks"]
                ];
            }
            echo json_encode($rows);
        }
        
        
        $conn->close();
    }
?>