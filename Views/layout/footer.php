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
        <form>
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium">Name</label>
                <input
                        id="username"
                        type="text"
                        class="w-full p-2 border border-gray-300 rounded-lg"
                        placeholder="Enter your name"
                        value="John Doe"
                />
            </div>
            <div class="mb-4">
                <label for="handle" class="block text-sm font-medium">Handle</label>
                <input
                        id="handle"
                        type="text"
                        class="w-full p-2 border border-gray-300 rounded-lg"
                        placeholder="Enter your handle"
                        value="@johndoe"
                />
            </div>
            <div class="mb-4">
                <label for="bio" class="block text-sm font-medium">Bio</label>
                <textarea
                        id="bio"
                        rows="4"
                        class="w-full p-2 border border-gray-300 rounded-lg"
                        placeholder="Enter a short bio"
                >Short bio about the user.</textarea>
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