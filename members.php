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
    <title>Members Page</title>
    <!-- Add your CSS includes here -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a202c; /* Updated background color */
        }
        .team-card {
            background-color: #252640; /* Updated card background color */
            color: #FFFFFF; /* Updated text color */
            border-radius: 10px;
            padding: 20px;
            border: 2px solid #0BC4D9;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            width: 70%; /* Adjusted width */
            margin: 0 auto; /* Center align the cards */
        }
        .team-card {
            font-size: 18px;
        }
        .team-card:hover {
            transform: translateY(-5px);
        }
        .team-card img {
            border-radius: 50%;
            margin-bottom: 20px;
            width: 200px; /* Adjust image width */
            height: 200px; /* Adjust image height */
        }
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #252640;
            color: #FFFFFF;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            text-align: justify;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: #FFFFFF;
        }
        .modal-close-btn {
            margin-top: 20px;
            background-color: #DC2626; /* Updated close button background color */
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .modal-close-btn:hover {
            background-color: #EF4444; /* Updated close button hover background color */
        }
        .modal-content p {
            margin-bottom: 10px; /* Add spacing between paragraphs */
        }
        .member-info {
            margin-bottom: 20px; /* Add some bottom margin */
        }
        .info {
            display: flex;
            align-items: center;
            margin-bottom: 10px; /* Add some bottom margin */
        }
        .info-icon {
            width: 24px; /* Set the width of the icons */
            height: 24px; /* Set the height of the icons */
            margin-right: 10px; /* Add some right margin to separate the icon from the text */
        }
        .mode-icon {
    width: 44px;
    height: 44px;
    margin-right: 80px;
    margin-top: 20px;
    transition: transform 0.3s ease;
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
/* Add this rule to hide desktop links when mobile dropdown is open */
.mobile-dropdown.open + .navbar-links {
    display: none;
}

    </style>
    <link rel="stylesheet" href="navbar.css"> <!-- Include navbar CSS -->
</head>
<body class="dark-mode">
<button id="mode-toggle" class="absolute top-4 right-4 focus:outline-none">
    <img src="images/dark.png" alt="Dark Mode" class="mode-icon" id="mode-icon">
</button>

   <!-- Navigation bar -->
<nav class="navbar">
    <div class="container mx-auto flex justify-between items-center">
        <div class="navbar-section">
            <a href="#" class="navbar-brand">Members</a>
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-8">
        <!-- Member Card 1 -->
        <div class="team-card">
            <img src="images/diane.png" alt="Allyza Diane J. Perillo" class="rounded-full mx-auto mb-4 ">
            <h3 class="text-center font-bold" style="color: #0BC4D9">Allyza Diane J. Perillo</h3>
            <p class="text-center"><strong>Address:</strong> Daang Bago Dinalupihan, Bataan</p>
            <p class="text-center">.....</p>
            <div class="text-center mb-4 mt-4"> <!-- Added text-center class -->
        <button class="btn-see-more bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">See More</button>
    </div>
            <div class="hidden" id="member-info-1">
                <div class="info">
                    <img src="images/address.png" alt="Address" class="info-icon">
                    <p><strong>Address:</strong> Daang Bago Dinalupihan, Bataan</p>
                </div>
                <div class="info">
                    <img src="images/information.png" alt="Other Information" class="info-icon">
                    <p><strong>Other Information:</strong> Allyza is a reliable problem-solver and decision-maker because of her capacity to stay calm under pressure and handle difficult situations. Because of Allyza's leadership, commitment, and many different skills, our team finds her to be a priceless asset that brings our projects along with quality and efficiency.</p>
                </div>
                <div class="info">
                    <img src="images/user.png" alt="Project Role" class="info-icon">
                    <p><strong>Project Role:</strong> Project Leader/Manager and Documentor</p>
                </div>
                <div class="info">
                    <img src="images/job-seeking.png" alt="Description of the role" class="info-icon">
                    <p><strong>Description of the role:</strong> Allyza is the Project Leader/Manager and she is responsible for the overall coordination and execution of the capstone project. Her role involves a combination of leadership, organization, and communication skills. And also, her role as documentor she is responsible for capturing, organizing, and maintaining all project-related documentation. Her role is important for ensuring accurate records and supporting the team's communication and accountability.</p>
                </div>
            </div>
        </div>

        <!-- Member Card 2 -->
        <div class="team-card">
            <img src="images/jars.png" alt="Jarielle L. Ramos" class="rounded-full mx-auto mb-4">
            <h3 class="text-center font-bold"  style="color: #0BC4D9">Jarielle L. Ramos</h3>
            <p class="text-center"><strong>Address:</strong> Balanga, Bataan</p>
            <p class="text-center">.....</p>
            <div class="text-center mb-4 mt-4"> <!-- Added text-center class -->
        <button class="btn-see-more bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">See More</button>
    </div>
            <div class="hidden" id="member-info-2">
                <div class="info">
                    <img src="images/address.png" alt="Address" class="info-icon">
                    <p><strong>Address:</strong> 150 Masinop St Cupang West Balanga City Bataan</p>
                </div>
                <div class="info">
                    <img src="images/information.png" alt="Other Information" class="info-icon">
                    <p><strong>Other Information:</strong> Jarielle's strength and resilience can be seen by his ability to balance a variety of responsibilities and interests. He is a visionary as well as a designer who is always looking for new ways to push the limit of creativity.</p>
                </div>
                <div class="info">
                    <img src="images/user.png" alt="Project Role" class="info-icon">
                    <p><strong>Project Role:</strong> Lead Designer / Assistant Programmer</p>
                </div>
                <div class="info">
                    <img src="images/job-seeking.png" alt="Description of the role" class="info-icon">
                    <p><strong>Description of the role:</strong> Jarielle is the Lead Designer and he responsible for overseeing the visual and user experience aspects of the project. This role involves creativity, a keen eye for aesthetics, and a strong understanding of design principles. His role as Assistant Programmer works closely with the development team to implement the project's technical components. This role requires coding skills, a collaborative mindset, and a willingness to learn from our lead programmer.</p>
                </div>
            </div>
        </div>

        <!-- Member Card 3 -->
        <div class="team-card">
            <img src="images/drex.png" alt="Ahldrex Jefferson M. Reyes" class="rounded-full mx-auto mb-4">
            <h3 class="text-center font-bold" style="color: #0BC4D9">Ahldrex Jefferson M. Reyes</h3>
            <p class="text-center"><strong>Address:</strong> 017 Macopa Street Landing Limay Bataan</p>
            <p class="text-center">.....</p>
            <div class="text-center mb-4 mt-4"> <!-- Added text-center class -->
        <button class="btn-see-more bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">See More</button>
    </div>
            <div class="hidden" id="member-info-3">
                <div class="info">
                    <img src="images/address.png" alt="Address" class="info-icon">
                    <p><strong>Address:</strong> 017 Macopa Street Landing Limay Bataan</p>
                </div>
                <div class="info">
                    <img src="images/information.png" alt="Other Information" class="info-icon">
                    <p><strong>Other Information:</strong> Ahldrex’s great attention to detail and knowledge allow him to carefully look over every aspect of our projects. He has been given the task of identifying and taking care of any possible problems before they become serious. His dedication to monitoring quality makes a big difference in our projects' overall success.</p>
                </div>
                <div class="info">
                    <img src="images/user.png" alt="Project Role" class="info-icon">
                    <p><strong>Project Role:</strong> Lead Tester / Documentor</p>
                </div>
                <div class="info">
                    <img src="images/job-seeking.png" alt="Description of the role" class="info-icon">
                    <p><strong>Description of the role:</strong> Ahldrex is the Lead Tester and he is responsible for ensuring the quality and functionality of our project deliverables through rigorous testing processes. This role requires a keen eye for detail, problem-solving skills, and a solid understanding of testing methodologies. And his role as a documentor plays an important role in maintaining accurate and organized project documentation. This role is important for project communication, continuity, and future reference.</p>
                </div>
            </div>
        </div>

        <!-- Member Card 4 -->
        <div class="team-card">
            <img src="images/kobie.png" alt="Kobie O. Villanueva" class="rounded-full mx-auto mb-4">
            <h3 class="text-center font-bold" style="color: #0BC4D9">Kobie O. Villanueva</h3>
            <p class="text-center"><strong>Address:</strong> 226 Sitio Toto Cupang Proper Balanga City Bataan</p>
            <p class="text-center">.....</p>
            <div class="text-center mb-4 mt-4"> <!-- Added text-center class -->
        <button class="btn-see-more bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">See More</button>
    </div>
            <div class="hidden" id="member-info-4">
                <div class="info">
                    <img src="images/address.png" alt="Address" class="info-icon">
                    <p><strong>Address:</strong> 226 Sitio Toto Cupang Proper Balanga City Bataan</p>
                </div>
                <div class="info">
                    <img src="images/information.png" alt="Other Information" class="info-icon">
                    <p><strong>Other Information:</strong> Kobie's attention to detail ensures that projects are completed accurately and effectively. He takes a positive and strong attitude toward problems, transforming failures into chances for growth.</p>
                </div>
                <div class="info">
                    <img src="images/user.png" alt="Project Role" class="info-icon">
                    <p><strong>Project Role:</strong> Lead Programmer</p>
                </div>
                <div class="info">
                    <img src="images/job-seeking.png" alt="Description of the role" class="info-icon">
                    <p><strong>Description of the role:</strong> Kobie is the Lead Programmer and he is responsible for guiding the technical development of our capstone project. His role involves advanced programming skills, technical leadership, and the ability to collaborate with our team members to ensure the project's success.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal-overlay" id="modal-overlay">
    <div class="modal-content">
        <div id="member-info" class="member-info"></div>
        <button class="modal-close-btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">Close</button>
    </div>
</div>

<script>

    // Function to toggle mobile dropdown
document.getElementById('mobile-menu-button').addEventListener('click', function() {
    var mobileDropdown = document.getElementById('mobile-dropdown');
    var navbarLinks = document.querySelector('.navbar-links');
    if (mobileDropdown.style.display === 'none' || mobileDropdown.style.display === '') {
        mobileDropdown.style.display = 'block';
        navbarLinks.classList.add('hidden'); // Hide desktop links when mobile dropdown is open
    } else {
        mobileDropdown.style.display = 'none';
        navbarLinks.classList.remove('hidden'); // Show desktop links when mobile dropdown is closed
    }
});

// Function to close mobile dropdown when clicking close icon
document.getElementById('close-icon').addEventListener('click', function() {
    var mobileDropdown = document.getElementById('mobile-dropdown');
    var navbarLinks = document.querySelector('.navbar-links');
    mobileDropdown.style.display = 'none';
    navbarLinks.classList.remove('hidden'); // Show desktop links when mobile dropdown is closed
});


    // Function to close mobile dropdown when clicking close icon
    document.getElementById('close-icon').addEventListener('click', function() {
        var mobileDropdown = document.getElementById('mobile-dropdown');
        mobileDropdown.style.display = 'none';
    });

document.querySelectorAll('.btn-see-more').forEach((btn, index) => {
    btn.addEventListener('click', () => {
        const modalOverlay = document.getElementById('modal-overlay');
        const modalContent = modalOverlay.querySelector('.modal-content');
        const memberInfo = document.getElementById('member-info-' + (index + 1)).innerHTML;
        const modalCloseBtn = document.querySelector('.modal-close-btn');

        // Add click event listener to close button
        modalCloseBtn.addEventListener('click', () => {
            // Hide modal overlay
            document.getElementById('modal-overlay').style.display = 'none';
        });
        
        modalContent.querySelector('.member-info').innerHTML = memberInfo;
        modalOverlay.style.display = 'flex';
    });
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
        // Change navbar background color to white
        document.querySelector('.navbar').style.backgroundColor = "#ffffff";
        // Change navbar text color to dark
        document.querySelector('.navbar-brand').style.color = "#252640";
        document.querySelectorAll('.navbar-links a').forEach(link => {
            link.style.color = "#252640";
        });
        // Change body background color to white
        document.body.style.backgroundColor = "#ffffff";
        // Change text color in cards to dark
        document.querySelectorAll('.team-card, .project-info-card').forEach(card => {
            card.style.backgroundColor = "#ffffff";
            card.style.color = "#252640";
            card.style.boxShadow = "0px 4px 10px rgba(0, 0, 0, 0.1)";
        });
    } else {
        body.classList.remove('light-mode');
        body.classList.add('dark-mode');
        modeIcon.src = "images/dark.png";
        // Additional styling changes for dark mode
        // Change navbar background color to dark
        document.querySelector('.navbar').style.backgroundColor = "#1a202c";
        // Change navbar text color to light
        document.querySelector('.navbar-brand').style.color = "#ffffff";
        document.querySelectorAll('.navbar-links a').forEach(link => {
            link.style.color = "#ffffff";
        });
        // Change body background color to dark
        document.body.style.backgroundColor = "#1a202c";
        // Change text color in cards to light
        document.querySelectorAll('.team-card, .project-info-card').forEach(card => {
            card.style.backgroundColor = "rgba(37, 38, 64, 0.8)";
            card.style.color = "#ffffff";
            card.style.boxShadow = "0px 4px 10px rgba(0, 0, 0, 0.1)";
        });
    }
});
</script>
</body>
</html>
