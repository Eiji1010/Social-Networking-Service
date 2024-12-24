<header class="flex items-center justify-between px-10 py-3 border-b border-[#f0f2f5]">
    <div class="flex items-center gap-4">
        <div class="w-10 h-10">
            <!-- SVG Icon -->
            <svg viewBox="0 0 48 48" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.8261 17.4264C16.7203 18.1174 20.2244 18.5217 24 18.5217C27.7756..." />
            </svg>
        </div>
        <h2 class="text-lg font-bold">Chirp</h2>
    </div>
    <div class="flex items-center gap-4">
        <button
                class="h-10 px-4 bg-[#2094f3] text-white text-sm font-bold rounded-lg"
                aria-label="Sign up"
                onclick="location.href='register'"
        >
            Sign up
        </button>
    </div>
</header>

<main class="flex flex-col items-center py-10 px-4">
    <h1 class="text-4xl font-bold text-center mb-4">Welcome back to Chirp</h1>
    <p class="text-center mb-6">The best place to share your thoughts with the world. Log in to get started.</p>
    <form class="w-full max-w-md" action="form/login" method="post">
        <input type="hidden" name="csrf_token" value=<?= Helpers\CrossSiteForgeryProtection::getToken(); ?>>
        <label for="email" class="block mb-2">Email</label>
        <input
                type="email"
                placeholder="Email"
                class="form-input w-full h-12 px-4 rounded-lg bg-[#f0f2f5] text-sm"
                aria-label="Email"
                id="email"
                name="email"
        />
        <label for="password" class="block mb-2 mt-1">Password</label>
        <input
                type="password"
                placeholder="Password"
                class="form-input w-full h-12 px-4 rounded-lg bg-[#f0f2f5] text-sm"
                aria-label="Password"
                id="password"
                name="password"
        />
        <button
                type="submit"
                class="w-full h-12 bg-[#2094f3] text-white font-bold rounded-lg mt-4"
        >
            Log in
        </button>
    </form>
    <p class="mt-4 text-sm text-center">
        <a href="#" class="underline">Forgot your password?</a>
    </p>
    <p class="mt-2 text-sm text-center">
        New to Chirp? <a href="register" class="underline">Sign up now.</a>
    </p>
