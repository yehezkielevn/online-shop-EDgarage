<nav class="fixed top-0 left-0 w-full z-40 bg-black/80 backdrop-blur-lg border-b border-white/10">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- Logo -->
        <a href="/" class="text-2xl font-extrabold tracking-tight">
            <span class="text-red-600">E&D</span><span class="text-white">garage</span>
        </a>

        <!-- Menu Desktop -->
        <ul class="hidden md:flex items-center gap-8 text-white">
            <li><a href="#hero" class="navbar-link hover:text-red-600 transition" data-anchor="hero">Beranda</a></li>
            <li><a href="#katalog" class="navbar-link hover:text-red-600 transition" data-anchor="katalog">Katalog</a></li>
            <li><a href="#tentang" class="navbar-link hover:text-red-600 transition" data-anchor="tentang">Tentang</a></li>
            <li><a href="#kontak" class="navbar-link hover:text-red-600 transition" data-anchor="kontak">Kontak</a></li>
            <li>
                <a href="/login" class="px-4 py-2 bg-red-600 rounded-full hover:bg-red-700 transition">
                    Login
                </a>
            </li>
        </ul>

    </div>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const navbarLinks = document.querySelectorAll('.navbar-link');

    navbarLinks.forEach(function(link) {
      link.addEventListener('click', function(e) {
        e.preventDefault();

        const anchor = this.getAttribute('data-anchor');
        const targetElement = document.getElementById(anchor);

        if (targetElement) {
          const offsetTop = targetElement.getBoundingClientRect().top + window.scrollY;
          const navbarHeight = 70; // Tinggi navbar fixed
          const scrollPosition = offsetTop - navbarHeight;

          window.scrollTo({
            top: scrollPosition,
            behavior: 'smooth'
          });
        }
      });
    });
  });
</script>
