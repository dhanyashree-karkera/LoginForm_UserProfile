<?php 
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $email = $_POST['Email']; // Corrected to match the form field name
    $password = $_POST['password'];

    // Validate login 
    $query = "SELECT id, email, password FROM login WHERE email='$email' AND password='$password'";
    $result = $con->query($query);

    if ($result->num_rows == 1) {
        // Login success
        $row = $result->fetch_assoc();
        $userId = $row['id']; // Retrieve the user ID
        
        // Get the current date and time
        $loginTime = date('Y-m-d H:i:s');

        
        // Convert userId to integer
        // $userId = (int) $userId;

        // Start the session and store the user ID
        session_start();
        $_SESSION['userId'] = $userId;
       
         // Update login_time in the database
        $updateQuery = "UPDATE login SET login_time=NOW() WHERE id='$userId'";
        $con->query($updateQuery);

        // Redirect to home.php with userId in URL
        header("Location: home.php");
        exit();
    } else {
        echo '<script>alert("Login failed"); window.location.href = "../../index.html";</script>';
    }

    $con->close();
}
?>

