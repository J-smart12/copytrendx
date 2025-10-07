<?php
require_once '../includes/header.php';
?>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-bg': '#1a1a1a',
                        'sidebar-bg': '#2a2a2a',
                        'green-accent': '#00d4aa',
                        'red-accent': '#ff6b6b'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background: #1a1a1a;
            font-family: 'Inter', sans-serif;
        }
        .crypto-item:hover {
            background: rgba(255,255,255,0.05);
        }
        .order-row:hover {
            background: rgba(255,255,255,0.02);
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
<body class="bg-dark-bg text-white overflow-hidden">
    <div class="flex h-screen">
        <!-- Main Trading Area -->
        <div class="flex-1 flex flex-col">
            <!-- Chart Tabs -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-700">
                <div class="flex items-center space-x-6">
                    <button class="text-green-accent border-b-2 border-green-accent pb-2">Chart</button>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-400 text-sm">Price</span>
                        <span class="text-white text-sm">Change</span>
                    </div>
                </div>
                <div>
                    <div class="text-gray-400 text-xs mb-1">Trading Balance</div>
                    <div class="text-white">$<?php echo number_format($profile['trading_balance']); ?></div>
                </div>
            </div>

            <!-- Chart Area -->
            <div class="flex-1 flex flex-col md:flex-row overflow-hidden">
                <!-- Trading Chart -->
                <div class="w-full relative bg-gray-900 h-[700px] md:h-full">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container" style="height:100%;width:100%">
                        <div class="tradingview-widget-container__widget" style="height:calc(100% - 32px);width:100%"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>

                        {
                        "allow_symbol_change": true,
                        "calendar": false,
                        "details": false,
                        "hide_side_toolbar": true,
                        "hide_top_toolbar": false,
                        "hide_legend": false,
                        "hide_volume": false,
                        "hotlist": false,
                        "interval": "D",
                        "locale": "en",
                        "save_image": true,
                        "style": "1",
                        "symbol": "BINANCE:<?php echo strtoupper($_GET['coin']); ?>USD",
                        "theme": "dark",
                        "timezone": "Etc/UTC",
                        "backgroundColor": "#0F0F0F",
                        "gridColor": "rgba(242, 242, 242, 0.06)",
                        "watchlist": [],
                        "withdateranges": false,
                        "compareSymbols": [],
                        "studies": [],
                        "autosize": true
                        }
                        </script>
                    </div>
                    <!-- TradingView Widget END -->
                </div>

                <!-- Right Panel - Order Book & Trading -->
                <div class="w-full md:w-80 border-l border-gray-700 flex flex-col overflow-auto">
                    <!-- Order Book Header -->
                    <div class="p-4 border-b border-gray-700 flex justify-between items-center">
                        <div class="flex justify-between items-center">
                            <a href="../trade/trade_history.html" class="text-white font-medium">
                                <i class="fas fa-history"></i>
                            </a>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <a class="text-white font-medium" href="../home">
                                <i class="fas fa-home"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Trading Panel -->
                    <form class="border-t border-gray-700 p-4" id="tradeForm">
                        <input type="hidden" id="coin" name="coin" value="<?php echo strip_tags(strtoupper($_GET['coin'])); ?>">
                        <input type="hidden" id="user" name="user" value="<?php echo $_SESSION['user']; ?>">
                        <div class="space-y-3 text-sm">
                            <div>
                                <div class="text-gray-400 text-xs mb-1">Amount</div>
                                <div class="text-white"></div>
                                <input type="text" id="amount" name="amount" placeholder="0.0000" class="w-full bg-gray-800 text-white px-3 py-2 rounded border border-gray-700 focus:border-green-accent outline-none text-sm" required>
                            </div>
                            
                            <div>
                                <div class="text-gray-400 text-xs mb-1">Leverage</div>
                                <select id="leverage" name="leverage" class="w-full bg-gray-800 text-white px-3 py-2 rounded border border-gray-700 focus:border-green-accent outline-none text-sm">
                                    <option value="1" selected>1x</option>
                                    <option value="5">5x</option>
                                    <option value="10">10x</option>
                                    <option value="20">20x</option>
                                    <option value="50">50x</option>
                                    <option value="75">75x</option>
                                    <option value="100">100x</option>
                                </select>
                            </div>
                            <div>

                            <div class="text-gray-400 text-xs mb-1">Time</div>
                                <select name="time" id="time" class="w-full bg-gray-800 text-white px-3 py-2 rounded border border-gray-700 focus:border-green-accent outline-none text-sm">
                                    <option value="1" selected>1m</option>
                                    <option value="3">3m</option>
                                    <option value="5">5m</option>
                                    <option value="15">15m</option>
                                    <option value="30">30m</option>
                                    <option value="60">1h</option>
                                    <option value="1440">1d</option>
                                </select>
                            </div>
                            
                            <div>
                                <div class="text-gray-400 text-xs mb-1">Margin</div>
                                <input type="text" name="margin" id="margin" placeholder="75%" class="w-full bg-gray-800 text-white px-3 py-2 rounded border border-gray-700 focus:border-green-accent outline-none text-sm">
                            </div>
                            
                            <div>
                                <div class="text-gray-400 text-xs mb-1">TP</div>
                                <input type="text" name="tp" id="tp" placeholder="75%" class="w-full bg-gray-800 text-white px-3 py-2 rounded border border-gray-700 focus:border-green-accent outline-none text-sm">
                            </div>
                            
                            <div>
                                <div class="text-gray-400 text-xs mb-1">SL</div>
                                <input type="text" name="sl" id="sl" placeholder="75%" class="w-full bg-gray-800 text-white px-3 py-2 rounded border border-gray-700 focus:border-green-accent outline-none text-sm">
                            </div>
                        </div>
                        <div class="flex space-x-2 mt-4">
                            <button class="flex-1 bg-green-accent text-black py-2 rounded font-medium" type="submit" name="buy" id="buy">Buy</button>
                            <button class="flex-1 bg-red-700 text-white py-2 rounded" type="submit" name="sell" id="sell">Sell</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tradeForm').submit(function(e) {
                e.preventDefault();
                let formData = {
                    coin: $('#coin').val(),
                    user: $('#user').val(),
                    amount: $('#amount').val(),
                    leverage: $('#leverage').val(),
                    time: $('#time').val(),
                    margin: $('#margin').val(),
                    tp: $('#tp').val(),
                    sl: $('#sl').val(),
                    action: e.originalEvent.submitter.name
                };
                $('#buy').prop('disabled', true);
                $('#sell').prop('disabled', true);
                $.ajax({
                    url: '../../phpapiserver/user/trade',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    success: function(response) {
                        console.log(response);
                        if(response.status == 'success') {
                            swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            });
                            $('#buy').prop('disabled', false);
                            $('#sell').prop('disabled', false);
                        }else if(response.status == 'Error') {
                            swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                            $('#buy').prop('disabled', false);
                            $('#sell').prop('disabled', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error
                        });
                        $('#buy').prop('disabled', false);
                        $('#sell').prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>