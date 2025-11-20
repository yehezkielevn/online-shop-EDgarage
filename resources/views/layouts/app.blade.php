<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'E&Dgarage' }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Tailwind / Vite --}}
    @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css','resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>

<body class="bg-black text-white font-poppins">

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- Slideshow Script --}}
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        document.querySelectorAll('img[data-images]').forEach(function(img){
            const images = JSON.parse(img.getAttribute('data-images') || '[]');
            if (!images.length) return;

            let idx = 0;

            setInterval(function(){
                idx = (idx + 1) % images.length;

                img.style.opacity = 0;

                setTimeout(function(){
                    img.src = images[idx];
                    img.style.opacity = 1;
                }, 300);

            }, 3000);
        });
    });
    </script>

</body>
</html>
