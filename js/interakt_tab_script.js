(function(jQuery) {
	
	jQuery(document).on( 'click', '.interakt-tab .nav-tab-wrapper a', function() {
		jQuery('.section1').removeClass('tab-active-test');
	    jQuery('.section2').removeClass('tab-active-test');
	    jQuery('.section3').removeClass('tab-active-test');
		jQuery('section.tab_toggle').hide();
		jQuery(this).addClass('tab-active-test');
		jQuery('section.tab_toggle').eq(jQuery(this).index()).show();
		return false;
	})
})( jQuery );
 
