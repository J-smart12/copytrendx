<?php 
require_once '../includes/header.php';
$coins = $db->ListCoins();
?>

<body class="bg-gray-100 h-screen overflow-hidden">
    <!-- Step 1: Coin Selection -->
    <div id="step1" class="h-full flex flex-col">
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4 border-b bg-white">
                <div class="flex items-center">
                    <a href="index.html" class="mr-3">
                        <i class="fas fa-arrow-left text-gray-700"></i>
                    </a>
                    <h1 class="text-xl font-semibold">Select Coin</h1>
                </div>
            </div>

            <!-- Coin List -->
            <div class="p-4">
                <div class="space-y-3">
                    <?php foreach ($coins['coins'] as $coin) { 
                        $walletAddress = $coin['wallet_address'] ?? '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa';
                        $minDeposit = $coin['min_deposit'] ?? 0.001;
                    ?>
                        <button onclick="showDepositDetails('<?php echo $coin['symbol']; ?>', '<?php echo $coin['name']; ?>', '<?php echo $coin['logo']; ?>', '<?php echo $walletAddress; ?>', <?php echo $minDeposit; ?>)" 
                                class="w-full text-left bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:border-blue-300 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <img src="<?php echo $coin['logo']; ?>" alt="<?php echo $coin['symbol']; ?>" class="w-10 h-10 rounded-full">
                                    <div>
                                        <div class="font-medium text-gray-900"><?php echo $coin['name']; ?></div>
                                        <div class="text-sm text-gray-500">Min: <?php echo $minDeposit; ?> <?php echo $coin['symbol']; ?></div>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </div>
                        </button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 2: Deposit Details -->
    <div id="step2" class="h-full flex-col hidden">
        <div class="flex-1 overflow-auto">
            <!-- Header with Back Button -->
            <div class="flex items-center px-4 py-4 border-b bg-white">
                <button onclick="backToStep1()" class="mr-3">
                    <i class="fas fa-arrow-left text-gray-700"></i>
                </button>
                <h1 class="text-xl font-semibold">Deposit <span id="coinName"></span></h1>
            </div>

            <!-- Deposit Card -->
            <div class="p-4">
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <!-- Coin Info -->
                    <div class="text-center mb-6">
                        <img id="coinImage" src="" alt="" class="w-20 h-20 mx-auto mb-3">
                        <h2 class="text-lg font-semibold text-gray-900">Send only <span id="coinName2"></span> to this address</h2>
                        <p class="text-red-500 text-sm mt-1">Sending any other asset may result in permanent loss</p>
                    </div>

                    <!-- QR Code -->
                    <div class="text-center mb-6">
                        <div class="bg-white p-3 rounded-lg inline-block border border-gray-200">
                            <img id="qrCode" src="" alt="QR Code" class="w-40 h-40">
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Scan QR code or copy address below</p>
                    </div>

                    <!-- Wallet Address -->
                    <div class="mb-6">
                        <div class="relative">
                            <div class="text-xs text-gray-500 mb-1">Wallet Address</div>
                            <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg border border-gray-200">
                                <span id="walletAddress" class="text-sm font-mono break-all pr-2"></span>
                                <button onclick="copyToClipboard('walletAddress')" class="text-blue-500 hover:text-blue-600">
                                    <i class="far fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Network Info -->
                    <div class="space-y-3">
                        <div class="bg-blue-50 p-3 rounded-lg border border-blue-100">
                            <div class="flex items-start">
                                <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-2"></i>
                                <div>
                                    <p class="text-sm text-blue-700">
                                        <span class="font-medium">Network:</span> 
                                        <span id="networkName">Bitcoin (BTC)</span>
                                    </p>
                                    <p class="text-xs text-blue-600 mt-1">
                                        Confirmations required: <span class="font-medium">3</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-100">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-yellow-500 mt-0.5 mr-2"></i>
                                <div>
                                    <p class="text-xs text-yellow-700">
                                        <span class="font-medium">Minimum deposit:</span> 
                                        <span id="minDeposit"></span> <span id="coinSymbol"></span>
                                    </p>
                                    <p class="text-xs text-yellow-700 mt-1">
                                        Deposits below minimum will not be credited.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Deposits -->
                <div class="mt-4 bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                    <h3 class="font-medium text-gray-900 mb-3">Recent Deposits</h3>
                    <div class="text-center py-6 text-gray-400">
                        <i class="fas fa-history text-3xl mb-2"></i>
                        <p class="text-sm">No recent deposits</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/auth.js"></script>
    <script>
        // Check authentication on page load
        // if (!checkAuth()) {
        //     window.location.href = 'login.html';
        // }

        // Show deposit details for selected coin
        function showDepositDetails(symbol, name, image, walletAddress, minDeposit) {
            // Update UI with selected coin data
            document.getElementById('coinName').textContent = name;
            document.getElementById('coinName2').textContent = name;
            document.getElementById('coinSymbol').textContent = symbol;
            document.getElementById('coinImage').src = image;
            document.getElementById('walletAddress').textContent = walletAddress;
            document.getElementById('minDeposit').textContent = minDeposit;
            
            // Generate QR code
            const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(walletAddress)}`;
            document.getElementById('qrCode').src = qrCodeUrl;
            
            // Update network name
            document.getElementById('networkName').textContent = `${name} (${symbol})`;
            
            // Show step 2, hide step 1
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            document.getElementById('step2').classList.add('flex');
        }

        // Go back to coin selection
        function backToStep1() {
            document.getElementById('step1').classList.remove('hidden');
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step2').classList.remove('flex');
        }

        // Copy to clipboard function
        function copyToClipboard(elementId) {
            const element = document.getElementById(elementId);
            const textToCopy = element.textContent || element.value;
            
            navigator.clipboard.writeText(textToCopy).then(() => {
                // Show copied feedback
                const button = event.currentTarget;
                const originalHTML = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i>';
                button.classList.remove('text-blue-500', 'hover:text-blue-600');
                button.classList.add('text-green-500');
                
                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.classList.remove('text-green-500');
                    button.classList.add('text-blue-500', 'hover:text-blue-600');
                }, 2000);
            });
        }
    </script>
</body>
</html>
