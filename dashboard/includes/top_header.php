<div class="flex items-center justify-between px-2 py-4">
    <div class="flex items-center">
        <div class="w-10 h-10 bg-orange-500 rounded-full mr-3 flex items-center justify-center user-initials">
            <span class="text-black font-semibold text-sm"><?php echo explode(" ", $profile['fullname'])[0][0] . explode(" ", $profile['fullname'])[1][0]; ?></span>
        </div>
        <div>
            <h2 class="font-semibold text-gray-900 user-name"><?php echo $profile['fullname']; ?></h2>
            <p class="text-sm text-gray-500 user-email"><?php echo $profile['email']; ?></p>
        </div>
    </div>
    <div class="flex items-center space-x-4">
        <a href="../notification" id="notificationBtn" class="text-gray-600 hover:text-blue-500 transition-colors z-50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
        </a>
        <button id="logoutBtn" class="text-gray-600 hover:text-red-500 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                </path>
            </svg>
        </button>
    </div>
</div>