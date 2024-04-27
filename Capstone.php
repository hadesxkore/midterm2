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
    <title>Capstone Description</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/framer-motion/4.1.17/framer-motion.umd.js"></script>
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #ffffff; /* Light background */
            font-family: 'Roboto', sans-serif; /* Change font for modern look */
            color: #252640; /* Dark text color */
        }
        
        body.light-mode {
            background-color: #1a202c;
            color: #ffffff;
        }

        /* Additional CSS for light mode navigation bar */
        .navbar.dark-mode-navbar {
            background-color: #ffffff;
            color: #252640;
            border-bottom-color: #0BC4D9;
        }
        /* Text color for links in light mode */
        .navbar.dark-mode-navbar .navbar-links a  {
            color: #252640;
        }
        .navbar.dark-mode-navbar .navbar-brand,
        .navbar.dark-mode-navbar .light-mode-navbar-brand {
            color: #252640;
        }
        

        body.dark-mode {
            background-color: #252640;
            color: #ffffff;
        }

        /* Style for the mode icons */
        .mode-icon {
    width: 44px;
    height: 44px;
    margin-right: 60px;
    margin-top: -28px;
    transition: transform 0.3s ease;
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

        /* Adjust the CSS for the mode toggle button */
        #mode-toggle {
            position: absolute;
            top: 4rem;
            right: 2rem;
            z-index: 10;
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

        /* Additional CSS for card styling */
        .card {
            background-color: #ffffff;
            border-radius: 10px;
            border: 2px solid #0BC4D9;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .card img {
            height: 200px; /* Adjust the height of the image as needed */
        }

        .card h2 {
            color: #252640; /* Adjust text color */
        }
        
        .carousel-container {
            width: 70%; /* Reduced width */
            margin: 2rem auto; /* Center the carousel */
            overflow: hidden;
            position: relative;
         
        }
        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-item {
            min-width: 100%;
            flex: 0 0 auto;
            max-width: 300px; /* Adjust the maximum width as needed */
            margin-right: 1rem; /* Add some margin between images */
            border-radius: 10px; /* Rounded corners */
            overflow: hidden; /* Ensure images don't overflow */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
            
        }

        .carousel-img {
            width: 100%;
            height: auto;
            
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #0BC4D9;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1; /* Ensure buttons are above images */
        }


        .carousel-btn:hover {
            background: #252640;
        }

        .carousel-prev {
            left: 1rem; /* Adjust position */
        }

        .carousel-next {
            right: 1rem; /* Adjust position */
        }

      
.light-mode .team-card {
        background-color:#252640; /* White background color */
        color: #ffffff; /* Dark text color */
        box-shadow: 4px 5px 3px 2px rgba(0, 0, 0, 0.1);
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
    margin-top: -30px;
    transition: transform 0.3s ease;
}

/* Large mode icon for larger screens */
.lg\:mode-icon-lg {
    width: 56px;
    height: 56px;
    margin-right: 30px;
    margin-top: 50px;
}
     /* Modal styles */
     .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            overflow: auto;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            border-radius: 10px;
            text-align: center;
        }

        .modal-content p {
            margin-bottom: 20px;
            color: black;
        }

        .modal-content button {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .modal-content button:hover {
            background-color:#FF7377;
        }


    </style>
</head>
<body class="light-mode">
    <!-- Mode toggle button -->
    <button id="mode-toggle" class="focus:outline-none">
        <img src="images/dark.png" alt="Dark Mode" class="mode-icon light-mode-icon" id="mode-icon">
    </button>

    <nav class="navbar">
    <div class="container mx-auto flex justify-between items-center">
        <div class="navbar-section">
            <a href="#" class="navbar-brand">Capstone Description</a>
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
                    <a href="#" class="logout-button" onclick="openModal()">Logout</a>
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
                <a href="#" class="dropdown-item" onclick="openModal()">Logout</a>
                <svg class="w-6 h-6 text-white close-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="close-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
        </div>
    </nav>
 <!-- Logout Confirmation Modal -->
 <div id="logoutModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Are you sure you want to logout?</p>
            <button onclick="logout()">Yes</button>
            <button onclick="closeModal()">Cancel</button>
        </div>
    </div>


    <!-- Content -->
    <div class="container mx-auto mt-8 light-mode-container">
        <h1 class="text-3xl font-bold" >CAPSTONE DESCRIPTION</h1>
        <!-- General Description -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">General Description</h2>
            <p class="text-white-800 leading-relaxed font-medium">
                Wherehouse is a comprehensive web-based system designed to simplify and streamline the management of warehouse rentals.
                The system addresses key challenges faced by lessors and lessees in the context of warehouse rental, focusing on automation, communication, and data security.
            </p>
        </div>

        <!-- Card grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-8 light-mode-cards">
            <!-- Card for Data Security -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md card light-mode-cards ">
                <img src="images/security.jpg" alt="Security" class="w-full h-40 object-cover object-center rounded-t-md">
                <div class="p-6 team-card">
                    <h2 class="text-lg font-semibold mb-4" style="color: #0BC4D9">Data Security</h2>
                    <p class="text-white-800 leading-relaxed font-medium">Ensuring that sensitive data of both lessors and lessees is protected from unauthorized access.</p>
                </div>
            </div>
           
             <!-- Card for Data Security -->
             <div class="bg-white rounded-lg overflow-hidden shadow-md card light-mode-cards ">
                <img src="images/Billing.jpg" alt="Security" class="w-full h-40 object-cover object-center rounded-t-md">
                <div class="p-6 team-card">
                    <h2 class="text-lg font-semibold mb-4" style="color: #0BC4D9">Automated Billing</h2>
                    <p class="text-white-800 leading-relaxed font-medium">Providing an automated billing system to ensure timely and accurate invoices for rental payments.</p>
                </div>
            </div>

             <!-- Card for Data Security -->
             <div class="bg-white rounded-lg overflow-hidden shadow-md card light-mode-cards ">
                <img src="images/Communication.jpg" alt="Security" class="w-full h-40 object-cover object-center rounded-t-md">
                <div class="p-6 team-card">
                    <h2 class="text-lg font-semibold mb-4" style="color: #0BC4D9">Communication</h2>
                    <p class="text-white-800 leading-relaxed font-medium">Offering a simple and efficient way for lessees to report maintenance issues and communicate directly with lessors.</p>
                </div>
            </div>

             <!-- Card for Data Security -->
             <div class="bg-white rounded-lg overflow-hidden shadow-md card light-mode-cards ">
                <img src="images/Report.jpg" alt="Security" class="w-full h-40 object-cover object-center rounded-t-md">
                <div class="p-6 team-card">
                    <h2 class="text-lg font-semibold mb-4" style="color: #0BC4D9">Report Generation</h2>
                    <p class="text-white-800 leading-relaxed font-medium">Allowing lessors to generate detailed reports on warehouse operations, maintenance, and problem statuses.</p>
                </div>
            </div>

             <!-- Card for Data Security -->
             <div class="bg-white rounded-lg overflow-hidden shadow-md card light-mode-cards ">
                <img src="images/Monitoring.jpg" alt="Security" class="w-full h-40 object-cover object-center rounded-t-md">
                <div class="p-6 team-card">
                    <h2 class="text-lg font-semibold mb-4" style="color: #0BC4D9">Monitoring and Maintenance</h2>
                    <p class="text-white-800 leading-relaxed font-medium">Giving lessors a tool to track and manage maintenance requests and their status in real-time.</p>
                </div>
            </div>

             <!-- Card for Data Security -->
             <div class="bg-white rounded-lg overflow-hidden shadow-md card light-mode-cards ">
                <img src="images/Agreements.jpg" alt="Security" class="w-full h-40 object-cover object-center rounded-t-md">
                <div class="p-6 team-card">
                    <h2 class="text-lg font-semibold mb-4" style="color: #0BC4D9">Lease Agreements</h2>
                    <p class="text-white-800 leading-relaxed font-medium">Allowing lessors to create clear lease agreements that define the terms and conditions for both parties.</p>
                </div>
            </div>

             <!-- Card for Data Security -->
             <div class="bg-white rounded-lg overflow-hidden shadow-md card light-mode-cards ">
                <img src="images/notif.jpg" alt="Security" class="w-full h-40 object-cover object-center rounded-t-md">
                <div class="p-6 team-card">
                    <h2 class="text-lg font-semibold mb-4" style="color: #0BC4D9">Notifications and Updates</h2>
                    <p class="text-white-800 leading-relaxed font-medium">Facilitating communication of important updates from lessors to lessees.</p>
                    <br>
                </div>
            </div>

             <!-- Card for Data Security -->
             <div class="bg-white rounded-lg overflow-hidden shadow-md card light-mode-cards ">
                <img src="images/Messaging.jpg" alt="Security" class="w-full h-40 object-cover object-center rounded-t-md">
                <div class="p-6 team-card">
                    <h2 class="text-lg font-semibold mb-4" style="color: #0BC4D9">Direct Messaging</h2>
                    <p class="text-white-800 leading-relaxed font-medium">Enabling lessees to send direct messages or inquiries to lessors.</p>
                    <br>
                </div>
            </div>
        </div>

        <!-- Carousel container -->
        <div class="carousel-container">
            <!-- Carousel inner content -->
            <div class="carousel-inner">
                <!-- Individual carousel items -->
                <div class="carousel-item"><img src="images/sample1.jpg" alt="Sample 1" class="carousel-img"></div>
                <div class="carousel-item"><img src="images/sample2.jpg" alt="Sample 2" class="carousel-img"></div>
                <div class="carousel-item"><img src="images/sample3.jpg" alt="Sample 3" class="carousel-img"></div>
                <div class="carousel-item"><img src="images/sample4.jpg" alt="Sample 4" class="carousel-img"></div>
                <div class="carousel-item"><img src="images/sample5.jpg" alt="Sample 5" class="carousel-img"></div>
            </div>
            <!-- Previous and Next buttons -->
            <button class="carousel-btn carousel-prev" onclick="moveSlide(-1)">Previous</button>
            <button class="carousel-btn carousel-next" onclick="moveSlide(1)">Next</button>
        </div>
    </div>


    <!-- JavaScript for light mode/dark mode functionality -->
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
        const modeToggle = document.getElementById('mode-toggle');
        const modeIcon = document.getElementById('mode-icon');
        const body = document.body;
        const navbar = document.querySelector('.navbar');

        modeToggle.addEventListener('click', () => {
            body.classList.toggle('light-mode');
            modeIcon.src = body.classList.contains('light-mode') ? 'images/dark.png' : 'images/light.png';
            
            // Toggle navigation bar background color
            navbar.classList.toggle('dark-mode-navbar');
        });
        
        // JavaScript for automatic carousel
        let slideIndex = 0;
        const carouselItems = document.querySelectorAll('.carousel-item');
        const totalSlides = carouselItems.length;

        function moveSlide(n) {
            slideIndex += n;
            if (slideIndex >= totalSlides) {
                slideIndex = 0;
            }
            if (slideIndex < 0) {
                slideIndex = totalSlides - 1;
            }
            updateCarousel();
        }

        function updateCarousel() {
            const offset = -slideIndex * 101.475 + "%";
            document.querySelector(".carousel-inner").style.transform = "translateX(" + offset + ")";
        }
        // Automatically move to next slide every 5 seconds
        setInterval(() => {
            moveSlide(1);
        }, 3000);
        
        // Function to open the modal
        function openModal() {
            var modal = document.getElementById("logoutModal");
            modal.style.display = "block";
        }

        // Function to close the modal
        function closeModal() {
            var modal = document.getElementById("logoutModal");
            modal.style.display = "none";
        }

        // Function to logout
        function logout() {
            window.location.href = 'LoginPage.php?logout=true';
        }
    </script>

</body>
</html>
