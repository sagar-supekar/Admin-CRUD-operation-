<?php
session_start();  // Make sure session_start() is called at the top of the script
ini_set('display_errors', 1);
error_reporting(E_ALL);

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to the database
    $dbconnect = mysqli_connect("localhost", "root", "root", "Admin_Panel");

    if ($dbconnect->connect_error) {
        die("Connection failed: " . $dbconnect->connect_error);
    }

    // Sanitize the inputs
    $email = mysqli_real_escape_string($dbconnect, trim($_POST['email']));
    $password = mysqli_real_escape_string($dbconnect, trim($_POST['password']));

    // Basic validation for email and password
    if (empty($email)) {
        $error = "<p>Email cannot be blank</p>";
    } else if (empty($password)) {
        $error = "<p>Password cannot be blank</p>";
    } 
    else if(strlen($password) <= 8) {
        $error = "Password must contain at least 8 characters!";
    } else {
        // Check if the email already exists in the database
        $query = "SELECT id FROM login_table WHERE email='$email'";
        $result = mysqli_query($dbconnect, $query);

        if (mysqli_num_rows($result) > 0) {
            $error = "<p>The email address is already registered.</p>";
        } else {
            // Hash the password before storing it
            $secure_pass = password_hash($password, PASSWORD_DEFAULT);
            // Insert new user into the database
            $query = "INSERT INTO login_table (email, password) VALUES ('$email', '$secure_pass')";
            if (mysqli_query($dbconnect, $query)) {

                // Get the user ID for the session
                $id_query = "SELECT id FROM login_table WHERE email='$email'";
                $id_result = mysqli_query($dbconnect, $id_query);
                if ($id_result && mysqli_num_rows($id_result) > 0) {
                    $row_id = mysqli_fetch_assoc($id_result);
                    $login_id = $row_id["id"];
                    $_SESSION['login_id'] = $login_id; // Set the session variable

                    // Debugging: Check if session variable is set correctly
                    echo "Session login_id: " . $_SESSION['login_id'];  // You can remove this after testing

                    // Redirect to session page
                    header('Location: session.php?login_id=' . urlencode($login_id)); // Redirect to session page
                    exit;  // Make sure to exit to stop further script execution
                } else {
                    $error = "<p>Could not retrieve user ID.</p>";
                }
            } else {
                $error = "<p>Error during sign-up. Please try again later.</p>";
            }
        }
    }

    mysqli_close($dbconnect);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>

    <!-- Include Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom styling for the page */
        body {
            background-image: url('signin.avif');
            background-color: #7242f5;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 80%;
        }

        .row {
            margin: 0;
        }

        .col-md-6,
        .col-lg-5 {
            padding: 0;
        }

        .form-container {
            box-sizing: border-box;
            background-color: rgba(13, 9, 59, 0.8);
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            color: white;
            border-bottom-right-radius: 18px;
             border-top-right-radius: 18px;
        }

        h1 {
            color: #007bff;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }


        .image-container {
            position: relative;
            height: 100%;
            width: 100%;
            max-width: 600px;
            height: 100%;
            overflow: hidden;
            /* background-color: rgba(13, 9, 59, 0.8); */
            display: flex;
            border-bottom-left-radius: 18px;
            border-top-left-radius: 18px;
            height: 411px;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            opacity: 1;
            object-fit: cover;
        }

        #error {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }

        p {
            color: red;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center align-items-center w-100">
            <!-- Image column -->
            <div class="col-md-6 col-lg-5 d-none d-md-block">
                <div class="image-container">
                    <img src="person-Photoroom.png" alt="Sign up image">
                </div>
            </div>

            <!-- Form column -->
            <div class="col-md-6 col-lg-5">
                <!-- Sign-Up Form -->
                <div class="form-container">

                    <h1>Sign Up</h1>
                    <form id="signupForm" method="POST">
                        <!-- Email Input -->
                        <?php if (!empty($error)) { ?>
                            <p id="error" style="color:red;"><?php echo $error; ?></p>
                        <?php } ?>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter user name" required>
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" >
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-6 mb-3">
                                <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                            </div>
                            <div class="col-6 mb-3">
                                <button type="submit" class="btn btn-secondary w-100"> <a href="/redirect of pages sign up to sig in/session.php" style="text-decoration:none;color:white">Sign In</a></button>
                            </div>
                        </div>

                        <small class="text-muted" style="color: white !important;">
                            If already registered, please click on the
                            <a href="/redirect of pages sign up to sig in/session.php" class="text-primary">Sign In</a> button.
                        </small>



                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap 5 JS (Optional, for Bootstrap components like Modals, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>