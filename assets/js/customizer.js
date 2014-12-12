/*global tinycolor */
( function( $ ) {

	function changeColor( color, adjustment, saturation ) {
		if ( tinycolor( color ).isLight() ) {
			return tinycolor( color ).darken( adjustment ).desaturate( saturation ).toHexString();
		} else {
			return tinycolor( color ).lighten( adjustment ).desaturate( saturation ).toHexString();
		}
	}

	function colorZeroPad( number ) {
		total = 6 - number.length;

		if ( 0 == total ) {
			return number;
		}

		for ( var i = 0; i < total; i++ ) {
			number = '0' + number;
		}

		return number;
	}

	function subtractColor( color, subtract ) {
		return '#' + pad( Math.abs( parseInt( color.replace( '#', '' ), 16 ) - parseInt( subtract.replace( '#', '' ), 16 ) ).toString( 16 ) );
	}

	// Primary Color.
	wp.customize( 'woocommerce_colors[primary]', function( value ) {
		value.bind( function( primary ) {
			var css         = '',
				primaryText = changeColor( primary, 50, 18 );

			// Buttons.
			css += '.woocommerce p.demo_store, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover { background-color: ' + primary + '; color: ' + primaryText + ' }';
			css += '.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover { background-color: ' + subtractColor( primary, '#111111' ) + '; color: ' + primaryText + ' }';

			// Widget proce filter.
			css += '.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-range { background-color: ' + primary + ' }';
			css += '.woocommerce .price_slider_wrapper .ui-widget-content { background-color: ' + subtractColor( primary, '#444444' ) + '  }';

			$( '#woocommerce-colors-primary' ).remove();
			$( 'head' ).append( '<style id="woocommerce-colors-primary">' + css + '</style>' );
		});
	});

	// Secondary Color.
	wp.customize( 'woocommerce_colors[secondary]', function( value ) {
		value.bind( function( secondary ) {
			var css           = '',
				secondaryText = changeColor( secondary, 60, 18 );

			// Messages.
			css += '.woocommerce .woocommerce-message, .woocommerce .woocommerce-error, .woocommerce .woocommerce-info { background-color: ' + tinycolor( secondary ).lighten( 5 ).toHexString() + '; color: ' + secondaryText + ' }';

			// Tabs.
			css += '.woocommerce div.product .woocommerce-tabs ul.tabs li { border: 1px solid ' + tinycolor( secondary ).darken( 10 ).toHexString() + '; background-color: ' + secondary + '; }';
			css += '.woocommerce div.product .woocommerce-tabs ul.tabs li a { color: ' + secondaryText + '; }';
			css += '.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover { color: ' + tinycolor( secondaryText ).lighten( 10 ).toHexString() + '; }';
			css += '.woocommerce div.product .woocommerce-tabs ul.tabs li:before, .woocommerce div.product .woocommerce-tabs ul.tabs li:after { border: 1px solid ' + tinycolor( secondary ).darken( 10 ).toHexString() + '; }';
			css += '.woocommerce div.product .woocommerce-tabs ul.tabs li:before { box-shadow: 2px 2px 0 ' + secondary + '; }';
			css += '.woocommerce div.product .woocommerce-tabs ul.tabs li:after { box-shadow: -2px 2px 0 ' + secondary + '; }';
			css += '.woocommerce div.product .woocommerce-tabs ul.tabs:before { border-bottom: 1px solid ' + tinycolor( secondary ).darken( 10 ).toHexString() + '; }';

			// Pagination.
			css += '.woocommerce nav.woocommerce-pagination ul { border: 1px solid ' + tinycolor( secondary ).darken( 10 ).toHexString() + '; }';
			css += '.woocommerce nav.woocommerce-pagination ul li { border-right: 1px solid ' + tinycolor( secondary ).darken( 10 ).toHexString() + '; }';
			css += '.woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus { background: ' + secondary + '; color: ' + tinycolor( secondary ).darken( 40 ).toHexString() + '; }';

			// Buttons.
			css += '.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit { color: ' + secondaryText + '; background-color: ' + secondary + '; }';
			css += '.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,	.woocommerce #respond input#submit:hover { background-color: ' + subtractColor( secondary, '#111111' ) + ';	color: ' + secondaryText + '; }';
			css += '.woocommerce a.button:disabled:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled[disabled]:hover,	.woocommerce button.button:disabled:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled[disabled]:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled[disabled]:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled[disabled]:hover { background-color: ' + secondary + '; }';

			// Reviews.
			css += '.woocommerce #reviews #comments ol.commentlist li img.avatar { background: ' + secondary + '; border: 1px solid ' + tinycolor( secondary ).darken( 4 ).toHexString() + '; }';
			css += '.woocommerce #reviews #comments ol.commentlist li .comment-text { border: 1px solid ' + tinycolor( secondary ).darken( 4 ).toHexString() + '; }';
			css += '.woocommerce #reviews #comments ol.commentlist #respond { border: 1px solid ' + tinycolor( secondary ).darken( 4 ).toHexString() + '; }';

			// Ratings.
			css += '.woocommerce .star-rating:before { color: ' + tinycolor( secondary ).darken( 10 ).toHexString() + '; }';

			// Widget shopping cart.
			css += '.woocommerce.widget_shopping_cart .total, .woocommerce .widget_shopping_cart .total { border-top: 3px double ' + secondary + '; }';

			// Forms.
			css += '.woocommerce form.login, .woocommerce form.checkout_coupon, .woocommerce form.register { border: 1px solid ' + tinycolor( secondary ).darken( 10 ).toHexString() + '; }';

			// Order page.
			css += '.woocommerce .order_details li { border-right: 1px dashed ' + tinycolor( secondary ).darken( 10 ).toHexString() + '; }';

			// Cart page.
			css += '.woocommerce-cart table.cart td.actions .coupon .input-text { border: 1px solid ' + tinycolor( secondary ).darken( 10 ).toHexString() + '; }';
  			css += '.woocommerce-cart .cart-collaterals .cart_totals tr td, .woocommerce-cart .cart-collaterals .cart_totals tr th { border-top: 1px solid ' + secondary + '; }';

  			// Checkout page.
			css += '.woocommerce-checkout #payment { background: ' + secondary + '; }';
			css += '.woocommerce-checkout #payment ul.payment_methods { border-bottom: 1px solid ' + tinycolor( secondary ).darken( 10 ).toHexString() + '; }';
			css += '.woocommerce-checkout #payment div.payment_box { background-color: ' + tinycolor( secondary ).darken( 5 ).toHexString() + '; color: ' + secondaryText + '; }';
			css += '.woocommerce-checkout #payment div.payment_box input.input-text, .woocommerce-checkout #payment div.payment_box textarea { border-color: ' + tinycolor( secondary ).darken( 15 ).toHexString() + '; border-top-color: ' + tinycolor( secondary ).darken( 20 ).toHexString() + '; }';
			css += '.woocommerce-checkout #payment div.payment_box ::-webkit-input-placeholder { color: ' + tinycolor( secondary ).darken( 20 ).toHexString() + '; }';
			css += '.woocommerce-checkout #payment div.payment_box :-moz-placeholder { color: ' + tinycolor( secondary ).darken( 20 ).toHexString() + '; }';
			css += '.woocommerce-checkout #payment div.payment_box :-ms-input-placeholder { color: ' + tinycolor( secondary ).darken( 20 ).toHexString() + '; }';
			css += '.woocommerce-checkout #payment div.payment_box:after { border: 8px solid ' + tinycolor( secondary ).darken( 5 ).toHexString() + '; }';

			$( '#woocommerce-colors-secondary' ).remove();
			$( 'head' ).append( '<style id="woocommerce-colors-secondary">' + css + '</style>' );

		});
	});


})( jQuery );
