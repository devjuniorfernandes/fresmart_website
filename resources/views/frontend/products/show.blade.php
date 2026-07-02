<x-frontend.layout>
    <x-slot:meta_title>{{ $product->name }} - Produtos Fresmart</x-slot>
    <x-slot:meta_description>{{ Str::limit(strip_tags($product->description), 150) }}</x-slot>
    @if ($product->image)
        <x-slot:meta_image>{{ str_starts_with($product->image, 'uploads/') ? $product->image : 'storage/' . $product->image }}</x-slot>
    @endif

    <!-- Interactive Responsive Image Carousel -->
    @php
        $carouselImages = [];
        if ($product->image) {
            $carouselImages[] = str_starts_with($product->image, 'uploads/')
                ? $product->image
                : 'storage/' . $product->image;
        }
        if ($product->gallery) {
            $galleryImgs = json_decode($product->gallery, true) ?? [];
            foreach ($galleryImgs as $gImg) {
                $carouselImages[] = str_starts_with($gImg, 'uploads/') ? $gImg : 'storage/' . $gImg;
            }
        }
        if (count($carouselImages) === 0) {
            $carouselImages[] = 'assets/img/slider1.png';
        }
    @endphp

    <div class="relative w-full overflow-hidden bg-gray-900 group" style="height: 480px;">
        <!-- Slides Wrapper -->
        <div id="carousel-slides" class="flex h-full transition-transform duration-500 ease-out">
            @foreach ($carouselImages as $index => $imgSrc)
                <div class="w-full md:w-1/2 lg:w-1/3 h-full flex-shrink-0 relative border-r border-white/10">
                    <img src="{{ asset($imgSrc) }}" alt="Imagem {{ $index + 1 }}" class="w-full h-full object-cover">
                    <!-- Dark Gradient Overlay for title readability -->
                </div>
            @endforeach
        </div>

        <!-- Banner Info (Title) -->

        @if (count($carouselImages) > 1)
            <!-- Left Navigation Arrow -->
            <button onclick="prevSlide()"
                class="absolute left-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/80 hover:bg-white text-gray-800 flex items-center justify-center shadow-lg hover:scale-105 transition-all duration-200 z-30 focus:outline-none">
                <i class="fas fa-chevron-left text-lg"></i>
            </button>

            <!-- Right Navigation Arrow -->
            <button onclick="nextSlide()"
                class="absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/80 hover:bg-white text-gray-800 flex items-center justify-center shadow-lg hover:scale-105 transition-all duration-200 z-30 focus:outline-none">
                <i class="fas fa-chevron-right text-lg"></i>
            </button>

            <!-- Bottom Left Info Pill -->
            <div class="absolute bottom-6 left-6 flex items-center gap-2 z-25 pointer-events-none select-none">
                <div
                    class="bg-black/60 backdrop-blur-md text-white text-[12px] font-bold px-3.5 py-2 rounded-full flex items-center gap-1.5 shadow-md">
                    <i class="fas fa-camera"></i> <span>{{ count($carouselImages) }} fotos</span>
                </div>
            </div>

            <!-- Bottom Right Counter Indicator -->
            <div class="absolute bottom-6 right-6 z-25 pointer-events-none select-none">
                <div
                    class="bg-black/60 backdrop-blur-md text-white text-[12px] font-bold px-4 py-2 rounded-full shadow-md">
                    <span id="carousel-index">1</span> / {{ count($carouselImages) }}
                </div>
            </div>
        @endif
    </div>

    @if (count($carouselImages) > 1)
        <!-- Carousel Slider Script -->
        <script>
            (function() {
                let currentSlide = 0;
                const totalSlides = {{ count($carouselImages) }};
                const slidesContainer = document.getElementById('carousel-slides');
                const indexIndicator = document.getElementById('carousel-index');

                function getVisibleCount() {
                    if (window.innerWidth >= 1024) return 3; // lg and up (max 3 images visible)
                    if (window.innerWidth >= 768) return 2; // md
                    return 1; // sm
                }

                window.updateCarousel = function() {
                    const slideElements = slidesContainer.children;
                    if (slideElements.length > 0) {
                        const slideWidth = slideElements[0].getBoundingClientRect().width;
                        slidesContainer.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
                    }
                    if (indexIndicator) {
                        indexIndicator.textContent = currentSlide + 1;
                    }
                };

                window.nextSlide = function() {
                    const visibleCount = getVisibleCount();
                    const maxSlide = Math.max(0, totalSlides - visibleCount);
                    if (currentSlide >= maxSlide) {
                        currentSlide = 0; // Wrap around
                    } else {
                        currentSlide++;
                    }
                    updateCarousel();
                };

                window.prevSlide = function() {
                    const visibleCount = getVisibleCount();
                    const maxSlide = Math.max(0, totalSlides - visibleCount);
                    if (currentSlide <= 0) {
                        currentSlide = maxSlide; // Wrap around to end
                    } else {
                        currentSlide--;
                    }
                    updateCarousel();
                };

                // Auto slide every 6 seconds
                let autoSlideTimer = setInterval(nextSlide, 6000);

                function resetTimer() {
                    clearInterval(autoSlideTimer);
                    autoSlideTimer = setInterval(nextSlide, 6000);
                }

                // Reset timer when arrows are clicked
                document.querySelectorAll('#carousel-slides, button').forEach(el => {
                    el.addEventListener('click', resetTimer);
                });

                // Listen for window resize to adjust offsets
                window.addEventListener('resize', () => {
                    const visibleCount = getVisibleCount();
                    const maxSlide = Math.max(0, totalSlides - visibleCount);
                    if (currentSlide > maxSlide) {
                        currentSlide = maxSlide;
                    }
                    updateCarousel();
                });

                // Initial alignment
                setTimeout(updateCarousel, 100);
            })();
        </script>
    @endif

    <div class="bg-white  p-8 md:p-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">{{ $product->name }}</h2>

        <div class="rich-content text-gray-700 text-lg leading-relaxed">
            {!! $product->description ??
                '<p class="text-gray-500">Nenhuma descrição fornecida para este departamento de produto.</p>' !!}
        </div>
    </div>
</x-frontend.layout>
