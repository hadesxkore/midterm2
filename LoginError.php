<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Error</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #252640; /* Light background */
            font-family: 'Roboto', sans-serif; /* Change font for modern look */
            color: #ffffff; /* White text color */
        }

        .card-container {
            background-color: #252640; /* Transparent background */
            border-radius: 20px;
            border: 2px solid transparent; /* Transparent border */
            border-color: #0BC4D9; /* Border color */
            display: flex;
            flex-direction: column;
            align-items: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px; /* Set width */
            max-width: 90%; /* Limit max width */
            padding: 2rem;
        }

        .card-content {
            text-align: center;
        }

        .error-message {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .back-button {
            background-color: #0BC4D9;
            color: #ffffff;
            padding: 0.75rem 2rem;
            border-radius: 9999px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #5ac4d8;
        }

        .mark-icon {
            width: 100px;
            height: auto;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="card-container">
        <img src="images/mark.png" alt="Error Icon" class="mark-icon">
        <div class="card-content">
            <p class="error-message">You are not properly Logged In</p>
            <a href="LoginPage.php" class="back-button">Back to Login Page</a>
        </div>
    </div>
</body>
</html>
