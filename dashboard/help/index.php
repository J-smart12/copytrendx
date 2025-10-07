<?php
require_once '../includes/header.php';
// In a real implementation, you would fetch tickets from the database here
// $tickets = $db->getTickets($profile['userid']);
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
                    <h1 class="text-xl font-semibold">Help & Support</h1>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 p-4">
                <!-- Support Options -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center mr-4">
                                <i class="fas fa-headset text-blue-500 text-xl"></i>
                            </div>
                            <h3 class="text-lg font-medium">24/7 Support</h3>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Our support team is available around the clock to assist you with any issues or questions.</p>
                        <a href="mailto:support@copywavex.com" class="text-blue-500 text-sm font-medium">Contact Support</a>
                    </div>
                    
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center mr-4">
                                <i class="fas fa-book text-green-500 text-xl"></i>
                            </div>
                            <h3 class="text-lg font-medium">Knowledge Base</h3>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Browse our comprehensive guides and tutorials to find answers to common questions.</p>
                        <a href="#" class="text-blue-500 text-sm font-medium">View Articles</a>
                    </div>
                </div>

                <!-- Ticket Management -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="text-lg font-medium">My Support Tickets</h2>
                        <button onclick="showNewTicketForm()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-plus mr-2"></i>New Ticket
                        </button>
                    </div>
                    
                    <!-- Ticket List -->
                    <div id="ticketList" class="divide-y divide-gray-100">
                        <!-- Tickets will be loaded here -->
                        <div class="p-4 text-center text-gray-500">
                            <p>Loading your support tickets...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <?php include '../includes/bottom_navigation.php'; ?>
    </div>

    <!-- New Ticket Modal -->
    <div id="newTicketModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl w-full max-w-md mx-4">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">New Support Ticket</h3>
                    <button onclick="closeNewTicketForm()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="ticketForm" class="space-y-4">
                    <input type="hidden" name="user_id" value="<?php echo $profile['userid']; ?>">
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" id="subject" name="subject" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                        <select id="department" name="department" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select a department</option>
                            <option value="technical">Technical Support</option>
                            <option value="billing">Billing & Payments</option>
                            <option value="account">Account Issues</option>
                            <option value="general">General Inquiry</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                        <select id="priority" name="priority" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea id="message" name="message" rows="4" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <label for="attachment" class="cursor-pointer">
                            <i class="fas fa-paperclip text-gray-400 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-500">Click to attach files or drag and drop</p>
                            <p class="text-xs text-gray-400 mt-1">Max file size: 5MB</p>
                            <input type="file" id="attachment" name="attachment" class="hidden" multiple>
                        </label>
                    </div>
                    
                    <div class="pt-2">
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            Submit Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Ticket Modal -->
    <div id="viewTicketModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl w-full max-w-2xl mx-4 max-h-[80vh] flex flex-col">
            <div class="p-6 overflow-y-auto flex-1">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-medium" id="ticketSubject"></h3>
                        <div class="flex items-center mt-1">
                            <span id="ticketId" class="text-sm text-gray-500 mr-3"></span>
                            <span id="ticketStatus" class="text-xs px-2 py-1 rounded-full"></span>
                        </div>
                    </div>
                    <button onclick="closeViewTicket()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <div class="flex justify-between text-sm text-gray-500 mb-2">
                        <span>Created: <span id="ticketCreated"></span></span>
                        <span>Priority: <span id="ticketPriority"></span></span>
                    </div>
                    <div id="ticketMessage" class="text-gray-700"></div>
                    
                    <div id="ticketAttachments" class="mt-4">
                        <!-- Attachments will be shown here -->
                    </div>
                </div>
                
                <div class="border-t border-gray-200 pt-4">
                    <h4 class="font-medium text-gray-700 mb-3">Conversation</h4>
                    <div id="ticketReplies" class="space-y-4">
                        <!-- Ticket replies will be shown here -->
                        <div class="text-center py-8 text-gray-400">
                            <i class="fas fa-comments text-3xl mb-2"></i>
                            <p>No replies yet. Our support team will respond shortly.</p>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <form id="replyForm" class="space-y-3">
                            <input type="hidden" name="ticket_id" id="replyTicketId">
                            <div>
                                <label for="replyMessage" class="block text-sm font-medium text-gray-700 mb-1">Your Reply</label>
                                <textarea id="replyMessage" name="message" rows="3" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Type your reply here..."></textarea>
                            </div>
                            <div class="flex justify-between items-center">
                                <label class="cursor-pointer text-blue-500 text-sm hover:text-blue-600">
                                    <i class="fas fa-paperclip mr-1"></i> Attach File
                                    <input type="file" name="attachment" class="hidden">
                                </label>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg text-sm font-medium transition-colors">
                                    Send Reply
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample ticket data - In a real app, this would come from your backend
        const sampleTickets = [
            {
                id: 'TKT-001',
                subject: 'Unable to withdraw funds',
                status: 'open',
                priority: 'high',
                department: 'technical',
                created: '2023-05-15 14:30:00',
                updated: '2023-05-15 14:30:00',
                message: 'I am unable to withdraw funds from my account. The withdrawal button seems to be disabled.',
                attachments: []
            },
            {
                id: 'TKT-002',
                subject: 'Account verification issue',
                status: 'in_progress',
                priority: 'medium',
                department: 'account',
                created: '2023-05-10 09:15:00',
                updated: '2023-05-11 11:20:00',
                message: 'I have submitted my documents for verification 5 days ago but my account is still not verified.',
                attachments: [
                    { name: 'id_proof.jpg', url: '#' },
                    { name: 'address_proof.pdf', url: '#' }
                ]
            },
            {
                id: 'TKT-003',
                subject: 'Transaction not showing in history',
                status: 'resolved',
                priority: 'medium',
                department: 'billing',
                created: '2023-05-05 16:45:00',
                updated: '2023-05-07 10:30:00',
                message: 'I made a deposit 2 hours ago but it is not showing in my transaction history. The funds were deducted from my bank account.',
                attachments: []
            }
        ];

        // Load tickets when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadTickets();
            
            // Form submission for new ticket
            document.getElementById('ticketForm').addEventListener('submit', function(e) {
                e.preventDefault();
                submitTicket();
            });
            
            // Form submission for ticket reply
            document.getElementById('replyForm').addEventListener('submit', function(e) {
                e.preventDefault();
                submitReply();
            });
        });

        // Load tickets into the UI
        function loadTickets() {
            const ticketList = document.getElementById('ticketList');

            // Fetch tickets from the server
            fetch('../../phpapiserver/user/tickets')
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // sampleTickets = data;
                    // renderTickets();
                })
                .catch(error => {
                    console.error('Error fetching tickets:', error);
                });
            
            if (sampleTickets.length === 0) {
                ticketList.innerHTML = `
                    <div class="p-8 text-center">
                        <i class="fas fa-ticket-alt text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">You don't have any support tickets yet.</p>
                        <button onclick="showNewTicketForm()" class="mt-4 text-blue-500 hover:text-blue-600 font-medium">
                            Create your first ticket
                        </button>
                    </div>
                `;
                return;
            }
            
            // let html = '';
            // sampleTickets.forEach(ticket => {
            //     const statusClass = getStatusClass(ticket.status);
            //     const priorityClass = getPriorityClass(ticket.priority);
            //     const department = formatDepartment(ticket.department);
                
            //     html += `
            //         <div class="p-4 hover:bg-gray-50 cursor-pointer border-b border-gray-100" onclick="viewTicket('${ticket.id}')">
            //             <div class="flex justify-between items-start">
            //                 <div class="flex-1 min-w-0">
            //                     <h4 class="text-base font-medium text-gray-900 truncate">${ticket.subject}</h4>
            //                     <p class="text-sm text-gray-500 mt-1">${ticket.message.substring(0, 100)}${ticket.message.length > 100 ? '...' : ''}</p>
            //                     <div class="mt-2 flex flex-wrap gap-2">
            //                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusClass}">
            //                             ${formatStatus(ticket.status)}
            //                         </span>
            //                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
            //                             ${department}
            //                         </span>
            //                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${priorityClass}">
            //                             ${formatPriority(ticket.priority)} priority
            //                         </span>
            //                     </div>
            //                 </div>
            //                 <div class="ml-4 flex-shrink-0">
            //                     <p class="text-xs text-gray-500">${formatDate(ticket.updated)}</p>
            //                 </div>
            //             </div>
            //         </div>
            //     `;
            // });
            
            ticketList.innerHTML = html;
        }
        
        // Show new ticket form
        function showNewTicketForm() {
            document.getElementById('newTicketModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        // Close new ticket form
        function closeNewTicketForm() {
            document.getElementById('newTicketModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('ticketForm').reset();
        }
        
        // View ticket details
        function viewTicket(ticketId) {
            const ticket = sampleTickets.find(t => t.id === ticketId);
            if (!ticket) return;
            
            // Update modal with ticket data
            document.getElementById('ticketSubject').textContent = ticket.subject;
            document.getElementById('ticketId').textContent = ticket.id;
            document.getElementById('ticketStatus').className = `text-xs px-2 py-1 rounded-full ${getStatusClass(ticket.status)}`;
            document.getElementById('ticketStatus').textContent = formatStatus(ticket.status);
            document.getElementById('ticketCreated').textContent = formatDateTime(ticket.created);
            document.getElementById('ticketPriority').textContent = formatPriority(ticket.priority);
            document.getElementById('ticketMessage').textContent = ticket.message;
            document.getElementById('replyTicketId').value = ticket.id;
            
            // Update attachments
            const attachmentsContainer = document.getElementById('ticketAttachments');
            if (ticket.attachments && ticket.attachments.length > 0) {
                let attachmentsHtml = '<div class="mt-3"><p class="text-sm font-medium text-gray-700 mb-2">Attachments:</p><div class="flex flex-wrap gap-2">';
                ticket.attachments.forEach(attachment => {
                    attachmentsHtml += `
                        <a href="${attachment.url}" target="_blank" class="inline-flex items-center px-3 py-1 border border-gray-200 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fas fa-paperclip mr-1 text-gray-400"></i>
                            ${attachment.name}
                        </a>
                    `;
                });
                attachmentsHtml += '</div></div>';
                attachmentsContainer.innerHTML = attachmentsHtml;
            } else {
                attachmentsContainer.innerHTML = '';
            }
            
            // Show the modal
            document.getElementById('viewTicketModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        // Close view ticket modal
        function closeViewTicket() {
            document.getElementById('viewTicketModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Submit new ticket
        function submitTicket() {
            const form = document.getElementById('ticketForm');
            const formData = new FormData(form);
            
            // In a real app, you would send this to your backend
            console.log('Submitting ticket:', Object.fromEntries(formData));
            
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Ticket Submitted',
                text: 'Your support ticket has been submitted successfully. We will get back to you soon!',
                confirmButtonText: 'OK'
            });
            
            // Close the form and refresh the ticket list
            closeNewTicketForm();
            loadTickets();
        }
        
        // Submit ticket reply
        function submitReply() {
            const form = document.getElementById('replyForm');
            const formData = new FormData(form);
            
            // In a real app, you would send this to your backend
            console.log('Submitting reply:', Object.fromEntries(formData));
            
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Reply Sent',
                text: 'Your reply has been sent to our support team.',
                confirmButtonText: 'OK'
            });
            
            // Clear the reply form
            form.reset();
        }
        
        // Helper functions
        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }
        
        function formatDateTime(dateTimeString) {
            const options = { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            return new Date(dateTimeString).toLocaleDateString(undefined, options);
        }
        
        function getStatusClass(status) {
            switch(status) {
                case 'open': return 'bg-blue-100 text-blue-800';
                case 'in_progress': return 'bg-yellow-100 text-yellow-800';
                case 'resolved': return 'bg-green-100 text-green-800';
                case 'closed': return 'bg-gray-100 text-gray-800';
                default: return 'bg-gray-100 text-gray-800';
            }
        }
        
        function getPriorityClass(priority) {
            switch(priority) {
                case 'low': return 'bg-blue-100 text-blue-800';
                case 'medium': return 'bg-yellow-100 text-yellow-800';
                case 'high': return 'bg-orange-100 text-orange-800';
                case 'urgent': return 'bg-red-100 text-red-800';
                default: return 'bg-gray-100 text-gray-800';
            }
        }
        
        function formatStatus(status) {
            const statusMap = {
                'open': 'Open',
                'in_progress': 'In Progress',
                'resolved': 'Resolved',
                'closed': 'Closed'
            };
            return statusMap[status] || status;
        }
        
        function formatPriority(priority) {
            return priority.charAt(0).toUpperCase() + priority.slice(1);
        }
        
        function formatDepartment(department) {
            const deptMap = {
                'technical': 'Technical',
                'billing': 'Billing',
                'account': 'Account',
                'general': 'General'
            };
            return deptMap[department] || department;
        }
    </script>
</body>
</html>