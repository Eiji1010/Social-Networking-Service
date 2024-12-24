<header class="flex items-center justify-between px-10 py-3 border-b border-[#f0f2f5]">
    <div class="flex items-center gap-4">
        <h1 class="text-lg font-bold">Chirp</h1>
    </div>
</header>
<main class="flex justify-center py-5 px-4">
    <div class="w-full max-w-md">
        <h2 class="text-[28px] font-bold leading-tight mb-5">Create an account</h2>
        <form action="form/register" method="post" class="space-y-6">
            <input type="hidden" name="csrf_token" value=<?= Helpers\CrossSiteForgeryProtection::getToken(); ?>>
            <div>
                <label class="block text-sm font-medium mb-2" for="username">Username</label>
                <input
                    id="username"
                    name="username"
                    type="text"
                    placeholder="e.g. claraoswald"
                    class="w-full h-12 px-4 border border-[#dbe1e6] rounded-xl focus:border-[#2094f3] focus:outline-none"
                    aria-label="Username"
                    required
                />
            </div>
            <div>
                <label class="block text-sm font-medium mb-2" for="email">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="you@example.com"
                    class="w-full h-12 px-4 border border-[#dbe1e6] rounded-xl focus:border-[#2094f3] focus:outline-none"
                    aria-label="Email"
                    required
                />
            </div>
            <div>
                <label class="block text-sm font-medium mb-2" for="password">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="At least 8 characters, uppercase, lowercase, number, and special character"
                    class="w-full h-12 px-2 border border-[#dbe1e6] rounded-xl focus:border-[#2094f3] focus:outline-none"
                    aria-label="Password"
                    required
                />
            </div>
            <div>
                <label class="block text-sm font-medium mb-2" for="confirm-password">Confirm Password</label>
                <input
                        id="confirm-password"
                        name="confirm-password"
                        type="password"
                        placeholder="At least 8 characters, uppercase, lowercase, number, and special character"
                        class="w-full h-12 px-2 border border-[#dbe1e6] rounded-xl focus:border-[#2094f3] focus:outline-none"
                        aria-label="confirm-Password"
                        required
                />
            </div>
            <div class="flex items-start gap-3">
                <input
                    id="terms"
                    name="terms"
                    type="checkbox"
                    class="h-5 w-5 rounded border-[#dbe1e6] focus:ring-0 focus:ring-offset-0"
                    required
                />
                <label for="terms" class="text-sm">
                    By signing up, you agree to our <a href="#" class="underline">Terms of Service</a> and <a href="#" class="underline">Privacy Policy</a>.
                </label>
            </div>
            <button
                type="submit"
                class="w-full h-12 bg-[#2094f3] text-white font-bold rounded-xl"
            >
                Register
            </button>
        </form>
        <p class="mt-4 text-sm text-center">
            Already have an account? <a href="#" class="underline">Log in</a>.
        </p>
    </div>