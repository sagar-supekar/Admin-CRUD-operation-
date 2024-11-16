

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap 5 CDN (same version as in footer) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .admin-heading {
            background-color: #343a40;
            text-align: center;
            color: white;
            padding: 20px 0;
            width: 100%;
        }

        .admin-container {
            background-color: #343a40;
            padding: 0 15px;
        }

        /* Center the heading and button on the same line */
        .d-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-sm {
            font-size: 12px; /* Adjust the size if needed */
        }

        .alert-container {
            width: 50%;
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
            max-width: 600px;
            min-width: 300px;
            margin: 0 10px;
            border-radius: 5px;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.42857;
            padding-top: 80px; 
        }
        

    </style>
</head>

<body>
    <!-- PHP to handle success, delete, and update messages -->
    <?php
    if (isset($_GET['success_message'])) {
        $msg = htmlspecialchars($_GET['success_message']);
        echo "<div class='alert-container'>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                " . $msg . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          </div>";
    } else if (isset($_GET["delete_message"])) {
        $msg = htmlspecialchars($_GET["delete_message"]);
        echo "<div class='alert-container'>
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                " . $msg . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          </div>";
    } else if (isset($_GET["update_message"])) {
        $msg = htmlspecialchars($_GET["update_message"]);
        echo "<div class='alert-container'>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                " . $msg . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          </div>";
    } else if (isset($_GET["update_email_message"])) {
        $msg = htmlspecialchars($_GET["update_email_message"]);
        echo "<div class='alert-container'>
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                " . $msg . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          </div>";
    }
    ?>

    <!-- Main container with full width -->
    <div class="container-fluid">
        <!-- Admin Panel Header -->
        <div class="d-flex admin-container">
            <h1 class="admin-heading">Admin Panel</h1>
            <!-- Use Font Awesome icon here for logout -->
            <a href="/Admin Panel/logout.php" class="btn btn-secondary btn-sm"> <i class="fas fa-sign-out-alt"></i> Log out</a>
        </div>
    </div>

    <!-- Include Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
