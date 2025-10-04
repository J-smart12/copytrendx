<?php 
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: ../login.html");
    exit();
}

require_once '../includes/require.php';
require_once '../includes/db.php';

$profile = $db->getUser($_SESSION['user']);

// $favCoins = $db->getFavCoins($_SESSION['user']);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Trading App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="manifest" href="config/manifiest.json">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        /* Custom styles for the mobile frame */
        .screen {
            background: #f5f5f5;
            position: relative;
        }

        .balance-bg {
            background: linear-gradient(135deg, #4a4a4a 0%, #2a2a2a 100%);
        }

        .main {
            overflow-y: auto;
            overflow-x: hidden;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen overflow-hidden">
    <div class="h-screen w-64 border-r border-gray-200 hidden md:block">
        <div class="flex flex-col h-full gap-4">
            <nav class="sidebar flex-1 px-3 py-4">
                <div class="flex items-center my-4">
                    <a href="#" class="flex items-center gap-2">
                        <img src="favicon.png" alt="Logo">
                        <span>CopyWavex</span>
                    </a>
                </div>
                <ul class="space-y-6">
                    <li class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg px-2 py-3 hover:shadow-lg border-gray-200">
                        <a href="#" class="flex items-center text-lg gap-2">
                            <i class="fa fa-home menu-icon"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg px-2 py-3 hover:shadow-lg border-gray-200">
                        <a href="#" class="flex items-center text-lg gap-2">
                            <i class="fa fa-chart-line menu-icon"></i>
                            Markets
                        </a>
                    </li>
                    <li class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg px-2 py-3 hover:shadow-lg border-gray-200">
                        <a href="#" class="flex items-center text-lg gap-2">
                            <i class="fa fa-chart-line menu-icon"></i>
                            Trade
                        </a>
                    </li>
                    <li class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg px-2 py-3 hover:shadow-lg border-gray-200">
                        <a href="#" class="flex items-center text-lg gap-2">
                            <i class="fa fa-user menu-icon"></i>
                            Profile
                        </a>
                    </li>
                    <li class=" border-t border-gray-200 my-8"></li>
                    <li class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg px-2 py-3 hover:shadow-lg border-gray-200">
                        <a href="#" class="flex items-center text-lg gap-2">
                            <i class="fa fa-sign-out menu-icon"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="flex flex-col gap-4 px-3">
                <!-- user name -->
                <div class="flex items-center my-4">
                    <a href="#" class="flex flex-col items-center gap-2">
                        <img src="favicon.png" alt="Logo" class="w-10 h-10 rounded-full">
                        <span><?php echo $profile['fullname']; ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="screen h-full w-full flex flex-col overflow-hidden">
        <div class="main flex-1 flex flex-col pb-32">
            <!-- Header -->
            <div class="flex items-center justify-between px-2 py-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-orange-500 rounded-full mr-3 flex items-center justify-center user-initials">
                        <span class="text-black font-semibold text-sm"><?php echo explode(" ", $profile['fullname'])[0][0].explode(" ", $profile['fullname'])[1][0]; ?></span>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-900 user-name"><?php echo $profile['fullname']; ?></h2>
                        <p class="text-sm text-gray-500 user-email"><?php echo $profile['email']; ?></p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button id="refreshBtn" class="text-gray-600 hover:text-blue-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </button>
                    <button id="logoutBtn" class="text-gray-600 hover:text-red-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Balance Card -->
            <div class="mx-2 mb-6 balance-bg rounded-lg p-2 text-white relative">
                <!-- Background pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white rounded-full -translate-y-16 translate-x-16">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-24 h-24 bg-white rounded-full translate-y-12 -translate-x-12">
                    </div>
                </div>

                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-sm opacity-80">Total Balance</span>
                        <span class="text-lg cursor-pointer" onclick="toggleBalance()">
                            <i class="fa-solid fa-eye opacity-80"></i>
                        </span>
                    </div>

                    <h1 class="text-4xl font-light mb-6" id="tb">$<?php echo number_format($profile['balance'], 2); ?></h1>
                    <h1 class="text-4xl font-light mb-6" id="tbn">****</h1>

                    <div class="flex space-x-3">
                        <a href="./deposit" class="flex items-center bg-white bg-opacity-20 px-4 py-2 rounded-full text-sm backdrop-blur">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="16"></line>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                            </svg>
                            Deposit
                        </a>
                        <a href="../withdraw" class="flex items-center bg-white bg-opacity-20 px-4 py-2 rounded-full text-sm backdrop-blur">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M12 1v6m0 6v6"></path>
                            </svg>
                            Withdraw
                        </a>
                        <a href="./profile"
                            class="flex items-center bg-white bg-opacity-20 px-3 py-2 rounded-full text-sm backdrop-blur">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Option list -->
            <div class="flex justify-between items-center my-6 w-full px-6">
                <a href="./deposit" class="flex flex-col items-center justify-center space-y-2 cursor-pointer">
                    <div class="w-12 h-12 flex items-center justify-center shadow-lg">
                        <span class="text-dark text-xs font-bold">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 text-sm">Deposit</p>
                    </div>
                </a>
                <a href="./referals" class="flex flex-col items-center justify-center space-y-2 cursor-pointer">
                    <div class="w-12 h-12 flex items-center justify-center shadow-lg">
                        <span class="text-dark text-xs font-bold">
                            <i class="fa-solid fa-users"></i>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 text-sm">Referals</p>
                    </div>
                </a>
                <a href="./copy" class="flex flex-col items-center justify-center space-y-2 cursor-pointer">
                    <div class="w-12 h-12 flex items-center justify-center shadow-lg">
                        <span class="text-dark text-xs font-bold">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 text-sm">Copy</p>
                    </div>
                </a>
                <a href="./help" class="flex flex-col items-center justify-center space-y-2 cursor-pointer">
                    <div class="w-12 h-12 flex items-center justify-center shadow-lg">
                        <span class="text-dark text-xs font-bold">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 text-sm">Help</p>
                    </div>
                </a>
            </div>

            <!-- My Coins Section -->
            <div class="px-2 mb-6">
                <div class="flex space-x-4 px-4 bg-white rounded-lg shadow-lg">
                    <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget rounded-2xl"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                            {
                                "symbols": [{
                                        "proName": "BITSTAMP:BTCUSD",
                                        "title": "Bitcoin"
                                    },
                                    {
                                        "proName": "BITSTAMP:ETHUSD",
                                        "title": "Ethereum"
                                    },
                                    {
                                        "proName": "BINANCE:SOLUSDT",
                                        "title": "Solana"
                                    }
                                ],
                                "colorTheme": "light",
                                "locale": "en",
                                "largeChartUrl": "http://localhost/copywavex/dashboard/coins/coins_info",
                                "isTransparent": true,
                                "showSymbolLogo": true
                            }
                        </script>
                    </div>
                </div>
            </div>

            <!-- List of Coins Section -->
            <div class="px-2 flex-1">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Coins</h3>
                    <button class="text-blue-500 text-sm font-medium">Manage</button>
                </div>

                <!-- Filter Tabs -->
                <div class="flex space-x-2 mb-4 overflow-x-auto">
                    <button class="px-4 py-2 bg-gray-800 text-white rounded-full text-sm whitespace-nowrap">Favorites</button>
                </div>

                <!-- Coin List -->
                <div class="space-y-4">
                    <!-- BNB -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold text-sm">B</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">
                                    BNB
                                    <span class="text-gray-500 text-sm">(BNB)</span>
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">$25,346.00</p>
                            <p class="text-red-500 text-sm">🔴 -0.23%</p>
                        </div>
                    </div>

                    <!-- Ethereum -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center mr-3">
                                <div class="w-5 h-5 bg-white transform rotate-45"></div>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Etherium <span
                                        class="text-gray-500 text-sm">(ETH)</span></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">$3,346.00</p>
                            <p class="text-green-500 text-sm">🟢 2.3%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <div class="left-0 right-0 bg-gray-900 p-4 fixed bottom-0 z-50 w-full rounded-t-2xl md:hidden">
            <div class="flex justify-between items-center">
                <div class="flex flex-col items-center">
                    <a href="./index" class="w-10 flex items-center justify-center mb-1">
                        <i class="fa fa-home text-white"></i>
                    </a>
                    <!-- <span class="text-white">Home</span> -->
                </div>

                <div class="flex flex-col items-center">
                    <a href="./markets" class="w-10 flex items-center justify-center mb-1">
                        <i class="fa fa-shop text-white"></i>
                    </a>
                    <!-- <span class="text-white">Markets</span> -->
                </div>

                <div class="flex flex-col items-center">
                    <a href="./trade" class="w-10 flex items-center justify-center mb-1">
                        <i class="fa fa fa-line-chart fa-1x text-white"></i>
                    </a>
                    <!-- <span class="text-white">Trade</span> -->
                </div>

                <div class="flex flex-col items-center">
                    <a href="./profile" class="w-10 flex items-center justify-center mb-1">
                        <i class="fa fa-user text-white"></i>
                    </a>
                    <!-- <span class="text-white">Profile</span> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery and App Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/auth.js"></script>
    <script src="js/dashboard.js"></script>
    <script>
        // Toggle balance visibility
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize balance visibility
            function initBalanceVisibility() {
                if (localStorage.getItem("balance") === "hidden") {
                    $("#tb").hide();
                    $("#tbn").show();
                } else {
                    $("#tb").show();
                    $("#tbn").hide();
                }
            }

            // Toggle balance function
            window.toggleBalance = function() {
                if (localStorage.getItem("balance") === "hidden") {
                    localStorage.setItem("balance", "visible");
                    $("#tb").show();
                    $("#tbn").hide();
                } else {
                    localStorage.setItem("balance", "hidden");
                    $("#tb").hide();
                    $("#tbn").show();
                }
            };

            // Initialize
            initBalanceVisibility();

            // Add refresh button click handler
            document.getElementById('refreshBtn').addEventListener('click', function() {
                location.reload();
            });
        });
    </script>
</body>

</html>