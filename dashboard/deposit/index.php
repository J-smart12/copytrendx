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
                <!-- <input type="text" id="search" placeholder="Search coins..." class="w-1/2 px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"> -->
                 <input type="hidden" id="userid" value="<?php echo $profile['userid']; ?>">
            </div>

            <!-- Coin List -->
            <div class="p-4">
                <div class="space-y-3">
                    <?php foreach ($coins['coins'] as $coin) {
                        $walletAddress = $coin['wallet_address'] ?? '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa';
                        $minDeposit = $coin['min_deposit'] ?? 0.001;
                    ?>
                        <button onclick="showReviewStep('<?php echo $coin['symbol']; ?>', '<?php echo $coin['name']; ?>', '<?php echo $coin['logo']; ?>', '<?php echo $walletAddress; ?>', <?php echo $minDeposit; ?>)"
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

    <!-- Step 2: Review and Confirm -->
    <div id="step2" class="h-full flex-col hidden">
        <div class="flex-1 overflow-auto">
            <div class="flex items-center px-4 py-4 border-b bg-white">
                <button onclick="backToStep1()" class="mr-3">
                    <i class="fas fa-arrow-left text-gray-700"></i>
                </button>
                <h1 class="text-xl font-semibold">Review Deposit</h1>
            </div>

            <div class="p-4">
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-4">
                    <h2 class="text-lg font-semibold mb-4">Confirm Deposit Details</h2>

                    <div class="space-y-4">
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <img id="reviewCoinImage" src="" alt="" class="w-12 h-12 rounded-full mr-3">
                            <div>
                                <div class="font-medium" id="reviewCoinName"></div>
                                <div class="text-sm text-gray-500">Selected Asset</div>
                            </div>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-lg">
                            <div class="text-sm text-gray-500 mb-1">Minimum Deposit</div>
                            <div class="font-medium" id="reviewMinDeposit"></div>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-lg">
                            <div class="text-sm text-gray-500 mb-1">Amount</div>
                            <input type="number" name="amount" min="0" id="amount" placeholder="Enter amount" class="w-full p-2 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 mb-3" required>
                        </div>

                        <div class="p-3 bg-blue-50 rounded-lg border border-blue-100">
                            <div class="flex items-start">
                                <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-2"></i>
                                <div class="text-sm text-blue-700">
                                    Please ensure you're sending the correct asset to the deposit address.
                                    Sending a different asset may result in permanent loss.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3">
                        <button onclick="proceedToDeposit()" class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                            Continue to Deposit
                        </button>
                        <button onclick="backToStep1()" class="w-full bg-white text-gray-700 py-3 rounded-lg font-medium border border-gray-300 hover:bg-gray-50 transition-colors">
                            Back to Selection
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 3: Deposit Details -->
    <div id="step3" class="h-full flex-col hidden">
        <div class="flex-1 overflow-auto">
            <div class="flex items-center px-4 py-4 border-b bg-white">
                <button onclick="backToReview()" class="mr-3">
                    <i class="fas fa-arrow-left text-gray-700"></i>
                </button>
                <h1 class="text-xl font-semibold">Deposit <span id="coinName"></span></h1>
            </div>

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

                    
                        <!-- Payment Proof Upload -->
                        <div id="paymentProofUpload" class="hidden p-3 bg-gray-50 rounded-lg">
                            <div class="text-sm text-gray-500 mb-2">Payment Proof (Screenshot/Receipt)</div>
                            <div class="flex items-center justify-center w-full">
                                <label for="paymentProof" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="uploadArea">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, or JPEG (MAX. 5MB)</p>
                                    </div>
                                    <input id="paymentProof" name="paymentProof" type="file" class="hidden" accept="image/*" onchange="previewImage(this)">
                                </label>
                            </div>
                            <!-- Image Preview -->
                            <div id="imagePreviewContainer" class="mt-3 hidden">
                                <p class="text-sm text-gray-500 mb-2">Preview:</p>
                                <div class="relative w-32 h-32 border rounded-lg overflow-hidden">
                                    <img id="imagePreview" src="#" alt="Preview" class="w-full h-full object-cover">
                                    <button type="button" onclick="removeImage()" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                            </div>
                            <button id="paidButton2" class="my-4 w-full bg-blue-600 text-white py-4 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                Proceed <i class="fas fa-arrow-right ml-2" aria-hidden="true" id="paidButton2Icon"></i>
                            </button>
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
                            <div class="mt-2">
                                <p class="text-xs text-yellow-700">
                                    <span class="font-medium">Minimum deposit:</span>
                                    <span id="minDeposit"></span> <span id="coinSymbol"></span>
                                </p>
                                <p class="text-xs text-yellow-700 mt-4">
                                    Once deposit has been made click on the button below to proceed to the next step.
                                    <button id="paidButton" class="mt-2 w-full bg-blue-600 text-white py-4 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                        I have paid
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/auth.js"></script>
    <script>
        // Store selected coin data and file
        let selectedCoin = null;
        let paymentProofFile = null;

        // Preview uploaded image
        function previewImage(input) {
            const file = input.files[0];
            if (file) {
                // Validate file size (5MB max)
                const maxSize = 5 * 1024 * 1024; // 5MB
                if (file.size > maxSize) {
                    alert('File size exceeds 5MB limit');
                    input.value = ''; // Clear the input
                    return;
                }
                
                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    alert('Please upload a valid image file (JPEG, JPG, PNG)');
                    input.value = ''; // Clear the input
                    return;
                }
                
                paymentProofFile = file;
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreviewContainer').classList.remove('hidden');
                    document.getElementById('uploadArea').classList.add('hidden');
                }
                
                reader.readAsDataURL(file);
            }
        }

        // Remove selected image
        function removeImage() {
            document.getElementById('paymentProof').value = '';
            document.getElementById('imagePreviewContainer').classList.add('hidden');
            document.getElementById('uploadArea').classList.remove('hidden');
            paymentProofFile = null;
        }

        // Show review step with selected coin
        function showReviewStep(symbol, name, image, walletAddress, minDeposit) {
            selectedCoin = {
                symbol,
                name,
                image,
                walletAddress,
                minDeposit,
            };

            // Update review step UI
            document.getElementById('reviewCoinImage').src = image;
            document.getElementById('reviewCoinName').textContent = `${name} (${symbol})`;
            document.getElementById('reviewMinDeposit').textContent = `${minDeposit} ${symbol}`;
            document.getElementById('amount').setAttribute('min', minDeposit);

            // Show review step, hide others
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            document.getElementById('step2').classList.add('flex');
        }

        // Proceed to deposit details
        function proceedToDeposit() {
            if (!selectedCoin) return;
            selectedCoin.amount = document.getElementById('amount').value;
            selectedCoin.userid = document.getElementById('userid').value;

            if(selectedCoin.amount < selectedCoin.minDeposit ){
                alert('Deposit amount must be greater than or equal to minimum deposit amount');
                return;
            }
            if(!selectedCoin.amount){
                alert('Deposit amount is required');
                return;
            }


            // Update deposit details UI
            document.getElementById('coinName').textContent = selectedCoin.name;
            document.getElementById('coinName2').textContent = selectedCoin.name;
            document.getElementById('coinSymbol').textContent = selectedCoin.symbol;
            document.getElementById('coinImage').src = selectedCoin.image;
            document.getElementById('walletAddress').textContent = selectedCoin.walletAddress;
            document.getElementById('minDeposit').textContent = selectedCoin.minDeposit;

            // Generate QR code
            const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(selectedCoin.walletAddress)}`;
            document.getElementById('qrCode').src = qrCodeUrl;

            // Update network name
            document.getElementById('networkName').textContent = `${selectedCoin.name} (${selectedCoin.symbol})`;

            // Show deposit details, hide review
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step2').classList.remove('flex');
            document.getElementById('step3').classList.remove('hidden');
            document.getElementById('step3').classList.add('flex');
        }

        // Navigation functions
        function backToStep1() {
            document.getElementById('step1').classList.remove('hidden');
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step2').classList.remove('flex');
        }

        function backToReview() {
            document.getElementById('step2').classList.remove('hidden');
            document.getElementById('step2').classList.add('flex');
            document.getElementById('step3').classList.add('hidden');
            document.getElementById('step3').classList.remove('flex');
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

        function paid() {
            if (!selectedCoin) return;
            let formData = new FormData();
            formData.append('userid', selectedCoin.userid);
            formData.append('amount', selectedCoin.amount);
            formData.append('name', selectedCoin.name);
            formData.append('symbol', selectedCoin.symbol);
            formData.append('wallet', selectedCoin.walletAddress);
            formData.append('image', paymentProofFile);
            $("#paidButton2Icon").removeClass('fa-arrow-right').addClass('fa-spinner fa-spin');

            $.ajax({
                url: '../../phpapiserver/user/deposit',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    setTimeout(() => {
                        window.location.href = '../../dashboard/history';
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    $("#paidButton2Icon").removeClass('fa-spinner fa-spin').addClass('fa-arrow-right');
                },
                complete: function() {
                    $("#paidButton2Icon").removeClass('fa-spinner fa-spin').addClass('fa-check');
                }
            });
        }

        $("#paidButton").on('click', function(e) {
            e.preventDefault();
            $("#paymentProofUpload").removeClass('hidden');
            $("#paidButton").addClass('hidden');
        });

        $("#paidButton2").on('click', function(e) {
            e.preventDefault();
            paid();
        });
    </script>
</body>

</html>