// Dashboard specific JavaScript

// document.addEventListener('DOMContentLoaded', function() {
//     // Check authentication
//     if (!checkAuth()) {
//         return;
//     }

//     // Initialize the dashboard
//     initDashboard();
// });

// Initialize dashboard functionality
function initDashboard() {
    // Add click handler for the logout button if it exists
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            logout();
        });
    }

    // Load user data without modifying UI structure
    loadUserData();
}

// Load user data
async function loadUserData() {
    try {
        const userData = await apiRequest('user/profile');
        
        // You can process user data here without modifying the UI
        console.log('User data loaded:', userData);
        
        // Example: Update balance if the element exists and user data is available
        if (userData.user && userData.user.balance !== undefined) {
            const balanceElement = document.querySelector('.balance-amount');
            if (balanceElement) {
                balanceElement.textContent = `$${parseFloat(userData.user.balance).toFixed(2)}`;
            }
        }
        
    } catch (error) {
        console.error('Error loading user data:', error);
        // Handle error without modifying UI
    }
}
