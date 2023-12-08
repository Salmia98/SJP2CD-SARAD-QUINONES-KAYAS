
<?php
    include 'configuration.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // collect value of input field
        $email = $_POST['email'];
        $id = $_POST['id'];
        $pass = $_POST['password'];
        $acc_type = $_POST['acc_type'];
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // sql INSERT table
        $sql = "INSERT INTO account (student_teacher_id, acc_type, email, passwrd) 
        VALUES ('$id', '$acc_type', '$email', '$pass_hash')";
    
    
        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "Error Inserting Account: " . $conn->error;
        }
        
        $conn->close();
    }
?>