<?php 
 require_once '../includes/header.php';
 $coins = $db->ListCoins();
?>


<body class="bg-dark-bg text-black flex items-center justify-center h-screen overflow-hidden">
    <!-- side bar nav -->
    <?php include '../includes/sidebar_navigation.php'; ?>
    <div class="screen h-full w-full flex flex-col overflow-hidden">
        <div class="main flex-1 flex flex-col overflow-y-auto scrollbar-hide">
            <!-- Header -->
            <?php include '../includes/top_header.php'; ?>

            <!-- List of Coins Section -->
            <div class="px-2 flex-1">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Manage Coins</h3>
                </div>

                <!-- Filter Tabs -->
                <div class="flex space-x-2 mb-4 overflow-x-auto">
                    <button class="px-4 py-2 bg-gray-800 text-white rounded-full text-sm whitespace-nowrap">Favorites</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-full text-sm whitespace-nowrap">Trending</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-full text-sm whitespace-nowrap">
                        Market cap
                    </button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-full text-sm whitespace-nowrap">Price</button>
                </div>

                <!-- Coin List -->
                <div class="w-full bg-sidebar-bg flex flex-col">
                        <!-- Crypto List -->
                        <div class="flex-1">
                            <!-- Crypto Items -->
                            <?php foreach ($coins['coins'] as $coin) { ?>
                                <a href="../trade/?coin=<?php echo $coin['symbol']; ?>" class="crypto-item px-4 py-2 cursor-pointer">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <img src="<?php echo $coin['logo']; ?>" alt="<?php echo $coin['name']; ?>" class="w-8 h-8 rounded-full">
                                            <div>
                                                <div class="text-black text-sm font-medium"><?php echo $coin['name']; ?></div>
                                                <div class="text-black text-xs"><?php echo $coin['volume']; ?></div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-black text-sm">$<?php echo number_format($coin['price'], 2); ?></div>
                                            <div class="text-green-accent text-xs"><?php echo $coin['symbol']; ?></div>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <?php include '../includes/bottom_navigation.php'; ?>
    </div>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // Toggle balance visibility
        if (localStorage.getItem("balance") === "hidden") {
            $("#tb").hide();
            $("#tbn").show();
        } else {
            $("#tb").show();
            $("#tbn").hide();
        }
        function toggleBalance() {
            // use local storage to save the state
            if (localStorage.getItem("balance") === "hidden") {
                localStorage.setItem("balance", "visible");
                $("#tb").show();
                $("#tbn").hide();
            } else {
                localStorage.setItem("balance", "hidden");
                $("#tb").hide();
                $("#tbn").show();
            }
        }

    </script>
</body>

</html>