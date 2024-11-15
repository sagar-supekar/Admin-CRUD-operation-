<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS for styling -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .welcome-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            text-align: center;
            background-color: #f4f4f9;
        }
        .welcome-text {
            font-size: 4rem;
            font-weight: bold;
            color: #333;
        }
        .button-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .btn {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <!-- Container for the welcome text and buttons -->
    <div class="welcome-container">
        <div>
            <div class="welcome-text">
                Welcome
            </div>
        </div>
    </div>

    <!-- Buttons at the top right -->
    <div class="button-container">
        <a href="/redirect of pages sign up to sig in/session.php" class="btn btn-primary">Sign In</a>
        <a href="/redirect of pages sign up to sig in/adding_form_dat_in_db.php" class="btn btn-secondary">Sign Up</a>
    </div>

    <!-- Bootstrap JS (optional, for components that require JavaScript) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
