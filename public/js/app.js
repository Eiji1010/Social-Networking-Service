// モーダルを開く
function openEditProfileModal() {
document.getElementById('editProfileModal').classList.remove('hidden');
}

// モーダルを閉じる
function closeModal() {
document.getElementById('editProfileModal').classList.add('hidden');
}

function openCreatePostModal() {
    const modal = document.getElementById('createPostModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.style.zIndex = 1000; // モーダルを最前面に配置
    } else {
        console.error('Create Post Modal not found.');
    }
}

function closeCreatePostModal() {
    const modal = document.getElementById('createPostModal');
    if (modal) {
        modal.classList.add('hidden');
    } else {
        console.error('Create Post Modal not found.');
    }
}
// 背景をクリックしてモーダルを閉じる
document.addEventListener('DOMContentLoaded', () => {
    const createPostModal = document.getElementById('createPostModal');

    if (createPostModal) {
        createPostModal.addEventListener('click', function (event) {
            if (event.target.id === 'createPostModal') {
                closeCreatePostModal();
            }
        });
    } else {
        console.error('Create Post Modal not found.');
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const tabLinks = document.querySelectorAll('.tab-link'); // タブリンクのセレクタ
    const tabContents = document.querySelectorAll('.tab-content'); // タブコンテンツのセレクタ

    tabLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault(); // リンクのデフォルト動作を無効化
            const targetTab = link.getAttribute('data-tab'); // 対象のタブIDを取得
            console.log(`Tab clicked: ${targetTab}`); // デバッグ用ログ

            // すべてのタブリンクを非アクティブ化
            tabLinks.forEach(link => {
                link.classList.remove('border-[#111518]', 'text-[#111518]');
                link.classList.add('border-transparent', 'text-[#60778a]');
            });

            // クリックしたタブリンクをアクティブ化
            link.classList.add('border-[#111518]', 'text-[#111518]');
            link.classList.remove('border-transparent', 'text-[#60778a]');

            // すべてのタブコンテンツを非表示
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });

            // 該当するすべてのタブコンテンツを表示
            const activeTabs = document.querySelectorAll(`[id^="${targetTab}"]`);
            activeTabs.forEach(tab => tab.classList.remove('hidden'));
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    if (window.location.pathname === '/homepage') {
        const trendingTimeline = document.querySelector('#trending'); // タイムラインのコンテナ
        const followingTimeline = document.querySelector('#following');
        const trendingTab = document.querySelector('[data-tab="trending"]');
        const followingTab = document.querySelector('[data-tab="following"]');

        let currentTab = 'trending'; // 現在のタブ
        let trendingPage = 1; // trendingの現在ページ
        let followingPage = 1; // followingの現在ページ
        let loading = false; // ロード中フラグ
        let scrollListenerAttached = false; // スクロールイベントがアタッチ済みか

        // タイムラインデータの初期化
        const initializeTimeline = () => {
            trendingTimeline.innerHTML = ''; // trendingデータ初期化
            followingTimeline.innerHTML = ''; // followingデータ初期化
            trendingPage = 1;
            followingPage = 1;
        };

        // メッセージをロードする関数
        const loadMessages = async (tab, page) => {
            try {
                const response = await fetch(`/api/posts?tab=${tab}&page=${page}`);
                if (!response.ok) throw new Error('Failed to fetch messages.');

                const data = await response.json();
                const timeline = tab === 'trending' ? trendingTimeline : followingTimeline;
                console.log(data)
                // データをHTMLに変換して追加
                data.message.forEach((message) => {
                    const post = document.createElement('article');
                    post.className = 'flex flex-col gap-4 px-4';
                    post.innerHTML = `
                    <div class="flex items-start gap-4">
                    <button onclick="location.href='/profile/${message.username}'">
                        <div
                            class="user-image w-12 h-12 bg-center bg-cover rounded-full bg-[#f0f0f0] mt-1"
                            style="background-image: url('#')"
                            data-user-id="${message.id}"
                            data-user-name="${message.username}"
                            >
                        </div>
                    </button>
                    <button>
                        <div class="text-left">
                            <h3 class="text-sm font-bold mt-1">${message.username}</h3>
                            <p class="text-sm text-[#60778a] ">
                            ${message.content}
                            </p>
                        </div>
                    </div>
                        <!-- アクションボタン -->
                        <div class="flex items-center justify-start gap-6 px-4">
                            <button
                                type="button"
                                class="flex items-center gap-1 text-[#60778a] hover:text-[#2094f3] transition"
                                aria-label="Like this post">
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
                                <p class="text-[13px] font-bold">${message.likeCount}</p>
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
                                <p class="text-[13px] font-bold">${message.commentCount}</p>
                            </button>
                        </div>
                    </button>
                    `;

                    timeline.appendChild(post);
                });

                // 次のページがなければロードを停止
                if (!data.hasMore) {
                    console.log(`No more ${tab} messages to load.`);
                }

                loading = false; // ロード完了
            } catch (error) {
                console.error(`Error loading ${tab} messages:`, error);
                loading = false; // エラー時もフラグをリセット
            }
        };

        // スクロールイベントの処理
        const handleScroll = () => {
            if (loading) return;

            const scrollPosition = window.innerHeight + window.scrollY;
            const threshold = document.body.offsetHeight - 200; // ページ下部200px手前でロード

            if (scrollPosition >= threshold) {
                loading = true; // ロード中
                if (currentTab === 'trending') {
                    loadMessages('trending', ++trendingPage);
                } else if (currentTab === 'following') {
                    loadMessages('following', ++followingPage);
                }
            }
        };

        // タブ切り替え処理
        const handleTabClick = (tab) => {
            if (currentTab === tab) return; // 同じタブなら処理しない

            currentTab = tab; // 現在のタブを更新

            if (tab === 'trending') {
                trendingTimeline.classList.remove('hidden');
                followingTimeline.classList.add('hidden');

                // 初回ロードが必要なら
                if (!trendingTimeline.hasChildNodes()) {
                    loadMessages('trending', trendingPage);
                }
            } else if (tab === 'following') {
                trendingTimeline.classList.add('hidden');
                followingTimeline.classList.remove('hidden');

                // 初回ロードが必要なら
                if (!followingTimeline.hasChildNodes()) {
                    loadMessages('following', followingPage);
                }
            }
        };

        // 初期化処理
        const initializePage = () => {
            initializeTimeline(); // タイムライン初期化
            currentTab = 'trending'; // デフォルトタブ
            trendingTimeline.classList.remove('hidden');
            followingTimeline.classList.add('hidden');
            loadMessages('trending', trendingPage);
        };

        // イベントリスナーを追加
        trendingTab.addEventListener('click', () => handleTabClick('trending'));
        followingTab.addEventListener('click', () => handleTabClick('following'));

        // スクロールイベントをアタッチ
        if (!scrollListenerAttached) {
            window.addEventListener('scroll', handleScroll);
            scrollListenerAttached = true;
        }

        // 初期ロード
        initializePage();
    }
});


document.addEventListener('DOMContentLoaded', () => {
    if (window.location.pathname === '/profile') {
        const profileTimeline = document.querySelector('#profile-contents'); // タイムラインのコンテナ
        let profilePage = 1; // 現在ページ
        let loading = false; // ロード中フラグ

        // メッセージをロードする関数
        const loadProfileMessages = async (page) => {
            try {
                const response = await fetch(`/api/profile?page=${page}`);
                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error('Failed to fetch messages.');
                }

                const data = await response.json();
                // データをHTMLに変換して追加
                data.message.forEach((message) => {
                    const post = document.createElement('article');
                    post.className = 'flex flex-col gap-4 px-4';
                    post.innerHTML = `
                    <div class="flex items-start gap-4">
                    <button>
                        <div
                            class="w-12 h-12 bg-center bg-cover rounded-full bg-[#f0f0f0] mt-1"
                            style="background-image: url('#')">
                        </div>
                    </button>
                    <button>
                        <div class="text-left">
                            <h3 class="text-sm font-bold mt-1">${message.username}</h3>
                            <p class="text-sm text-[#60778a]">
                            ${message.content}
                            </p>
                        </div>
                    </div>
                        <!-- アクションボタン -->
                        <div class="flex items-center justify-start gap-6 px-4">
                            <button
                                type="button"
                                class="flex items-center gap-1 text-[#60778a] hover:text-[#2094f3] transition"
                                aria-label="Like this post">
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
                                <p class="text-[13px] font-bold">${message.likeCount}</p>
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
                                <p class="text-[13px] font-bold">${message.commentCount}</p>
                            </button>
                        </div>
                    </button>
                    `;

                    profileTimeline.appendChild(post);
                });

                // 次のページがなければロードを停止
                if (!data.hasMore) {
                    console.log('No more profile messages to load.');
                }

                loading = false; // ロード完了
            } catch (error) {
                console.error('Error loading profile messages:', error);
                loading = false; // エラー時もフラグをリセット
            }
        };

        // スクロールイベントの処理
        const handleScroll = () => {
            if (loading) return;

            const scrollPosition = window.innerHeight + window.scrollY;
            const threshold = document.body.offsetHeight - 200; // ページ下部200px手前でロード

            if (scrollPosition >= threshold) {
                loading = true; // ロード中
                loadProfileMessages(++profilePage);
            }
        };

        // 初期化処理
        const initializePage = () => {
            profileTimeline.innerHTML = ''; // タイムライン初期化
            profilePage = 1; // ページ初期化
            loadProfileMessages(profilePage); // 初回ロード
        };

        // スクロールイベントをアタッチ
        window.addEventListener('scroll', handleScroll);

        // 初期ロード
        initializePage();
    }
});
