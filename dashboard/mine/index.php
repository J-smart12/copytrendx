<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mining - Crypto Trading App</title>
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
        .balance-bg {
            background: linear-gradient(135deg, #4a4a4a 0%, #2a2a2a 100%);
        }
        .miner-card {
            transition: all 0.3s ease;
        }
        .miner-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen overflow-hidden">
    <!-- <div class="h-screen"></div> -->
    <?php include '../includes/sidebar_navigation.php'; ?>
    <div class="screen h-full w-full flex flex-col overflow-hidden">
        <div class="main flex-1 flex flex-col overflow-auto">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4 border-b">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold">Mining</h1>
                </div>
                <div class="flex items-center space-x-3">
                    <button class="text-gray-600">
                        <i class="fas fa-history"></i>
                    </button>
                    <button class="text-gray-600">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
            </div>
            <?php include '../includes/top_navigation.php'; ?>

            <!-- Mining Stats -->
            <div class="p-4">
                <div class="bg-white rounded-xl p-4 shadow-sm mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Mining Overview</h2>
                        <span class="text-sm bg-green-100 text-green-800 px-2 py-1 rounded-full">Active</span>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="text-center">
                            <p class="text-sm text-gray-500">Hashrate</p>
                            <p class="text-lg font-semibold">245.7 TH/s</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-500">Active Miners</p>
                            <p class="text-lg font-semibold">3/5</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-500">24h Reward</p>
                            <p class="text-lg font-semibold">0.0021 BTC</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-500 mb-1">
                            <span>Daily Profit</span>
                            <span>$24.50</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 78%"></div>
                        </div>
                    </div>
                </div>

                <!-- Active Miners -->
                <h3 class="text-lg font-semibold mb-3 px-2">Active Miners</h3>
                <div class="space-y-3 mb-6">
                    <!-- Miner 1 -->
                    <div class="bg-white rounded-xl p-4 shadow-sm miner-card">
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-server text-blue-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium">Bitmain Antminer S19 Pro</h4>
                                    <p class="text-xs text-gray-500">Mining: <span class="text-green-500">Running</span></p>
                                </div>
                            </div>
                            <span class="text-sm font-medium">110 TH/s</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2 text-center text-xs mt-3">
                            <div class="bg-gray-50 p-2 rounded">
                                <p class="text-gray-500">Temp</p>
                                <p class="font-medium">68°C</p>
                            </div>
                            <div class="bg-gray-50 p-2 rounded">
                                <p class="text-gray-500">Uptime</p>
                                <p class="font-medium">12d 6h</p>
                            </div>
                            <div class="bg-gray-50 p-2 rounded">
                                <p class="text-gray-500">Efficiency</p>
                                <p class="font-medium text-green-500">98%</p>
                            </div>
                        </div>
                    </div>

                    <!-- Miner 2 -->
                    <div class="bg-white rounded-xl p-4 shadow-sm miner-card">
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-server text-blue-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium">Whatsminer M30S++</h4>
                                    <p class="text-xs text-gray-500">Mining: <span class="text-green-500">Running</span></p>
                                </div>
                            </div>
                            <span class="text-sm font-medium">112 TH/s</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2 text-center text-xs mt-3">
                            <div class="bg-gray-50 p-2 rounded">
                                <p class="text-gray-500">Temp</p>
                                <p class="font-medium">72°C</p>
                            </div>
                            <div class="bg-gray-50 p-2 rounded">
                                <p class="text-gray-500">Uptime</p>
                                <p class="font-medium">8d 14h</p>
                            </div>
                            <div class="bg-gray-50 p-2 rounded">
                                <p class="text-gray-500">Efficiency</p>
                                <p class="font-medium text-yellow-500">89%</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Available Miners -->
                <h3 class="text-lg font-semibold mb-3 px-2">Available Miners</h3>
                <div class="grid grid-cols-2 gap-4">
                    <!-- Miner 3 -->
                    <div class="bg-white rounded-xl p-4 shadow-sm text-center miner-card">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-server text-blue-500 text-2xl"></i>
                        </div>
                        <h4 class="font-medium">Bitmain S19j Pro</h4>
                        <p class="text-sm text-gray-500 mb-3">100 TH/s</p>
                        <div class="text-left text-xs space-y-1 mb-3">
                            <p class="flex justify-between"><span>Power:</span> <span class="font-medium">2950W</span></p>
                            <p class="flex justify-between"><span>Efficiency:</span> <span class="font-medium">29.5 J/TH</span></p>
                            <p class="flex justify-between"><span>Daily Profit:</span> <span class="font-medium text-green-500">$8.24</span></p>
                        </div>
                        <button class="w-full bg-blue-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors" onclick="activateMiner('s19j-pro')">
                            Activate Miner
                        </button>
                    </div>

                    <!-- Miner 4 -->
                    <div class="bg-white rounded-xl p-4 shadow-sm text-center miner-card opacity-50">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-lock text-gray-400 text-2xl"></i>
                        </div>
                        <h4 class="font-medium text-gray-400">Avalon A1246</h4>
                        <p class="text-sm text-gray-400 mb-3">90 TH/s</p>
                        <p class="text-xs text-gray-400 mb-3">Unlocks at 0.01 BTC</p>
                        <button class="w-full bg-gray-200 text-gray-500 py-2 rounded-lg text-sm font-medium cursor-not-allowed" disabled>
                            Locked
                        </button>
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
        // Check authentication on page load
        // if (!checkAuth()) {
        //     window.location.href = 'login.html';
        // }

        // Function to simulate miner activation
        function activateMiner(minerId) {
            // In a real app, this would make an API call to activate the miner
            alert(`Activating miner ${minerId}...`);
            // Update UI to show miner as active
        }
    </script>
</body>
</html>
