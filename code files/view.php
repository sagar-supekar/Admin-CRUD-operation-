<?php
include("header.php");
include("connection.php");

session_start();
if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $_SESSION['id'] = $id;
    // Fetch data from the database
    $query = "SELECT * FROM VoterRegistration WHERE `id` = '$id'";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die("Connection failed");
    } else {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $row['email']; // Store the email in session for reference if needed
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter Registration Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .main {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .input-box label,
        .column label,
        .gender label,
        .address label,
        .ID-proof h5 {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-box {
            
            justify-content: space-between;
            align-items: center;
        }

        .input-box label,
        .input-box span {
            flex: 1;
        }

        /* Custom Padding for each span field */
        #first-name-span {
            padding-left: 32px;
        }

        #last-name-span {
            padding-left: 33px;
        }

        #email-span {
            padding-left: 5px;
        }

        #phone-number-span {
            padding-left: 3px;
        }

        #birth-date-span {
            padding-left: 33px;
        }

        #gender-span {
            padding-left: 56px;
        }

        #gv-proof-span {
            padding-left: 22px;
        }

        #file-path-span {
            padding-left: 10px;
        }

        #address-span {
            padding-left: 50px;
        }

        #state-span{
            padding-left: 70px;
        }
        #city-span{
            padding-left: 79px;
        }
        #postal-code-span {
            padding-left: 17px;
        }

        
        .button-link {
            text-decoration: none;
        }

        #btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            text-align: center;
            margin-top: 20px;
            width: 100%;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        #btn:hover {
            background-color: #0056b3;
        }

        .file-link {
            color: #007bff;
            text-decoration: none;
        }

        .file-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="main">
        <h1>Voter Registration Details</h1>

        <form class="form" method="POST" action="view.php" enctype="multipart/form-data">
            
            <!-- First Name -->
            <div class="input-box">
                <label>First Name:</label>
                <span id="first-name-span"><?php echo htmlspecialchars($row['first_name']); ?></span>
            </div>

            <!-- Last Name -->
            <div class="input-box">
                <label>Last Name:</label>
                <span id="last-name-span"><?php echo htmlspecialchars($row['last_name']); ?></span>
            </div>

            <!-- Email -->
            <div class="input-box">
                <label>Email Address:</label>
                <span id="email-span"><?php echo htmlspecialchars($row['email']); ?></span>
            </div>

            <!-- Phone Number and Birth Date -->
            <div class="column">
                <div class="input-box">
                    <label>Phone Number:</label>
                    <span id="phone-number-span"><?php echo htmlspecialchars($row['mobile_number']); ?></span>
                </div>
                <div class="input-box">
                    <label>Birth Date:</label>
                    <span id="birth-date-span"><?php echo htmlspecialchars($row['birth_date']); ?></span>
                </div>
            </div>

            <!-- Gender -->
            <div class="gender">
                <label>Gender:</label>
                <span id="gender-span"><?php echo htmlspecialchars($row['gender']); ?></span>
            </div>

            <!-- Government ID Proof -->
            <div class="input-box">
                <label>GV ID Proof:</label>
                <span id="gv-proof-span"><?php echo htmlspecialchars($row['gv_proof']); ?></span>
            </div>

            <!-- File Upload -->
            <div class="input-box">
                <label>Uploaded File:</label>
                <?php if ($row['file_path']) { ?>
                    <span id="file-path-span"><a href="<?php echo htmlspecialchars($row['file_path']); ?>" class="file-link" target="_blank">View File</a></span>
                <?php } else { ?>
                    <span id="file-path-span">No file uploaded</span>
                <?php } ?>
            </div>

            <!-- Address -->
            <div class="address">
                <label>Address:</label>
                <span id="address-span"><?php echo htmlspecialchars($row['address']); ?></span>
            </div>

            <!-- State, City, Postal Code -->
            <div class="column">
                <div class="input-box">
                    <label>State:</label>
                    <span id="state-span"><?php echo htmlspecialchars($row['state']); ?></span>
                </div>
                <div class="input-box">
                    <label>City:</label>
                    <span id="city-span"><?php echo htmlspecialchars($row['city']); ?></span>
                </div>
                <div class="input-box">
                    <label>Postal Code:</label>
                    <span id="postal-code-span"><?php echo htmlspecialchars($row['postal_code']); ?></span>
                </div>
            </div>

            <!-- Back Button -->
            <div id="button">
                <a href="index.php" class="button-link">
                    <button type="button" id="btn">Back to Home</button>
                </a>
            </div>

        </form>
    </div>
</body>
</html>

<?php include("footer.php"); ?>
