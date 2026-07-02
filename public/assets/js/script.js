/* C:\Users\sh\.gemini\antigravity\scratch\fresmart\script.js */
document.addEventListener('DOMContentLoaded', () => {
  const observerOptions = {
    root: null,
    rootMargin: '0px 0px 50px 0px',
    threshold: 0.05
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target); 
      }
    });
  }, observerOptions);

  const elementsToAnimate = document.querySelectorAll('.animate-on-scroll');
  elementsToAnimate.forEach(el => {
    observer.observe(el);
  });

  // Hero Slider Logic
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.slider-dot');
  let currentSlide = 0;
  const slideInterval = 6000; // 6 seconds

  if (slides.length > 0) {
    const showSlide = (index) => {
      slides.forEach((slide, i) => {
        if (i === index) {
          slide.classList.add('opacity-100', 'z-10');
          slide.classList.remove('opacity-0', 'z-0');
        } else {
          slide.classList.remove('opacity-100', 'z-10');
          slide.classList.add('opacity-0', 'z-0');
        }
      });

      dots.forEach((dot, i) => {
        if (i === index) {
          dot.classList.add('bg-white');
          dot.classList.remove('bg-white/30');
        } else {
          dot.classList.remove('bg-white');
          dot.classList.add('bg-white/30');
        }
      });
      
      currentSlide = index;
    };

    const nextSlide = () => {
      let next = (currentSlide + 1) % slides.length;
      showSlide(next);
    };

    let autoSlide = setInterval(nextSlide, slideInterval);

    dots.forEach(dot => {
      dot.addEventListener('click', () => {
        const index = parseInt(dot.getAttribute('data-index'));
        showSlide(index);
        clearInterval(autoSlide);
        autoSlide = setInterval(nextSlide, slideInterval);
      });
    });
  }
});
