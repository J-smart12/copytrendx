<?php
require_once '../includes/header.php';
// In a real implementation, you would fetch wallet and transaction data from the database here
// $walletBalance = $db->getWalletBalance($profile['userid']);
// $withdrawalHistory = $db->getWithdrawalHistory($profile['userid']);
?>

<body class="bg-gray-100 flex items-center justify-center h-screen overflow-hidden">
    <?php include '../includes/sidebar_navigation.php'; ?>
    <div class="screen h-full w-full flex flex-col overflow-hidden">
        <div class="main flex-1 flex flex-col overflow-auto">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4 border-b">
                <div class="flex items-center">
                    <a href="../home/" class="mr-3">
                        <i class="fas fa-arrow-left text-gray-700"></i>
                    </a>
                    <h1 class="text-xl font-semibold">Withdraw Funds</h1>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="../transactions/" class="text-blue-500 text-sm font-medium">
                        <i class="fas fa-history mr-1"></i> History
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 p-4 overflow-y-auto">
                <!-- Balance Overview -->
                <div class="bg-white rounded-xl p-6 mb-6 shadow-sm border border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Available Balance</p>
                            <h2 class="text-3xl font-bold text-gray-900">$12,450.75</h2>
                            <p class="text-sm text-gray-500 mt-1">≈ 0.3456 BTC</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <div class="flex space-x-3
                            <div class="flex space-x-3">
                                <button class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium transition-colors">
                                    <i class="fas fa-plus mr-2"></i> Deposit
                                </button>
                                <button class="px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-lg font-medium transition-colors">
                                    <i class="fas fa-exchange-alt mr-2"></i> Transfer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Withdrawal Form -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h2 class="text-lg font-semibold mb-4">Withdraw Funds</h2>
                            
                            <!-- Network Selection -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Network</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <button class="network-option flex items-center justify-center p-3 border-2 border-blue-500 rounded-lg bg-blue-50">
                                        <img src="https://cryptologos.cc/logos/bitcoin-btc-logo.png" alt="Bitcoin" class="w-6 h-6 mr-2">
                                        <span>Bitcoin (BTC)</span>
                                    </button>
                                    <button class="network-option flex items-center justify-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                                        <img src="https://cryptologos.cc/logos/ethereum-eth-logo.png" alt="Ethereum" class="w-6 h-6 mr-2">
                                        <span>Ethereum (ETH)</span>
                                    </button>
                                    <button class="network-option flex items-center justify-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                                        <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" alt="Tether" class="w-6 h-6 mr-2">
                                        <span>USDT (ERC20)</span>
                                    </button>
                                    <button class="network-option flex items-center justify-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                                        <i class="fas fa-ellipsis-h text-gray-400"></i>
                                        <span class="ml-2">More</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Withdrawal Form -->
                            <form id="withdrawForm" class="space-y-4">
                                <!-- Amount -->
                                <div>
                                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" name="amount" id="amount" required
                                            class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 pr-12 py-3 sm:text-sm border-gray-300 rounded-lg"
                                            placeholder="0.00">
                                        <div class="absolute inset-y-0 right-0 flex items-center">
                                            <span class="text-gray-500 text-sm pr-3">USD</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between mt-1">
                                        <span class="text-xs text-gray-500">Min: $10.00</span>
                                        <span class="text-xs text-gray-500">Max: $10,000.00</span>
                                    </div>
                                    <div class="mt-2">
                                        <div class="flex justify-between text-xs text-gray-500">
                                            <span>Available: $12,450.75</span>
                                            <button type="button" onclick="setMaxAmount()" class="text-blue-500 hover:text-blue-700">
                                                Max
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Wallet Address -->
                                <div>
                                    <label for="walletAddress" class="block text-sm font-medium text-gray-700 mb-1">Wallet Address</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input type="text" name="walletAddress" id="walletAddress" required
                                            class="focus:ring-blue-500 focus:border-blue-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-lg"
                                            placeholder="Enter wallet address">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <button type="button" onclick="showAddressBook()" class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-address-book"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Make sure the address is correct and supports the selected network.</p>
                                </div>

                                <!-- Network Fee -->
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Network Fee</span>
                                        <span class="font-medium">0.0005 BTC ≈ $15.00</span>
                                    </div>
                                    <div class="flex justify-between text-sm mt-1">
                                        <span class="text-gray-500">You'll receive</span>
                                        <span class="font-semibold text-green-600">0.0341 BTC ≈ $1,000.00</span>
                                    </div>
                                </div>

                                <!-- 2FA Verification -->
                                <div class="pt-2">
                                    <label for="verificationCode" class="block text-sm font-medium text-gray-700 mb-1">2FA Code</label>
                                    <input type="text" name="verificationCode" id="verificationCode" required
                                        class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-lg"
                                        placeholder="Enter 6-digit code">
                                    <p class="mt-1 text-xs text-gray-500">Enter the code from your authenticator app.</p>
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-2">
                                    <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                                        <i class="fas fa-paper-plane mr-2"></i> Withdraw Now
                                    </button>
                                </div>

                                <!-- Security Notice -->
                                <div class="mt-4 p-3 bg-yellow-50 border-l-4 border-yellow-400 rounded-r">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-exclamation-circle text-yellow-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-yellow-700">
                                                For security reasons, withdrawals may take up to 24 hours to process. Large withdrawals may require additional verification.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Recent Withdrawals -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h2 class="text-lg font-semibold mb-4">Recent Withdrawals</h2>
                            
                            <div class="space-y-4">
                                <?php
                                // Sample withdrawal history - replace with actual database query
                                $withdrawals = [
                                    ['amount' => 500, 'currency' => 'BTC', 'status' => 'Completed', 'date' => '2025-10-05 14:32', 'txid' => '3FZbgi29...1dQ2L5']
                                ];

                                foreach ($withdrawals as $withdrawal) {
                                    $statusClass = [
                                        'Completed' => 'bg-green-100 text-green-800',
                                        'Pending' => 'bg-yellow-100 text-yellow-800',
                                        'Failed' => 'bg-red-100 text-red-800'
                                    ][$withdrawal['status']];
                                ?>
                                <div class="border border-gray-100 rounded-lg p-3 hover:bg-gray-50">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="font-medium"><?php echo $withdrawal['amount']; ?> <?php echo $withdrawal['currency']; ?></div>
                                            <div class="text-xs text-gray-500"><?php echo date('M j, Y H:i', strtotime($withdrawal['date'])); ?></div>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded-full <?php echo $statusClass; ?>">
                                            <?php echo $withdrawal['status']; ?>
                                        </span>
                                    </div>
                                    <div class="mt-2 text-xs text-gray-500 truncate">
                                        TXID: <?php echo $withdrawal['txid']; ?>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <!-- View All Link -->
                                <div class="text-center mt-4">
                                    <a href="../transactions/" class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                                        View All Transactions <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Fee Information -->
                            <div class="mt-8">
                                <h3 class="text-sm font-medium text-gray-700 mb-2">Withdrawal Fees</h3>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Bitcoin (BTC)</span>
                                            <span>0.0005 BTC</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Ethereum (ETH)</span>
                                            <span>0.01 ETH</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">USDT (ERC20)</span>
                                            <span>10 USDT</span>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-xs text-gray-500">Fees are subject to change based on network conditions.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <?php include '../includes/bottom_navigation.php'; ?>
    </div>

    <!-- Address Book Modal -->
    <div id="addressBookModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl w-full max-w-md mx-4">
            <div class="p-4 border-b">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium">Saved Addresses</h3>
                    <button onclick="closeAddressBook()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-4 max-h-96 overflow-y-auto">
                <div class="space-y-3">
                    <div class="border border-gray-200 rounded-lg p-3 hover:bg-blue-50 cursor-pointer">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="font-medium">My Ledger</div>
                                <div class="text-xs text-gray-500">bc1qxy2kgdy49...a0gnq</div>
                            </div>
                            <i class="fas fa-check-circle text-blue-500"></i>
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-3 hover:bg-gray-50 cursor-pointer">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="font-medium">Binance</div>
                                <div class="text-xs text-gray-500">3FZbgi29...1dQ2L5</div>
                            </div>
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-3 hover:bg-gray-50 cursor-pointer">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="font-medium">Cold Storage</div>
                                <div class="text-xs text-gray-500">1A1zP1eP5...U2WbDWEc</div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="mt-4 w-full border-2 border-dashed border-gray-300 rounded-lg py-3 text-blue-500 hover:bg-blue-50 transition-colors">
                    <i class="fas fa-plus mr-2"></i> Add New Address
                </button>
            </div>
        </div>
    </div>

    <script>
        // Set max amount
        function setMaxAmount() {
            document.getElementById('amount').value = '10000.00';
            updateReceiveAmount();
        }
        
        // Update receive amount when amount changes
        document.getElementById('amount').addEventListener('input', updateReceiveAmount);
        
        function updateReceiveAmount() {
            // In a real app, you would calculate this based on the current rate and fees
            const amount = parseFloat(document.getElementById('amount').value) || 0;
            const fee = 15; // Example fee
            const receiveAmount = amount - fee;
            
            // Update UI
            document.querySelector('.receive-amount').textContent = `$${receiveAmount.toFixed(2)}`;
        }
        
        // Address book modal
        function showAddressBook() {
            document.getElementById('addressBookModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeAddressBook() {
            document.getElementById('addressBookModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Handle form submission
        document.getElementById('withdrawForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());
            
            // Validate amount
            const amount = parseFloat(data.amount);
            if (amount < 10 || amount > 10000) {
                alert('Amount must be between $10 and $10,000');
                return;
            }
            
            // In a real app, you would send this to your backend
            console.log('Withdrawal request:', data);
            
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Withdrawal Requested',
                text: 'Your withdrawal request has been submitted and is being processed.',
                confirmButtonText: 'OK'
            });
            
            // Reset form
            this.reset();
        });
        
        // Network selection
        document.querySelectorAll('.network-option').forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.network-option').forEach(opt => {
                    opt.classList.remove('border-blue-500', 'bg-blue-50');
                    opt.classList.add('border-gray-300', 'hover:bg-gray-50');
                });
                this.classList.remove('border-gray-300', 'hover:bg-gray-50');
                this.classList.add('border-blue-500', 'bg-blue-50');
                
                // Update network fee and other details based on selected network
                // This is a simplified example
                const network = this.textContent.trim();
                console.log('Selected network:', network);
            });
        });
    </script>
</body>
</html>