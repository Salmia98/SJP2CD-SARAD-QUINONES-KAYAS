<?php
    include 'configuration.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $student_teacher_id= $_POST['student_teacher_id'];
        $passwrd= $_POST['passwrd'];
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
        
        // Query Value
        $sql = "SELECT passwrd, acc_type FROM account 
        WHERE student_teacher_id='$student_teacher_id' LIMIT 1";

        // passwrd='$passwrd' LIMIT 1;
        // Query
        $res = $conn->query($sql);

        // Account type
        $accType = null;

        // Check return
        if($res->num_rows > 0){
            // Fetch Data
            $row = $res->fetch_assoc();
            // Verify password
            if (password_verify($passwrd, $row['passwrd']))
                /* The password is correct. */
                $accType = $row["acc_type"];
        }

        // Login Success
        if ($accType != null) 
            echo $accType;
        // Login Failed
        else
            echo "Login Failed!";

        // Close Connection
        $conn->close();

    }
?>