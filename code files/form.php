<?php
session_start();
include("connection.php");
error_reporting(E_ALL); 
ini_set('display_errors', 1);
if (isset($_SESSION['id'])) {
    $new_id = $_SESSION['id'];
    echo 'session id set successfully'.$new_id.'';
} else {
    echo "Session ID is missing. Please log in again.";
}
$first_nameErr=$last_nameErr=$emailErr=$phoneErr=$birthErr=$genderErr=$gv_idErr=$addressErr=$stateErr=$fileErr=$cityErr=$postalErr="";

$first_name=$last_name=$email=$phone=$birth_date=$gender=$gv_id=$address=$state=$city=$postal="";

$successMessage="";
 // test_input function is used when there is some space, special character and forward or backward slash is available then it remove it and then send to server 
 
include("connection.php");

$signal=true;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	
	// first name validation
	if(empty ($_POST["first-name"]))
	{
		$first_nameErr="first name is required";
        $signal=false;
	}
	else
	{
		$first_name=test_input($_POST["first-name"]);
		// check only charcters and whitespaces are allowed in first name and last name
		  if(!preg_match("/^[a-zA-Z-' ]*$/",$first_name)) 
		   {
     			 $first_nameErr= "Only letters and white space allowed";
                  $signal=false;
    	   }
           
	}
	
	//last name validation
	if(empty ($_POST["last-name"]))
	{
		$last_nameErr="last name is required";
        $signal=false;
	}
	else
	{
		
		$last_name=test_input($_POST["last-name"]);
		if(!preg_match("/^[a-zA-Z-' ]*$/",$last_name)) 
		   {
     			 $last_nameErr= "Only letters and white space allowed";
                  $signal=false;
    		   }
	}
	
	// email validation
	
	  if (empty($_POST["email"])) 
	  {
   		 $emailErr = "Email is required";
            $signal=false;
  	  }
       else if(isset($_POST["submit"]))
        {
            $user_email=$_POST['email'];
            $email_query="select * from VoterRegistration where email='$user_email'";
            $email_result=mysqli_query($link,$email_query);
            if(!$email_result)
            {
                die("connection failed");
            }
            else
            {
                $email_result_rows=mysqli_num_rows($email_result);
                if($email_result_rows> 0)
                {
                    $emailErr= "Email address already exist";
                    header("Location:index.php?update_email_message='The email address is already exist can not Register with same Email'");
                }

            }
        } 
  	  else 
  	  {
    		$email = test_input($_POST["email"]); 
    		// check if e-mail address is well-formed
    		if (filter_var($email, FILTER_VALIDATE_EMAIL)==false) 
    		{
     		 	$emailErr = "Invalid email format";
                  $signal=false;
    		}
  	  }
  	  
  	  // phone number validatio
  	  
  	  if(empty ($_POST["phone-number"]))
  	  {
  	  	$phoneErr="phone number is required";
        $signal=false;
  	  }
  	  else
  	  {
  	  	$phone=test_input($_POST["phone-number"]);
  	  	
  	  	if(!preg_match('/^[0-9]{10}$/',$phone))
  	  	{
  	  		$phoneErr="enter 10 digit phone number";
  	  	}
  	  }
	
	// birth date validation 
	
	$birth_date=$_POST["birth-date"];
	
	
			
			function isDate($string) 
			{
		   		 $inputDate = DateTime::createFromFormat('Y-m-d', $string);
		    		if ($inputDate === false)
		    		 {
		        			return false;
		   		 }
		    
		   		 $currentDate = new DateTime();
		   		 if ($inputDate > $currentDate) 
		   		 {
		       			 return false;
		    		 }
		    
		    		$age = $currentDate->diff($inputDate)->y;
		  		  if ($age < 18) 
		  		  {
		       			 return false;
		   		  }

		    	return true;
		    	
		        }
			

	
	if(!isDate($birth_date))
	{
		$birthErr="age should not less than 18 or birth date not allowed in future";
	}
	
	// gender filed is required
	
	
	  if (empty($_POST["gender"])) 
	  {
	    	$genderErr = "Gender is required";
	  } 
	  else 
	  {
	    	$gender = test_input($_POST["gender"]);
	  }
		
	// checkbox validation
	
	 if(!isset($_POST['gv-card']))
   	 {
        		$gv_idErr="please select at least one id proof";
   	 }
   	 
   	 // file validation 
   	 
   	 if(isset($_FILES['filename']))
   	 {
		$file=$_FILES['filename'];
		$allowed_types=['application/pdf','image/jpeg','image/jpg'];
		
		if($file['error']==0)
		{
			if(!in_array($file['type'],$allowed_types))
			{
				$fileErr="only JPEG/JPG and PDF files are allowed";
			}
		}
		else
		{
			$fileErr="please upload valid file";
		}	 	
   	 }
   	 else
   	 {
   	 	$fileErr="please upload a file";
   	 }
   	 
   	 // address field validation
   	 
   	 if(empty($_POST['address']))
   	 {
   	 	$addressErr="address field is require";
   	 }
   	 
   	 // state field validation
   	
   	$state=$_POST['state'];
   	
	if ($state == 'Select State' || empty($state)) {
   	 $stateErr = "Please select a  state";
	}
		 
   		
   	 //city validatiion
   	 
   	 if(empty ($_POST["city"]))
	{
		$cityErr="city is required";
	}
	else
	{
		
		$city=test_input($_POST["last-name"]);
		if(!preg_match("/^[a-zA-Z-' ]*$/",$city)) 
		   {
     			 $cityErr= "Only letters and white space allowed";
    		   }
	}
	
	
	//postal code validation
	
	if(empty ($_POST["postal-code"]))
  	  {
  	  	$postalErr="postal code is required";
  	  }
  	  else
  	  {
  	  	$postal=test_input($_POST["postal-code"]);
  	  	
  	  	if(!preg_match('/^[0-9]{6}$/',$postal))
  	  	{
  	  		$postalErr="enter 6 digit postal code";
  	  	}
  	  }
  	  
  	 //echo $_POST['address'];
       if (isset($_POST['gv-card']) && !empty($_POST['gv-card'])) {
        $gv_ids = $_POST['gv-card'];  // This is an array of selected values
        $gv_id = implode(", ", $gv_ids);  // Convert array to comma-separated string
    } else {
        $gv_idErr = "Please select at least one ID proof.";
    }

    
    // if (empty($first_nameErr) && empty($last_nameErr) && empty($emailErr) && empty($phoneErr) && empty($birthErr) && empty($genderErr)  && empty($gv_idErr) && empty($addressErr) && empty($stateErr) && empty($fileErr) && empty($cityErr) && empty($postalErr)) 
  	// {   
    //     $address = mysqli_real_escape_string($link, $_POST['address']);
    //     $sql = "INSERT INTO VoterRegistration (first_name, last_name, email, mobile_number, birth_date, gender, gv_proof, address, state, city, postal_code)
    //     VALUES ('$first_name', '$last_name', '$email', '$phone', '$birth_date', '$gender', '$gv_id', '$address', '$state', '$city', '$postal')";
    //     $quey="insert into VoterRegistration (address) values ('Navi mumbai maharashtra')";
    //     $result=mysqli_query($link,$sql);
    //     echo $sql;
    
    //     if($result)
    //     {   
    //             // $email=mysqli_real_escape_string($link,$email);
    //             // $address_query="update VoterRegistration set address='$address' where email='$email'";
    //             // $result=mysqli_query($link,$address_query);
    //             // if($result)
    //             // {
    //                 $successMessage = '<div class="alert alert-success" style="background-color:green;color:white;width:100%;height:50px;padding:14px 20px;">Congratulations for your successful Registration !!!!</div>';
    //             //}
    //     }
    //     else{
    //         $successMessage = '<div class="alert alert-danger" style="background-color:green;color:white;width:100%;height:50px;padding:14px 20px;">fail to submit</div>';
    //     }
    // }

    $allowed_types = ['application/pdf', 'image/jpeg', 'image/jpg'];
    $fileErr = "";

 // Check if file is uploaded
 if (isset($_FILES['filename']) && $_FILES['filename']['error'] == 0) {
    $file = $_FILES['filename'];

   
    if (!in_array($file['type'], $allowed_types)) {
        $fileErr = "Only PDF, JPEG, or JPG files are allowed.";
    } else {
         $email_result_rows=mysqli_num_rows($email_result);
        if (!file_exists($target_file)) {
            $fileErr = "Sorry, the file already exists.";
        } else {
            
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                

                
                $address = mysqli_real_escape_string($link, $_POST['address']);

               
                $sql = "INSERT INTO VoterRegistration (first_name, last_name, email, mobile_number, birth_date, gender, gv_proof, address, state, city, postal_code, file_path)
                        VALUES ('$first_name', '$last_name', '$email', '$phone', '$birth_date', '$gender', '$gv_id', '$address', '$state', '$city', '$postal', '$target_file')";

                if (mysqli_query($link, $sql)) {
                    $successMessage = '<div class="alert alert-success" style="background-color:green;color:white;width:100%;height:50px;padding:14px 20px;">Registration successful with file upload!</div>';
                    header("Location:index.php?update_message=" . urlencode('New Record added successfully'));
                } else {
                    $signal=false;
                    $fileErr = "Failed to submit data to the database: " . mysqli_error($link);
                }
            } else {
                $signal=false;
                $fileErr = "Sorry, there was an error uploading your file.";
            }
        }
    }
} else {
    if ($_FILES['filename']['error'] != 0) {
        $signal=false;
        $fileErr = "No file uploaded or there was an error uploading the file.";
    }
}

   
  	  
}

// if(!$signal) {
//     $_SESSION['error_message'] = "There are errors in the form. Please check again!";
//    // header("Location: index.php");  
//     exit();
// } 



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
                <input type="text" placeholder="Enter email address" id="email" name="email"   />
                <small id="email-error"></small>
                 <span class="error" style="color:red;"><?php echo $emailErr;?></span>
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
