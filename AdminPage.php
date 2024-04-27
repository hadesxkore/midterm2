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
    <title>Admin Page</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #252640; /* Light background */
            font-family: 'Roboto', sans-serif; /* Change font for modern look */
            color: #ffffff; /* White text color */
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
   /* Content container */
        .content-container {
            padding: 2rem;
            background-color: #1a202c;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .content-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0BC4D9;
            margin-bottom: 1.5rem;
            text-align: center;
        }
/* Adjust the CSS for the team cards to resemble a glass window */
.team-card {
    background-color: rgba(37, 38, 64, 0.8); /* Semi-transparent background color */
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
    border: 2px solid #0BC4D9;
    transition: transform 0.3s ease;
}

.team-card:hover {
    background-color: rgba(37, 38, 64, ); /* More opaque background color on hover */
    transition: transform 0.3s ease;
    transform: scale(1.05); /* Scale up by 5% on hover */
}
.project-info-card{
    border: 2px solid #0BC4D9;
}


        .team-card h3 {
            font-size: 1.2rem;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .team-card p {
            color: #ffffff;
            line-height: 1.8;
            text-align: justify;
            font-size: 1.2rem;
            
        }

        .project-info-card {
            background-color: #252640;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .project-info-card h3 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 1rem;
        }

        .project-info-card p {
            color: #ffffff;
            line-height: 1.8;
            font-size: 1.3rem;
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
            <a href="#" class="navbar-brand">Admin Panel</a>
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
    <!-- Content container -->
    <div class="content-container">
        <!-- Title of the capstone project -->
        <h2 class="content-title mt-5">Wherehouse: Web-based system for Warehouse Rental Management System with 2D Mapping</h2>
        
        <!-- Team Members -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-16">
        <!-- Team Member Card -->
        <div class="team-card">
            <h3>Allyza Diane J. Perillo</h3>
            <p style="color: #0BC4D9">Team Leader</p>
            <p>Her leadership keeps us focused and organized, guiding us through every project with clarity and purpose. </p>
        </div>
        <!-- Team Member Card -->
        <div class="team-card">
            <h3>Jarielle L. Ramos</h3>
            <p style="color: #0BC4D9">Lead Designer</p>
            <p>He takes the lead in designing our projects, ensuring they look great and function smoothly. Jarielle's designs not only look good but also enhance the usability of our creations.  </p>
        </div>
        <!-- Team Member Card -->
        <div class="team-card">
            <h3>Ahldrex Jefferson M. Reyes</h3>
            <p style="color: #0BC4D9">Lead Tester</p>
            <p>He plays an important role in our team as the one who tests everything to make sure it works correctly. </p>
        </div>
        <!-- Team Member Card -->
        <div class="team-card">
            <h3>Kobie O. Villanueva</h3>
            <p style="color: #0BC4D9">Lead Programmer</p>
           <p> He is responsible for writing the programs that bring our ideas to life. We work well as a team, with each person bringing special talents and ideas to each conversation. Ahldrex's detailed testing helps us deliver products that meet highquality standards. </p>
        </div>
    </div>

    <!-- Capstone Project Information -->
    <div class="project-info-card mt-8">
        <h3>Capstone Project Information</h3>
        <p>Our capstone project is all about Wherehouse: Web-based system for Warehouse Rental Management System with 2D Mapping is a portal with the aim of connecting lessor and lessee in Balanga, Bataan. The goal is to help the difficulties that traditional lessee deal with, while also making the warehouse searching process more convenient, efficient, and personalized. And to save the time of lessee by reducing the need for searching in person when looking for a warehouse. And also, to help lessor improve their rental processes, increase efficiency, improve lessee satisfaction, and reduce risks related to manual processes.</p>
    </div>
</div>
</body>
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

