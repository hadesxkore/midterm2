<?php
// Start session
session_start();

// Check if logout query parameter is set
if (isset($_GET["logout"]) && $_GET["logout"] === "true") {
    // Destroy the session
    session_destroy();

    // Redirect to login page after logout
    header("Location: LoginPage.php");
    exit;
}

// Check if user is not logged in, redirect to LoginError if not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: LoginError.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Capabilities</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #252640; /* Light background */
            font-family: 'Roboto', sans-serif; /* Change font for modern look */
            color: #ffffff; /* White text color */
        }
        .team-card {
    background-color: #252640; /* Updated card background color */
    color: #FFFFFF; /* Updated text color */
    border-radius: 10px;
    padding: 20px;
    border: 2px solid #0BC4D9;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    width: 100%; /* Adjusted width */
    margin: 0 auto; /* Center align the cards */
   
}

.team-card:hover {
    transform: translateY(-5px);
}

/* Light mode styles */
        .light-mode {
            background-color: #ffffff;
            color: #252640;
        }

        .light-mode .navbar {
            background-color: #ffffff;
        }

        .light-mode .navbar-brand {
            color: #252640;
        }

        .light-mode .navbar-links a {
            color: #252640;
        }

        /* Dark mode styles */
        .dark-mode {
            background-color: #252640;
        }

        .dark-mode .navbar {
            background-color: #1a202c;
        }

        .dark-mode .navbar-brand {
            color: #ffffff;
        }

        .dark-mode .navbar-links a {
            color: #ffffff;
        }
        .light-mode .team-card {
    background-color: #ffffff;
    color: #252640;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.light-mode .team-card h3,
.light-mode .team-card p {
    color: #252640;
}

.light-mode .project-info-card {
        background-color: #ffffff; /* White background color */
        color: #252640; /* Dark text color */

        box-shadow: 2px 5px 3px 2px rgba(0, 0, 0, 0.1);
    }
    .light-mode .content-container {
    background-color: #ffffff; /* Light background color */
    color: #252640; /* Dark text color */
}


.light-mode .project-info-card h3,
.light-mode .project-info-card p {
    color: #252640;
}
.light-mode .team-card:hover {
        background-color: #f3f4f6; /* Lighter background color on hover */
       
    }
.light-mode .team-card {
        background-color: #ffffff; /* White background color */
        color: #252640; /* Dark text color */

        box-shadow: 4px 5px 3px 2px rgba(0, 0, 0, 0.1);
    }

        .navbar {
            background-color: #1a202c;
            padding: 2rem 0;
            border-bottom: 2px solid #0BC4D9;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff;
            text-decoration: none;
        }

        .navbar-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .navbar-section {
            padding: 0 2rem;
        }
/* Style for the mode icons */
.mode-icon {
    width: 44px;
    height: 44px;
    margin-right: 80px;
    margin-top: 20px;
    transition: transform 0.3s ease;
}



        .navbar-links a {
            color: #ffffff;
            text-decoration: none;
            font-size: 1.2rem;
            margin-left: 2rem;
            position: relative;
            transition: color 0.3s ease;
        }

        .navbar-links a:hover {
            color: #0BC4D9;
        }

        .navbar-links a::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #0BC4D9;
            visibility: hidden;
            transform: scaleX(0);
            transition: all 0.3s ease-in-out;
        }

        .navbar-links a:hover::before {
            visibility: visible;
            transform: scaleX(1);
        }

   /* Adjust the CSS for the logout button */
.navbar-section .logout-button {
    background-color: transparent;
    border: 2px solid #0BC4D9;
    color: #0BC4D9;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1.2rem;
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}

.navbar-section .logout-button:hover {
    background-color: #0BC4D9;
    color: #ffffff;
    border-color: #0BC4D9;
}

        /* Mobile Menu Styles */
        @media (max-width: 767px) {
            .navbar-links {
                display: none; /* Hide desktop nav links */
            }

            .navbar-brand {
                margin-left: 1rem;
            }

            .mobile-menu-button {
                display: block; /* Show mobile menu button */
            }

            .mobile-dropdown {
                display: none; /* Hide mobile dropdown menu */
            }

            .mobile-dropdown.open {
                display: block; /* Show mobile dropdown menu when open */
            }

            .dropdown-item {
                padding: 0.5rem 2rem;
                display: block;
                color: #ffffff;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }

            .dropdown-item:hover {
                background-color: #0BC4D9;
            }

            .close-icon {
                position: absolute;
                top: 0.5rem;
                right: 0.5rem;
                cursor: pointer;
            }
        }
        .team-card img {
    width: 100%; /* Set the image width to 100% of its container */
    height: auto; /* Automatically calculate the image height based on the aspect ratio */
    max-width: 400px; /* Optional: Set a maximum width for the image */
    max-height: 400px; /* Optional: Set a maximum height for the image */
}
        /* Responsive light and dark mode icons */
        .mode-icon {
    width: 44px;
    height: 44px;
    margin-right: 30px;
    margin-top: 15px;
    transition: transform 0.3s ease;
}

/* Large mode icon for larger screens */
.lg\:mode-icon-lg {
    width: 56px;
    height: 56px;
    margin-right: 30px;
    margin-top: 50px;
}

    </style>
</head>
<body class="dark-mode">
    <button id="mode-toggle" class="absolute top-4 right-4 focus:outline-none">
        <img src="images/dark.png" alt="Light Mode" class="mode-icon light-mode-icon" id="mode-icon">
    </button>


<!-- Navigation bar -->
<nav class="navbar">
    <div class="container mx-auto flex justify-between items-center">
        <div class="navbar-section">
            <a href="#" class="navbar-brand">System Capabilities</a>
        </div>
        <!-- Mobile Menu Button -->
        <button class="block lg:hidden focus:outline-none mobile-menu-button" id="mobile-menu-button">
            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <!-- Dropdown Menu -->
        <div class="hidden lg:flex lg:items-center space-x-4 navbar-links">
            <div class="navbar-section">
                <a href="AdminPage.php">Admin Page</a>
                <a href="Capstone.php">Capstone Description</a>
                <a href="Members.php">Members</a>
                <a href="Capabs.php">System Capabilities</a>
            </div>
            <div class="navbar-section">
                <a href="AdminPage.php?logout=true" class="logout-button">Logout</a>
            </div>
        </div>
    </div>
    <!-- Dropdown Menu for Mobile -->
    <div class="lg:hidden absolute top-0 left-0 w-full bg-gray-800 mobile-dropdown" id="mobile-dropdown" style="display: none;">
        <div class="container mx-auto py-4">
            <a href="AdminPage.php" class="dropdown-item">Admin Page</a>
            <a href="Capstone.php" class="dropdown-item">Capstone Description</a>
            <a href="Members.php" class="dropdown-item">Members</a>
            <a href="Capabs.php" class="dropdown-item">System Capabilities</a>
            <a href="AdminPage.php?logout=true" class="dropdown-item">Logout</a>
            <svg class="w-6 h-6 text-white close-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="close-icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
    </div>
</nav>
<div class="container mx-auto px-4 mt-8">
    <!-- Main card -->
    <div class="team-card bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold mb-4">System Capabilities</h2>
        <p class="text-base text-white-700">
            The main objective of the study is to develop and implement Wherehouse: Web-based system for Warehouse Rental Management System with 2D mapping that is capable of providing a comprehensive platform for lessor and lessee, facilitating streamlined transactions, boosting business performance, fostering a positive user experience, and promoting growth and innovation within the business industry.
        </p>
    </div>

    <!-- List of capabilities -->
    <div class="grid grid-cols-1 md:grid-cols- lg:grid-cols-4 gap-4 mt-8"> 
        <!-- Card for each capability -->
        <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/register.jpg" alt="Registration" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4" style="color: #0BC4D9">Account Registration</h2>
            <p class="text-base text-white-700">
                Allowing the lessor and lessee to register an account on the Wherehouse platform through the user’s account registration module.
            </p>
        </div>

        <!-- Example card -->
        <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/payment.jpg" alt="Billing" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4" style="color: #0BC4D9">Automating Billing Process</h2>
            <p class="text-base text-white-700">
                Automating billing process for timely and accurate invoice for rental payment through billing module.
            </p>
        </div>

          <!-- Example card -->
          <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/rep.jpg" alt="Billing" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4"style="color: #0BC4D9">Problem Report</h2>
            <p class="text-base text-white-700">
            Allowing the lessee to report or communicate about any problem or maintenance in warehouse through report problem module;
            </p>
        </div>
          <!-- Example card -->
          <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/generate.jpg" alt="Billing" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4"style="color: #0BC4D9">Generate Report</h2>
            <p class="text-base text-white-700">
            Allowing lessor to generate report like status of the problem and maintenance in warehouse through report generation module;
            </p>
        </div>

          <!-- Example card -->
          <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/status.jpg" alt="Billing" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4"style="color: #0BC4D9">Automating Monitor Status</h2>
            <p class="text-base text-white-700">
            Allowing lessor to monitor the status of the problem or maintenance in warehouse through status monitoring module;
            </p>
        </div>
          <!-- Example card -->
          <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/contract.jpg" alt="Billing" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4"style="color: #0BC4D9">Automating Lease Agreement </h2>
            <p class="text-base text-white-700">
            Creating a lease agreement that clearly outline terms and conditions for both lessor and lessee through lease agreement module;
            </p>
        </div>
          <!-- Example card -->
          <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/updates.jpg" alt="Billing" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4"style="color: #0BC4D9">Important Updates </h2>
            <p class="text-base text-white-700">
            Allowing lessor to communicate important updates to lessee through notifications module;
            </p>
        </div>
          <!-- Example card -->
          <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/chats.jpg" alt="Billing" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4"style="color: #0BC4D9">Automating Direct Message </h2>
            <p class="text-base text-white-700">
            Allowing lessee send direct message or inquires to lessor through direct message module.
            </p>
        </div>
    </div>
</div>
<!-- New section -->
<div class="container mx-auto px-4 mt-8">
    <h2 class="text-2xl font-semibold mb-4">System Requirements</h2>

    <!-- List of requirements -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"> <!-- Adjust grid layout as needed -->
        <!-- Card for each requirement -->
        <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/vsc.png" alt="Visual Studio" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4" style="color: #0BC4D9">Visual Studio Code</h2>
            <p class="text-base text-white-700">
                Create a system using Visual Studio Code.
            </p>
        </div>

        <!-- Add similar cards for other requirements here -->
        <!-- Example card -->
        <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/firebase.png" alt="Firebase" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4" style="color: #0BC4D9">Firebase</h2>
            <p class="text-base text-white-700">
                Use Firebase for backend services.
            </p>
        </div>

        <!-- Example card -->
        <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/browser.png" alt="Web Browser" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4" style="color: #0BC4D9">Web Browser</h2>
            <p class="text-base text-white-700">
                Ensure compatibility with popular web browsers.
            </p>
        </div>

        <!-- Example card -->
        <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/css.png" alt="CSS" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4" style="color: #0BC4D9">CSS</h2>
            <p class="text-base text-white-700">
                Use CSS for styling the user interface.
            </p>
        </div>

        <!-- Example card -->
        <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src=images/javascript.png alt="JavaScript" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4" style="color: #0BC4D9">JavaScript</h2>
            <p class="text-base text-white-700">
                Implement dynamic functionality using JavaScript.
            </p>
        </div>

        <!-- Example card -->
        <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/figma.png" alt="Figma" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4" style="color: #0BC4D9">Figma</h2>
            <p class="text-base text-white-700">
                Design user interfaces using Figma.
            </p>
        </div>

        <!-- Example card -->
        <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/windows.png" alt="Windows OS" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4" style="color: #0BC4D9">Windows Operating System</h2>
            <p class="text-base text-white-700">
                Ensure compatibility with Windows OS.
            </p>
        </div>

        <!-- Example card -->
        <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/tailwind.png" alt="Tailwind CSS" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4" style="color: #0BC4D9">Tailwind CSS</h2>
            <p class="text-base text-white-700">
                Use Tailwind CSS for rapid UI development.
            </p>
        </div>

        <!-- Example card -->
        <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/system.png" alt="Computer System" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Computer System</h2>
            <p class="text-base text-white-700">
                Ensure the system runs smoothly on computer systems.
            </p>
        </div>

        <!-- Example card -->
        <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/phone.png" alt="Mobile Phone" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4" style="color: #0BC4D9">Mobile Phone</h2>
            <p class="text-base text-white-700">
                Ensure compatibility with mobile devices.
            </p>
        </div>

        <!-- Example card -->
        <div class="team-card bg-white rounded-lg shadow-lg p-6">
            <img src="images/router.png" alt="Router" class="w-full mb-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4" style="color: #0BC4D9">Router</h2>
            <p class="text-base text-white-700">
                Ensure network connectivity via routers.
            </p>
        </div>
    </div>
</div>


<script>
    // Function to toggle mobile dropdown
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        var mobileDropdown = document.getElementById('mobile-dropdown');
        if (mobileDropdown.style.display === 'none' || mobileDropdown.style.display === '') {
            mobileDropdown.style.display = 'block';
        } else {
            mobileDropdown.style.display = 'none';
        }
    });

    // Function to close mobile dropdown when clicking close icon
    document.getElementById('close-icon').addEventListener('click', function() {
        var mobileDropdown = document.getElementById('mobile-dropdown');
        mobileDropdown.style.display = 'none';
    });

    // Function to toggle between light and dark modes
    document.getElementById('mode-toggle').addEventListener('click', function() {
            const body = document.body;
            const modeIcon = document.getElementById('mode-icon');
            
            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                body.classList.add('light-mode');
                modeIcon.src = "images/light.png";
                // Additional styling changes for light mode
            } else {
                body.classList.remove('light-mode');
                body.classList.add('dark-mode');
                modeIcon.src = "images/dark.png";
                // Additional styling changes for dark mode
            }
        });
</script>
</html>
