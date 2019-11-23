$(document).ready(function() {  
	// adding swipe effect to slider
  	$("#full-width-carousel").swipe({

	  swipe: function(event, direction, distance, duration, fingerCount, fingerData) {

	    if (direction == 'left') $(this).carousel('next');
	    if (direction == 'right') $(this).carousel('prev');

	  },
	  allowPageScroll:"vertical"

	});

  	// carousel progress bar
  	var percent = 0,
	interval = 30,//it takes about 6s, interval=20 takes about 4s
	$bar = $('.transition-timer-carousel-progress-bar'),
	$crsl = $('#full-width-carousel');
	$('.carousel-indicators li, .carousel-control').click(function (){$bar.css({width:0.5+'%'});});
	/*line above just for showing when controls are clicked the bar goes to 0.5% to make more friendly, 
	if you want when clicked set bar empty, change on width:0.5 to width:0*/
	$crsl.carousel({//initialize
		interval: false,
		pause: true
	}).on('slide.bs.carousel', function (){percent = 0;});//This event fires immediately when the bootstrap slide instance method is invoked.
	function progressBarCarousel() {
		$bar.css({width:percent+'%'});
		percent = percent +0.5;
		if (percent>=100) {
			percent=0;
			$crsl.carousel('next');
		}
	}
	var barInterval = setInterval(progressBarCarousel, interval);//set interval to progressBarCarousel function
	if (!(/Mobi/.test(navigator.userAgent))) {//tests if it isn't mobile
		$crsl.hover(function(){
					clearInterval(barInterval);
				},
				function(){
					barInterval = setInterval(progressBarCarousel, interval);
				}
		);
	}


});  
  
/*!
 * @fileOverview TouchSwipe - jQuery Plugin
 * @version 1.6.18
 *
 * @author Matt Bryson http://www.github.com/mattbryson
 * @see https://github.com/mattbryson/TouchSwipe-Jquery-Plugin
 * @see http://labs.rampinteractive.co.uk/touchSwipe/
 * @see http://plugins.jquery.com/project/touchSwipe
 * @license
 * Copyright (c) 2010-2015 Matt Bryson
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 */
/**/