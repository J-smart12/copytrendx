<?php 
require_once '../includes/header.php';
?>
    <style>
        .screen {
            background: #f5f5f5;
            position: relative;
        }
        .balance-bg {
            background: linear-gradient(135deg, #4a4a4a 0%, #2a2a2a 100%);
        }
        .profile-section {
            border-radius: 1rem;
            overflow: hidden;
        }
    </style>

<body class="bg-gray-100 flex items-center justify-center h-screen overflow-hidden">
    <!-- <div class="h-screen"></div> -->
    <?php include '../includes/sidebar_navigation.php'; ?>
    <div class="screen h-full w-full flex flex-col overflow-hidden">
        <div class="main flex-1 flex flex-col overflow-auto">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4 border-b">
                <div class="flex items-center">
                    <a href="../home" class="mr-3 text-gray-600">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-xl font-semibold">My Profile</h1>
                </div>
                <button class="text-blue-500 text-sm font-medium">Edit</button>
            </div>

            <!-- Profile Header -->
            <div class="px-4 py-6 text-center">
                <div class="relative inline-block mb-4">
                    <div class="w-24 h-24 rounded-full bg-gray-200 overflow-hidden mx-auto">
                        <img id="profileImage" src="https://via.placeholder.com/150" alt="Profile" class="w-full h-full object-cover">
                    </div>
                    <button class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full p-2">
                        <i class="fas fa-camera text-xs"></i>
                    </button>
                </div>
                <h2 class="text-xl font-semibold" id="userName"><?php echo $profile['fullname']; ?></h2>
                <p class="text-gray-500 text-sm" id="userEmail"><?php echo $profile['email']; ?></p>
                <div class="mt-3">
                    <?php if ($profile['email_verified'] == 1) { ?>
                        <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                            <i class="fas fa-check-circle mr-1"></i> Verified
                        </span>
                    <?php }else { ?>
                        <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                            <i class="fas fa-times-circle mr-1"></i> Not Verified
                        </span>
                    <?php } ?>
                </div>
            </div>

            <!-- Account Info -->
            <div class="px-4 mb-6">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="border-b border-gray-100 px-4 py-3">
                        <h3 class="font-medium text-gray-700">Account Information</h3>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <div class="px-4 py-3 flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">Full Name</p>
                                <p class="font-medium" id="userFullName"><?php echo $profile['fullname']; ?></p>
                            </div>
                            <i class="fas fa-check-circle text-green-500"></i>
                        </div>
                        <div class="px-4 py-3 flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium" id="userEmailInfo"><?php echo $profile['email']; ?></p>
                            </div>
                            <?php if ($profile['email_verified'] == 1) { ?>
                                <i class="fas fa-check-circle text-green-500"></i>
                            <?php }else { ?>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            <?php } ?>
                        </div>
                        <div class="px-4 py-3 flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">Phone</p>
                                <p class="font-medium" id="userPhone"><?php echo $profile['phone']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security -->
            <div class="px-4 mb-6">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="border-b border-gray-100 px-4 py-3">
                        <h3 class="font-medium text-gray-700">Settings</h3>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <div class="px-4 py-3 flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-500"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Update Profile</p>
                                    <!-- <p class="text-xs text-gray-500">Last changed 3 months ago</p> -->
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </div>
                        <div class="px-4 py-3 flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-lock text-blue-500"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Change Password</p>
                                    <!-- <p class="text-xs text-gray-500">Last changed 3 months ago</p> -->
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </div>
                        <a href="../notification" class="px-4 py-3 flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-bell text-yellow-500"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Notifications</p>
                                    <p class="text-xs text-gray-500">Manage your alerts</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </a>
                        <a href="../kyc" class="px-4 py-3 flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-shield-alt text-yellow-500"></i>
                                </div>
                                <div>
                                    <p class="font-medium">KYC</p>
                                    <p class="text-xs text-gray-500">Verify your identity</p>
                                </div>
                            </div>
                            
                            <?php if ($profile['kyc'] == 1) { ?>
                                <i class="fas fa-check-circle text-green-500"></i>
                            <?php }else { ?>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            <?php } ?>
                        </a>
                        <!-- <div class="px-4 py-3 flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-shield-alt text-green-500"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Two-Factor Authentication</p>
                                    <p class="text-xs text-green-500">Active</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </div> -->
                    </div>
                </div>
            </div>

            <!-- Preferences -->
            <!-- <div class="px-4 mb-6">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="border-b border-gray-100 px-4 py-3">
                        <h3 class="font-medium text-gray-700">Preferences</h3>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <div class="px-4 py-3 flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-moon text-purple-500"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Dark Mode</p>
                                </div>
                            </div>
                            <div class="relative inline-block w-10 mr-2 align-middle select-none">
                                <input type="checkbox" name="darkModeToggle" id="darkModeToggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                                <label for="darkModeToggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </div>
                        <div class="px-4 py-3 flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-bell text-yellow-500"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Notifications</p>
                                    <p class="text-xs text-gray-500">Manage your alerts</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Sign Out -->
            <div class="px-4 mb-6">
                <button id="signOutBtn" class="w-full bg-red-50 text-red-500 py-3 rounded-xl font-medium hover:bg-red-100 transition-colors">
                    Sign Out
                </button>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <?php include '../includes/bottom_navigation.php'; ?>
    </div>

    <!-- Scripts -->
    <script src="js/auth.js"></script>
    <script>
        $(document).ready(function() {
            // Load user data
            const user = JSON.parse(localStorage.getItem('user'));
            if (user) {
                $('#userName').text(user.displayName || 'User');
                $('#userEmail').text(user.email);
                $('#userFullName').text(user.displayName || 'Not set');
                $('#userEmailInfo').text(user.email);
                
                // Set profile image if available
                if (user.photoURL) {
                    $('#profileImage').attr('src', user.photoURL);
                }
            }

            // Sign out functionality
            $('#signOutBtn').click(function() {
                // This should be handled by your auth.js
                window.location.href = '../logout';
            });

            // Dark mode toggle
            // $('#darkModeToggle').change(function() {
            //     $('html').toggleClass('dark', this.checked);
            //     // Save preference to localStorage
            //     localStorage.setItem('darkMode', this.checked);
            // });

            // // Check for saved dark mode preference
            // if (localStorage.getItem('darkMode') === 'true') {
            //     $('html').addClass('dark');
            //     $('#darkModeToggle').prop('checked', true);
            // }
        });
    </script>
    <style>
        /* Toggle switch styling */
        .toggle-checkbox:checked {
            right: 0;
            border-color: #4299e1;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #4299e1;
        }
        .toggle-label {
            transition: all 0.3s ease;
        }
        /* Dark mode styles */
        .dark body {
            background-color: #1a202c;
            color: #e2e8f0;
        }
        .dark .bg-white {
            background-color: #2d3748;
            color: #e2e8f0;
        }
        .dark .text-gray-700, .dark .text-gray-900 {
            color: #e2e8f0;
        }
        .dark .text-gray-500 {
            color: #a0aec0;
        }
        .dark .border-gray-100 {
            border-color: #4a5568;
        }
        .dark .divide-gray-100 > :not([hidden]) ~ :not([hidden]) {
            border-color: #4a5568;
        }
    </style>
</body>
</html>