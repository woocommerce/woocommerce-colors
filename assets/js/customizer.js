( function( $ ) {

	// Primary Color.
	wp.customize( 'woocommerce_styles[primary]', function( value ) {
		value.bind( function( color ) {
			$( 'a.button, button.button, input.button, #respond input#submit ' ).css( 'background-color', color );
		});
	});

})( jQuery );
