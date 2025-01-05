<div class="flex min-h-screen">


    <!-- メインコンテンツ -->
    <main class="ml-80 flex-1 bg-white overflow-y-auto">
        <!-- 投稿作成 -->
        <div class="flex flex-1 flex-col">
        <form  method="post" action="form/post" class="p-1">
            <div class="flex items-center px-10 py-3 gap-3 @container justify-center">
                <input type="hidden" name="csrf_token" value=<?= Helpers\CrossSiteForgeryProtection::getToken(); ?>>
                <label class="flex flex-col min-w-40 h-full flex-1" for="post">
                <textarea
                    placeholder="What's happening?"
                    class="w-full p-2 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    id="post"
                    name="post"
                ></textarea>
                <div class="flex bg-white justify-end pr-[15px] rounded-br-xl border-l-0 border-t-0 px-[15px] pb-[15px]">
                    <div class="flex items-center gap-4 justify-end">
                        <div class="flex items-center gap-1">
                            <button class="flex items-center justify-center p-1.5">
                                <div class="text-[#60778a]" data-icon="Image" data-size="20px" data-weight="regular">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path
                                        d="M216,40H40A16,16,0,0,0,24,56V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A16,16,0,0,0,216,40Zm0,16V158.75l-26.07-26.06a16,16,0,0,0-22.63,0l-20,20-44-44a16,16,0,0,0-22.62,0L40,149.37V56ZM40,172l52-52,80,80H40Zm176,28H194.63l-36-36,20-20L216,181.38V200ZM144,100a12,12,0,1,1,12,12A12,12,0,0,1,144,100Z"
                                        ></path>
                                    </svg>
                                </div>
                            </button>
                            <button class="flex items-center justify-center p-1.5">
                                <div class="text-[#60778a]" data-icon="Gif" data-size="20px" data-weight="regular">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path
                                        d="M144,72V184a8,8,0,0,1-16,0V72a8,8,0,0,1,16,0Zm80-8H176a8,8,0,0,0-8,8V184a8,8,0,0,0,16,0V136h32a8,8,0,0,0,0-16H184V80h40a8,8,0,0,0,0-16ZM96,120H72a8,8,0,0,0,0,16H88v16a24,24,0,0,1-48,0V104A24,24,0,0,1,64,80c11.19,0,21.61,7.74,24.25,18a8,8,0,0,0,15.5-4C99.27,76.62,82.56,64,64,64a40,40,0,0,0-40,40v48a40,40,0,0,0,80,0V128A8,8,0,0,0,96,120Z"
                                        ></path>
                                    </svg>
                                </div>
                            </button>
                            <button class="flex items-center justify-center p-1.5">
                                <div class="text-[#60778a]" data-icon="Question" data-size="20px" data-weight="regular">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path
                                        d="M140,180a12,12,0,1,1-12-12A12,12,0,0,1,140,180ZM128,72c-22.06,0-40,16.15-40,36v4a8,8,0,0,0,16,0v-4c0-11,10.77-20,24-20s24,9,24,20-10.77,20-24,20a8,8,0,0,0-8,8v8a8,8,0,0,0,16,0v-.72c18.24-3.35,32-17.9,32-35.28C168,88.15,150.06,72,128,72Zm104,56A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z"
                                        ></path>
                                    </svg>
                                </div>
                            </button>
                            <button class="flex items-center justify-center p-1.5">
                                <div class="text-[#60778a]" data-icon="Smiley" data-size="20px" data-weight="regular">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path
                                        d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216ZM80,108a12,12,0,1,1,12,12A12,12,0,0,1,80,108Zm96,0a12,12,0,1,1-12-12A12,12,0,0,1,176,108Zm-1.07,48c-10.29,17.79-27.4,28-46.93,28s-36.63-10.2-46.92-28a8,8,0,1,1,13.84-8c7.47,12.91,19.21,20,33.08,20s25.61-7.1,33.07-20a8,8,0,0,1,13.86,8Z"
                                        ></path>
                                    </svg>
                                </div>
                            </button>
                            <button class="flex items-center justify-center p-1.5">
                                <div class="text-[#60778a]" data-icon="Calendar" data-size="20px" data-weight="regular">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path
                                        d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-96-88v64a8,8,0,0,1-16,0V132.94l-4.42,2.22a8,8,0,0,1-7.16-14.32l16-8A8,8,0,0,1,112,120Zm59.16,30.45L152,176h16a8,8,0,0,1,0,16H136a8,8,0,0,1-6.4-12.8l28.78-38.37A8,8,0,1,0,145.07,132a8,8,0,1,1-13.85-8A24,24,0,0,1,176,136,23.76,23.76,0,0,1,171.16,150.45Z"
                                        ></path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                        <button
                        class="min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#2094f3] text-white text-sm font-medium leading-normal hidden sm:block"
                        >
                            <span class="truncate">Post</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        </div>
        <!-- トップバー -->
        <section class="border-b border-[#dbe1e6]">
            <div class="flex justify-center gap-4 px-4 py-3">
                <a
                        href="#"
                        class="tab-link flex flex-col items-center justify-center border-b-4 border-[#111518] text-[#111518] pb-2 flex-1"
                        data-tab="trending"
                >
                    <p class="text-sm font-bold">Trending</p>
                </a>
                <a
                        href="#"
                        class="tab-link flex flex-col items-center justify-center border-b-4 border-transparent text-[#60778a] pb-2 flex-1 hover:border-gray-300"
                        data-tab="following"
                >
                    <p class="text-sm font-bold">Following</p>
                </a>
            </div>
        </section>

        <!-- タブコンテンツ -->
        <!-- Trendingのコンテンツ -->
        <section id="trending" class="tab-content">
            <!-- タイムライン -->
            <section id="trending-contents" class="space-y-6 mt-6">

            </section>
        </section>

        <!-- Followingのコンテンツ -->
            <section id="following" class="tab-content hidden">
                <!-- タイムライン -->
                <section id="following-contents" class="space-y-6 mt-6">

                </section>
            </section>
    </main>

