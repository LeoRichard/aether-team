/*
* Aether Team main script
* Author: Richard Leo
*/

(function ($) {

	//console.log('Aether team plugin is running...');

	$('.aether-slick').slick({
	  dots: false,
	  arrows: true,
	  infinite: false,
	  speed: 300,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  focusOnSelect: true,
	  prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-chevron-left' aria-hidden='true'></i></button>",
    nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-chevron-right' aria-hidden='true'></i></button>",
	  asNavFor: '.aether-slick-content',
	  responsive: [
	    {
	      breakpoint: 1025,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 3,
	        infinite: true,
	        dots: false
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 2
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1,
	        arrows: true,
	      }
	    }
	  ]
	});

	$('.aether-slick-content').slick({
	  dots: false,
	  arrows: false,
	  infinite: false,
	  fade: true,
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  asNavFor: '.aether-slick'
	});

	// Init with first filter
	$(document).ready(function() {
	  $('.aether-team-filter[data-filter=directores]').click();
	});

	$(document).on('click', '.aether-team-filter', function(a){
    $(".aether-team-category-filters span.active").removeClass("active");
    $(this).addClass("active");
    filterValue = $(this).attr("data-filter");
    var $slider = $('.aether-slick, .aether-slick-content');
    $slider.slick('slickUnfilter').slick('slickFilter', ".aether-team-filter-value[data-category="+ filterValue +"]");

    $slider.each(function(index,slide){
      s_id = 0;
      //console.log(index,slide,s_id);
      $(".slick-slide:not(.slick-cloned)",slide).each(function(s_index,s_slide) {
        $(this).attr("data-slick-index",s_id);
        s_id = s_id+1;
        if (index==0) {
          if ($(this).hasClass("slick-current")) {
              active_index = s_id;
          }
        }
        if (index==1) {
          if (s_id==active_index) {
            $(this).addClass("slick-current");
          } else {
            $(this).removeClass("slick-current");
          }
        }
      });
    });
    $slider.slick('slickGoTo',0,true);
	});

	$('.aether-team-see-more').on('click', function(e) {
		$('p', this).text($('p', this).text() == 'Ver más' ? 'Ver menos' : 'Ver más');
		$(this).next().slideToggle();
		e.stopPropagation();
	});

	$('.aether-team-scroll').click(function(e){
    var jump = $(this).attr('href');
    var new_position = $(jump).offset();
    $('html, body').stop().animate({ scrollTop: new_position.top }, 500);
    e.preventDefault();
	});

})(jQuery);
