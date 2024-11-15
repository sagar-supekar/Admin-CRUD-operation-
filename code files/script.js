let btn = document.getElementById("btn");

btn.addEventListener('click', (e) => {
    e.preventDefault();

    let isValid = true;
    document.getElementById("first-name-error").innerHTML = "";
    document.getElementById("last-name-error").innerHTML = "";
    document.getElementById("email-error").innerHTML = "";
    document.getElementById("phone-error").innerHTML = "";
    document.getElementById("address-error").innerHTML = "";
    document.getElementById("city-error").innerHTML = "";
    document.getElementById("postal-error").innerHTML = "";
    document.getElementById("error-message").innerHTML = "";
    document.getElementById("check-box-error").innerHTML = "";
    document.getElementById("check-box-error-1").innerHTML = "";


    // First name and last name validation 
    let namePattern = /^[a-zA-Z]+$/;
    let first_name = document.getElementById("first-name") ? document.getElementById("first-name").value : null;
    let last_name = document.getElementById("last-name") ? document.getElementById("last-name").value : null;
    let first_name_error = document.getElementById("first-name-error");
    let last_name_error = document.getElementById("last-name-error");

    if (!namePattern.test(first_name)) {
        first_name_error.style.color = "red";
        isValid = false;
        first_name_error.innerHTML = "Please enter a valid first name.";
    }
    if (!namePattern.test(last_name)) {
        last_name_error.style.color = "red";
        isValid = false;
        last_name_error.innerHTML = "Please enter a valid last name.";
    }

    // Email validation
    let email = document.getElementById("email");
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    let email_value = email ? email.value : null;
    let email_error = document.getElementById("email-error");
    email_error.innerHTML = "";

    if (!emailPattern.test(email_value)) {
        email_error.style.color = "red";
        isValid = false;
        email_error.innerHTML = "Please enter a valid email.";
    }

    // Phone number validation
    var phoneNum = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    let phone_number = document.getElementById("phone-number");
    let phone_number_value = phone_number ? phone_number.value : null;
    let phone_error = document.getElementById("phone-error");
    phone_error.innerHTML = "";

    if (!phoneNum.test(phone_number_value)) {
        phone_error.style.color = "red";
        isValid = false;
        phone_error.innerHTML = "Please enter a valid Mobile number.";
    } else if (phone_number_value.length !== 10) {
        phone_error.innerHTML = "Length Mobile of Number should be exactly 10.";
    }

    // Address field validation
    // let address1 = document.getElementById("address") ? document.getElementById("address").value : null;
    // let address_error = document.getElementById("address-error");
    // address_error.innerHTML = "";

    // if (!address1 ||  address1.trim() === "") {
    //     address_error.style.color = "red";
    //     address_error.innerHTML = "Address is required.";
    // }

    let address = document.getElementById("area").value;
    let address_error = document.getElementById("address-error");
    address_error.innerHTML = "";

    if (address.trim() === "") {
        isValid = false;
        address_error.style.color = "red";
        address_error.innerHTML = "Address is required.";
    }

    // birth date validation
    let birthDate = document.getElementById("birth-date").value;
    let birthError = document.getElementById("birth-error");
    birthError.innerHTML = "";

    if (!birthDate) {
        isValid = false;
        birthError.style.color = "red"
        birthError.innerHTML = "Birth date is required.";
    } else {
        const selectedDate = new Date(birthDate);
        const today = new Date();

        console.log("selected date object")
        console.log(selectedDate);
        console.log(today);
        // Check if the selected date is in the future
        if (selectedDate > today) {
            isValid = false;
            birthError.style.color = "red"
            birthError.innerHTML = "Birth date cannot be in the future.";
        } else {
            // Check if the user is at least 18 years old
            const age = today.getFullYear() - selectedDate.getFullYear();
            const monthDifference = today.getMonth() - selectedDate.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < selectedDate.getDate())) {
                age--;
            }
            if (age < 18) {
                isValid = false;
                birthError.style.color = "red"
                birthError.innerHTML = "You must be at least 18 years old.";
            }
        }
    }



    // City validation
    let cityPattern = /^[a-zA-Z]+$/;
    let city_name = document.getElementById("city-name") ? document.getElementById("city-name").value : null;
    let city_name_error = document.getElementById("city-error");
    city_name_error.innerHTML = "";

    if (!cityPattern.test(city_name)) {
        city_name_error.style.color = "red";
        isValid = false;
        city_name_error.innerHTML = "Please enter a valid City name.";
    }

    // postal code validation
    let postal_code = document.getElementById("postal-code") ? document.getElementById("postal-code").value : null;
    let postal_error = document.getElementById("postal-error");
    if (postal_code === null || postal_code.length !== 6) {
        postal_error.style.color = "red";
        isValid = false;
        postal_error.innerHTML = "please enter 6 digit length of Postal Code";
    }


    //radio button validation
    let maleChecked = document.getElementById('male').checked;
    let femaleChecked = document.getElementById('female').checked;
    let errorMessage = document.getElementById('error-message');

    if (!maleChecked && !femaleChecked) {
        errorMessage.style.color = 'red';
        isValid = false;
        errorMessage.innerHTML = " please select a gender";
    }

    // checkbox validation

    const adharChecked = document.getElementById("adhar-card").checked;
    const panChecked = document.getElementById("pan-card").checked;

    let checkboxError = document.getElementById("check-box-error");
    checkboxError.innerHTML = "";

    if (!adharChecked && !panChecked) {
        checkboxError.style.color = "red";
        checkboxError.innerHTML = "Please select at least one ID proof.";
        isValid = false;
    }

    // State validation
    const stateSelect = document.getElementById("check-box");
    let stateError = document.getElementById("check-box-error-1");
    stateError.innerHTML = "";

    if (stateSelect.value === "Select State") {
        stateError.style.color = "red";
        isValid = false;
        stateError.innerHTML = "Please select a state.";

    }

   
       
            //let first_name = document.getElementById("first-name") ? document.getElementById("first-name").value : null;
            //let last_name = document.getElementById("last-name") ? document.getElementById("last-name").value : null;
            document.getElementById("success-msg").innerHTML = `${first_name} ${last_name} Register successfully`
            if (isValid) {
                myPopup.classList.add("show");
            }
    
    closePopup.addEventListener(
        "click",
        function () {
            myPopup.classList.remove(
                "show"
            );
        }
    );
    window.addEventListener(
        "click",
        function (event) {
            if (event.target == myPopup) {
                myPopup.classList.remove(
                    "show"
                );
            }
        }


    );

    let fileInput = document.getElementById('file')?document.getElementById('file').value:null;
    let fileError = document.getElementById("file-error")
    if(!fileInput)
    {
            fileError.style.color = "red";
            fileError.innerHTML = "Add Goverenment ID proof (adhar card / pan card)";
    }


    let fileValidationButton = document.getElementById("upload");

    fileValidationButton.addEventListener("click", (e) => {
        let fileError = document.getElementById("file-error");
        let fileInput = document.getElementById('file');
        let filePath = fileInput.value;

        
        var allowedExtensions = /(\.pdf|\.jpg|\.jpeg)$/i;

        fileError.innerHTML = "";

        
        if (!allowedExtensions.exec(filePath)) {
            fileError.style.color = "red";
            fileError.innerHTML = "Add only .pdf or .jpeg format";
            fileInput.value = '';
            e.preventDefault(); 
            return false;
        }
    });

        // reset button code
        ldocument.getElementById("btn-reset").reset();

 

});


