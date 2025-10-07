<?php 
require_once '../includes/header.php';
?>

<body class="bg-gray-100 flex items-center justify-center h-screen overflow-hidden">
    <?php include '../includes/sidebar_navigation.php'; ?>
    <div class="screen h-full w-full flex flex-col overflow-hidden">
        <div class="main flex-1 flex flex-col overflow-auto">
            <?php include '../includes/top_header.php'; ?>

            <div class="screen">
                <!-- Settings Screen -->
                <div id="settingsScreen" class="px-2 pt-4">
                    <!-- Profile Header -->
                    <div class="bg-gray-800 rounded-xl p-4 mb-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gray-600 rounded-full mr-4 profile-image"
                                style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 48 48%22><circle cx=%2224%22 cy=%2224%22 r=%2224%22 fill=%22%23d4d4d8%22/><circle cx=%2224%22 cy=%2218%22 r=%228%22 fill=%22%23525252%22/><ellipse cx=%2224%22 cy=%2240%22 rx=%2212%22 ry=%2210%22 fill=%22%23525252%22/></svg>'); background-size: cover;">
                            </div>
                            <div>
                                <div class="text-white font-medium"><?php echo $profile['fullname']; ?></div>
                                <div class="text-gray-400 text-sm">UID: <?php echo $profile['userid']; ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Settings -->
                    <div class="mb-6">
                        <h3 class="text-dark text-md font-bold mb-3">Security settings</h3>
                        <div class="bg-gray-800 rounded-xl p-4 cursor-pointer" onclick="showScreen('update_password')">
                            <div class="flex items-center justify-between">
                                <span class="text-white">Security</span>
                                <div class="flex items-center">
                                    <span class="text-green-500 text-sm mr-2">High</span>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- General Settings -->
                    <div>
                        <h3 class="text-dark text-md font-bold mb-3">General settings</h3>
                        <div class="space-y-3">
                            <div class="bg-gray-800 rounded-xl p-4 cursor-pointer" onclick="showScreen('profile')">
                                <div class="flex items-center justify-between">
                                    <span class="text-white">Settings</span>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>

                            <div class="bg-gray-800 rounded-xl p-4 cursor-pointer" onclick="showScreen('profile')">
                                <div class="flex items-center justify-between">
                                    <span class="text-white">Support Center</span>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>

                            <div class="bg-gray-800 rounded-xl p-4 cursor-pointer" onclick="showScreen('profile')">
                                <div class="flex items-center justify-between">
                                    <span class="text-white">Account Priority</span>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>

                            <div class="bg-gray-800 rounded-xl p-4 cursor-pointer" onclick="showScreen('profile')">
                                <div class="flex items-center justify-between">
                                    <span class="text-white">Company policy document</span>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Screen -->
                <div id="profileScreen" class="px-2 pt-4 hidden">
                    <!-- Back Button -->
                    <div class="flex items-center mb-8">
                        <svg class="w-6 h-6 text-dark cursor-pointer" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" onclick="showScreen('settings')">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>

                    <!-- Profile Image -->
                    <div class="flex flex-col items-center mb-8">
                        <div class="relative">
                            <div class="w-32 h-32 bg-gray-600 rounded-full profile-image"
                                style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><circle cx=%2264%22 cy=%2264%22 r=%2264%22 fill=%22%23d4d4d8%22/><circle cx=%2264%22 cy=%2248%22 r=%2220%22 fill=%22%23525252%22/><ellipse cx=%2264%22 cy=%22108%22 rx=%2232%22 ry=%2226%22 fill=%22%23525252%22/></svg>'); background-size: cover;">
                            </div>
                            <div class="camera-icon flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="text-gray-400 text-sm mt-4">Your profile</div>
                    </div>

                    <!-- Profile Details -->
                    <div class="space-y-4 mb-8">
                        <div class="bg-gray-800 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-gray-400 text-sm">UID</div>
                                    <div class="text-white"><?php echo $profile['userid']; ?></div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-gray-400 text-sm">Name</div>
                                    <div class="text-white"><?php echo $profile['fullname']; ?></div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-gray-400 text-sm">Email</div>
                                    <div class="text-white"><?php echo $profile['email']; ?></div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Log out button -->
                    <div class="px-4">
                        <a href="../logout"
                            class="w-full bg-gray-700 hover:bg-gray-600 text-white py-4 rounded-xl font-medium transition-colors">
                            Log out
                        </a>
                    </div>
                </div>

                <!-- Profile Screen -->
                <div id="updatePasswordScreen" class="px-2 pt-4 hidden">
                    <!-- Back Button -->
                    <div class="flex items-center mb-8">
                        <svg class="w-6 h-6 text-dark cursor-pointer" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" onclick="showScreen('settings')">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>

                    <!-- Profile Image -->
                    <div class="flex flex-col items-center mb-8">
                        <div class="text-gray-400 text-sm mt-4">Update password</div>
                    </div>

                    <!-- Profile Details -->
                    <form class="space-y-4 mb-8" id="update_password">
                        <input type="hidden" name="userid" id="userid" value="<?php echo $profile['userid']; ?>">
                        <div class="bg-gray-800 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-gray-400 text-sm">Old Password</div>
                                    <input type="password" name="old_password" id="old_password" class="w-full bg-gray-800 rounded-xl p-4">
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-gray-400 text-sm">New Password</div>
                                    <input type="password" name="new_password" id="new_password" class="w-full bg-gray-800 rounded-xl p-4">
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-gray-400 text-sm">Confirm Password</div>
                                    <input type="password" name="confirm_password" id="confirm_password" class="w-full bg-gray-800 rounded-xl p-4">
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-gray-700 hover:bg-gray-600 text-white py-4 rounded-xl font-medium transition-colors">Update Password</button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Bottom Navigation -->
        <?php include '../includes/bottom_navigation.php'; ?>
    </div>
    
    <script>
        function showScreen(screen) {
            const settingsScreen = document.getElementById('settingsScreen');
            const profileScreen = document.getElementById('profileScreen');
            const updatePasswordScreen = document.getElementById('updatePasswordScreen');

            if (screen === 'settings') {
                settingsScreen.classList.remove('hidden');
                profileScreen.classList.add('hidden');
                updatePasswordScreen.classList.add('hidden');
            } else if (screen === 'profile') {
                settingsScreen.classList.add('hidden');
                profileScreen.classList.remove('hidden');
                updatePasswordScreen.classList.add('hidden');
            } else if (screen === 'update_password') {
                settingsScreen.classList.add('hidden');
                profileScreen.classList.add('hidden');
                updatePasswordScreen.classList.remove('hidden');
            }
        }
        

    </script>
</body>

</html>