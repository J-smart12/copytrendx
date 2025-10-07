<?php
require_once '../includes/header.php';
// In a real implementation, you would fetch referral data from the database here
// $referralStats = $db->getReferralStats($profile['userid']);
// $referredUsers = $db->getReferredUsers($profile['userid']);
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
                    <h1 class="text-xl font-semibold">Refer & Earn</h1>
                </div>
                <button onclick="showReferralGuide()" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-question-circle mr-1"></i> How it works
                </button>
            </div>

            <!-- Main Content -->
            <div class="flex-1 p-4 overflow-y-auto">
                <!-- Referral Stats -->
                <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Total Referrals</p>
                                <h3 class="text-3xl font-bold">24</h3>
                            </div>
                            <div class="text-3xl opacity-80">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-blue-400 border-opacity-30">
                            <div class="flex justify-between text-sm">
                                <span>Active</span>
                                <span class="font-medium">18</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Total Earned</p>
                                <h3 class="text-3xl font-bold">$1,245</h3>
                            </div>
                            <div class="text-3xl opacity-80">
                                <i class="fas fa-coins"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-purple-300 border-opacity-30">
                            <div class="flex justify-between text-sm">
                                <span>This Month</span>
                                <span class="font-medium">$245</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-green-500 to-teal-500 rounded-xl p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Pending Rewards</p>
                                <h3 class="text-3xl font-bold">$320</h3>
                            </div>
                            <div class="text-3xl opacity-80">
                                <i class="fas fa-gift"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-green-300 border-opacity-30">
                            <div class="flex justify-between text-sm">
                                <span>Next Payout</span>
                                <span class="font-medium">Oct 15, 2025</span>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Referral Link & Sharing -->
                <div class="bg-white rounded-xl p-6 mb-6 shadow-sm border border-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Your Referral Link</h2>
                    <div class="flex flex-col space-y-3">
                        <div class="flex">
                            <input type="text" id="referralLink" readonly 
                                value="https://copywavex.com/ref/<?php echo $profile['username'] ?? 'user123'; ?>"
                                class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <button onclick="copyReferralLink()" 
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 rounded-r-lg transition-colors">
                                <i class="fas fa-copy"></i> Copy
                            </button>
                        </div>
                        <p class="text-sm text-gray-500">Earn 20% of your referrals' trading fees for life!</p>
                    </div>

                    <!-- Social Sharing -->
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">Share via</h3>
                        <div class="flex space-x-3">
                            <button onclick="shareOnSocial('twitter')" class="w-12 h-12 rounded-full bg-blue-400 hover:bg-blue-500 text-white flex items-center justify-center transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </button>
                            <button onclick="shareOnSocial('facebook')" class="w-12 h-12 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center transition-colors">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </button>
                            <button onclick="shareOnSocial('telegram')" class="w-12 h-12 rounded-full bg-blue-500 hover:bg-blue-600 text-white flex items-center justify-center transition-colors">
                                <i class="fab fa-telegram-plane text-xl"></i>
                            </button>
                            <button onclick="shareOnSocial('whatsapp')" class="w-12 h-12 rounded-full bg-green-500 hover:bg-green-600 text-white flex items-center justify-center transition-colors">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </button>
                            <button onclick="shareOnSocial('email')" class="w-12 h-12 rounded-full bg-gray-500 hover:bg-gray-600 text-white flex items-center justify-center transition-colors">
                                <i class="fas fa-envelope text-xl"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Promo Materials -->
                <!-- <div class="bg-white rounded-xl p-6 mb-6 shadow-sm border border-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Promotional Materials</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="border border-gray-200 rounded-lg p-4 text-center hover:shadow-md transition-shadow">
                            <div class="bg-blue-50 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-image text-blue-500 text-xl"></i>
                            </div>
                            <h4 class="font-medium">Banners</h4>
                            <p class="text-sm text-gray-500 mt-1">Download banners for your website</p>
                            <button class="mt-3 text-blue-500 text-sm font-medium hover:text-blue-700">
                                Download <i class="fas fa-arrow-down ml-1"></i>
                            </button>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4 text-center hover:shadow-md transition-shadow">
                            <div class="bg-purple-50 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-file-alt text-purple-500 text-xl"></i>
                            </div>
                            <h4 class="font-medium">Email Templates</h4>
                            <p class="text-sm text-gray-500 mt-1">Pre-written email templates</p>
                            <button class="mt-3 text-blue-500 text-sm font-medium hover:text-blue-700">
                                View Templates <i class="fas fa-external-link-alt ml-1"></i>
                            </button>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4 text-center hover:shadow-md transition-shadow">
                            <div class="bg-green-50 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-bullhorn text-green-500 text-xl"></i>
                            </div>
                            <h4 class="font-medium">Social Media Posts</h4>
                            <p class="text-sm text-gray-500 mt-1">Ready-to-post content</p>
                            <button class="mt-3 text-blue-500 text-sm font-medium hover:text-blue-700">
                                Get Content <i class="fas fa-external-link-alt ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div> -->

                <!-- Referred Users -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                        <h2 class="text-lg font-semibold">Your Referrals</h2>
                        <div class="mt-2 sm:mt-0">
                            <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>All Time</option>
                                <option>This Month</option>
                                <option>Last 7 Days</option>
                                <option>Active</option>
                            </select>
                        </div>
                    </div>

                    <div class="overflow-x-auto
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Joined</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trading Volume</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Your Earnings</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php
                                // Sample data - replace with actual database query
                                $referredUsers = [
                                    ['name' => 'Alex Johnson', 'email' => 'alex@example.com', 'date' => '2025-09-15', 'status' => 'Active', 'volume' => 12500, 'earnings' => 125],
                                    ['name' => 'Sarah Miller', 'email' => 'sarah@example.com', 'date' => '2025-09-22', 'status' => 'Active', 'volume' => 8700, 'earnings' => 87],
                                    ['name' => 'Mike Chen', 'email' => 'mike@example.com', 'date' => '2025-10-01', 'status' => 'Pending', 'volume' => 3200, 'earnings' => 32],
                                    ['name' => 'Emma Davis', 'email' => 'emma@example.com', 'date' => '2025-10-03', 'status' => 'Active', 'volume' => 15300, 'earnings' => 153],
                                    ['name' => 'James Wilson', 'email' => 'james@example.com', 'date' => '2025-10-05', 'status' => 'Inactive', 'volume' => 0, 'earnings' => 0],
                                ];

                                foreach ($referredUsers as $user) {
                                    $statusClass = [
                                        'Active' => 'bg-green-100 text-green-800',
                                        'Pending' => 'bg-yellow-100 text-yellow-800',
                                        'Inactive' => 'bg-gray-100 text-gray-800'
                                    ][$user['status']];
                                    
                                    $initials = '';
                                    $nameParts = explode(' ', $user['name']);
                                    foreach ($nameParts as $part) {
                                        $initials .= strtoupper(substr($part, 0, 1));
                                    }
                                    $initials = substr($initials, 0, 2);
                                    
                                    $colors = ['bg-blue-500', 'bg-purple-500', 'bg-green-500', 'bg-yellow-500', 'bg-red-500'];
                                    $colorIndex = array_rand($colors);
                                    $bgColor = $colors[$colorIndex];
                                ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full <?php echo $bgColor; ?> flex items-center justify-center text-white font-medium">
                                                <?php echo $initials; ?>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900"><?php echo $user['name']; ?></div>
                                                <div class="text-sm text-gray-500"><?php echo $user['email']; ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo date('M j, Y', strtotime($user['date'])); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $statusClass; ?>">
                                            <?php echo $user['status']; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        $<?php echo number_format($user['volume']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                                        $<?php echo number_format($user['earnings'], 2); ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <?php include '../includes/bottom_navigation.php'; ?>
    </div>

    <!-- Referral Guide Modal -->
    <div id="referralGuideModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl w-full max-w-2xl mx-4 max-h-[80vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">How It Works</h3>
                    <button onclick="closeReferralGuide()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-lg mr-4">1</div>
                        <div>
                            <h4 class="font-medium text-gray-900">Share Your Referral Link</h4>
                            <p class="mt-1 text-gray-600">Copy your unique referral link or share it directly through social media, email, or messaging apps.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-500 text-white flex items-center justify-center font-bold text-lg mr-4">2</div>
                        <div>
                            <h4 class="font-medium text-gray-900">Friends Sign Up & Trade</h4>
                            <p class="mt-1 text-gray-600">Your friends sign up using your link and start trading on CopyWaveX.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-500 text-white flex items-center justify-center font-bold text-lg mr-4">3</div>
                        <div>
                            <h4 class="font-medium text-gray-900">Earn Commissions</h4>
                            <p class="mt-1 text-gray-600">Earn 20% of the trading fees generated by your referrals for their entire lifetime on our platform.</p>
                        </div>
                    </div>
                    
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h4 class="font-medium text-blue-800">Pro Tip</h4>
                        <p class="mt-1 text-blue-700">The more active your referrals are in trading, the more you earn. Share your link with friends who are interested in cryptocurrency trading to maximize your earnings!</p>
                    </div>
                    
                    <div class="pt-2">
                        <button onclick="closeReferralGuide()" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            Got it, thanks!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show referral guide modal
        function showReferralGuide() {
            document.getElementById('referralGuideModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        // Close referral guide modal
        function closeReferralGuide() {
            document.getElementById('referralGuideModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Copy referral link to clipboard
        function copyReferralLink() {
            const referralLink = document.getElementById('referralLink');
            referralLink.select();
            document.execCommand('copy');
            
            // Show success message
            const originalText = event.target.innerHTML;
            event.target.innerHTML = '<i class="fas fa-check"></i> Copied!';
            event.target.classList.remove('bg-blue-500', 'hover:bg-blue-600');
            event.target.classList.add('bg-green-500', 'hover:bg-green-600');
            
            // Reset button after 2 seconds
            setTimeout(() => {
                event.target.innerHTML = originalText;
                event.target.classList.remove('bg-green-500', 'hover:bg-green-600');
                event.target.classList.add('bg-blue-500', 'hover:bg-blue-600');
            }, 2000);
        }
        
        // Share on social media
        function shareOnSocial(platform) {
            const referralLink = document.getElementById('referralLink').value;
            const message = `Join me on CopyWaveX and start trading cryptocurrencies! Use my referral link to get started: ${referralLink}`;
            
            let url = '';
            
            switch(platform) {
                case 'twitter':
                    url = `https://twitter.com/intent/tweet?text=${encodeURIComponent(message)}`;
                    break;
                case 'facebook':
                    url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(referralLink)}&quote=${encodeURIComponent(message)}`;
                    break;
                case 'telegram':
                    url = `https://t.me/share/url?url=${encodeURIComponent(referralLink)}&text=${encodeURIComponent('Join me on CopyWaveX!')}`;
                    break;
                case 'whatsapp':
                    url = `https://wa.me/?text=${encodeURIComponent(message)}`;
                    break;
                case 'email':
                    url = `mailto:?subject=Join me on CopyWaveX&body=${encodeURIComponent(message)}`;
                    break;
            }
            
            window.open(url, '_blank', 'width=600,height=400');
        }
        
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize any tooltips if needed
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>