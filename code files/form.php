<?php
session_start();


include("connection.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define error messages and form variables
$first_nameErr = $last_nameErr = $emailErr = $phoneErr = $birthErr = $genderErr = $gv_idErr = $addressErr = $stateErr = $fileErr = $cityErr = $postalErr = "";
$first_name = $last_name = $email = $phone = $birth_date = $gender = $gv_id = $address = $state = $city = $postal = "";
$successMessage = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $signal = true;

    // Check if email already exists
   

    // Validate form fields
    // First name validation
    if (empty($_POST["first-name"])) {
        $first_nameErr = "First name is required";
        $signal = false;
    } else {
        $first_name = test_input($_POST["first-name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $first_name)) {
            $first_nameErr = "Only letters and white space allowed";
            $signal = false;
        }
    }

    // Last name validation
    if (empty($_POST["last-name"])) {
        $last_nameErr = "Last name is required";
        $signal = false;
    } else {
        $last_name = test_input($_POST["last-name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $last_name)) {
            $last_nameErr = "Only letters and white space allowed";
            $signal = false;
        }
    }

    // Email validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $signal = false;
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $signal = false;
        }
    }

    // Phone number validation
    if (empty($_POST["phone-number"])) {
        $phoneErr = "Phone number is required";
        $signal = false;
    } else {
        $phone = test_input($_POST["phone-number"]);
        if (!preg_match('/^[0-9]{10}$/', $phone)) {
            $phoneErr = "Enter 10 digit phone number";
            $signal = false;
        }
    }

    // Birth date validation
    $birth_date = $_POST["birth-date"];
    function isDate($string) {
        $inputDate = DateTime::createFromFormat('Y-m-d', $string);
        if ($inputDate === false) {
            return false;
        }
        $currentDate = new DateTime();
        if ($inputDate > $currentDate) {
            return false;
        }
        $age = $currentDate->diff($inputDate)->y;
        if ($age < 18) {
            return false;
        }
        return true;
    }
    if (!isDate($birth_date)) {
        $birthErr = "Age should not be less than 18 or birth date not allowed in the future.";
        $signal = false;
    }

    // Gender validation
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
        $signal = false;
    } else {
        $gender = test_input($_POST["gender"]);
    }

    // ID Proof validation (checkbox)
    if (!isset($_POST['gv-card'])) {
        $gv_idErr = "Please select at least one ID proof";
        $signal = false;
    } else {
        $gv_ids = $_POST['gv-card'];
        $gv_id = implode(", ", $gv_ids); // Convert array to comma-separated string
    }

    // File upload validation
    if (isset($_FILES['filename'])) {
        $file = $_FILES['filename'];
        $allowed_types = ['application/pdf', 'image/jpeg', 'image/jpg'];
        if ($file['error'] == 0) {
            if (!in_array($file['type'], $allowed_types)) {
                $fileErr = "Only JPEG/JPG and PDF files are allowed.";
                $signal = false;
            }
        } else {
            $fileErr = "Please upload a valid file.";
            $signal = false;
        }
    } else {
        $fileErr = "Please upload a file.";
        $signal = false;
    }

    // Address validation
    if (empty($_POST['address'])) {
        $addressErr = "Address field is required";
        $signal = false;
    }

    // State validation
    $state = $_POST['state'];
    if ($state == 'Select State' || empty($state)) {
        $stateErr = "Please select a state";
        $signal = false;
    }

    // City validation
    if (empty($_POST["city"])) {
        $cityErr = "City is required";
        $signal = false;
    } else {
        $city = test_input($_POST["city"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
            $cityErr = "Only letters and white space allowed";
            $signal = false;
        }
    }

    // Postal code validation
    if (empty($_POST["postal-code"])) {
        $postalErr = "Postal code is required";
        $signal = false;
    } else {
        $postal = test_input($_POST["postal-code"]);
        if (!preg_match('/^[0-9]{6}$/', $postal)) {
            $postalErr = "Enter a 6-digit postal code";
            $signal = false;
        }
    }
    if ($signal) {
        $user_email = $_POST['email'];
        $email_query = "SELECT * FROM VoterRegistration WHERE email = '$user_email'";
        $email_result = mysqli_query($link, $email_query);

        if ($email_result && mysqli_num_rows($email_result) > 0) {
            $emailErr = "Email address already exists. Please use a different email.";
            $signal = false;
        }
    }
    if ($signal) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($file["name"]);
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            $address = mysqli_real_escape_string($link, $_POST['address']);
            $sql = "INSERT INTO VoterRegistration (first_name, last_name, email, mobile_number, birth_date, gender, gv_proof, address, state, city, postal_code, file_path)
                    VALUES ('$first_name', '$last_name', '$email', '$phone', '$birth_date', '$gender', '$gv_id', '$address', '$state', '$city', '$postal', '$target_file')";
            if (mysqli_query($link, $sql)) {
                $successMessage = "Registration successful!";   
                header("Location: admin_home.php?update_message=" . urlencode('New record added successfully'));
                exit();
            } else {
                $fileErr = "Failed to submit data to the database: " . mysqli_error($link);
            }
        } else {
            $fileErr = "Sorry, there was an error uploading your file.";
        }
    } else {
        // If any error exists, redirect back with errors
        header("Location:form.php?email_message=" . urlencode('Email already exists '));
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registartion Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main">
        <div class="d-flex justify-content-start">
            <a href="admin_home.php" class="btn-close" aria-label="Close" style="font-size: 24px;text-decoration:none;">X</a>
        </div>
       <form class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="error-alert"><?php echo $successMessage ?></div>
            <h1>Voter Registration Form</h1>
            <div class="input-box">
                <label>First Name</label>
                <input type="text" placeholder="Enter first name" id="first-name" name="first-name"  />
                <small id="first-name-error"></small>
                 <span class="error" style="color:red;"><?php echo $first_nameErr;?></span>
            </div>

            <div class="input-box">
                <label>Last Name</label>
                <input type="text" placeholder="Enter last name" id="last-name" name="last-name"   />
                <small id="last-name-error"></small>
                 <span class="error" style="color:red;"><?php echo $last_nameErr;?></span>
            </div>


            <div class="input-box">
                <label>Email Address</label>
                <input type="text" placeholder="Enter email address" name="email"  />
                <small id="email-error"></small>
                <span class="error" style="color:red;"><?php echo  isset($_GET['email_message']) ?$_GET['email_message']:''; ?></span>
            </div>


            <div class="column">
                <div class="input-box">
                    <label>Phone Number</label>
                    <input type="text" placeholder="Enter phone number" id="phone-number" maxlength="10" name="phone-number"  />
                    <small id="phone-error"></small>
                    <span class="error" style="color:red;"><?php echo $phoneErr;?></span>
                </div>
                <div class="input-box">
                    <label>Birth Date</label>
                    <input type="date" id="birth-date" name="birth-date"  />
                    <small id="birth-error"></small>
                    <span class="error" style="color:red;"><?php echo $birthErr;?></span>
                </div>
            </div>

            <div class="gender">
                <label for="gender">Gender</label>
                <input type="radio" name="gender" id="male" value="male" > Male
                <input type="radio" name="gender" id="female" value="female"> Female
                <small id="error-message"></small>
                <span class="error" style="color:red;"><?php echo $genderErr;?></span>
            </div>
            <div class="ID-proof column">
                <div class="input-box">
                    <h5>Select Government ID proof:</h5>
                    <div class="checkbox-container">
                        <input type="checkbox" id="adhar-card" name="gv-card[]" value="Adhar Card">
                        <label for="adhar-card" class="gv-proof"> Adhar Card</label>
                        <input type="checkbox" id="pan-card" name="gv-card[]" value="Pan Card">
                        <label for="pan-card" class="gv-proof"> Pan Card</label>
                    </div>
                    <small id="check-box-error"></small>
                    <span class="error" style="color:red;"><?php echo $gv_idErr;?></span>
                </div>
                <div class="input-box">
                    <h5>Click on the "Choose File" button to upload a file (.pdf or .jpeg):</h5>
                    <input type="file" id="file" name="filename">
                    <input type="submit" value="Upload" id="upload" name="upload">
                    <small id="file-error"></small>
                    <span class="error" style="color:red;"><?php echo $fileErr;?></span>
                </div>
            </div>


            <div class="address">
                <p><label for="area">Address:</label></p>
                <textarea id="area" name="address" rows="4" cols="50" id="address"></textarea>
                <small id="address-error"></small>
                 <span class="error" style="color:red;"><?php echo $addressErr;?></span>
                <div>

                    <div class="column">
                        <div class="select-box">
                            <label for="check-box" id="state">Select State</label>
                            <select id="check-box" name="state" required>
                                <option hidden>Select State</option>
                                <option>Andhra Pradesh</option>
                                <option>Arunachal Pradesh</option>
                                <option>Assam</option>
                                <option>Bihar</option>
                                <option>Chhattisgarh</option>
                                <option>Goa</option>
                                <option>Gujarat</option>
                                <option>Haryana</option>
                                <option>Himachal Pradesh</option>
                                <option>Jharkhand</option>
                                <option>Karnataka</option>
                                <option>Kerala</option>
                                <option>Madhya Pradesh</option>
                                <option>Maharashtra</option>
                                <option>Manipur</option>
                                <option>Meghalaya</option>
                                <option>Mizoram</option>
                                <option>Nagaland</option>
                                <option>Odisha</option>
                                <option>Punjab</option>
                                <option>Rajasthan</option>
                                <option>Sikkim</option>
                                <option>Tamil Nadu</option>
                                <option>Telangana</option>
                                <option>Tripura</option>
                                <option>Uttar Pradesh</option>
                                <option>Uttarakhand</option>
                                <option>West Bengal</option>
                                <option>Andaman and Nicobar Islands</option>
                                <option>Chandigarh</option>
                                <option>Dadra and Nagar Haveli and Daman and Diu</option>
                                <option>Lakshadweep</option>
                                <option>Delhi</option>
                                <option>Puducherry</option>
                            </select>
                            <small id="check-box-error-1"></small>
                             <span class="error" style="color:red;"><?php echo $stateErr;?></span>
                        </div>
                    </div>
                    <div class="column">
                        <div class="input-box">
                            <label for="city">City</label>
                            <input type="text" placeholder="Enter your city" id="city-name" name="city"  />
                            <small id="city-error"></small>
                            <span class="error" style="color:red;"><?php echo $cityErr;?></span>
                        </div>
                        <div class="input-box">
                            <label for="postal-code">Postal Code</label>
                            <input type="text" placeholder="Enter postal code" id="postal-code" maxlength="6" name="postal-code"   />
                            <small id="postal-error"></small>
                            <span class="error" style="color:red;"><?php echo $postalErr;?></span>
                        </div>
                    </div>
                </div>
                <div id="button">
                    <button id="btn" type="submit" name="submit">Submit</button>
                    <button id="btn-reset" type="reset">Reset</button>
                </div>
                <div id="myPopup" class="popup">
                    <div class="popup-content">
                        <h1 style="color: green">
                            Congratulations !!
                        </h1>
                        <p id="success-msg"></p>
                        <button id="closePopup">
                            Close
                        </button>
                    </div>
                </div>
        </form>
    </div>
   <!--Add script file after validation
   and add required keyword in each field
   -->
   
   
</body>

</html>
