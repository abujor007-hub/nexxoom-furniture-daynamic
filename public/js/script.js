$(document).ready(function(){

  $('.left-slider').slick({
    dots: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 4000,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1
  });

  $('.left-prev').click(function(){ $('.left-slider').slick('slickPrev'); });
  $('.left-next').click(function(){ $('.left-slider').slick('slickNext'); });

});





// best saller start
  $(document).ready(function(){
    $('#product-slider').slick({
      dots: false,
      arrows: false,
      infinite: true,
      speed: 400,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2500,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2
          }
        }
      ]
    });
  }); 
// best saller end



$(document).ready(function(){
  $('.product-slider').slick({
    dots: true,
    arrows: false,
    infinite: true,
    speed: 400,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: false,
    responsive: [
      {
        breakpoint: 992, // < lg : show 3
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 768, // < md : show 2 (mobile)
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      }
    ]
  });
});






document.addEventListener('DOMContentLoaded', function () {

    const tabButtons = document.querySelectorAll(
        '#furnitureTabs .nav-link'
    );

    tabButtons.forEach(function (button) {

        button.addEventListener('shown.bs.tab', function () {

            // সব nav item থেকে bg-nex remove
            tabButtons.forEach(function (item) {
                item.classList.remove('bg-nex');
            });

            // যে item click করা হয়েছে সেটাতে bg-nex add
            button.classList.add('bg-nex');

        });

    });

    // প্রথম active item-এ bg-nex
    const activeButton = document.querySelector(
        '#furnitureTabs .nav-link.active'
    );

    if (activeButton) {
        activeButton.classList.add('bg-nex');
    }

});









document.addEventListener('DOMContentLoaded', function () {

    const wrapper = document.getElementById('backToTopWrapper');
    const button = document.getElementById('backToTop');
    const progress = document.getElementById('scrollProgress');

    const circumference = 144.5;

    window.addEventListener('scroll', function () {

        const scrollTop = window.scrollY;

        const scrollHeight =
            document.documentElement.scrollHeight - window.innerHeight;

        const percentage = scrollHeight > 0
            ? scrollTop / scrollHeight
            : 0;

        progress.style.strokeDashoffset =
            circumference - (percentage * circumference);

        if (scrollTop > 300) {
            wrapper.classList.remove('d-none');
        } else {
            wrapper.classList.add('d-none');
        }

    });

    button.addEventListener('click', function () {

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

    });

});










