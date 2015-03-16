<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

// Varibles.
$primary:       <?php echo $colors['primary']; ?>;
$primarytext:   <?php echo wc_light_or_dark( $colors['primary'], 'desaturate(darken($primary,50%),18%)', 'desaturate(lighten($primary,50%),18%)' ) ?>;
$secondary:     <?php echo $colors['secondary']; ?>;
$secondarytext: <?php echo wc_light_or_dark( $colors['secondary'], 'desaturate(darken($secondary,60%),18%)', 'desaturate(lighten($secondary,60%),18%)' ); ?>;
$highlight:     <?php echo $colors['highlight']; ?>;
$highlightext:  <?php echo wc_light_or_dark( $colors['highlight'], 'desaturate(darken($highlight,60%),18%)', 'desaturate(lighten($highlight,60%),18%)' ) ?>;
$contentbg:     <?php echo $colors['content_bg']; ?>;
$subtext:       <?php echo $colors['subtext']; ?>;

p.demo_store {
	background-color: $primary;
	color: $primarytext;
}

.woocommerce {

	// .woocommerce-message,
	// .woocommerce-error,
	// .woocommerce-info {
	// 	background-color: lighten($secondary,5%);
	// 	color: $secondarytext;
	// }

	small.note {
		color: $subtext;
	}

	.woocommerce-breadcrumb {
		color: $subtext;

		a {
			color: $subtext;
		}
	}

	div.product {
		span.price,
		p.price {
			color: $highlight;
		}

		.stock {
			color: $highlight;
		}

		// .woocommerce-tabs {
		// 	ul.tabs {
		// 		li {
		// 			border: 1px solid darken( $secondary, 10% );
		// 			background-color: $secondary;

		// 			a {
		// 				color: $secondarytext;

		// 				&:hover {
		// 					color: lighten( $secondarytext, 10% );
		// 				}
		// 			}

		// 			&.active {
		// 				background: $contentbg;
		// 				border-bottom-color: $contentbg;

		// 				&:before {
		// 					box-shadow: 2px 2px 0 $contentbg;
		// 				}

		// 				&:after {
		// 					box-shadow: -2px 2px 0 $contentbg;
		// 				}
		// 			}

		// 			&:before,
		// 			&:after {
		// 				border: 1px solid darken( $secondary, 10% );
		// 				position: absolute;
		// 				bottom: -1px;
		// 				width: 5px;
		// 				height: 5px;
		// 				content: " ";
		// 			}

		// 			&:before {
		// 				left: -6px;
		// 				-webkit-border-bottom-right-radius: 4px;
		// 				-moz-border-bottom-right-radius: 4px;
		// 				border-bottom-right-radius: 4px;
		// 				border-width: 0 1px 1px 0;
		// 				box-shadow: 2px 2px 0 $secondary;
		// 			}

		// 			&:after {
		// 				right: -6px;
		// 				-webkit-border-bottom-left-radius: 4px;
		// 				-moz-border-bottom-left-radius: 4px;
		// 				border-bottom-left-radius: 4px;
		// 				border-width: 0 0 1px 1px;
		// 				box-shadow: -2px 2px 0 $secondary;
		// 			}
		// 		}

		// 		&:before {
		// 			border-bottom: 1px solid darken( $secondary, 10% );
		// 		}
		// 	}
		// }
	}

	span.onsale {
		background-color: $highlight;
		color: $highlightext;
	}

	ul.products {
		li.product {
			.price {
				color: $highlight;

				.from {
					color: rgba(desaturate($highlight, 75%), 0.5);
				}
			}
		}
	}

	nav.woocommerce-pagination {
		ul {
			border: 1px solid darken( $secondary, 10% );

			li {
				border-right: 1px solid darken( $secondary, 10% );

				span.current,
				a:hover,
				a:focus {
					background: $secondary;
					color: darken( $secondary, 40% );
				}
			}
		}
	}

	a.button,
	button.button,
	input.button,
	#respond input#submit {
		color: $secondarytext;
		background-color: $secondary;

		&:hover {
			background-color: $secondary - #111;
			color: $secondarytext;
		}

		&.alt {
			background-color: $primary;
			color: $primarytext;

			&:hover {
				background-color: $primary - #111;
				color: $primarytext;
			}

			&.disabled,
			&:disabled,
			&:disabled[disabled],
			&.disabled:hover,
			&:disabled:hover,
			&:disabled[disabled]:hover {
				background-color: $primary;
				color: $primarytext;
			}
		}

		&:disabled,
		&.disabled,
		&:disabled[disabled] {
			&:hover {
				background-color: $secondary;
			}
		}
	}

	#reviews {
		h2 small {
			color: $subtext;

			a {
				color: $subtext;
			}
		}

		#comments {
			ol.commentlist {
				li {
					.meta {
						color: $subtext;
					}

					img.avatar {
						background: $secondary;
						border: 1px solid darken( $secondary, 3% );
					}

					.comment-text {
						border: 1px solid darken( $secondary, 3% );
					}
				}

				#respond {
					border: 1px solid darken( $secondary, 3% );
				}
			}
		}
	}

	.star-rating {
		&:before {
			color: darken( $secondary, 10% );
		}
	}

	&.widget_shopping_cart,
	.widget_shopping_cart {
		.total {
			border-top: 3px double $secondary;
		}
	}

	form.login,
	form.checkout_coupon,
	form.register {
		border: 1px solid darken( $secondary, 10% );
	}

	.order_details {
		li {
			border-right: 1px dashed darken( $secondary, 10% );
		}
	}

	.widget_price_filter {
		.ui-slider .ui-slider-handle {
			background-color: $primary;
		}

		.ui-slider .ui-slider-range {
			background-color: $primary;
		}

		.price_slider_wrapper .ui-widget-content {
			background-color: $primary - #444;
		}
	}
}

.woocommerce-cart {
	table.cart {
		td.actions {
			.coupon {
				.input-text {
					border: 1px solid darken( $secondary, 10% );
				}
			}
		}
	}

	.cart-collaterals {
		.cart_totals {
			p {
				small {
					color: $subtext;
				}
			}

			table {
				small {
					color: $subtext;
				}
			}

			.discount td {
				color: $highlight;
			}

			tr td,
			tr th {
				border-top: 1px solid $secondary;
			}
		}
	}
}

.woocommerce-checkout {
	.checkout {
		.create-account small {
			color: $subtext;
		}
	}

	#payment {
		background: $secondary;

		ul.payment_methods {
			border-bottom: 1px solid darken( $secondary, 10% );
		}

		div.payment_box {
			background-color: darken( $secondary, 5% );
			color: $secondarytext;

			input.input-text, textarea {
				border-color: darken( $secondary, 15% );
				border-top-color: darken( $secondary, 20% );
			}

			::-webkit-input-placeholder {
				color: darken( $secondary, 20% );
			}

			:-moz-placeholder {
				color: darken( $secondary, 20% );
			}

			:-ms-input-placeholder {
				color: darken( $secondary, 20% );
			}

			span.help {
				color: $subtext;
			}

			&:after {
				content: "";
				display: block;
				border: 8px solid darken( $secondary, 5% );
				border-right-color: transparent;
				border-left-color: transparent;
				border-top-color: transparent;
				position: absolute;
				top: -3px;
				left: 0;
				margin: -1em 0 0 2em;
			}
		}
	}
}
