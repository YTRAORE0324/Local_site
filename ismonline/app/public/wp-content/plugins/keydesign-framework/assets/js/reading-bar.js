(function ($) {
	$(window).scroll(function() {
		'use strict';
        if ($(".rebar-wrapper").length) {
			let contentHeight = $("body.single-post .entry-content").height();
			let finalHeight = contentHeight + $("body.single-post .entry-content").offset().top;
			let winHeight = $(window).height();
			let viewport = finalHeight - winHeight;
			let scrollPos = $(window).scrollTop();
			let scrollPercent = (scrollPos / viewport) * 100;
			$(".rebar-element").css("width", scrollPercent + "%");
		}
	});
})(jQuery);