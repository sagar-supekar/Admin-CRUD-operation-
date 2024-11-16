<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();  

if (array_key_exists('email', $_POST) || array_key_exists('password', $_POST)) {
    $error = "";
    $success = "";

   
    $dbconnect = mysqli_connect("localhost", "root", "root", "WA_training_Oct_2024");

    
    if ($dbconnect->connect_error) {
        die("Connection failed: " . $dbconnect->connect_error);
    }

    $username = trim($_POST['email']);
    $password = trim($_POST['password']);
 
    // Query to check if the email exists in the database
   
    //check validation for the admin user 
    if($username=="root" && $password== "root") 
    {   
        $_SESSION['username'] = $username;
        header("Location:code files/admin_home.php");
    }
    else
    {
              
        $query = "SELECT * FROM username_password WHERE email='$username'";
        $result = mysqli_query($dbconnect, $query);
        if (mysqli_num_rows($result) > 0) {
  
        //fetch password
        $row = mysqli_fetch_assoc($result);
        $hash_password = $row["password"];

        // Verify the password
        if (password_verify($password, $hash_password)) {
            $success = "<p>Login successful</p>";
            $_SESSION['username'] = $username; // Store the email in the session
            print_r($_SESSION['username']);
            header("Location: welcome.php"); 
            exit();
        } else {
            // Incorrect password
            $error = "<p>Username and password do not match.</p>";
        }
    }
    else {
        // Email not found
        $error = "<p>Username and password do not match.</p>";
    }
    }   

    // Close the database connection
    mysqli_close($dbconnect);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Background image */
        body {
            background-image: url('signin.avif');
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed; 
            height: 100vh; 
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0; 
            color: white; 
        }

        /* Container for the sign-in form */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin-right: 100px;
        }

        /* Sign In Card Styling */
        .card {
            width: 300px;
            padding: 30px;
            background-color: rgba(13, 9, 59, 0.8); 
            color: white;
            border: 1px solid #ccc;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .success {
            color: green;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <form method="POST">
                <h3 class="text-center mb-4">Welcome</h3>
                <h3 class="text-center mb-4">Sign In</h3>

             
                <?php if (!empty($error)) { ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php } ?>

               
                <?php if (!empty($success)) { ?>
                    <div class="success"><?php echo $success; ?></div>
                <?php } ?>

                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Username" id="email" name="email" required />
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" required />
                </div>

                <div class="mb-3">
                    <button class="btn btn-success btn-block w-100" name="submit" value="submit">Sign In</button>
                </div>

                <div class="d-flex justify-content-between mb-3 mx-2">
                    <a href="/redirect of pages sign up to sig in/adding_form_data_in _db.php">New user? Register</a>
                    <a href="/">Forgot Password?</a>
                </div>

                <div class="text-center mt-3">
                    <small>All rights are reserved.</small>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>

