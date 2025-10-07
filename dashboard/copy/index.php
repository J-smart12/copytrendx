<?php
require_once '../includes/header.php';
// In a real implementation, you would fetch traders from the database here
// $traders = $db->getTraders();
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
                    <h1 class="text-xl font-semibold">Copy Traders</h1>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="relative">
                        <input type="text" id="searchTraders" placeholder="Search traders..." 
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 p-4">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Total Traders</p>
                                <h3 class="text-2xl font-semibold">127</h3>
                            </div>
                            <div class="p-3 bg-blue-50 rounded-full">
                                <i class="fas fa-users text-blue-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Active Copiers</p>
                                <h3 class="text-2xl font-semibold">2,843</h3>
                            </div>
                            <div class="p-3 bg-green-50 rounded-full">
                                <i class="fas fa-user-check text-green-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Avg. Monthly ROI</p>
                                <h3 class="text-2xl font-semibold text-green-600">8.7%</h3>
                            </div>
                            <div class="p-3 bg-purple-50 rounded-full">
                                <i class="fas fa-chart-line text-purple-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Total Volume</p>
                                <h3 class="text-2xl font-semibold">$12.4M</h3>
                            </div>
                            <div class="p-3 bg-yellow-50 rounded-full">
                                <i class="fas fa-dollar-sign text-yellow-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-white rounded-xl p-4 mb-6 shadow-sm border border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium text-gray-700">Filter by:</span>
                            <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>All Traders</option>
                                <option>Top Performers</option>
                                <option>Low Risk</option>
                                <option>High Risk</option>
                            </select>
                            <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>All Strategies</option>
                                <option>Swing Trading</option>
                                <option>Day Trading</option>
                                <option>Scalping</option>
                                <option>HODL</option>
                            </select>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium text-gray-700">Sort by:</span>
                            <select id="sortTraders" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="roi-desc">Highest ROI</option>
                                <option value="roi-asc">Lowest ROI</option>
                                <option value="trades-desc">Most Trades</option>
                                <option value="winrate-desc">Highest Win Rate</option>
                                <option value="risk-low">Lowest Risk</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Traders Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php
                    // Sample trader data - replace with actual database query
                    $traders = [
                        [
                            'id' => 1,
                            'name' => 'Alex Johnson',
                            'username' => '@cryptoking',
                            'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg',
                            'roi' => 245.7,
                            'win_rate' => 78.3,
                            'total_trades' => 1247,
                            'min_investment' => 100,
                            'risk_level' => 'medium',
                            'strategy' => 'Swing Trading',
                            'copiers' => 842,
                            'profit_30d' => 12.4,
                            'profit_90d' => 38.7,
                            'profit_all' => 245.7,
                            'max_drawdown' => 8.2,
                            'copied' => false,
                            'verified' => true
                        ],
                        [
                            'id' => 2,
                            'name' => 'Sarah Miller',
                            'username' => '@cryptoguru',
                            'avatar' => 'https://randomuser.me/api/portraits/women/44.jpg',
                            'roi' => 189.2,
                            'win_rate' => 82.1,
                            'total_trades' => 987,
                            'min_investment' => 250,
                            'risk_level' => 'low',
                            'strategy' => 'Day Trading',
                            'copiers' => 1256,
                            'profit_30d' => 8.7,
                            'profit_90d' => 29.5,
                            'profit_all' => 189.2,
                            'max_drawdown' => 5.4,
                            'copied' => true,
                            'verified' => true
                        ],
                        [
                            'id' => 3,
                            'name' => 'Mike Chen',
                            'username' => '@bitcoinbull',
                            'avatar' => 'https://randomuser.me/api/portraits/men/75.jpg',
                            'roj' => 312.5,
                            'win_rate' => 68.9,
                            'total_trades' => 2156,
                            'min_investment' => 500,
                            'risk_level' => 'high',
                            'strategy' => 'Scalping',
                            'copiers' => 567,
                            'profit_30d' => 18.9,
                            'profit_90d' => 52.1,
                            'profit_all' => 312.5,
                            'max_drawdown' => 15.7,
                            'copied' => false,
                            'verified' => false
                        ]
                    ];

                    foreach ($traders as $trader) {
                        $riskColor = [
                            'low' => 'text-green-500',
                            'medium' => 'text-yellow-500',
                            'high' => 'text-red-500'
                        ][$trader['risk_level']];
                        
                        $riskText = ucfirst($trader['risk_level']);
                        $roiColor = $trader['roi'] >= 0 ? 'text-green-500' : 'text-red-500';
                        $roiSign = $trader['roi'] >= 0 ? '+' : '';
                    ?>
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <!-- Trader Header -->
                        <div class="p-4 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="relative">
                                        <img src="<?php echo $trader['avatar']; ?>" alt="Trader" class="w-12 h-12 rounded-full object-cover">
                                        <?php if ($trader['verified']): ?>
                                        <div class="absolute -bottom-1 -right-1 bg-blue-500 text-white rounded-full p-0.5">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900"><?php echo $trader['name']; ?></h3>
                                        <p class="text-sm text-gray-500"><?php echo $trader['username']; ?></p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold <?php echo $roiColor; ?>">
                                        <?php echo $roiSign . $trader['roi']; ?>%
                                    </div>
                                    <div class="text-xs text-gray-500">Total ROI</div>
                                </div>
                            </div>
                        </div>

                        <!-- Trader Stats -->
                        <div class="p-4 space-y-3">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-sm text-gray-500">Win Rate</div>
                                    <div class="font-medium"><?php echo $trader['win_rate']; ?>%</div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Total Trades</div>
                                    <div class="font-medium"><?php echo number_format($trader['total_trades']); ?></div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Min. Investment</div>
                                    <div class="font-medium">$<?php echo number_format($trader['min_investment']); ?></div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Risk Level</div>
                                    <div class="font-medium <?php echo $riskColor; ?>">
                                        <?php echo $riskText; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2">
                                <div class="flex justify-between text-xs text-gray-500 mb-1">
                                    <span>30d: <span class="font-medium text-green-500">+<?php echo $trader['profit_30d']; ?>%</span></span>
                                    <span>90d: <span class="font-medium text-green-500">+<?php echo $trader['profit_90d']; ?>%</span></span>
                                    <span>All: <span class="font-medium text-green-500">+<?php echo $trader['profit_all']; ?>%</span></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-2">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-users mr-1"></i>
                                    <span><?php echo number_format($trader['copiers']); ?> copiers</span>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <span class="font-medium"><?php echo $trader['strategy']; ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="px-4 pb-4">
                            <?php if ($trader['copied']): ?>
                                <button class="w-full bg-gray-100 text-gray-700 py-2 px-4 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-check-circle mr-2"></i> Copied
                                </button>
                            <?php else: ?>
                                <button onclick="showCopyModal(<?php echo htmlspecialchars(json_encode($trader), ENT_QUOTES, 'UTF-8'); ?>)" 
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                                    <i class="fas fa-copy mr-2"></i> Copy Trader
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    <nav class="inline-flex rounded-md shadow-sm -space-x-px">
                        <a href="#" class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            Previous
                        </a>
                        <a href="#" class="px-3 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-blue-600 hover:bg-blue-50">
                            1
                        </a>
                        <a href="#" class="px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            2
                        </a>
                        <a href="#" class="px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            3
                        </a>
                        <span class="px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                            ...
                        </span>
                        <a href="#" class="px-3 py-2 border-t border-b border-r border-gray-300 rounded-r-md bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            Next
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <?php include '../includes/bottom_navigation.php'; ?>
    </div>

    <!-- Copy Trader Modal -->
    <div id="copyTraderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl w-full max-w-md mx-4">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Copy Trader</h3>
                    <button onclick="closeCopyModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div id="traderInfo" class="mb-6">
                    <!-- Trader info will be inserted here by JavaScript -->
                </div>
                
                <form id="copyTraderForm" class="space-y-4">
                    <input type="hidden" name="trader_id" id="traderId">
                    <input type="hidden" name="user_id" value="<?php echo $profile['userid']; ?>">
                    
                    <div>
                        <label for="investmentAmount" class="block text-sm font-medium text-gray-700 mb-1">
                            Investment Amount ($)
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="amount" id="investmentAmount" required
                                min="0" step="0.01"
                                class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-lg"
                                placeholder="0.00">
                        </div>
                        <p class="mt-1 text-xs text-gray-500" id="minInvestmentText"></p>
                    </div>
                    
                    <div>
                        <label for="riskLevel" class="block text-sm font-medium text-gray-700 mb-1">
                            Risk Level
                        </label>
                        <select id="riskLevel" name="risk_level" required
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg">
                            <option value="low">Low (Conservative)</option>
                            <option value="medium" selected>Medium (Balanced)</option>
                            <option value="high">High (Aggressive)</option>
                        </select>
                    </div>
                    
                    <div class="pt-2">
                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            Confirm & Start Copying
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Sample trader data - in a real app, this would come from your API
        let currentTrader = null;

        // Show copy trader modal with trader details
        function showCopyModal(trader) {
            currentTrader = trader;
            document.getElementById('traderId').value = trader.id;
            document.getElementById('investmentAmount').value = trader.min_investment;
            document.getElementById('minInvestmentText').textContent = `Minimum investment: $${trader.min_investment}`;
            
            // Update trader info in modal
            const traderInfo = document.getElementById('traderInfo');
            traderInfo.innerHTML = `
                <div class="flex items-center space-x-4 mb-4">
                    <img src="${trader.avatar}" alt="${trader.name}" class="w-12 h-12 rounded-full">
                    <div>
                        <h4 class="font-medium text-gray-900">${trader.name}</h4>
                        <p class="text-sm text-gray-500">${trader.username}</p>
                    </div>
                    <div class="ml-auto text-right">
                        <div class="text-xl font-bold ${trader.roi >= 0 ? 'text-green-500' : 'text-red-500'}">
                            ${trader.roi >= 0 ? '+' : ''}${trader.roi}%
                        </div>
                        <div class="text-xs text-gray-500">Total ROI</div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 text-center text-sm">
                    <div>
                        <div class="font-medium">${trader.win_rate}%</div>
                        <div class="text-gray-500">Win Rate</div>
                    </div>
                    <div>
                        <div class="font-medium">${trader.total_trades.toLocaleString()}</div>
                        <div class="text-gray-500">Trades</div>
                    </div>
                    <div>
                        <div class="font-medium">${trader.copiers.toLocaleString()}</div>
                        <div class="text-gray-500">Copiers</div>
                    </div>
                </div>
            `;
            
            // Show the modal
            document.getElementById('copyTraderModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        // Close copy trader modal
        function closeCopyModal() {
            document.getElementById('copyTraderModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Handle copy trader form submission
        document.getElementById('copyTraderForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());
            
            // In a real app, you would send this to your backend
            console.log('Copying trader:', data);
            
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: `You are now copying ${currentTrader.name}. Your trades will be executed automatically.`,
                confirmButtonText: 'Got it!'
            });
            
            // Close the modal
            closeCopyModal();
            
            // Update the UI to show the trader is being copied
            // In a real app, you would update this after a successful API response
            const copyButton = document.querySelector(`[onclick*="${currentTrader.id}"]`);
            if (copyButton) {
                copyButton.outerHTML = `
                    <button class="w-full bg-gray-100 text-gray-700 py-2 px-4 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                        <i class="fas fa-check-circle mr-2"></i> Copied
                    </button>
                `;
            }
        });
        
        // Search functionality
        document.getElementById('searchTraders').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const traderCards = document.querySelectorAll('.bg-white.rounded-xl');
            
            traderCards.forEach(card => {
                const name = card.querySelector('h3').textContent.toLowerCase();
                const username = card.querySelector('p.text-gray-500').textContent.toLowerCase();
                
                if (name.includes(searchTerm) || username.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
        
        // Sort functionality
        document.getElementById('sortTraders').addEventListener('change', function(e) {
            const sortBy = e.target.value;
            const container = document.querySelector('.grid.grid-cols-1');
            const cards = Array.from(container.children);
            
            cards.sort((a, b) => {
                const aRoi = parseFloat(a.querySelector('[data-roi]').dataset.roi);
                const bRoi = parseFloat(b.querySelector('[data-roi]').dataset.roi);
                
                if (sortBy === 'roi-desc') return bRoi - aRoi;
                if (sortBy === 'roi-asc') return aRoi - bRoi;
                
                // Add more sorting options as needed
                return 0;
            });
            
            // Re-append cards in new order
            cards.forEach(card => container.appendChild(card));
        });
    </script>
</body>
</html>