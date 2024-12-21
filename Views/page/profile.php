<?php
    $user = \Helpers\Authenticate::getAuthenticatedUser();
?>
<!-- サイドバー -->
<nav class="bg-[#f0f2f5] w-80 p-4 flex flex-col gap-4 fixed h-full">
    <div class="space-y-2">
        <a
            href="homepage"
            class="flex items-center gap-3 px-3 py-2 bg-white rounded-lg hover:bg-gray-200 transition"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="text-[#111518]"
                width="24"
                height="24"
                fill="currentColor"
                viewBox="0 0 256 256"
            >
                <path
                    d="M224,115.55V208a16,16,0,0,1-16,16H168a16,16,0,0,1-16-16V168a8,8,0,0,0-8-8H112a8,8,0,0,0-8,8v40a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V115.55a16,16,0,0,1,5.17-11.78l80-75.48.11-.11a16,16,0,0,1,21.53,0,1.14,1.14,0,0,0,.11.11l80,75.48A16,16,0,0,1,224,115.55Z"
                ></path>
            </svg>
            <span class="text-sm font-medium">Home</span>
        </a>
        <a
            href="#"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="text-[#111518]"
                width="24"
                height="24"
                fill="currentColor"
                viewBox="0 0 256 256"
            >
                <path
                    d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216ZM172.42,72.84l-64,32a8.05,8.05,0,0,0-3.58,3.58l-32,64A8,8,0,0,0,80,184a8.1,8.1,0,0,0,3.58-.84l64-32a8.05,8.05,0,0,0,3.58-3.58l32-64a8,8,0,0,0-10.74-10.74ZM138,138,97.89,158.11,118,118l40.15-20.07Z"
                ></path>
            </svg>
            <span class="text-sm font-medium">Explore</span>
        </a>
        <a
            href="#"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                <path
                    d="M221.8,175.94C216.25,166.38,208,139.33,208,104a80,80,0,1,0-160,0c0,35.34-8.26,62.38-13.81,71.94A16,16,0,0,0,48,200H88.81a40,40,0,0,0,78.38,0H208a16,16,0,0,0,13.8-24.06ZM128,216a24,24,0,0,1-22.62-16h45.24A24,24,0,0,1,128,216ZM48,184c7.7-13.24,16-43.92,16-80a64,64,0,1,1,128,0c0,36.05,8.28,66.73,16,80Z"
                ></path>
            </svg>
            <span class="text-sm font-medium">Notification</span>
        </a>
        <a
            href="#"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                <path
                    d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48Zm-96,85.15L52.57,64H203.43ZM98.71,128,40,181.81V74.19Zm11.84,10.85,12,11.05a8,8,0,0,0,10.82,0l12-11.05,58,53.15H52.57ZM157.29,128,216,74.18V181.82Z"
                ></path>
            </svg>
            <span class="text-sm font-medium">Message</span>
        </a>
        <a
            href="#"
            class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-200 transition"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                <path
                    d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"
                ></path>
            </svg>
            <span class="text-sm font-medium">Profile</span>
        </a>
    </div>
    <button
        class="mt-auto flex items-center justify-center px-4 py-2 bg-[#2094f3] text-white rounded-lg text-sm font-bold hover:bg-blue-700 transition"
    >
        Post
    </button>
</nav>


<!-- メインコンテンツ -->

<!-- メインコンテンツ -->
<main class="ml-80 flex-1 bg-white relative">
    <!-- プロフィールセクション -->
    <section class="p-4 border-b border-gray-200">
        <div class="bg-gray-300 h-48"></div>
        <div class="flex items-center justify-between mt-4 px-4">
            <!-- プロフィール画像 -->
            <div>
                <div
                    class="w-32 h-32 rounded-full bg-center bg-cover border-4 border-white"
                    style="background-image: url('#');"
                ></div>
            </div>
            <!-- Edit Profile ボタン -->
            <button
                class="px-4 py-2 bg-[#2094f3] text-white rounded-lg text-sm font-bold hover:bg-blue-700 transition"
                onclick="openModal()"
            >
                Edit Profile
            </button>
        </div>
        <!-- ユーザー情報 -->
        <div class="mt-4 px-4">
            <h2 class="text-xl font-bold"><?= $user->getUsername() ?></h2>
            <p class="text-sm text-gray-500">@<?= $user->getHandle() ?></p>
            <p class="mt-2 text-sm text-gray-700"><?= $user->getBiography() ?></p>
        </div>
    </section>