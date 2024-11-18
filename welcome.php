<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter Registration</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS for styling -->
    <style>
        body, html {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.42857;
            height: 100%;
            margin: 0;
        }
        /* Center content vertically and horizontally */
        .welcome-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60%; /* Adjusted height */
            text-align: center;
            background-image: url('images.jpeg'); /* Replace with your image URL */
            background-size: cover;  /* Ensures the image covers the entire container */
            background-position: center;
            color:black;  /* Centers the image */
        }
        
        .welcome-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4); /* Dark overlay with opacity */
            z-index: 1; /* Makes sure the overlay is on top of the image, but below the text */
        }

        .welcome-text {
            font-size: 4rem;
            font-weight: bold;
            color:white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Optional: Add a shadow for better visibility */
        }
        /* Navbar styling */
        .navbar-custom {
            background-color: #343a40; /* Dark background for navbar */
        }
        .navbar-custom .navbar-nav .nav-link {
            color: #fff; /* White text for nav links */
        }
        .navbar-custom .navbar-nav .nav-link:hover {
            color: #ddd; /* Slight hover effect */
        }
        /* Section Cards */
        .info-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            margin: 20px 0;
        }
        .info-card h5 {
            color: #007bff;
            font-weight: bold;
        }
        .info-card p {
            font-size: 1rem;
            color: #555;
        }
        /* Footer styling */
        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: gray;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .cta-button {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            padding: 15px 30px;
            font-size: 1.2rem;
            text-decoration: none;
            margin-top: 20px;
        }
        .cta-button:hover {
            background-color: #0056b3;
        }
        /* Testimonials Section */
        .testimonial {
            background-color: #e9ecef;
            padding: 30px 0;
        }
        .testimonial-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            text-align: center;
        }
        .testimonial-card p {
            font-style: italic;
        }
        .testimonial-card h5 {
            font-weight: bold;
        }
        /* FAQ Section */
        .faq-section {
            background-color: #f1f1f1;
            padding: 40px 0;
        }
        .faq-question {
            font-weight: bold;
            color: #007bff;
        }
        .faq-answer {
            padding-left: 20px;
            color: #555;
        }
    </style>
</head>
<body>

    <!-- Navbar with Home, Show Form, Logout -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Voter Registration</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="welcome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="code files/view.php">Show Form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="session.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Welcome Section with Background Image -->
    <div class="welcome-container">
        <div>
            <div class="welcome-text">
                Welcome to the Voter Registration System
            </div>
            <p style="font-size:15px;">Your one-stop portal for voter registration and election information.</p>
        </div>
    </div>

    <!-- Call-to-Action Button Section -->
    <div class="container text-center my-4">
        <a href="code files/form.php" class="cta-button">Register Now</a>
    </div>

    <!-- Information Cards Section -->
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="info-card">
                    <h5>Eligibility Criteria</h5>
                    <p>To register to vote, you must be at least 18 years old, a citizen, and meet local residency requirements.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="info-card">
                    <h5>Steps to Register</h5>
                    <p>Fill out your personal information, confirm your eligibility, and submit your registration form.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="info-card">
                    <h5>Important Dates</h5>
                    <p>Stay updated on upcoming elections. Find polling dates and locations for your area.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonial">
        <div class="container text-center">
            <h2>What People Are Saying</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p>"Registering to vote was easy and informative. It's empowering to have a say in the future of our country!"</p>
                        <h5>Sarah W.</h5>
                        <small>Community Leader</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p>"As a first-time voter, I was nervous, but this platform made the registration process simple and straightforward."</p>
                        <h5>John P.</h5>
                        <small>First-time Voter</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p>"This system helped me understand the importance of voting and how I can make a difference."</p>
                        <h5>Linda T.</h5>
                        <small>Voter Advocate</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="faq-section">
        <div class="container">
            <h2 class="text-center">Frequently Asked Questions (FAQ)</h2>
            <div class="faq-question">
                <p>1. How can I check if I'm already registered?</p>
                <div class="faq-answer">
                    <p>You can check your registration status by visiting your local elections office or using online verification tools provided by the government.</p>
                </div>
            </div>
            <div class="faq-question">
                <p>2. What if I change my address or name?</p>
                <div class="faq-answer">
                    <p>If you move or change your name, you will need to update your voter registration to reflect these changes.</p>
                </div>
            </div>
            <div class="faq-question">
                <p>3. What documents do I need to register?</p>
                <div class="faq-answer">
                    <p>You typically need proof of citizenship, proof of residency, and an ID card. Check with your local election office for specific requirements.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>&copy; 2024 Voter Registration System | All Rights Reserved</p>
    </div>

    <!-- Bootstrap JS (optional, for components that require JavaScript) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
