<?php
include '../includes/header.php';
?>
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

<body class="bg-gray-100 flex items-center justify-center h-screen overflow-hidden">
    <!-- side bar nav -->
    <?php include '../includes/sidebar_navigation.php'; ?>
    <div class="screen h-full w-full flex flex-col overflow-hidden">
        <div class="main flex-1 flex flex-col pb-32">
            <!-- Header -->
            <?php include '../includes/top_header.php'; ?>

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
                        <a href="../deposit" class="flex items-center bg-white bg-opacity-20 px-4 py-2 rounded-full text-sm backdrop-blur">
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
                        <a href="../profile"
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
                <a href="../deposit" class="flex flex-col items-center justify-center space-y-2 cursor-pointer">
                    <div class="w-12 h-12 flex items-center justify-center shadow-lg">
                        <span class="text-dark text-xs font-bold">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 text-sm">Deposit</p>
                    </div>
                </a>
                <a href="../referrals" class="flex flex-col items-center justify-center space-y-2 cursor-pointer">
                    <div class="w-12 h-12 flex items-center justify-center shadow-lg">
                        <span class="text-dark text-xs font-bold">
                            <i class="fa-solid fa-users"></i>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 text-sm">Referals</p>
                    </div>
                </a>
                <a href="../mine" class="flex flex-col items-center justify-center space-y-2 cursor-pointer">
                    <div class="w-12 h-12 flex items-center justify-center shadow-lg">
                        <span class="text-dark text-xs font-bold">
                            <i class="fa-solid fa-cube"></i>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 text-sm">Mining</p>
                    </div>
                </a>
                <a href="../copy" class="flex flex-col items-center justify-center space-y-2 cursor-pointer">
                    <div class="w-12 h-12 flex items-center justify-center shadow-lg">
                        <span class="text-dark text-xs font-bold">
                            <i class="fa-solid fa-copy"></i>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 text-sm">Copy</p>
                    </div>
                </a>
                <a href="../help" class="flex flex-col items-center justify-center space-y-2 cursor-pointer">
                    <div class="w-12 h-12 flex items-center justify-center shadow-lg">
                        <span class="text-dark text-xs font-bold">
                            <i class="fa-solid fa-question"></i>
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
                    <?php
                    $coins = [];
                    if (is_array($favCoins) && isset($favCoins['favCoins']) && is_array($favCoins['favCoins'])) {
                        $coins = $favCoins['favCoins'];
                    }

                    if (!empty($coins)) {
                        foreach ($coins as $coin) { ?>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white font-bold text-sm"><?php echo $coin['short_name']; ?></span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900"><?php echo $coin['name']; ?></p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900"><?php echo number_format($coin['price'], 2); ?></p>
                                    <p class="text-red-500 text-sm">🔴 -0.23%</p>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="text-center py-8 text-gray-500">
                            <p>No favorite coins found. Add some coins to your favorites!</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php include '../includes/bottom_navigation.php'; ?>
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