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
            /* Modal styles */
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

/* CSS for Circular Image */
.rounded-full {
    border-radius: 50%; /* Make the image circular */
}

/* CSS for Member Cards */
.team-card {
    width: 70%; /* Set card width to fill the container */
    margin-left: 100px;
    margin-top: 50px;
    color: black;
    margin-bottom: 20px; /* Add some bottom margin between cards */
    background-color: #ffffff; /* White background color */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add box shadow for depth */
}

.team-card:hover {
    transform: translateY(-2px); /* Add slight elevation on hover */
    transition: transform 0.3s ease;
}

.team-card:hover .overlay {
    opacity: 1; /* Show overlay on hover */
}

/* CSS for Overlay */
.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    opacity: 0;
    transition: opacity 0.3s ease;
}
.modal-info {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 500px;
    border-radius: 10px;
    text-align: center;
    position: relative;
}
.close-button {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    background-color: red;
    color: whitesmoke;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.close-button:hover {
    background-color: lightcoral; /* Button background color on hover */
}

.modal-info p {
            margin-bottom: 20px;
            color: black;
        }

        .modal{
            
        }
/* CSS for Overlay Content */
.overlay-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}

.overlay-content h3 {
    font-size: 1.5rem;
    font-weight: bold;
    color: #ffffff;
    margin-bottom: 0.5rem;
}

.overlay-content p {
    font-size: 1rem;
    color: #ffffff;
    margin-bottom: 1rem;
}

.overlay-content button {
    background-color: #0BC4D9;
    color: #ffffff;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.overlay-content button:hover {
    background-color: #0798AC;
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
                <a href="#" class="navbar-brand">Members Panel</a>
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
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
  <!-- Member Card 1: Allyza Diane J. Perillo -->
<div class="team-card relative rounded-lg overflow-hidden border-2 border-blue-500">
    <div class="overflow-hidden rounded-full w-32 h-32 mx-auto mt-4">
        <img src="images/diane.png" alt="Allyza Diane J. Perillo" class="w-full h-full object-cover rounded-full">
    </div>
    <div class="p-4">
        <div class="flex items-center justify-center mb-2">
            <img src="images/user.png" alt="Address Icon" class="w-6 h-6 mr-2">
            <h3 class="text-xl font-semibold">Allyza Diane J. Perillo</h3>
        </div>
        <div class="flex items-center justify-center mb-4">
            <img src="images/address.png" alt="User Icon" class="w-6 h-6 mr-2">
            <p class="text-sm text-gray-600">Address: Daang Bago Dinalupihan, Bataan</p>
        </div>
        <button class="block w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none" onclick="showModal('Allyza')">See More</button>
    </div>
    <!-- Additional Information (Hidden by default) -->
    <div id="allyza-info" class="hidden">
        <div class="p-4">
     
            <div class="flex items-center mb-2">
                <img src="images/information.png" alt="Information Icon" class="w-6 h-6 mr-2">
                <h4 class="text-lg font-semibold">Other Information:</h4>
            </div>
            <p class="mb-4">Allyza is a reliable problem-solver and decision-maker because of her capacity to stay calm under pressure and handle difficult situations. Because of Allyza's leadership, commitment, and many different skills, our team finds her to be a priceless asset that brings our projects along with quality and efficiency.</p>
            <div class="flex items-center mb-2">
                <img src="images/job-seeking.png" alt="Job Seeking Icon" class="w-6 h-6 mr-2">
                <h4 class="text-lg font-semibold">Description of the Role:</h4>
            </div>
            <p>Allyza is the Project Leader/Manager and she is responsible for the overall coordination and execution of the capstone project. Her role involves a combination of leadership, organization, and communication skills. And also, her role as documentor she is responsible for capturing, organizing, and maintaining all project-related documentation. Her role is important for ensuring accurate records and supporting the team's communication and accountability.</p>
        </div>
    </div>
</div>
<!-- Member Card 2: Jarielle L. Ramos -->
<div class="team-card relative rounded-lg overflow-hidden border-2 border-blue-500">
    <div class="overflow-hidden rounded-full w-32 h-32 mx-auto mt-4">
        <img src="images/jars.png" alt="Jarielle L. Ramos" class="w-full h-full object-cover rounded-full">
    </div>
    <div class="p-4">
        <div class="flex items-center justify-center mb-2">
            <img src="images/user.png" alt="Address Icon" class="w-6 h-6 mr-2">
            <h3 class="text-xl font-semibold">Jarielle L. Ramos</h3>
        </div>
        <div class="flex items-center justify-center mb-4">
            <img src="images/address.png" alt="User Icon" class="w-6 h-6 mr-2">
            <p class="text-sm text-gray-600">150 Masinop St Cupang West Balanga City Bataan
</p>
        </div>
        <button class="block w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none" onclick="showModal('Jarielle')">See More</button>
    </div>
    <!-- Additional Information (Hidden by default) -->
    <div id="jarielle-info" class="hidden">
        <div class="p-4">
            <div class="flex items-center mb-2">
                <img src="images/information.png" alt="Information Icon" class="w-6 h-6 mr-2">
                <h4 class="text-lg font-semibold">Other Information:</h4>
            </div>
            <p class="mb-4">Jarielle's strength and resilience can be seen by his ability to balance a variety of responsibilities and interests. He is a visionary as well as a designer who is always looking for new ways to push the limit of creativity.</p>
            <div class="flex items-center mb-2">
                <img src="images/job-seeking.png" alt="Job Seeking Icon" class="w-6 h-6 mr-2">
                <h4 class="text-lg font-semibold">Description of the Role:</h4>
            </div>
            <p>Jarielle is the Lead Designer and he responsible for overseeing the visual and user experience aspects of the project. This role involves creativity, a keen eye for aesthetics, and a strong understanding of design principles. His role as Assistant Programmer works closely with the development team to implement the project's technical components. This role requires coding skills, a collaborative mindset, and a willingness to learn from our lead programmer.</p>
        </div>
    </div>
</div>

<!-- Member Card 3: Ahldrex Jefferson M. Reyes -->
<div class="team-card relative rounded-lg overflow-hidden border-2 border-blue-500">
    <div class="overflow-hidden rounded-full w-32 h-32 mx-auto mt-4">
        <img src="images/drex.png" alt="Ahldrex Jefferson M. Reyes" class="w-full h-full object-cover rounded-full">
    </div>
    <div class="p-4">
        <div class="flex items-center justify-center mb-2">
            <img src="images/user.png" alt="Address Icon" class="w-6 h-6 mr-2">
            <h3 class="text-xl font-semibold">Ahldrex Jefferson M. Reyes</h3>
        </div>
        <div class="flex items-center justify-center mb-4">
            <img src="images/address.png" alt="User Icon" class="w-6 h-6 mr-2">
            <p class="text-sm text-gray-600">Address: 017 Macopa Street Landing Limay Bataan</p>
        </div>
        <button class="block w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none" onclick="showModal('Ahldrex')">See More</button>
    </div>
    <!-- Additional Information (Hidden by default) -->
    <div id="ahldrex-info" class="hidden">
        <div class="p-4">
            <div class="flex items-center mb-2">
                <img src="images/information.png" alt="Information Icon" class="w-6 h-6 mr-2">
                <h4 class="text-lg font-semibold">Other Information:</h4>
            </div>
            <p class="mb-4">Ahldrex’s great attention to detail and knowledge allow him to carefully look over every aspect of our projects. He has been given the task of identifying and taking care of any possible problems before they become serious. His dedication to monitoring quality makes a big difference in our projects' overall success.</p>
            <div class="flex items-center mb-2">
                <img src="images/job-seeking.png" alt="Job Seeking Icon" class="w-6 h-6 mr-2">
                <h4 class="text-lg font-semibold">Description of the Role:</h4>
            </div>
            <p>Ahldrex is the Lead Tester and he is responsible for ensuring the quality and functionality of our project deliverables through rigorous testing processes. This role requires a keen eye for detail, problem-solving skills, and a solid understanding of testing methodologies. And his role as a documentor plays an important role in maintaining accurate and organized project documentation. This role is important for project communication, continuity, and future reference.</p>
        </div>
    </div>
</div>

<!-- Member Card 4: Kobie O. Villanueva -->
<div class="team-card relative rounded-lg overflow-hidden border-2 border-blue-500">
    <div class="overflow-hidden rounded-full w-32 h-32 mx-auto mt-4">
        <img src="images/kobie.png" alt="Kobie O. Villanueva" class="w-full h-full object-cover rounded-full">
    </div>
    <div class="p-4">
        <div class="flex items-center justify-center mb-2">
            <img src="images/user.png" alt="Address Icon" class="w-6 h-6 mr-2">
            <h3 class="text-xl font-semibold">Kobie O. Villanueva</h3>
        </div>
        <div class="flex items-center justify-center mb-4">
            <img src="images/address.png" alt="User Icon" class="w-6 h-6 mr-2">
            <p class="text-sm text-gray-600">Address: 226 Sitio Toto Cupang Proper Balanga City Bataan</p>
        </div>
        <button class="block w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none" onclick="showModal('Kobie')">See More</button>
    </div>
    <!-- Additional Information (Hidden by default) -->
    <div id="kobie-info" class="hidden">
        <div class="p-4">
            <div class="flex items-center mb-2">
                <img src="images/information.png" alt="Information Icon" class="w-6 h-6 mr-2">
                <h4 class="text-lg font-semibold">Other Information:</h4>
            </div>
            <p class="mb-4">Kobie's attention to detail ensures that projects are completed accurately and effectively. He takes a positive and strong attitude toward problems, transforming failures into chances for growth.</p>
            <div class="flex items-center mb-2">
                <img src="images/job-seeking.png" alt="Job Seeking Icon" class="w-6 h-6 mr-2">
                <h4 class="text-lg font-semibold">Description of the Role:</h4>
            </div>
            <p>Kobie is the Lead Programmer and he is responsible for guiding the technical development of our capstone project. His role involves advanced programming skills, technical leadership, and the ability to collaborate with our team members to ensure the project's success.</p>
        </div>
        
    </div>
</div>


</div>
<!-- Modal -->
<div id="memberModal" class="modal">
    <div class="modal-info">
        <!-- Close button -->
        <button class="close-button" onclick="closeModal2()">Close</button>
        <span class="close" onclick="closeModal2()">&times;</span>
        <div id="modal-info"></div>
    </div>
</div>




     <!-- Logout Confirmation Modal -->
     <div id="logoutModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Are you sure you want to logout?</p>
            <button onclick="logout()">Yes</button>
            <button onclick="closeModal()">Cancel</button>
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
// Function to show modal with member information
function showModal(memberName) {
    var modal = document.getElementById("memberModal");
    var modalContent = document.getElementById("modal-info");
    var memberInfo = document.getElementById(memberName.toLowerCase() + "-info").innerHTML;
    modalContent.innerHTML = memberInfo;
    modal.style.display = "block";
}


    // Function to close the modal
    function closeModal2() {
        var modal = document.getElementById("memberModal");
        modal.style.display = "none";
    }
    // Function to close the more info section


    </script>
