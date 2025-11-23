<div 
    id="loginOverlay"
    class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300 z-40"
    onclick="toggleLogin(false)"
></div>

<div 
    id="loginModal"
    class="fixed inset-0 flex items-center justify-center px-4 hidden z-50 pointer-events-none"
>
    <div 
        id="loginCard"
        class="bg-neutral-900 border border-red-600/40 rounded-2xl w-full max-w-md p-8 
               shadow-[0_0_35px_rgba(255,0,0,0.45)]
               scale-90 opacity-0 transform transition-all duration-300 
               relative backdrop-blur-xl pointer-events-auto"
    >
        <h2 class="text-3xl font-bold text-center mb-6 text-white tracking-wider">
            Login <span class="text-red-600">Akun</span>
        </h2>

        @if($errors->any())
            <div class="bg-red-900/50 border border-red-600 text-red-200 px-4 py-2 rounded-lg mb-4 text-sm">
                Login Gagal. Periksa email/password.
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block mb-1 font-medium text-gray-400 text-sm">Email</label>
                <input 
                    type="email" 
                    name="email"
                    class="w-full px-4 py-3 bg-neutral-800 text-white border border-neutral-700 rounded-lg
                           focus:ring-1 focus:ring-red-600 focus:border-red-600 focus:outline-none transition"
                    placeholder="nama@email.com"
                    required
                >
            </div>

            <div class="relative">
                <label class="block mb-1 font-medium text-gray-400 text-sm">Password</label>
                <input 
                    type="password" 
                    name="password"
                    id="modalPasswordInput"
                    class="w-full px-4 py-3 bg-neutral-800 text-white border border-neutral-700 rounded-lg
                           focus:ring-1 focus:ring-red-600 focus:border-red-600 focus:outline-none pr-10 transition"
                    placeholder="••••••••"
                    required
                >
                
                <button type="button" onclick="toggleModalPassword()" class="absolute right-3 top-[34px] text-gray-500 hover:text-white">
                    <svg id="modalEyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </button>
            </div>

            <button class="w-full py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-bold transition shadow-lg transform hover:scale-[1.02]">
                Masuk Sekarang
            </button>

            <p class="text-center text-sm text-gray-400 mt-4">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-red-500 hover:text-white font-medium transition">Daftar di sini</a>
            </p>
        </form>

        <button onclick="toggleLogin(false)" class="absolute top-4 right-4 text-gray-500 hover:text-white text-xl font-bold transition">
            &times;
        </button>

    </div>
</div>

<script>
    function toggleLogin(show) {
        const modal = document.getElementById("loginModal");
        const overlay = document.getElementById("loginOverlay");
        const card = document.getElementById("loginCard");

        if (show) {
            overlay.classList.remove("hidden");
            modal.classList.remove("hidden");
            // Delay sedikit untuk animasi fade-in
            setTimeout(() => {
                overlay.classList.remove("opacity-0");
                card.classList.remove("scale-90", "opacity-0");
            }, 10);
        } else {
            overlay.classList.add("opacity-0");
            card.classList.add("scale-90", "opacity-0");
            // Delay untuk animasi fade-out sebelum hidden
            setTimeout(() => {
                overlay.classList.add("hidden");
                modal.classList.add("hidden");
            }, 300);
        }
    }

    function toggleModalPassword() {
        const input = document.getElementById("modalPasswordInput");
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>