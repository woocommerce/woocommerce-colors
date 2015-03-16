/*global tinycolor */
( function( $ ) {

	function isDark( color ) {
		var rgb = tinycolor( color ).toRgb(),
			brightness = ( ( rgb.r * 299 ) + ( rgb.g * 587 ) + ( rgb.b * 114 ) ) / 1000;

		return brightness < 155;
	}

	function changeColor( color, adjustment, saturation ) {
		if ( isDark( color ) ) {
			return tinycolor( color ).lighten( adjustment ).desaturate( saturation ).toString();
		} else {
			return tinycolor( color ).darken( adjustment ).desaturate( saturation ).toString();
		}
	}

	function colorZeroPad( number ) {
		var total = 6 - number.length;

		if ( 0 === total ) {
			return number;
		}

		for ( var i = 0; i < total; i++ ) {
			number = '0' + number;
		}

		return number;
	}

	function subtractColor( color, subtract ) {
		return '#' + colorZeroPad( Math.abs( parseInt( color.replace( '#', '' ), 16 ) - parseInt( subtract.replace( '#', '' ), 16 ) ).toString( 16 ) );
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
			css += '.woocommerce .woocommerce-message, .woocommerce .woocommerce-error, .woocommerce .woocommerce-info { background-color: ' + tinycolor( secondary ).lighten( 5 ).toString() + '; color: ' + secondaryText + ' }';

			// Tabs.
			// css += '.woocommerce div.product .woocommerce-tabs ul.tabs li { border: 1px solid ' + tinycolor( secondary ).darken( 10 ).toString() + '; background-color: ' + secondary + '; }';
			// css += '.woocommerce div.product .woocommerce-tabs ul.tabs li a { color: ' + secondaryText + '; }';
			// css += '.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover { color: ' + tinycolor( secondaryText ).lighten( 10 ).toString() + '; }';
			// css += '.woocommerce div.product .woocommerce-tabs ul.tabs li:before, .woocommerce div.product .woocommerce-tabs ul.tabs li:after { border: 1px solid ' + tinycolor( secondary ).darken( 10 ).toString() + '; position: absolute; bottom: -1px; width: 5px; height: 5px; content: " "; }';
			// css += '.woocommerce div.product .woocommerce-tabs ul.tabs li:before { box-shadow: 2px 2px 0 ' + secondary + '; left: -6px; -webkit-border-bottom-right-radius: 4px; -moz-border-bottom-right-radius: 4px; border-bottom-right-radius: 4px; border-width: 0 1px 1px 0; }';
			// css += '.woocommerce div.product .woocommerce-tabs ul.tabs li:after { box-shadow: -2px 2px 0 ' + secondary + '; right: -6px; -webkit-border-bottom-left-radius: 4px; -moz-border-bottom-left-radius: 4px; border-bottom-left-radius: 4px; border-width: 0 0 1px 1px; }';
			// css += '.woocommerce div.product .woocommerce-tabs ul.tabs:before { border-bottom: 1px solid ' + tinycolor( secondary ).darken( 10 ).toString() + '; }';

			// Pagination.
			css += '.woocommerce nav.woocommerce-pagination ul { border: 1px solid ' + tinycolor( secondary ).darken( 10 ).toString() + '; }';
			css += '.woocommerce nav.woocommerce-pagination ul li { border-right: 1px solid ' + tinycolor( secondary ).darken( 10 ).toString() + '; }';
			css += '.woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus { background: ' + secondary + '; color: ' + tinycolor( secondary ).darken( 40 ).toString() + '; }';

			// Buttons.
			css += '.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit { color: ' + secondaryText + '; background-color: ' + secondary + '; }';
			css += '.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,	.woocommerce #respond input#submit:hover { background-color: ' + subtractColor( secondary, '#111111' ) + ';	color: ' + secondaryText + '; }';
			css += '.woocommerce a.button:disabled:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled[disabled]:hover,	.woocommerce button.button:disabled:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled[disabled]:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled[disabled]:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled[disabled]:hover { background-color: ' + secondary + '; }';

			// Reviews.
			css += '.woocommerce #reviews #comments ol.commentlist li img.avatar { background: ' + secondary + '; border: 1px solid ' + tinycolor( secondary ).darken( 4 ).toString() + '; }';
			css += '.woocommerce #reviews #comments ol.commentlist li .comment-text { border: 1px solid ' + tinycolor( secondary ).darken( 4 ).toString() + '; }';
			css += '.woocommerce #reviews #comments ol.commentlist #respond { border: 1px solid ' + tinycolor( secondary ).darken( 4 ).toString() + '; }';

			// Ratings.
			css += '.woocommerce .star-rating:before { color: ' + tinycolor( secondary ).darken( 10 ).toString() + '; }';

			// Widget shopping cart.
			css += '.woocommerce.widget_shopping_cart .total, .woocommerce .widget_shopping_cart .total { border-top: 3px double ' + secondary + '; }';

			// Forms.
			css += '.woocommerce form.login, .woocommerce form.checkout_coupon, .woocommerce form.register { border: 1px solid ' + tinycolor( secondary ).darken( 10 ).toString() + '; }';

			// Order page.
			css += '.woocommerce .order_details li { border-right: 1px dashed ' + tinycolor( secondary ).darken( 10 ).toString() + '; }';

			// Cart page.
			css += '.woocommerce-cart table.cart td.actions .coupon .input-text { border: 1px solid ' + tinycolor( secondary ).darken( 10 ).toString() + '; }';
			css += '.woocommerce-cart .cart-collaterals .cart_totals tr td, .woocommerce-cart .cart-collaterals .cart_totals tr th { border-top: 1px solid ' + secondary + '; }';

			// Checkout page.
			css += '.woocommerce-checkout #payment { background: ' + secondary + '; }';
			css += '.woocommerce-checkout #payment ul.payment_methods { border-bottom: 1px solid ' + tinycolor( secondary ).darken( 10 ).toString() + '; }';
			css += '.woocommerce-checkout #payment div.payment_box { background-color: ' + tinycolor( secondary ).darken( 5 ).toString() + '; color: ' + secondaryText + '; }';
			css += '.woocommerce-checkout #payment div.payment_box input.input-text, .woocommerce-checkout #payment div.payment_box textarea { border-color: ' + tinycolor( secondary ).darken( 15 ).toString() + '; border-top-color: ' + tinycolor( secondary ).darken( 20 ).toString() + '; }';
			css += '.woocommerce-checkout #payment div.payment_box ::-webkit-input-placeholder { color: ' + tinycolor( secondary ).darken( 20 ).toString() + '; }';
			css += '.woocommerce-checkout #payment div.payment_box :-moz-placeholder { color: ' + tinycolor( secondary ).darken( 20 ).toString() + '; }';
			css += '.woocommerce-checkout #payment div.payment_box :-ms-input-placeholder { color: ' + tinycolor( secondary ).darken( 20 ).toString() + '; }';
			css += '.woocommerce-checkout #payment div.payment_box:after { border: 8px solid ' + tinycolor( secondary ).darken( 5 ).toString() + '; content: ""; display: block; border-right-color: transparent; border-left-color: transparent; border-top-color: transparent; position: absolute; top: -3px; left: 0; margin: -1em 0 0 2em; }';

			$( '#woocommerce-colors-secondary' ).remove();
			$( 'head' ).append( '<style id="woocommerce-colors-secondary">' + css + '</style>' );

		});
	});

	// Highlight Color.
	wp.customize( 'woocommerce_colors[highlight]', function( value ) {
		value.bind( function( highlight ) {
			var css         = '',
				highlightText = changeColor( highlight, 60, 18 );

			// Product page.
			css += '.woocommerce div.product span.price, .woocommerce div.product p.price { color: ' + highlight + '; }';
			css += '.woocommerce div.product .stock { color: ' + highlight + '; }';

			// On Sale.
			css += '.woocommerce span.onsale { background-color: ' + highlight + '; color: ' + highlightText + '; }';

			// Products loop.
			css += '.woocommerce ul.products li.product .price { color: ' + highlight + '; }';
			css += '.woocommerce ul.products li.product .price .from { color: ' + tinycolor( highlight ).desaturate( 75 ).setAlpha( 0.5 ).toString() + '; }';

			// Cart page.
			css += '.woocommerce-cart .cart-collaterals .cart_totals .discount td { color: ' + highlight + '; }';

			$( '#woocommerce-colors-highlight' ).remove();
			$( 'head' ).append( '<style id="woocommerce-colors-highlight">' + css + '</style>' );
		});
	});

	// Content Background Color.
	wp.customize( 'woocommerce_colors[contentbg]', function( value ) {
		value.bind( function( contentbg ) {
			var css = '';

			// Product page.
			// css += '.woocommerce div.product .woocommerce-tabs ul.tabs li.active { background: ' + contentbg + '; border-bottom-color: ' + contentbg + '; }';
			// css += '.woocommerce div.product .woocommerce-tabs ul.tabs li.active:before { box-shadow: 2px 2px 0 ' + contentbg + '; }';
			// css += '.woocommerce div.product .woocommerce-tabs ul.tabs li.active:after { box-shadow: -2px 2px 0 ' + contentbg + '; }';

			$( '#woocommerce-colors-contentbg' ).remove();
			$( 'head' ).append( '<style id="woocommerce-colors-contentbg">' + css + '</style>' );
		});
	});

	// Subtext Color.
	wp.customize( 'woocommerce_colors[subtext]', function( value ) {
		value.bind( function( subtext ) {
			var css = '';

			// Notes.
			css += '.woocommerce small.note { color: ' + subtext + '; }';

			// Breadcrumbs.
			css += '.woocommerce .woocommerce-breadcrumb { color: ' + subtext + '; }';
			css += '.woocommerce .woocommerce-breadcrumb a { color: ' + subtext + '; }';

			// Reviews.
			css += '.woocommerce #reviews h2 small { color: ' + subtext + '; }';
			css += '.woocommerce #reviews h2 small a { color: ' + subtext + '; }';
			css += '.woocommerce #reviews #comments ol.commentlist li .meta { color: ' + subtext + '; }';

			// Cart page.
			css += '.woocommerce-cart .cart-collaterals .cart_totals p small { color: ' + subtext + '; }';
			css += '.woocommerce-cart .cart-collaterals .cart_totals table small { color: ' + subtext + '; }';

			// Checkout page.
			css += '.woocommerce-checkout .checkout .create-account small { color: ' + subtext + '; }';
			css += '.woocommerce-checkout #payment div.payment_box span.help { color: ' + subtext + '; }';

			$( '#woocommerce-colors-subtext' ).remove();
			$( 'head' ).append( '<style id="woocommerce-colors-subtext">' + css + '</style>' );
		});
	});

})( jQuery );
