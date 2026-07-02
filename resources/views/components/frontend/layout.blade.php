<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $meta_title ?? ($title ?? 'Fresmart - Servindo Angola com Coração') }}</title>
    <meta name="description"
        content="{{ $meta_description ?? 'A Fresmart é o seu supermercado de confiança em Angola. Encontre produtos frescos, carnes, legumes e serviços de excelência.' }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Fresmart" />
    <link rel="manifest" href="/site.webmanifest" />

    <!-- Open Graph / Redes Sociais -->
    <meta property="og:title" content="{{ $meta_title ?? ($title ?? 'Fresmart') }}">
    <meta property="og:description"
        content="{{ $meta_description ?? 'A Fresmart é o seu supermercado de confiança em Angola. Encontre produtos frescos, carnes, legumes e serviços de excelência.' }}">
    <meta property="og:image" content="{{ isset($meta_image) ? asset($meta_image) : ($settings->logo ? asset($settings->logo) : asset('assets/img/logo.png')) }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Leaflet CSS (optional, based on page) -->
    {{ $head_scripts ?? '' }}

    <!-- Tailwind CSS CDN (Temporário para visualização rápida) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            light: '#7dd82a',
                            DEFAULT: '#3b9b18',
                            dark: '#1b5314',
                        }
                    },
                    fontFamily: {
                        sans: ['"Helvetica Neue"', 'Helvetica', 'Arial', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS & Tailwind Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <style>
        html {
            scroll-behavior: smooth;
        }

        #ofertas,
        #receitas,
        #servicos,
        #lojas {
            scroll-margin-top: 136px;
        }
    </style>
</head>

<body class="text-gray-800 antialiased bg-[#EBECEE]">

    <!-- Preloader -->
    <div id="preloader"
        class="fixed inset-0 bg-white z-[9999] flex flex-col items-center justify-center transition-all duration-500">
        <div class="flex flex-col items-center space-y-8">
            <img src="{{ $settings->logo ? asset($settings->logo) : asset('assets/img/logo.png') }}" alt="Fresmart" class="w-auto h-16 md:h-20 animate-pulse">
            <div class="loader"></div>
        </div>
    </div>

    <!-- Header -->
    <x-frontend.header />

    <!-- Mobile Menu -->
    <x-frontend.mobile-menu />

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-frontend.footer />

    <!-- Global Scripts -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenuClose = document.getElementById('mobile-menu-close');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileLinks = document.querySelectorAll('.mobile-link');

            const openMenu = () => {
                mobileMenu.classList.remove('translate-x-full');
                document.body.style.overflow = 'hidden';
            };

            const closeMenu = () => {
                mobileMenu.classList.add('translate-x-full');
                document.body.style.overflow = '';
            };

            if (mobileMenuToggle) mobileMenuToggle.addEventListener('click', openMenu);
            if (mobileMenuClose) mobileMenuClose.addEventListener('click', closeMenu);

            mobileLinks.forEach(link => {
                link.addEventListener('click', closeMenu);
            });

            // Preloader Logic
            window.addEventListener('load', () => {
                const preloader = document.getElementById('preloader');
                setTimeout(() => {
                    preloader.classList.add('opacity-0', 'invisible');
                }, 500);
            });
        });
    </script>
    {{ $scripts ?? '' }}
</body>

</html>
