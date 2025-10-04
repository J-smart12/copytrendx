// Authentication and API service for the dashboard

// Check if user is authenticated
function checkAuth() {
    const token = localStorage.getItem('auth_token');
    if (!token) {
        // Redirect to login if no token is found
        window.location.href = '../login.html';
        return false;
    }
    return true;
}

// Make authenticated API requests
async function apiRequest(endpoint, method = 'GET', data = null) {
    const token = localStorage.getItem('auth_token');
    if (!token) {
        window.location.href = '../login.html';
        return Promise.reject('Not authenticated');
    }

    const headers = {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`
    };

    const config = {
        method: method,
        headers: headers
    };

    if (data) {
        config.body = JSON.stringify(data);
    }

    try {
        const response = await fetch(`../phpapiserver/${endpoint}`, config);
        const responseData = await response.json();
        
        if (!response.ok) {
            if (response.status === 401) {
                // Token expired or invalid
                localStorage.removeItem('auth_token');
                window.location.href = '../login.html';
            }
            throw new Error(responseData.message || 'API request failed');
        }
        
        return responseData;
    } catch (error) {
        console.error('API request failed:', error);
        throw error;
    }
}

// Logout function
function logout() {
    // Call the logout API
    apiRequest('user/logout', 'POST')
        .then(() => {
            // Clear local storage and redirect to login
            localStorage.removeItem('auth_token');
            window.location.href = '../login.html';
        })
        .catch(error => {
            console.error('Logout failed:', error);
            // Still clear local storage and redirect even if API call fails
            localStorage.removeItem('auth_token');
            window.location.href = '../login.html';
        });
}

// Check authentication on dashboard pages
// const currentPage = window.location.pathname.split('/').pop();
// if (currentPage !== 'login.html' && currentPage !== 'register.html') {
//     if (!checkAuth()) {
//         // Redirect to login if not authenticated
//         window.location.href = '../login.html';
//     }
// }
