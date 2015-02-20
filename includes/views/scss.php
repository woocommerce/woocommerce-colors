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

	.woocommerce-message,
	.woocommerce-error,
	.woocommerce-info {
		background-color: lighten($secondary,5%) !important;
		color: $secondarytext !important;
	}

	small.note {
		color: $subtext !important;
	}

	.woocommerce-breadcrumb {
		color: $subtext !important;

		a {
			color: $subtext !important;
		}
	}

	div.product {
		span.price,
		p.price {
			color: $highlight !important;
		}

		.stock {
			color: $highlight !important;
		}

		.woocommerce-tabs {
			ul.tabs {
				li {
					border: 1px solid darken( $secondary, 10% ) !important;
					background-color: $secondary !important;

					a {
						color: $secondarytext !important;

						&:hover {
							color: lighten( $secondarytext, 10% ) !important;
						}
					}

					&.active {
						background: $contentbg !important;
						border-bottom-color: $contentbg !important;

						&:before {
							box-shadow: 2px 2px 0 $contentbg !important;
						}

						&:after {
							box-shadow: -2px 2px 0 $contentbg !important;
						}
					}

					&:before,
					&:after {
						border: 1px solid darken( $secondary, 10% ) !important;
						position: absolute;
						bottom: -1px;
						width: 5px;
						height: 5px;
						content: " ";
					}

					&:before {
						left: -6px;
						-webkit-border-bottom-right-radius: 4px;
						-moz-border-bottom-right-radius: 4px;
						border-bottom-right-radius: 4px;
						border-width: 0 1px 1px 0;
						box-shadow: 2px 2px 0 $secondary !important;
					}

					&:after {
						right: -6px;
						-webkit-border-bottom-left-radius: 4px;
						-moz-border-bottom-left-radius: 4px;
						border-bottom-left-radius: 4px;
						border-width: 0 0 1px 1px;
						box-shadow: -2px 2px 0 $secondary !important;
					}
				}

				&:before {
					border-bottom: 1px solid darken( $secondary, 10% ) !important;
				}
			}
		}
	}

	span.onsale {
		background-color: $highlight !important;
		color: $highlightext !important;
	}

	ul.products {
		li.product {
			.price {
				color: $highlight !important;

				.from {
					color: rgba(desaturate($highlight, 75%), 0.5) !important;
				}
			}
		}
	}

	nav.woocommerce-pagination {
		ul {
			border: 1px solid darken( $secondary, 10% ) !important;

			li {
				border-right: 1px solid darken( $secondary, 10% ) !important;

				span.current,
				a:hover,
				a:focus {
					background: $secondary !important;
					color: darken( $secondary, 40% ) !important;
				}
			}
		}
	}

	a.button,
	button.button,
	input.button,
	#respond input#submit {
		color: $secondarytext !important;
		background-color: $secondary !important;

		&:hover {
			background-color: $secondary - #111 !important;
			color: $secondarytext !important;
		}

		&.alt {
			background-color: $primary !important;
			color: $primarytext !important;

			&:hover {
				background-color: $primary - #111 !important;
				color: $primarytext !important;
			}

			&.disabled,
			&:disabled,
			&:disabled[disabled],
			&.disabled:hover,
			&:disabled:hover,
			&:disabled[disabled]:hover {
				background-color: $primary !important;
				color: $primarytext !important;
			}
		}

		&:disabled,
		&.disabled,
		&:disabled[disabled] {
			&:hover {
				background-color: $secondary !important;
			}
		}
	}

	#reviews {
		h2 small {
			color: $subtext !important;

			a {
				color: $subtext !important;
			}
		}

		#comments {
			ol.commentlist {
				li {
					.meta {
						color: $subtext !important;
					}

					img.avatar {
						background: $secondary !important;
						border: 1px solid darken( $secondary, 3% ) !important;
					}

					.comment-text {
						border: 1px solid darken( $secondary, 3% ) !important;
					}
				}

				#respond {
					border: 1px solid darken( $secondary, 3% ) !important;
				}
			}
		}
	}

	.star-rating {
		&:before {
			color: darken( $secondary, 10% ) !important;
		}
	}

	&.widget_shopping_cart,
	.widget_shopping_cart {
		.total {
			border-top: 3px double $secondary !important;
		}
	}

	form.login,
	form.checkout_coupon,
	form.register {
		border: 1px solid darken( $secondary, 10% ) !important;
	}

	.order_details {
		li {
			border-right: 1px dashed darken( $secondary, 10% ) !important;
		}
	}

	.widget_price_filter {
		.ui-slider .ui-slider-handle {
			background-color: $primary !important;
		}

		.ui-slider .ui-slider-range {
			background-color: $primary !important;
		}

		.price_slider_wrapper .ui-widget-content {
			background-color: $primary - #444 !important;
		}
	}
}

.woocommerce-cart {
	table.cart {
		td.actions {
			.coupon {
				.input-text {
					border: 1px solid darken( $secondary, 10% ) !important;
				}
			}
		}
	}

	.cart-collaterals {
		.cart_totals {
			p {
				small {
					color: $subtext !important;
				}
			}

			table {
				small {
					color: $subtext !important;
				}
			}

			.discount td {
				color: $highlight !important;
			}

			tr td,
			tr th {
				border-top: 1px solid $secondary !important;
			}
		}
	}
}

.woocommerce-checkout {
	.checkout {
		.create-account small {
			color: $subtext !important;
		}
	}

	#payment {
		background: $secondary !important;

		ul.payment_methods {
			border-bottom: 1px solid darken( $secondary, 10% ) !important;
		}

		div.payment_box {
			background-color: darken( $secondary, 5% ) !important;
			color: $secondarytext !important;

			input.input-text, textarea {
				border-color: darken( $secondary, 15% ) !important;
				border-top-color: darken( $secondary, 20% ) !important;
			}

			::-webkit-input-placeholder {
				color: darken( $secondary, 20% ) !important;
			}

			:-moz-placeholder {
				color: darken( $secondary, 20% ) !important;
			}

			:-ms-input-placeholder {
				color: darken( $secondary, 20% ) !important;
			}

			span.help {
				color: $subtext !important;
			}

			&:after {
				content: "";
				display: block;
				border: 8px solid darken( $secondary, 5% ) !important;
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
