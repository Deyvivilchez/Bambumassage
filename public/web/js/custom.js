/* JS Document */

/******************************

[Table of Contents]

1. Vars and Inits
2. Set Header
3. Init Menu
4. Init Home Slider
5. Init Gallery
6. Init Testimonials Slider
7. Init Lightbox


******************************/

$(document).ready(function()
{
	"use strict";

	/*

	1. Vars and Inits

	*/

	var header = $('.header');
	var menuActive = false;
	var menu = $('.menu');
	var burger = $('.burger_container');

	setHeader();

	$(window).on('resize', function()
	{
		setHeader();
	});

	$(document).on('scroll', function()
	{
		setHeader();
	});

	// initHomeSlider();
	initMenu();
	initGallery();
	initTestSlider();
	initLightbox();

	/*

	2. Set Header

	*/

	function setHeader()
	{
		if($(window).scrollTop() > 100)
		{
			header.addClass('scrolled');
		}
		else
		{
			header.removeClass('scrolled');
		}
	}

	/*

	3. Init Menu

	*/

	function initMenu()
	{
		if($('.menu').length)
		{
			var menu = $('.menu');
			if($('.burger_container').length)
			{
				burger.on('click', function()
				{
					if(menuActive)
					{
						closeMenu();
					}
					else
					{
						openMenu();

						$(document).one('click', function cls(e)
						{
							if($(e.target).hasClass('menu_mm'))
							{
								$(document).one('click', cls);
							}
							else
							{
								closeMenu();
							}
						});
					}
				});
			}
		}
	}

	function openMenu()
	{
		menu.addClass('active');
		menuActive = true;
	}

	function closeMenu()
	{
		menu.removeClass('active');
		menuActive = false;
	}

	/*

	4. Init Home Slider

	*/
function customPager() {

        $.each(this.owl.userItems, function (i) {

            var titleData = jQuery(this).find('h3').text();
            var paginationLinks = jQuery('.owl-controls .owl-pagination .owl-page span');

            $(paginationLinks[i]).append(titleData).wrap('<h3 class="slideTitle"></h3>');

        });
    }


	/*

	5. Init Gallery

	*/

	$('.btn-right-experiencia').on('click', function(ev)
  {
	currentSlidId=1;
	sliderElement=document.getElementById("carousel-expe");
	totalSlides=sliderElement.childElementCount;

	;

  });
	function initGallery()
	{
		if($('.gallery_slider').length)
		{
			var gallerySlider = $('.gallery_slider');
			gallerySlider.owlCarousel(
			{
				items:6,
				loop:true,
				margin:22,
				autoplay:true,
				nav:false,
				dots:false,
				responsive:
				{
					0:
					{
						margin:7,
						items:3
					},
					575:
					{
						margin:7,
						items:6
					},
					991:
					{
						margin:22,
						items:6
					}
				}
			});
		}
	}

	/*

	6. Init Testimonials Slider

	*/

	function initTestSlider()
	{
		if($('.test_slider').length)
		{
			var testSlider = $('.test_slider');
			testSlider.owlCarousel(
			{
				items:1,
				loop:true,
				autoplay:true,
				smartSpeed:1200,
				nav:false,
				dots:false
			});
		}
	}

	/*

	7. Init Lightbox

	*/

	function initLightbox()
	{
		if($('.gallery_item').length)
		{
			$('.colorbox').colorbox(
			{
				rel:'colorbox',
				photo: true,
				maxWidth:'95%',
				maxHeight:'95%'
			});
		}
	}
});
