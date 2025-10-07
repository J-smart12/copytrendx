<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Crypto Trading App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .screen {
            background: #f5f5f5;
            position: relative;
        }
        .notification-item {
            transition: all 0.2s ease;
            border-bottom: 1px solid #e5e7eb;
        }
        .notification-item:last-child {
            border-bottom: none;
        }
        .notification-item:hover {
            background-color: #f9fafb;
        }
        .unread {
            background-color: #f0f9ff;
            border-left: 3px solid #0ea5e9;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen overflow-hidden">
    <!-- side bar nav -->
    <?php include '../includes/sidebar_navigation.php'; ?>
    <div class="screen h-full w-full flex flex-col overflow-hidden">
        <div class="main flex-1 flex flex-col overflow-auto">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4 border-b sticky top-0 bg-white z-10">
                <div class="flex items-center">
                    <a href="index.html" class="mr-3 text-gray-600">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-xl font-semibold">Notifications</h1>
                </div>
                <div class="flex items-center space-x-3">
                    <button id="markAllRead" class="text-blue-500 text-sm font-medium">Mark all as read</button>
                    <button class="text-gray-600">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="px-4 py-3 border-b bg-white">
                <div class="flex space-x-2 overflow-x-auto pb-1 hide-scrollbar">
                    <button class="px-4 py-2 rounded-full bg-blue-50 text-blue-600 text-sm font-medium whitespace-nowrap">
                        All
                    </button>
                    <!-- <button class="px-4 py-2 rounded-full text-gray-500 hover:bg-gray-100 text-sm font-medium whitespace-nowrap">
                        Unread
                    </button>
                    <button class="px-4 py-2 rounded-full text-gray-500 hover:bg-gray-100 text-sm font-medium whitespace-nowrap">
                        Transactions
                    </button>
                    <button class="px-4 py-2 rounded-full text-gray-500 hover:bg-gray-100 text-sm font-medium whitespace-nowrap">
                        Promotions
                    </button>
                    <button class="px-4 py-2 rounded-full text-gray-500 hover:bg-gray-100 text-sm font-medium whitespace-nowrap">
                        System
                    </button> -->
                </div>
            </div>

            <!-- Notifications List -->
            <div class="flex-1 overflow-y-auto">
                <!-- Date Header -->
                <div class="px-4 py-3 bg-gray-50">
                    <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider">Today</h3>
                </div>

                <!-- Notification Items -->
                <div class="divide-y divide-gray-100">
                    <!-- Unread Notification -->
                    <div class="notification-item unread px-4 py-3">
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mr-3">
                                <i class="fas fa-check-circle text-blue-500"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">Deposit Successful</p>
                                <p class="text-sm text-gray-500 mt-1">Your deposit of 0.05 BTC has been confirmed and added to your account.</p>
                                <div class="flex items-center mt-1">
                                    <span class="text-xs text-blue-500">2 min ago</span>
                                    <span class="mx-2 text-gray-300">•</span>
                                    <span class="text-xs text-gray-500">Transaction ID: 7XQ9K2M</span>
                                </div>
                            </div>
                            <button class="ml-2 text-gray-400 hover:text-gray-500">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Read Notification -->
                    <div class="notification-item px-4 py-3">
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mr-3">
                                <i class="fas fa-chart-line text-green-500"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">Market Update</p>
                                <p class="text-sm text-gray-500 mt-1">Bitcoin has increased by 5.2% in the last 24 hours. Check your portfolio.</p>
                                <div class="flex items-center mt-1">
                                    <span class="text-xs text-gray-400">1 hour ago</span>
                                </div>
                            </div>
                            <button class="ml-2 text-blue-400 hover:text-blue-500">
                                <i class="fas fa-bookmark"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Promotional Notification -->
                    <div class="notification-item px-4 py-3">
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center flex-shrink-0 mr-3">
                                <i class="fas fa-gift text-yellow-500"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">Special Offer</p>
                                <p class="text-sm text-gray-500 mt-1">Get 10% bonus on your next deposit. Limited time offer!</p>
                                <div class="flex items-center mt-1">
                                    <span class="text-xs text-gray-400">3 hours ago</span>
                                    <span class="ml-2 px-2 py-0.5 rounded-full bg-yellow-50 text-yellow-700 text-xs">Promotion</span>
                                </div>
                            </div>
                            <button class="ml-2 text-gray-400 hover:text-gray-500">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </div>
                    </div>

                    <!-- System Notification -->
                    <div class="notification-item px-4 py-3">
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0 mr-3">
                                <i class="fas fa-shield-alt text-purple-500"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">Security Alert</p>
                                <p class="text-sm text-gray-500 mt-1">New login detected from a new device. Was this you?</p>
                                <div class="flex items-center mt-1">
                                    <span class="text-xs text-gray-400">5 hours ago</span>
                                    <span class="ml-2 px-2 py-0.5 rounded-full bg-red-50 text-red-700 text-xs">Security</span>
                                </div>
                                <div class="mt-2 flex space-x-2">
                                    <button class="flex-1 bg-blue-50 text-blue-600 py-1.5 px-3 rounded-lg text-sm font-medium">
                                        Yes, it's me
                                    </button>
                                    <button class="flex-1 bg-gray-100 text-gray-700 py-1.5 px-3 rounded-lg text-sm font-medium">
                                        No, secure account
                                    </button>
                                </div>
                            </div>
                            <button class="ml-2 text-gray-400 hover:text-gray-500">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Older Notifications -->
                <div class="px-4 py-3 bg-gray-50 mt-4">
                    <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider">Yesterday</h3>
                </div>

                <div class="divide-y divide-gray-100">
                    <!-- Older Notification -->
                    <div class="notification-item px-4 py-3">
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0 mr-3">
                                <i class="fas fa-exchange-alt text-indigo-500"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">Trade Executed</p>
                                <p class="text-sm text-gray-500 mt-1">Your order to buy 0.1 BTC has been executed at $42,350.00</p>
                                <div class="flex items-center mt-1">
                                    <span class="text-xs text-gray-400">Yesterday, 4:32 PM</span>
                                </div>
                            </div>
                            <button class="ml-2 text-gray-400 hover:text-gray-500">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <?php include '../includes/bottom_navigation.php'; ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/auth.js"></script>
    <script>
        $(document).ready(function() {
            // Mark all as read
            $('#markAllRead').click(function() {
                $('.notification-item').removeClass('unread');
                // Here you would typically make an API call to mark all as read
            });

            // Mark individual notification as read when clicked
            $('.notification-item').click(function() {
                $(this).removeClass('unread');
                // Here you would typically make an API call to mark this notification as read
            });

            // Filter notifications
            $('.filter-tab').click(function() {
                $('.filter-tab').removeClass('bg-blue-50 text-blue-600').addClass('text-gray-500 hover:bg-gray-100');
                $(this).removeClass('text-gray-500 hover:bg-gray-100').addClass('bg-blue-50 text-blue-600');
                
                // Here you would filter the notifications based on the selected tab
                const filter = $(this).text().trim().toLowerCase();
                console.log('Filtering by:', filter);
                // Implement filtering logic here
            });
        });
    </script>
    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        /* Dark mode styles */
        .dark .bg-white {
            background-color: #1f2937;
        }
        .dark .text-gray-900 {
            color: #f9fafb;
        }
        .dark .text-gray-500 {
            color: #9ca3af;
        }
        .dark .bg-gray-50 {
            background-color: #111827;
        }
        .dark .notification-item {
            border-color: #374151;
        }
        .dark .unread {
            background-color: #1e3a8a;
            border-left-color: #3b82f6;
        }
        .dark .bg-blue-50 {
            background-color: #1e40af;
        }
        .dark .text-blue-600 {
            color: #93c5fd;
        }
    </style>
</body>
</html>