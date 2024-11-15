<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        .admin-heading {
            background-color: #343a40; 
            color: white;
            padding: 20px 0; 
            width: 100%; 
          
        }

        .table-responsive {
            width: 100%; 
           
           
        }

        table {
            margin: 0 auto; 
            border-collapse: collapse; 
        }

        th, td {
            padding: 15px; 
            text-align: center; 
        }

        th {
            background-color: #222;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: white; 
        }

        tbody tr:nth-child(odd) {
            background-color: white; 
        }

        tbody tr:hover {
            background-color: gray; 
            color: black; 
        }

        .container-fluid {
            margin: 0 20px; 
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd; 
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
    padding-top: 80px; /* Make sure there is enough space for the alert */
}

    </style>
</head>
<body>
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
}
else if (isset($_GET["update_message"])) {
    $msg = htmlspecialchars($_GET["update_message"]);
    echo "<div class='alert-container'>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                " . $msg . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          </div>";
}
else if (isset($_GET["update_email_message"])) {
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

    
    <div class="container-fluid ">
        
        <div class="text-center mb-2">
             <h1 class="admin-heading"> Admin Panel</h1>
         </div>