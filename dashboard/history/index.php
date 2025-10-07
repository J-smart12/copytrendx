<?php
require_once '../includes/header.php';
$stats = $db->stats($profile['userid']);
$deposits = $db->getDeposits($profile['userid']);
$withdrawals = $db->getWithdraws($profile['userid']);
$transactions = $stats['transactions'];
?>

<body class="bg-gray-100 flex items-center justify-center h-screen overflow-hidden">
    <!-- side bar nav -->
    <?php include '../includes/sidebar_navigation.php'; ?>  
    <div class="screen h-full w-full flex flex-col overflow-hidden">
        <!-- Header -->
        <div class="bg-white border-b">
            <div class="flex items-center justify-between px-4 py-4">
                <div class="flex items-center">
                    <a href="../home/" class="mr-3">
                        <i class="fas fa-arrow-left text-gray-700"></i>
                    </a>
                    <h1 class="text-xl font-semibold">Transaction History</h1>
                </div>
                <div class="flex items-center space-x-2">
                    <button id="filterButton" class="p-2 text-gray-600 hover:bg-gray-100 rounded-full">
                        <i class="fas fa-filter"></i>
                    </button>
                    <button id="exportButton" class="p-2 text-gray-600 hover:bg-gray-100 rounded-full">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
            </div>
        </div>
 
        <!-- Main Content -->
        <div class="flex-1 overflow-auto p-4">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Transactions</p>
                            <h3 class="text-2xl font-semibold" id="totalTransactions"><?php echo $stats['count']; ?></h3>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-full">
                            <i class="fas fa-exchange-alt text-blue-500 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Deposits</p>
                            <h3 class="text-2xl font-semibold text-green-600" id="totalDeposits"><?php echo $deposits['count']; ?></h3>
                        </div>
                        <div class="p-3 bg-green-50 rounded-full">
                            <i class="fas fa-arrow-down text-green-500 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Withdrawals</p>
                            <h3 class="text-2xl font-semibold text-red-600" id="totalWithdrawals"><?php echo $withdrawals['count']; ?></h3>
                        </div>
                        <div class="p-3 bg-red-50 rounded-full">
                            <i class="fas fa-arrow-up text-red-500 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <h2 class="text-lg font-medium">Recent Transactions</h2>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table id="transactionsTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($transactions as $transaction) { ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $transaction['description']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $transaction['amount']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?php if($transaction['status'] == 0) { ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        <?php } elseif($transaction['status'] == 1) { ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                        <?php } elseif($transaction['status'] == 2) { ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Failed</span>
                                        <?php } ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $transaction['createdAt']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-blue-600 hover:text-blue-900" onclick="viewTransaction(<?php echo $transaction['id']; ?>)">View</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php include '../includes/bottom_navigation.php'; ?>
    </div>

    <!-- View Transaction Modal -->
    <div id="transactionModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl w-full max-w-md mx-4">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium" id="modalTitle">Transaction Details</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="space-y-4" id="transactionDetails">
                    <!-- Transaction details will be loaded here -->
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $("#transactionsTable").DataTable({
            "order": [[ 0, "desc" ]],
            "export": true,
            "exportButtons": [
                {
                    "extend": "excelHtml5",
                    "text": "Export to Excel",
                    "className": "btn btn-primary"
                }
            ]
        });

        // View transaction details
        function viewTransaction(id) {
            const modal = document.getElementById('transactionModal');
            const details = document.getElementById('transactionDetails');
            
            // Simulate loading data
            details.innerHTML = `
                <div class="animate-pulse space-y-4">
                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-4 bg-gray-200 rounded"></div>
                    <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                </div>
            `;
            
            modal.classList.remove('hidden');
            
            // Simulate API call
            $.ajax({
                url: '../../phpapiserver/user/transaction/single',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ id:id }),
                success: function(data) {
                    details.innerHTML = `
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Transaction ID</p>
                            <p class="font-medium">${data.tranx_id}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Amount</p>
                            <p class="font-medium text-green-600">$${Number(data.amount).toFixed(2)}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <p>
                                ${data.status==1?'<span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">Completed</span>':data.status==2?'<span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-red-100 text-red-800">Failed</span>':'<span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>'}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Date</p>
                            <p>${data.createdAt}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Description</p>
                            <p>${data.description}</p>
                        </div>
                    </div>
                `;
                }
            });
        }

        // Close modal
        function closeModal() {
            document.getElementById('transactionModal').classList.add('hidden');
        }
    </script>
</body>
</html>