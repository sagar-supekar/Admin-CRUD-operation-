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
            background-color: #343a40; /* Dark background for heading */
            color: white;
            padding: 20px 0;  /* Vertical padding */
            width: 100%; /* Ensure full width */
          
        }

        .table-responsive {
            width: 100%; /* Ensure table is full width */
           
           
        }

        table {
            margin: 0 auto; /* Center the table */
            border-collapse: collapse; /* Remove double borders */
        }

        th, td {
            padding: 15px; /* Add padding inside cells */
            text-align: center; /* Center align text */
        }

        th {
            background-color: #222; /* Dark background for the header */
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #444; /* Dark gray for even rows */
        }

        tbody tr:nth-child(odd) {
            background-color: #333; /* Slightly lighter gray for odd rows */
        }

        tbody tr:hover {
            background-color: #555; /* Hover effect */
            color: white; /* White text on hover */
        }

        .container-fluid {
            margin: 0 20px; /* Add margin from all sides */
        }

        .table-bordered {
            border: 1px solid #ddd; /* Add border around the table */
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd; /* Light borders for cells */
        }
        
    </style>
</head>
<body>

    <!-- Main container with full width -->

    
    <div class="container-fluid ">
        
        <div class="text-center mb-2">
             <h1 class="admin-heading"> Admin Panel</h1>
         </div>