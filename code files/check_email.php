<?php
include("connection.php");

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Prepare the SQL query to check if the email exists
    $sql = "SELECT * FROM VoterRegistrationTable WHERE email = $email]";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if any row exists with the given email
    if ($stmt->num_rows > 0) {
        echo 'exists';  // Email already exists
    } else {
        echo 'not_exists';  // Email does not exist
    }

    $stmt->close();
}

$conn->close();


?>