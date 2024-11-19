<?php  include("header.php"); ?>
<?php include("connection.php"); ?>
<?php
session_start();
if (isset($_GET["id"])) {
    $id = $_GET['id'];

    $_SESSION['id']= $id;
    $query = "select * from VoterRegistrationTable where `id`='$id'";

    $result = mysqli_query($link, $query);

    if (!$result) {

        die("connection failed");
    } else {
        $row = mysqli_fetch_assoc($result);
        //print_r($row);
        $_SESSION['email']= $row['email'];
        
    }
}

?>

<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1);


if (isset($_POST['submit'])) {
    $new_id= $_SESSION['id'];

    $first_name = $_POST['first-name'];
    $last_name =  $_POST['last-name'];
    $email = $_POST['email'];
    $phone_number =  $_POST['phone-number'];
    $birth_date =  $_POST['birth-date'];
    $gender =  $_POST['gender'];
    $address =  $_POST['address'];
    $state = $_POST['state'];
    $city =  $_POST['city'];
    $postal_code =  $_POST['postal-code'];

    // Check if gv-card (ID proofs) are selected
    $gv_card = isset($_POST['gv-card']) ? implode(', ', $_POST['gv-card']) : ''; 

    // Check if a file was uploaded
    $file_path = '';
    if (isset($_FILES['filename']) && $_FILES['filename']['error'] == 0) {
        $target_dir = "uploads/";
        $file_path = $target_dir . basename($_FILES['filename']['name']);
        move_uploaded_file($_FILES['filename']['tmp_name'], $file_path);
    }

    // Update query
    $query = "UPDATE VoterRegistrationTable  SET 
                first_name='$first_name', 
                last_name='$last_name', 
                email='$email', 
                mobile_number='$phone_number', 
                birth_date='$birth_date', 
                gender='$gender', 
                address='$address', 
                state='$state', 
                city='$city', 
                postal_code='$postal_code', 
                gv_proof='$gv_card', 
                file_path='$file_path' 
              WHERE id ='$new_id'";

    // Execute the query
    $result = mysqli_query($link, $query);;
    if (!$result) {
        die("Update failed: ");
    } else {
        header("Location:admin_home.php?success_message=" . urlencode('Record Update successfully'));
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
        <form class="form" method="POST" action="update.php" enctype="multipart/form-data">
        <div class="d-flex justify-content-start">
            <a href="admin_home.php" class="btn-close" aria-label="Close" style="font-size: 24px;text-decoration:none;"></a>
        </div>
            <h1>Voter Registration Form</h1>
            <div class="input-box">
                <label>First Name</label>
                <input type="text" placeholder="Enter first name" id="first-name" name="first-name" value="<?php echo $row['first_name'] ?>" />

            </div>

            <div class="input-box">
                <label>Last Name</label>
                <input type="text" placeholder="Enter last name" id="last-name" name="last-name" value="<?php echo $row['last_name'] ?>" />
                <small id="last-name-error"></small>
                
            </div>


            <div class="input-box">
                <label>Email Address</label>
                <input type="text" placeholder="Enter email address" id="email" name="email" value="<?php echo $row['email'] ?>" />
                <small id="email-error"></small>
               
            </div>


            <div class="column">
                <div class="input-box">
                    <label>Phone Number</label>
                    <input type="text" placeholder="Enter phone number" id="phone-number" maxlength="10" name="phone-number" value="<?php echo $row['mobile_number'] ?>" />
                    <small id="phone-error"></small>
                   
                </div>
                <div class="input-box">
                    <label>Birth Date</label>
                    <input type="date" id="birth-date" name="birth-date" value="<?php echo $row['birth_date'] ?>" />
                    <small id="birth-error"></small>
                    
                </div>
            </div>

            <div class="gender">
                <label for="gender">Gender</label>
                <input type="radio" name="gender" id="male" value="male" <?php if ($row['gender'] == 'male') echo 'checked'; ?>> Male
                <input type="radio" name="gender" id="female" value="female" <?php if ($row['gender'] == 'female') echo 'checked'; ?>> Female

                <small id="error-message"></small>
                
            </div>
            <div class="ID-proof column">
                <div class="input-box">
                    <h5>Select Government ID proof:</h5>
                    <div class="checkbox-container">
                        <input type="checkbox" id="adhar-card" name="gv-card[]" value="Adhar Card"
                            <?php if (in_array('Adhar Card', explode(", ", $row['gv_proof']))) echo 'checked'; ?>>
                        <label for="adhar-card" class="gv-proof"> Adhar Card</label>

                        <input type="checkbox" id="pan-card" name="gv-card[]" value="Pan Card"
                            <?php if (in_array('Pan Card', explode(", ", $row['gv_proof']))) echo 'checked'; ?>>
                        <label for="pan-card" class="gv-proof"> Pan Card</label>
                    </div>
                    <small id="check-box-error"></small>
                   
                </div>
                <div class="input-box">
                    <h5>Click on the "Choose File" button to upload a file (.pdf or .jpeg):</h5>
                    <input type="file" id="file" name="filename">
                    <?php if ($row['file_path']) { ?>
                        <p style="color:green">Current File: <?php echo basename($row['file_path']); ?></p>
                    <?php } ?>
                    <input type="submit" value="Upload" id="upload" name="upload">
                    <small id="file-error"></small>
                    
                </div>
            </div>


            <div class="address">
                <p><label for="area">Address:</label></p>
                <textarea id="area" name="address" rows="4" cols="50" id="address"><?php echo $row['address'] ?></textarea>
                <small id="address-error"></small>
                
                <div>

                    <div class="column">
                        <div class="select-box">
                            <label for="check-box" id="state">Select State</label>
                            <select id="check-box" name="state" required>
                                <option hidden>Select State</option>
                                <option <?php if ($row['state'] == 'Andhra Pradesh') echo 'selected'; ?>>Andhra Pradesh</option>
                                <option <?php if ($row['state'] == 'Arunachal Pradesh') echo 'selected'; ?>>Arunachal Pradesh</option>
                                <option <?php if ($row['state'] == 'Assam') echo 'selected'; ?>>Assam</option>
                                <option <?php if ($row['state'] == 'Bihar') echo 'selected'; ?>>Bihar</option>
                                <option <?php if ($row['state'] == 'Chhattisgarh') echo 'selected'; ?>>Chhattisgarh</option>
                                <option <?php if ($row['state'] == 'Goa') echo 'selected'; ?>>Goa</option>
                                <option <?php if ($row['state'] == 'Gujarat') echo 'selected'; ?>>Gujarat</option>
                                <option <?php if ($row['state'] == 'Haryana') echo 'selected'; ?>>Haryana</option>
                                <option <?php if ($row['state'] == 'Himachal Pradesh') echo 'selected'; ?>>Himachal Pradesh</option>
                                <option <?php if ($row['state'] == 'Jharkhand') echo 'selected'; ?>>Jharkhand</option>
                                <option <?php if ($row['state'] == 'Karnataka') echo 'selected'; ?>>Karnataka</option>
                                <option <?php if ($row['state'] == 'Kerala') echo 'selected'; ?>>Kerala</option>
                                <option <?php if ($row['state'] == 'Madhya Pradesh') echo 'selected'; ?>>Madhya Pradesh</option>
                                <option <?php if ($row['state'] == 'Maharashtra') echo 'selected'; ?>>Maharashtra</option>
                                <option <?php if ($row['state'] == 'Manipur') echo 'selected'; ?>>Manipur</option>
                                <option <?php if ($row['state'] == 'Meghalaya') echo 'selected'; ?>>Meghalaya</option>
                                <option <?php if ($row['state'] == 'Mizoram') echo 'selected'; ?>>Mizoram</option>
                                <option <?php if ($row['state'] == 'Nagaland') echo 'selected'; ?>>Nagaland</option>
                                <option <?php if ($row['state'] == 'Odisha') echo 'selected'; ?>>Odisha</option>
                                <option <?php if ($row['state'] == 'Punjab') echo 'selected'; ?>>Punjab</option>
                                <option <?php if ($row['state'] == 'Rajasthan') echo 'selected'; ?>>Rajasthan</option>
                                <option <?php if ($row['state'] == 'Sikkim') echo 'selected'; ?>>Sikkim</option>
                                <option <?php if ($row['state'] == 'Tamil Nadu') echo 'selected'; ?>>Tamil Nadu</option>
                                <option <?php if ($row['state'] == 'Telangana') echo 'selected'; ?>>Telangana</option>
                                <option <?php if ($row['state'] == 'Tripura') echo 'selected'; ?>>Tripura</option>
                                <option <?php if ($row['state'] == 'Uttar Pradesh') echo 'selected'; ?>>Uttar Pradesh</option>
                                <option <?php if ($row['state'] == 'Uttarakhand') echo 'selected'; ?>>Uttarakhand</option>
                                <option <?php if ($row['state'] == 'West Bengal') echo 'selected'; ?>>West Bengal</option>
                                <option <?php if ($row['state'] == 'Andaman and Nicobar Islands') echo 'selected'; ?>>Andaman and Nicobar Islands</option>
                                <option <?php if ($row['state'] == 'Chandigarh') echo 'selected'; ?>>Chandigarh</option>
                                <option <?php if ($row['state'] == 'Dadra and Nagar Haveli and Daman and Diu') echo 'selected'; ?>>Dadra and Nagar Haveli and Daman and Diu</option>
                                <option <?php if ($row['state'] == 'Lakshadweep') echo 'selected'; ?>>Lakshadweep</option>
                                <option <?php if ($row['state'] == 'Delhi') echo 'selected'; ?>>Delhi</option>
                                <option <?php if ($row['state'] == 'Puducherry') echo 'selected'; ?>>Puducherry</option>
                            </select>

                            <small id="check-box-error-1"></small>
                           
                        </div>
                    </div>
                    <div class="column">
                        <div class="input-box">
                            <label for="city">City</label>
                            <input type="text" placeholder="Enter your city" id="city-name" name="city" value="<?php echo $row['city'] ?>" />
                            <small id="city-error"></small>
                            
                        </div>
                        <div class="input-box">
                            <label for="postal-code">Postal Code</label>
                            <input type="text" placeholder="Enter postal code" id="postal-code" maxlength="6" name="postal-code" value="<?php echo $row['postal_code'] ?>" />
                            <small id="postal-error"></small>
                            
                        </div>
                    </div>
                </div>
                <div id="button">
                    <button id="btn" type="submit" name="submit" value="Add">Submit</button>
                    <button id="btn-reset" type="reset">Reset</button>
                </div>
        </form>
    </div>
    <!--Add script file after validation
   and add required keyword in each field
   -->


</body>

</html>


<?php include("footer.php"); ?>