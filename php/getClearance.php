<?php
    // Database Configuration values
    include 'configuration.php';

    // Post method
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if already exist
        $sql = "SELECT * FROM clearance ORDER BY office_name";
        // Query
        $res = $conn->query($sql);
        
        // No duplication
        if ($res->num_rows > 0) {
            $rows = [];
            while($row = mysqli_fetch_assoc($res)) {
                $rows[] = [
                    "id" => $row["id"],
                    "semester_periods" => $row["semester_periods"],
                    "office_name" => $row["office_name"],
                ];
            }
            echo json_encode($rows);
        }else{
            echo "No Data";
        }
    
        $conn->close();
    }
?>