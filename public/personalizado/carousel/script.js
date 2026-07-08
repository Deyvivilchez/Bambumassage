
  $(window).ready(function(){
    "use strict";
			var homeSlider = $('.home_slider');
			homeSlider.owlCarousel(
			{
				items:1,
				autoplay:true,
				loop:true,
				nav:false,
                padding:20,
				smartSpeed:1000,
                animateOut: 'fadeOut'
			});

			// Custom Navigation
			if($('.home_slider_next').length)
			{
				console.log("entro");
				var next = $('.home_slider_next');
				next.on('click', function()
				{
					homeSlider.trigger('next.owl.carousel');
				});
			}

			/* Custom dots events */
			if($('.btn-right').length)
			{

				$('.btn-right').on('click', function(ev)
				{
					homeSlider.trigger('next.owl.carousel');
				});
			}
			if($('.btn-left').length)
			{

				$('.btn-left').on('click', function(ev)
				{


					homeSlider.trigger('next.owl.carousel');
				});
			}

			/* Change active class for dots when slide changes by nav or touch */
			homeSlider.on('changed.owl.carousel', function(event)
			{
				// console.log("entro3");
				$('.home_slider_custom_dot').removeClass('active');
				$('.home_slider_custom_dots li').eq(event.page.index).addClass('active');
			});
            //contactanos inicio de carrucel
            var owl = $('.contactanosCarrusel');
                owl.owlCarousel({
                    // navText : ['<span class="fa fa-chevron-circle-left" aria-hidden="true"></span>','<span class="fa fa-chevron-circle-right" aria-hidden="true"></span>'],
                    dots:false,
                    loop: true,
                    nav: false,
                    lazyLoad: false,
                    margin: 0,
                    padding:0,
                    video: true,
                    autoHeight:false,
                    autoplay:true,
                    autoplayTimeout:2000,
                    responsive: {
                        0: {
                        items: 1
                        },
                        600: {
                        items: 2
                        },
                        960: {
                        items: 3
                        },
                        1200: {
                        items: 4
                        }
                    }
                    });
            owl.find('img').on('load', function() {
                owl.trigger('refresh.owl.carousel');
            });
            $(window).on('load resize', function() {
                owl.trigger('refresh.owl.carousel');
            });
            //fin contactanos inicio de carrucel

            $('.experienciaCarrusel').owlCarousel({
                center: true,
                dots:false,
                loop: true,
                nav: false,
                lazyLoad: false,
                margin: 0,
                padding:0,
                interval: 3000,
                video: true,
               // autoWidth:true,
               //autoHeight:true,
                interval: 100,
                autoplay:true,
                autoplayTimeout:2500,
                responsive: {
                    0: {
                    items: 1
                    },
                    700: {
                    items: 2
                    },
                    960: {
                    items: 3
                    },
                    1200: {
                    items: 3
                    }
                }
            });
  });
