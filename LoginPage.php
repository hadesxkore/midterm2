<?php
// Start session
session_start();

// Check if logout query parameter is set
if (isset($_GET["logout"]) && $_GET["logout"] === "true") {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page after logout
    header("Location: LoginPage.php");
    exit;
}

// Check if user is already logged in, redirect to AdminPage if logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: AdminPage.php");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hardcoded credentials
    $valid_username = "admin";
    $valid_password = "password";

    // Get username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate credentials
    if ($username === $valid_username && $password === $valid_password) {
        // Store session data
        $_SESSION["loggedin"] = true;

        // Redirect to AdminPage
        header("Location: AdminPage.php");
        exit;
    } else {
        // Set error message
        $error_message = "Invalid username or password!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #252640; /* Light background */
            font-family: 'Roboto', sans-serif; /* Change font for modern look */
            color: #ffffff; /* White text color */
        }

        .form-container {
            background-color: #252640; /* Transparent background */
            border-radius: 20px;
            border: 3px solid transparent; /* Transparent border */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden; /* Prevents image overflow */
            width: 800px; /* Set width */
            max-width: 90%; /* Limit max width */
            margin: auto; /* Center horizontally */
            margin-top: 250px;
            border-color: #0BC4D9; /* Border color */
            transition: border-color 0.3s ease; /* Transition for border color */
        }

        .form-container:hover {
            border-color: #5ac4d8; /* Glowing border color */
        }

        .form-content {
            padding: 3rem;
            width: 50%; /* Adjust width of content */
        }

        .form-image {
            width: 50%;
            height: 250px;
            border-left: 1px solid #ffffff; /* Add vertical line */
        }

        .glow-on-hover {
            transition: 0.3s;
            box-shadow: 0 0 20px rgba(65, 105, 225, 0.5);
        }

        .glow-on-hover:hover {
            box-shadow: 0 0 40px rgba(65, 105, 225, 0.8);
        }

        .logo2{
            width: 15%;
            height: auto;
            position: absolute;
            top: -220px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
        }

        /* Input field style */
        input[type="text"],
        input[type="password"] {
            border: 1px solid #ccc; /* Border color */
            border-radius: 5px; /* Border radius */
            padding: 10px; /* Padding */
            width: 100%; /* Full width */
            color: #000000; /* Text color */
            background-color: #ffffff; /* Background color */
            text-align: center;
            font-size: large;
            transition: border-color 0.3s ease; /* Transition for border color */
        }

        /* Input field focus style */
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none; /* Remove default outline */
            border-color: #0BC4D9; /* Border color on focus */
        }

        /* Popup Styles */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
        }

        .popup {
    position: fixed;
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    display: flex;
    flex-direction: column; /* Adjust the button alignment */
    align-items: center; /* Center items horizontally */
}

        .close {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
            
        }

        /* Button style */
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Popup Message Text Style */
        .popup p {
            color: #000000;
            margin-bottom: 10px;
            text-align: center;
            justify-content: center;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-container {
                flex-direction: column;
                align-items: center;
            }

            .form-content {
                width: 100%;
            }

            .form-image {
                width: 80%;
                margin-top: 20px;
            }

            .logo2 {
                top: -50px;
            }
        }
    </style>
</head>
<body class="h-screen relative">
    <img src="images/logo2.png" alt="Company Logo" class="logo2">
    <div class="bg-white p-8 rounded-md shadow-md w-full form-container mt-16">
        <div class="form-content">
            <h2 class="text-3xl font-bold mb-4 text-center text-blue-600">Welcome Back!</h2>
            <form id="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-6">
                    <label for="username" class="block text-sm font-medium text-gray-300">Username</label>
                    <input type="text" id="username" name="username" class="border rounded-lg px-4 py-2 w-full focus:outline-none focus:ring focus:border-blue-500">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                    <input type="password" id="password" name="password" class="border rounded-lg px-4 py-2 w-full focus:outline-none focus:ring focus:border-blue-500">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg w-full hover:bg-blue-600 focus:outline-none glow-on-hover">Login</button>
            </form>
        </div>
        <img src="images/Picture3.png" alt="Form Image" class="form-image">
    </div>

    <!-- Overlay and Popup for Error Message -->
    <div class="overlay" id="overlay">
        <div class="popup">
            <span class="close" onclick="closePopup()">&times;</span>
            <p><?php echo isset($error_message) ? $error_message : ''; ?></p>
            <button onclick="redirectToError()">Okay</button>
        </div>
    </div>

    <script>
        // Function to display the overlay and popup
        function displayPopup() {
            document.getElementById('overlay').style.display = 'block';
        }

        // Function to close the popup
        function closePopup() {
            document.getElementById('overlay').style.display = 'none';
        }

        // Function to redirect to LoginError page
        function redirectToError() {
            window.location.href = 'LoginError.php';
        }

        // Check if there is an error message, if yes, display the popup
        <?php if(isset($error_message)): ?>
            displayPopup();
        <?php endif; ?>
    </script>
</body>
</html>
