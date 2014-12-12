( function( $ ) {

	function LightenDarkenColor( color, amount ) {
		// Remove the #
		color = color.slice( 1 );

		var number = parseInt( color, 16 ),
			red    = ( number >> 16 ) + amount,
			blue   = ( ( number >> 8 ) & 0x00FF ) + amount,
			green  = ( number & 0x0000FF ) + amount;

		if ( red > 255 ) {
			red = 255;
		} else if ( red < 0 ) {
			red = 0;
		}

		if ( blue > 255 ) {
			blue = 255;
		} else if ( blue < 0 ) {
			blue = 0;
		}

		if ( green > 255 ) {
			green = 255;
		} else if ( green < 0 ) {
			green = 0;
		}

		return '#' + ( green | ( blue << 8 ) | ( red << 16 ) ).toString( 16 );
	}

	function desaturate( color ) {
		color = color.slice( 1 ).match( /\d+/g );
		var r = color[0];
		var g = color[1];
		var b = color[2];

		var intensity = 0.3 * r + 0.59 * g + 0.11 * b;
		var k = 1;

		r = Math.floor(intensity * k + r * (1 - k));
		g = Math.floor(intensity * k + g * (1 - k));
		b = Math.floor(intensity * k + b * (1 - k));

		return [r, g, b];
	}

	// Primary Color.
	wp.customize( 'woocommerce_styles[primary]', function( value ) {
		value.bind( function( color ) {
			console.log( LightenDarkenColor( color, 50 ) );
			$( 'a.button.alt, button.button.alt, input.button.alt, #respond input#submit.alt' ).css( 'background-color', color );
		});
	});

	// Secondary Color.
	wp.customize( 'woocommerce_styles[secondary]', function( value ) {
		value.bind( function( color ) {
			console.log( LightenDarkenColor( color, 60 ) );
			$( 'a.button, button.button, input.button, #respond input#submit' ).not( '.alt' ).css( 'background-color', color );
		});
	});


})( jQuery );
