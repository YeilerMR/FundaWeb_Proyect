$(document).ready(function () {

    // Scroll Header
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('body').addClass('scrolled');
            $('.header').addClass('scrolled');
        } else {
            $('body').removeClass('scrolled');
            $('.header').removeClass('scrolled');
        }
    });

    // AOS Init
    AOS.init({
        duration: 600,
        easing: 'ease-in-out',
        once: true,
        mirror: false
    });

    // ---------------------------
    // HERO SLIDER (solo si existe)
    // ---------------------------
    const heroDataElement = $('#heroSlickData');
    if (heroDataElement.length > 0) {
        try {
            const heroSlidesData = JSON.parse(heroDataElement.attr('data-slides') || '[]');

            if (heroSlidesData.length > 0) {
                // Pre-carga de imágenes
                heroSlidesData.forEach(slide => {
                    const img = new Image();
                    img.src = slide.imagen;
                });

                // Inicializar Slick solo si existe el contenedor
                if ($('.hero-slick').length > 0 && $.fn.slick) {
                    $('.hero-slick').slick({
                        dots: true,
                        infinite: true,
                        speed: 1200,
                        fade: true,
                        cssEase: 'ease-in-out',
                        autoplay: true,
                        autoplaySpeed: 5000,
                        pauseOnHover: false,
                        pauseOnFocus: false,
                        prevArrow: $('.hero-arrow.left'),
                        nextArrow: $('.hero-arrow.right')
                    });

                    // Función para actualizar contenido
                    function updateHeroContent(index) {
                        const slide = heroSlidesData[index];
                        $('.hero-section').css({
                            backgroundImage: `url(${slide.imagen})`,
                            backgroundSize: 'cover',
                            backgroundPosition: 'center'
                        });
                        $('.hero-content').removeClass('show');
                        setTimeout(() => {
                            $('.hero-title').text(slide.titulo);
                            $('.hero-subtitle').text(slide.subtitulo);
                            $('.btn-slider').attr('href', slide.enlace ?? '#');
                            $('.hero-content').addClass('show');
                        }, 300);
                    }

                    // Primer slide y evento de cambio
                    updateHeroContent(0);
                    $('.hero-slick').on('afterChange', function (event, slick, currentSlide) {
                        updateHeroContent(currentSlide);
                    });
                }
            }
        } catch (error) {
            console.warn('⚠️ Error al parsear heroSlidesData:', error);
        }
    }

    // ---------------------------
    // Fancybox (solo si existe)
    // ---------------------------
    if (window.Fancybox) {
        Fancybox.bind('[data-fancybox="galeria"]', {
            Thumbs: { autoStart: true },
            Toolbar: { display: ["close"] },
            animated: true,
            dragToClose: true
        });
    }

});
