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
