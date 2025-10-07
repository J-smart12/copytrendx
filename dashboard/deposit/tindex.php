<?php 
 require_once '../includes/header.php';
 $coins = $db->ListCoins();
?>

<body class="bg-gray-100 flex items-center justify-center h-screen overflow-hidden">
    <div class="h-screen"></div>
    <div class="screen screen1 h-full w-full flex flex-col overflow-hidden">
        <div class="main flex-1 flex flex-col overflow-auto">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4 border-b">
                <div class="flex items-center">
                    <a href="index.html" class="mr-3">
                        <i class="fas fa-arrow-left text-gray-700"></i>
                    </a>
                    <h1 class="text-xl font-semibold">Deposit Funds</h1>
                </div>
                <div class="w-10"></div> <!-- Spacer for balance -->
            </div>

            <!-- Deposit Form -->
            <div class="p-4">
                <div class="bg-white rounded-xl p-4 shadow-sm mb-4">
                    <?php foreach ($coins['coins'] as $coin) { ?>
                        <button class="crypto-item px-4 py-2 cursor-pointer shadow-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <img src="<?php echo $coin['image']; ?>" alt="<?php echo $coin['name']; ?>" class="w-8 h-8 rounded-full">
                                    <div>
                                        <div class="text-black text-sm font-medium"><?php echo $coin['name']; ?></div>
                                        <div class="text-black text-xs"><?php echo $coin['volume']; ?></div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-black text-sm"><?php echo number_format($coin['price'], 2); ?></div>
                                    <div class="text-green-accent text-xs"><?php echo $coin['short_name']; ?></div>
                                </div>
                            </div>
                        </button>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <!-- <div class="left-0 right-0 bg-gray-900 p-4">
            <div class="flex justify-between items-center">
                <a href="index.html" class="text-gray-400 hover:text-white">
                    <i class="fas fa-home text-xl"></i>
                </a>
                <a href="markets.html" class="text-gray-400 hover:text-white">
                    <i class="fas fa-chart-line text-xl"></i>
                </a>
                <a href="deposit.html" class="text-blue-400">
                    <div class="bg-blue-900 p-3 rounded-full -mt-8">
                        <i class="fas fa-plus text-white text-xl"></i>
                    </div>
                </a>
                <a href="miners_list.html" class="text-gray-400 hover:text-white">
                    <i class="fas fa-cube text-xl"></i>
                </a>
                <a href="profile.html" class="text-gray-400 hover:text-white">
                    <i class="fas fa-user text-xl"></i>
                </a>
            </div>
        </div> -->
    </div>
    <div class="screen screen2 h-full w-full flex flex-col overflow-hidden">
        <div class="main flex-1 flex flex-col overflow-auto">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4 border-b">
                <div class="flex items-center">
                    <a href="index.html" class="mr-3">
                        <i class="fas fa-arrow-left text-gray-700"></i>
                    </a>
                    <h1 class="text-xl font-semibold">Deposit Funds</h1>
                </div>
                <div class="w-10"></div> <!-- Spacer for balance -->
            </div>

            <!-- Deposit Form -->
            <div class="p-4">
                <div class="bg-white rounded-xl p-4 shadow-sm mb-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Coin</label>
                        <div class="relative">
                            <select class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>Bitcoin (BTC)</option>
                                <option>Ethereum (ETH)</option>
                                <option>USDT (TRC20)</option>
                                <option>USDT (ERC20)</option>
                                <option>Litecoin (LTC)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deposit Amount</label>
                        <div class="relative">
                            <input type="number" placeholder="0.00" 
                                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <div class="absolute right-3 top-3 text-gray-500">USD</div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Minimum deposit: $10.00</p>
                    </div>

                    <div class="bg-blue-50 p-3 rounded-lg mb-4">
                        <p class="text-sm text-blue-800">
                            <i class="fas fa-info-circle mr-1"></i>
                            Send only <span class="font-semibold">BTC</span> to this deposit address. Sending any other coin may result in permanent loss.
                        </p>
                    </div>

                    <div class="text-center mb-4">
                        <div class="bg-white p-4 rounded-lg inline-block mb-3">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=bitcoin:1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa" 
                                alt="Deposit QR Code" class="w-40 h-40 mx-auto">
                        </div>
                        <p class="text-sm text-gray-600">Scan QR code or copy address below</p>
                    </div>

                    <div class="relative mb-6">
                        <input type="text" readonly value="1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa" 
                            class="w-full p-3 pr-10 bg-gray-100 rounded-lg text-sm font-mono text-center" id="depositAddress">
                        <button onclick="copyToClipboard('depositAddress')" 
                            class="absolute right-2 top-2 p-1 text-gray-500 hover:text-blue-500">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>

                    <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-200">
                        <h4 class="font-medium text-yellow-800 mb-1">Important Notice</h4>
                        <p class="text-xs text-yellow-700">
                            For your security, deposits may take 3-6 network confirmations before being credited to your account.
                            The current network fee is <span class="font-medium">0.0005 BTC</span>.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <h3 class="font-medium text-gray-900 mb-3">Deposit History</h3>
                    <div class="text-center py-8 text-gray-400">
                        <i class="fas fa-history text-3xl mb-2"></i>
                        <p>No recent deposits</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <!-- <div class="left-0 right-0 bg-gray-900 p-4">
            <div class="flex justify-between items-center">
                <a href="index.html" class="text-gray-400 hover:text-white">
                    <i class="fas fa-home text-xl"></i>
                </a>
                <a href="markets.html" class="text-gray-400 hover:text-white">
                    <i class="fas fa-chart-line text-xl"></i>
                </a>
                <a href="deposit.html" class="text-blue-400">
                    <div class="bg-blue-900 p-3 rounded-full -mt-8">
                        <i class="fas fa-plus text-white text-xl"></i>
                    </div>
                </a>
                <a href="miners_list.html" class="text-gray-400 hover:text-white">
                    <i class="fas fa-cube text-xl"></i>
                </a>
                <a href="profile.html" class="text-gray-400 hover:text-white">
                    <i class="fas fa-user text-xl"></i>
                </a>
            </div>
        </div> -->
    </div>


    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/auth.js"></script>
    <script>
        // Check authentication on page load
        // if (!checkAuth()) {
        //     window.location.href = 'login.html';
        // }

        // Copy to clipboard function
        function copyToClipboard(elementId) {
            const element = document.getElementById(elementId);
            element.select();
            document.execCommand('copy');
            
            // Show copied feedback
            const copyBtn = element.nextElementSibling;
            const originalIcon = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fas fa-check"></i>';
            copyBtn.classList.add('text-green-500');
            
            setTimeout(() => {
                copyBtn.innerHTML = originalIcon;
                copyBtn.classList.remove('text-green-500');
            }, 2000);
        }
    </script>
</body>
</html>