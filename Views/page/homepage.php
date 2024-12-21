<div class="flex min-h-screen">
    <!-- サイドバー -->
    <nav class="bg-[#f0f2f5] w-80 p-4 flex flex-col gap-4 fixed h-full">
        <div class="space-y-2">
            <a
                href="#"
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
    <main class="ml-80 flex-1 bg-white overflow-y-auto">
        <!-- トップバー -->
        <section class="border-b border-[#dbe1e6]">
            <div class="flex justify-center gap-4 px-4 py-3">
                <a
                    href="#"
                    class="flex flex-col items-center justify-center border-b-4 border-[#111518] text-[#111518] pb-2 flex-1"
                >
                    <p class="text-sm font-bold">Trending</p>
                </a>
                <a
                    href="#"
                    class="flex flex-col items-center justify-center border-b-4 border-transparent text-[#60778a] pb-2 flex-1 hover:border-gray-300"
                >
                    <p class="text-sm font-bold">Following</p>
                </a>
            </div>
        </section>

        <!-- 投稿作成 -->
        <section class="p-4 border-b border-[#dbe1e6]">
            <div class="flex items-center px-4 py-3 gap-3 @container">
                <label class="flex flex-col min-w-40 h-full flex-1">
                    <div class="flex w-full flex-1 items-stretch rounded-xl h-full">
                        <div class="flex border border-[#dbe1e6] bg-white justify-end pl-[15px] pr-[15px] pt-[15px] rounded-l-xl border-r-0">
                            <div
                                class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 shrink-0"
                                style='background-image: url("#");'
                            ></div>
                        </div>
                        <div class="flex flex-1 flex-col">
                    <textarea
                        placeholder="What's happening?"
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#111518] focus:outline-0 focus:ring-0 border border-[#dbe1e6] bg-white focus:border-[#dbe1e6] h-auto placeholder:text-[#bac5cf] rounded-l-none border-l-0 pl-2 rounded-b-none border-b-0 text-base font-normal leading-normal pt-[22px]"
                    ></textarea>
                            <div class="flex border border-[#dbe1e6] bg-white justify-end pr-[15px] rounded-br-xl border-l-0 border-t-0 px-[15px] pb-[15px]">
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
                                        class="min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#2094f3] text-white text-sm font-medium leading-normal hidden @[480px]:block"
                                    >
                                        <span class="truncate">Post</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </label>
            </div>
        </section>

        <!-- タイムライン -->
        <section class="space-y-6 mt-6">
            <article class="flex flex-col gap-4 px-4">
                <!-- プロフィールとツイート内容 -->
                <div class="flex items-start gap-4">
                    <div
                        class="w-12 h-12 bg-center bg-cover rounded-full"
                        style="background-image: url('#')"
                    ></div>
                    <div>
                        <h3 class="text-sm font-bold">Jackie Altman</h3>
                        <p class="text-sm text-[#60778a]">
                            This is a test tweet. Please do not like or reply.
                        </p>
                    </div>
                </div>
                <!-- アクションボタン -->
                <div class="flex items-center justify-start gap-6 px-4">
                    <button
                        type="button"
                        class="flex items-center gap-1 text-[#60778a] hover:text-[#2094f3] transition"
                        aria-label="Like this post"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24px"
                            height="24px"
                            fill="currentColor"
                            viewBox="0 0 256 256"
                        >
                            <path
                                d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z"
                            ></path>
                        </svg>
                        <p class="text-[13px] font-bold">23</p>
                    </button>
                    <button
                        type="button"
                        class="flex items-center gap-1 text-[#60778a] hover:text-[#2094f3] transition"
                        aria-label="Comment on this post"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24px"
                            height="24px"
                            fill="currentColor"
                            viewBox="0 0 256 256"
                        >
                            <path
                                d="M128,24A104,104,0,0,0,36.18,176.88L24.83,210.93a16,16,0,0,0,20.24,20.24l34.05-11.35A104,104,0,1,0,128,24Zm0,192a87.87,87.87,0,0,1-44.06-11.81,8,8,0,0,0-6.54-.67L40,216,52.47,178.6a8,8,0,0,0-.66-6.54A88,88,0,1,1,128,216Z"
                            ></path>
                        </svg>
                        <p class="text-[13px] font-bold">4</p>
                    </button>
                    <button
                        type="button"
                        class="flex items-center gap-1 text-[#60778a] hover:text-[#2094f3] transition"
                        aria-label="Share this post"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24px"
                            height="24px"
                            fill="currentColor"
                            viewBox="0 0 256 256"
                        >
                            <path
                                d="M229.66,109.66l-48,48a8,8,0,0,1-11.32-11.32L204.69,112H165a88,88,0,0,0-85.23,66,8,8,0,0,1-15.5-4A103.94,103.94,0,0,1,165,96h39.71L170.34,61.66a8,8,0,0,1,11.32-11.32l48,48A8,8,0,0,1,229.66,109.66ZM192,208H40V88a8,8,0,0,0-16,0V208a16,16,0,0,0,16,16H192a8,8,0,0,0,0-16Z"
                            ></path>
                        </svg>
                        <p class="text-[13px] font-bold">5</p>
                    </button>
                    <button
                        type="button"
                        class="flex items-center gap-1 text-[#60778a] hover:text-[#2094f3] transition"
                        aria-label="Retweet this post"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24px"
                            height="24px"
                            fill="currentColor"
                            viewBox="0 0 256 256"
                        >
                            <path
                                d="M240,56v48a8,8,0,0,1-8,8H184a8,8,0,0,1,0-16H211.4L184.81,71.64l-.25-.24a80,80,0,1,0-1.67,114.78,8,8,0,0,1,11,11.63A95.44,95.44,0,0,1,128,224h-1.32A96,96,0,1,1,195.75,60L224,85.8V56a8,8,0,1,1,16,0Z"
                            ></path>
                        </svg>
                    </button>
                </div>
            </article>
        </section>