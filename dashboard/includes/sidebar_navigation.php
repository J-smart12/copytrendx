<div class="h-screen w-64 border-r border-gray-200 hidden md:block">
    <div class="flex flex-col h-full gap-4">
        <nav class="sidebar flex-1 px-3 py-4">
            <div class="flex items-center my-4">
                <a href="../home" class="flex items-center gap-2">
                    <img src="favicon.png" alt="Logo">
                    <span>CopyWavex</span>
                </a>
            </div>
            <ul class="space-y-6">
                <li class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg px-2 py-3 hover:shadow-lg border-gray-200">
                    <a href="../home" class="flex items-center text-lg gap-2">
                        <i class="fa fa-home menu-icon"></i>
                        Dashboard
                    </a>
                </li>
                <li class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg px-2 py-3 hover:shadow-lg border-gray-200">
                    <a href="../markets" class="flex items-center text-lg gap-2">
                        <i class="fa fa-chart-line menu-icon"></i>
                        Markets
                    </a>
                </li>
                <li class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg px-2 py-3 hover:shadow-lg border-gray-200">
                    <a href="../referrals" class="flex items-center text-lg gap-2">
                        <i class="fa fa-users menu-icon"></i>
                        Referrals
                    </a>
                </li>
                <li class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg px-2 py-3 hover:shadow-lg border-gray-200">
                    <a href="../history" class="flex items-center text-lg gap-2">
                        <i class="fa fa-history menu-icon"></i>
                        History
                    </a>
                </li>
                <li class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg px-2 py-3 hover:shadow-lg border-gray-200">
                    <a href="../mine" class="flex items-center text-lg gap-2">
                        <i class="fa fa-cube menu-icon"></i>
                        Mining
                    </a>
                </li>
                <li class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg px-2 py-3 hover:shadow-lg border-gray-200">
                    <a href="../profile" class="flex items-center text-lg gap-2">
                        <i class="fa fa-user menu-icon"></i>
                        Profile
                    </a>
                </li>
                <li class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg px-2 py-3 hover:shadow-lg border-gray-200">
                    <a href="../help" class="flex items-center text-lg gap-2">
                        <i class="fa fa-chart-line menu-icon"></i>
                        Help
                    </a>
                </li>
                <li class=" border-t border-gray-200 my-8"></li>
                <li class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg px-2 py-3 hover:shadow-lg border-gray-200">
                    <a href="../logout" class="flex items-center text-lg gap-2">
                        <i class="fa fa-sign-out menu-icon"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
        <div class="flex flex-col gap-4 px-3">
            <!-- user name -->
            <div class="flex items-center my-4">
                <a href="../settings" class="flex flex-col items-center gap-2">
                    <img src="favicon.png" alt="Logo" class="w-10 h-10 rounded-full">
                    <span><?php echo $profile['fullname']; ?></span>
                </a>
            </div>
        </div>
    </div>
</div>