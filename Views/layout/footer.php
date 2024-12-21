<?php
    $user = \Helpers\Authenticate::getAuthenticatedUser();
?>
</main>
<!--    <footer class="bg-light text-center text-lg-start">-->
<!--        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">-->
<!--            © 2024:-->
<!--            <a class="text-dark" href="/">SNS.com</a>-->
<!--        </div>-->
<!--    </footer>-->

<!-- モーダル -->
<div
        id="editProfileModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden"
>
    <div class="bg-white p-6 rounded-lg w-[90%] max-w-md">
        <h2 class="text-xl font-bold mb-4">Edit Profile</h2>
        <form action="form/edit-profile" method="post">
            <div class="mb-4">
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

    </body>
</html>