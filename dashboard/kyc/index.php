<?php
require_once '../includes/header.php';
// In a real implementation, you would check KYC status from the database
// $kycStatus = $db->getKYCStatus($profile['userid']);
?>

<body class="bg-gray-50 flex items-center justify-center h-screen overflow-hidden">
    <?php include '../includes/sidebar_navigation.php'; ?>
    <div class="screen h-full w-full flex flex-col overflow-hidden">
        <div class="main flex-1 flex flex-col overflow-auto">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4 border-b">
                <div class="flex items-center">
                    <a href="../home/" class="mr-3">
                        <i class="fas fa-arrow-left text-gray-700"></i>
                    </a>
                    <h1 class="text-xl font-semibold">Identity Verification (KYC)</h1>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 p-4 overflow-y-auto">
                <!-- Progress Steps -->
                <div class="max-w-3xl mx-auto mb-8">
                    <div class="flex items-center justify-between relative">
                        <!-- Progress Line -->
                        <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-200 -z-10">
                            <div class="h-full bg-blue-500 transition-all duration-300 ease-in-out" style="width: 33.33%" id="progressBar"></div>
                        </div>
                        
                        <!-- Step 1 -->
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-sm font-semibold mb-1">
                                <span id="step1Icon">1</span>
                            </div>
                            <span class="text-xs font-medium text-gray-700">Personal Info</span>
                        </div>
                        
                        <!-- Step 2 -->
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-sm font-semibold mb-1">
                                <span id="step2Icon">2</span>
                            </div>
                            <span class="text-xs font-medium text-gray-500">ID Verification</span>
                        </div>
                        
                        <!-- Step 3 -->
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-sm font-semibold mb-1">
                                <span id="step3Icon">3</span>
                            </div>
                            <span class="text-xs font-medium text-gray-500">Face Verification</span>
                        </div>
                    </div>
                </div>

                <!-- Step 1: Personal Information -->
                <div id="step1" class="max-w-2xl mx-auto">
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <h2 class="text-lg font-semibold mb-6">Personal Information</h2>
                        
                        <form id="personalInfoForm" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                    <input type="text" id="firstName" name="firstName" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                        value="<?php echo htmlspecialchars($profile['first_name'] ?? ''); ?>">
                                </div>
                                <div>
                                    <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                    <input type="text" id="lastName" name="lastName" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                        value="<?php echo htmlspecialchars($profile['last_name'] ?? ''); ?>">
                                </div>
                            </div>
                            
                            <div>
                                <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                                <input type="date" id="dob" name="dob" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <div>
                                <label for="country" class=