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

    // OBTENER DATA DEL SLIDER DESDE BLADE
    const heroSlidesData = JSON.parse($('#heroSlickData').attr('data-slides'));

    // PRE-CARGA DE IMÁGENES
    heroSlidesData.forEach(slide => {
        const img = new Image();
        img.src = slide.imagen;
    });

    // INICIALIZAR SLICK
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

    // ACTUALIZAR FONDO Y TEXTO 
    function updateHeroContent(index) {
        const slide = heroSlidesData[index];

        // Fondo del contenedor global
        $('.hero-section').css({
            backgroundImage: `url(${slide.imagen})`,
            backgroundSize: 'cover',
            backgroundPosition: 'center'
        });

        // Animación del texto
        $('.hero-content').removeClass('show');

        setTimeout(() => {
            $('.hero-title').text(slide.titulo);
            $('.hero-subtitle').text(slide.subtitulo);
            $('.btn-slider').attr('href', slide.enlace ?? '#');
            $('.hero-content').addClass('show');
        }, 300);
    }

    // Primer slide
    updateHeroContent(0);

    // Cuando cambia slick
    $('.hero-slick').on('afterChange', function (event, slick, currentSlide) {
        updateHeroContent(currentSlide);
    });

    // Fancybox (por si se usa luego)
    if (window.Fancybox) {
        Fancybox.bind('[data-fancybox="galeria"]', {
            Thumbs: { autoStart: true },
            Toolbar: { display: ["close"] },
            animated: true,
            dragToClose: true
        });
    }

});
