<?php
    $user = \Helpers\Authenticate::getAuthenticatedUser();
?>

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
                onclick="openEditProfileModal()"
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

    <!-- モーダル -->
    <div
            id="editProfileModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden"
    >
        <div class="bg-white p-6 rounded-lg w-[90%] max-w-md">
            <h2 class="text-xl font-bold mb-4">Edit Profile</h2>
            <form action="form/edit-profile" method="post">
                <div class="mb-4">
                    <input type="hidden" name="csrf_token" value=<?= \Helpers\CrossSiteForgeryProtection::getToken(); ?>
                    <label for="username" class="block text-sm font-medium">Name</label>
                    <input
                            id="username"
                            name="username"
                            type="text"
                            class="w-full p-2 border border-gray-300 rounded-lg"
                            placeholder="Enter your name"
                            value=<?= $user->getUsername() ?>
                    />
                </div>
                <div class="mb-4">
                    <label for="handle" class="block text-sm font-medium">handle</label>
                    <input
                            id="handle"
                            name="handle"
                            type="text"
                            class="w-full p-2 border border-gray-300 rounded-lg"
                            placeholder="Enter your handle"
                            value=<?= $user->getHandle() ?>
                    />
                </div>
                <div class="mb-4">
                    <label for="age" class="block text-sm font-medium">Age</label>
                    <input
                            id="age"
                            name="age"
                            type="text"
                            class="w-full p-2 border border-gray-300 rounded-lg"
                            placeholder="Enter your Age"
                            value=<?= $user->getAge() ?>
                    />
                </div>
                <div class="mb-4">
                    <label for="place" class="block text-sm font-medium">Place</label>
                    <input
                            id="place"
                            name="place"
                            type="text"
                            class="w-full p-2 border border-gray-300 rounded-lg"
                            placeholder="Enter your place of residence"
                            value=<?= $user->getPlace() ?>
                    />
                </div>
                <div class="mb-4">
                    <label for="biography" class="block text-sm font-medium">Bio</label>
                    <textarea
                            id="biography"
                            name="biography"
                            rows="4"
                            class="w-full p-2 border border-gray-300 rounded-lg"
                            placeholder="Enter a short bio"

                    ><?= $user->getBiography() ?></textarea>
                </div>
                <div class="flex justify-end gap-4">
                    <button
                            type="button"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg"
                            onclick="closeModal()"
                    >
                        Cancel
                    </button>
                    <button
                            type="submit"
                            class="px-4 py-2 bg-[#2094f3] text-white rounded-lg"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>