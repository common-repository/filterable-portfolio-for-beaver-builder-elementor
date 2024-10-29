<?php

/*-------------------*/
/* General Css */
/*-------------------*/

// Portfolio Item Height
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'items_height',
			'enabled' 	    => 'masonry' != $settings->portfolio_layout,
			'selector'		=> ".fl-node-$id .tnit-portfolio-layout-grid .cbp-item,
								.fl-node-$id .tnit-portfolio-layout-mosaic .cbp-item,
							.fl-node-$id .tnit-portfolio-slider .item-img,
							.fl-node-$id .tnit-slider-innovative .item-img,
							.fl-node-$id .tnit-slider-innovative .item-content",
		'prop'			=> 'height',
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'enabled' 	    => 'true' === $settings->auto_width,
		'setting_name'	=> 'auto_width_value', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-portfolio-slider .item-img",
		'prop'			=> 'width',
	)
);


// Portfolio Wrapper Height
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'wrapper_height',
		'selector'		=> ".fl-node-$id .tnit-slick-slider-full,.fl-node-$id .tnit-slider-full-half,.fl-node-$id .tnit-slider-full,.fl-node-$id .tnit-slick-slider-full .tnit-slide-image",
		'prop'			=> 'height',
	)
);





/*-------------------*/
/* Filters Css */
/*-------------------*/

// Typography
FLBuilderCSS::typography_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'filters_typography', // As in $settings->typography
		'selector' 		=> ".fl-node-$id .tnit-portfolio-filter .cbp-l-filters-button .cbp-filter-item,
							.fl-node-$id .tnit-portfolio-dropdown .select-option",
	)
);

// Alignment
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-portfolio-filter ul",
		'props' 	=> array(
			'text-align' => $settings->filters_alignment,
		),
	)
);
// color
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-l-filters-button .cbp-filter-item",
		'props' 	=> array(
			'color' 			=> $settings->filters_color,
			'background-color' 	=> $settings->filters_bg_color,
		),
	)
);
// Hover color
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-filter-item:not(.cbp-filter-item-active):hover",
		'props' 	=> array(
			'color' 			=> $settings->filters_hvr_color,
			'background-color' 	=> $settings->filters_bg_hvr_color,
		),
	)
);
// Active color
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-filter-item.cbp-filter-item-active",
		'props' 	=> array(
			'color' 			=> $settings->filters_active_color,
			'background-color' 	=> $settings->filters_bg_active_color,
		),
	)
);
// Border
FLBuilderCSS::border_field_rule(
	array(
		'settings' 		=> $settings,
		'setting_name' 	=> 'filters_border', // As in $settings->item_border
		'selector' 		=> ".fl-node-$id .tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-l-filters-button .cbp-filter-item",
	)
);
// Border hover
FLBuilderCSS::border_field_rule(
	array(
		'settings' 		=> $settings,
		'setting_name' 	=> 'filters_border_hover', // As in $settings->item_border
		'selector' 		=> ".fl-node-$id .tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-filter-item:not(.cbp-filter-item-active):hover",
	)
);
// Border active
FLBuilderCSS::border_field_rule(
	array(
		'settings' 		=> $settings,
		'setting_name' 	=> 'filters_border_active', // As in $settings->item_border
		'selector' 		=> ".fl-node-$id .tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-filter-item.cbp-filter-item-active",
	)
);
// Padding
FLBuilderCSS::dimension_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'filters_padding',
		'selector' 		=> ".fl-node-$id .tnit-portfolio-filter .cbp-l-filters-button .cbp-filter-item",
		'unit'			=> 'px', // Omit if custom unit select is used.
		'props'			=> array(
			'padding-top' 	 => 'filters_padding_top', // As in $settings->padding_top
			'padding-right'  => 'filters_padding_right',
			'padding-bottom' => 'filters_padding_bottom',
			'padding-left' 	 => 'filters_padding_left',
		),
	)
);
// Spacing b/w filters
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-portfolio-filter .cbp-l-filters-button .cbp-filter-item",
		'props' 	=> array(
			'margin-left' 	=> ( $settings->filters_spacing != '' ) ? $settings->filters_spacing . 'px' : '',
			'margin-right' 	=> ( $settings->filters_spacing != '' ) ? $settings->filters_spacing . 'px' : '',
		),
	)
);
// Bottom spacing
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'filters_bottom_spacing', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-portfolio-filter",
		'prop'			=> 'margin-bottom',
		'unit'			=> 'px',
	)
);

/*---------------------------*/
/* Filters Dropdown Css */
/*---------------------------*/

// Color
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-portfolio-dropdown .cbp-l-filters-button .cbp-filter-item",
		'props' 	=> array(
			'color' 			=> $settings->filters_color_resp,
			'background-color' 	=> $settings->filters_bg_color_resp,
			'border' 			=> 'none',
			'border-radius' 	=> '0',
		),
	)
);
// Hover color
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-portfolio-dropdown .cbp-filter-item:not(.cbp-filter-item-active):hover",
		'props' 	=> array(
			'color' 			=> $settings->filters_hvr_color_resp,
			'background-color' 	=> $settings->filters_bg_hvr_color_resp,
		),
	)
);
// Active color
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-portfolio-dropdown .select-option",
		'props' 	=> array(
			'color' 			=> $settings->filters_active_color_resp,
			'background-color' 	=> $settings->filters_bg_active_color_resp,
		),
	)
);
// Separator
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-portfolio-dropdown .cbp-l-filters-button .cbp-filter-item",
		'enabled' 	=> 'yes' === $settings->filters_separator,
		'props' 	=> array(
			'border-bottom-style' => $settings->filters_separator_style,
			'border-bottom-width' => ($settings->filters_separator_size != '') ? $settings->filters_separator_size . 'px' : '1px',
			'border-bottom-color' => $settings->filters_separator_color,
		),
	)
);

/*-------------------*/
/* Gallery Css */
/*-------------------*/

// Gallery border
FLBuilderCSS::border_field_rule(
	array(
		'settings' 		=> $settings,
		'setting_name' 	=> 'portfolio_items_border', // As in $settings->item_border
		'selector' 		=> ".fl-node-$id .tnit-portfolio-wrapper .cbp-item,
							.fl-node-$id .tnit-portfolio-slider .item-img,
							.fl-node-$id .tnit-slick-slider-full,.fl-node-$id .tnit-slider-full-half,
							.fl-node-$id .tnit-slider-full,.fl-node-$id .xpro-item-before .owl-item .xpro-item-inner::before",
	)
);

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-slider-innovative .item-content,
						.fl-node-$id .tnit-slick-slider-full,.fl-node-$id .tnit-slider-full-half,.fl-node-$id .tnit-slider-full",
		'props' 	=> array(
			'background-color' 	=> $settings->content_box_bgcolor,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-slider-full .tnit-full-content:before",
		'props' 	=> array(
			'background-color' 	=> $settings->modern_overaly_color,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-item-before .owl-item .xpro-item-inner:before",
		'props' 	=> array(
			'background-color' 	=> $settings->item_center_bg,
		),
	)
);


/*-------------------*/
/* Overlay Css */
/*-------------------*/

// Color
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-portfolio-module .tnit-portfolio-wrapper .cbp-caption-activeWrap, 
						.fl-node-$id .tnit-portfolio-slider .slide-caption,
						.fl-node-$id .cbp-caption-innovative-top-bottom .cbp-caption:hover .cbp-caption-activeWrap,
						.fl-node-$id .cbp-caption-innovative-title .cbp-caption:hover .cbp-caption-activeWrap,
						.fl-node-$id .tnit-portfolio-slider.slide-fade-bottom .tnit-overlay-content,
						.fl-node-$id .tnit-slider-innovative .slide-caption",
		'props' 	=> array(
			'background-color' 	=> $settings->overlay_color,
		),
	)
);
// Border Color
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .cbp-caption-zoom-box .cbp-caption-activeWrap:after,
						.fl-node-$id .cbp-caption-zoom-box-out .cbp-caption-activeWrap:after,
						.fl-node-$id .tnit-portfolio-slider.slide-zoom-box .slide-caption:after",
		'props' 	=> array(
			'border-left-style' 	=> $settings->overlay_border_style,
			'border-right-style' 	=> $settings->overlay_border_style,
			'border-left-color' 	=> $settings->overlay_border_color,
			'border-right-color' 	=> $settings->overlay_border_color,
			'border-left-width' 	=> ( '' != $settings->overlay_border_size ) ? $settings->overlay_border_size . 'px' : '',
			'border-right-width' 	=> ( '' != $settings->overlay_border_size ) ? $settings->overlay_border_size . 'px' : '',
		),
	)
);


FLBuilderCSS::rule(
	array(
	'selector' 	=> ".fl-node-$id .cbp-caption-zoom-box .cbp-caption-activeWrap:before,
						.fl-node-$id .cbp-caption-zoom-box-out .cbp-caption-activeWrap:before,
						.fl-node-$id .tnit-portfolio-slider.slide-zoom-box .slide-caption:before",
		'props' 	=> array(
			'border-top-style' 	    => $settings->overlay_border_style,
			'border-bottom-style' 	=> $settings->overlay_border_style,
			'border-top-color' 	    => $settings->overlay_border_color,
			'border-bottom-color' 	=> $settings->overlay_border_color,
			'border-top-width' 	    => ( '' != $settings->overlay_border_size ) ? $settings->overlay_border_size . 'px' : '',
			'border-bottom-width' 	=> ( '' != $settings->overlay_border_size ) ? $settings->overlay_border_size . 'px' : '',
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .cbp-caption-innovative-top-bottom .cbp-caption:hover .tnit-underline",
		'props' 	=> array(
			'background-color' 	=> $settings->overlay_border_color,
			'height' 	=> ( '' != $settings->overlay_border_size ) ? $settings->overlay_border_size . 'px' : '',
		),
	)
);


FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-bottom-content",
		'props' 	=> array(
			'text-align' 	=> $settings->overlay_outside_aligment,
		),
	)
);

// Overlay Padding
FLBuilderCSS::dimension_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'overlay_padding',
		'selector' 		=> ".fl-node-$id .cbp-caption-activeWrap, .fl-node-$id .cbp-caption-innovative-top-bottom .cbp-caption-activeWrap,
							.fl-node-$id .tnit-slider-innovative .slide-caption, .fl-node-$id .tnit-bottom-content,
							.fl-node-$id .tnit-portfolio-slider .slide-caption",
		'unit'			=> 'px', // Omit if custom unit select is used.
		'props'			=> array(
			'padding-top' 	 => 'overlay_padding_top', // As in $settings->padding_top
			'padding-right'  => 'overlay_padding_right',
			'padding-bottom' => 'overlay_padding_bottom',
			'padding-left' 	 => 'overlay_padding_left',
		),
	)
);


/*-------------------*/
/* Overlay Icon Css */
/*-------------------*/

// Icon Colors
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-overlay-icon i",
		'props' 	=> array(
			'color' 			=> $settings->overlay_icon_color,
			'background-color' 	=> $settings->overlay_icon_bg_color,
		),
	)
);
// Icon Size
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'overlay_icon_size', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-overlay-icon i",
		'prop'			=> 'font-size',
		'unit'			=> 'px',
	)
);
// Icon BG Size
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'overlay_icon_bg_size', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-overlay-icon i",
		'prop'			=> 'width',
		'unit'			=> 'px',
	)
);
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'overlay_icon_bg_size', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-overlay-icon i",
		'prop'			=> 'height',
		'unit'			=> 'px',
	)
);
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'overlay_icon_bg_size', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-overlay-icon i",
		'prop'			=> 'line-height',
		'unit'			=> 'px',
	)
);
// Icon border
FLBuilderCSS::border_field_rule(
	array(
		'settings' 		=> $settings,
		'setting_name' 	=> 'overlay_icon_border', // As in $settings->item_border
		'selector' 		=> ".fl-node-$id .tnit-overlay-icon i",
	)
);


/*-------------------*/
/* Title Css */
/*-------------------*/

// Typography
FLBuilderCSS::typography_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'title_typography', // As in $settings->typography
		'selector' 		=> ".fl-node-$id .tnit-overlay-content .title, .fl-node-$id .tnit-bottom-content .title, 
							.fl-node-$id .tnit-right-content .title,.fl-node-$id .tnit-slick-slider-full .title",
	)
);
// Color
FLBuilderCSS::rule(
	array(
				'selector' 		=> ".fl-node-$id .tnit-overlay-content .title, .fl-node-$id .tnit-bottom-content .title, 
							.fl-node-$id .tnit-right-content .title, .fl-node-$id .tnit-slick-slider-full .title",
		'props' 	=> array(
			'color' 	=> $settings->title_color,
		),
	)
);
// Margin Top
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'title_margin_top', // As in $settings->align.
				'selector' 		=> ".fl-node-$id .tnit-overlay-content .title, .fl-node-$id .tnit-bottom-content .title, 
							.fl-node-$id .tnit-right-content .title, .fl-node-$id .tnit-slick-slider-full .title",
		'prop'			=> 'margin-top',
		'unit'			=> 'px',
	)
);
// Margin Bottom
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'title_margin_bottom', // As in $settings->align.
		'selector' 		=> ".fl-node-$id .tnit-overlay-content .title, .fl-node-$id .tnit-bottom-content .title, 
					.fl-node-$id .tnit-right-content .title, .fl-node-$id .tnit-slick-slider-full .title",
		'prop'			=> 'margin-bottom',
		'unit'			=> 'px',
	)
);


/*-------------------*/
/* Description Css */
/*-------------------*/

// Typography
FLBuilderCSS::typography_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'description_typography', // As in $settings->typography
		'selector' 		=> ".fl-node-$id .tnit-overlay-content .desc, .fl-node-$id .tnit-bottom-content .desc,
							.fl-node-$id .tnit-right-content .desc, .fl-node-$id .tnit-slick-slider-full .desc",
	)
);
// Color
FLBuilderCSS::rule(
	array(
		'selector' 		=> ".fl-node-$id .tnit-overlay-content .desc, .fl-node-$id .tnit-bottom-content .desc,
							.fl-node-$id .tnit-right-content .desc, .fl-node-$id .tnit-slick-slider-full .desc",
		'props' 	=> array(
			'color' 	=> $settings->description_color,
		),
	)
);
// Margin Top
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'description_margin_top', // As in $settings->align.
		'selector' 		=> ".fl-node-$id .tnit-overlay-content .desc, .fl-node-$id .tnit-bottom-content .desc,
							.fl-node-$id .tnit-right-content .desc, .fl-node-$id .tnit-slick-slider-full .desc",
		'prop'			=> 'margin-top',
		'unit'			=> 'px',
	)
);
// Margin Bottom
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'description_margin_bottom', // As in $settings->align.
		'selector' 		=> ".fl-node-$id .tnit-overlay-content .desc, .fl-node-$id .tnit-bottom-content .desc,
							.fl-node-$id .tnit-right-content .desc, .fl-node-$id .tnit-slick-slider-full .desc",
		'prop'			=> 'margin-bottom',
		'unit'			=> 'px',
	)
);


/*-------------------*/
/* Button Css */
/*-------------------*/

FLBuilderCSS::typography_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'button_typography', // As in $settings->typography
		'selector' 		=> ".fl-node-$id .tnit-overlay-content .btn, .fl-node-$id .tnit-bottom-content .btn,
							.fl-node-$id .tnit-right-content .btn, .fl-node-$id .tnit-slick-slider-full .btn",
	)
);

// Color
FLBuilderCSS::rule(
	array(
	'selector' 		=> ".fl-node-$id .tnit-overlay-content .btn, .fl-node-$id .tnit-bottom-content .btn,
							.fl-node-$id .tnit-right-content .btn, .fl-node-$id .tnit-slick-slider-full .btn",
		'props' 	=> array(
			'color' 	=> $settings->button_color,
		),
	)
);

//Background Color
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-overlay-content .btn,.fl-node-$id .tnit-overlay-content .btn:focus,
						.fl-node-$id .tnit-bottom-content .btn,.fl-node-$id .tnit-bottom-content .btn:focus,
						.fl-node-$id .tnit-right-content .btn,.fl-node-$id .tnit-right-content .btn:focus,
						.fl-node-$id .tnit-slick-slider-full .btn,.fl-node-$id .tnit-slick-slider-full .btn:focus",
		'props' 	=> array(
			'background-color' 	=> $settings->button_bg,
		),
	)
);

// border
FLBuilderCSS::border_field_rule(
	array(
		'settings' 		=> $settings,
		'setting_name' 	=> 'button_border',
			'selector' 		=> ".fl-node-$id .tnit-overlay-content .btn, .fl-node-$id .tnit-bottom-content .btn,
							.fl-node-$id .tnit-right-content .btn, .fl-node-$id .tnit-slick-slider-full .btn",
	)
);

// Color Hover
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-overlay-content .btn:hover, .fl-node-$id .tnit-bottom-content .btn:hover,
						.fl-node-$id .tnit-right-content .btn:hover,.fl-node-$id .tnit-slick-slider-full .btn:hover",
		'props' 	=> array(
			'color' 	=> $settings->button_hover_color,
		),
	)
);

//Background Color Hover
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-overlay-content .btn:hover, .fl-node-$id .tnit-bottom-content .btn:hover,
		                .fl-node-$id .tnit-right-content .btn:hover,.fl-node-$id .tnit-slick-slider-full .btn:hover",
		'props' 	=> array(
			'background-color' 	=> $settings->button_hover_bg,
		),
	)
);

//Border Color Hover
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-overlay-content .btn:hover, .fl-node-$id .tnit-bottom-content .btn:hover,
						.fl-node-$id .tnit-right-content .btn:hover, .fl-node-$id .tnit-slick-slider-full .btn:hover",
		'props' 	=> array(
			'border-color' 	=> $settings->button_hover_bg,
		),
	)
);

// Padding
FLBuilderCSS::dimension_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'button_padding',
		'selector' 		=> ".fl-node-$id .tnit-overlay-content .btn, .fl-node-$id .tnit-bottom-content .btn,
							.fl-node-$id .tnit-right-content .btn, .fl-node-$id .tnit-slick-slider-full .btn",
		'unit'			=> 'px', // Omit if custom unit select is used.
		'props'			=> array(
			'padding-top' 	 => 'button_padding_top',
			'padding-right'  => 'button_padding_right',
			'padding-bottom' => 'button_padding_bottom',
			'padding-left' 	 => 'button_padding_left',
		),
	)
);

// Margin
FLBuilderCSS::dimension_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'button_margin',
		'selector' 		=> ".fl-node-$id .tnit-overlay-content .btn, .fl-node-$id .tnit-bottom-content .btn,
							.fl-node-$id .tnit-right-content .btn, .fl-node-$id .tnit-slick-slider-full .btn",
		'unit'			=> 'px', // Omit if custom unit select is used.
		'props'			=> array(
			'margin-top' 	 => 'button_margin_top',
			'margin-right'  => 'button_margin_right',
			'margin-bottom' => 'button_margin_bottom',
			'margin-left' 	 => 'button_margin_left',
		),
	)
);


/*----------------------------------*/
/* Slider Navigation Arrows Css */
/*----------------------------------*/

// Color
FLBuilderCSS::rule(
	array(
		'selector' => ".fl-node-$id .tnit-portfolio-slider-wrapper .tnit-slider-nav,.fl-node-$id .tnit-slider-arrows .tnit-slider-nav",
		'props' => array(
			'color' => $settings->arrows_color,
		),
	)
);
// Hover Color
FLBuilderCSS::rule(
	array(
		'selector' => ".fl-node-$id .tnit-portfolio-slider-wrapper .tnit-slider-nav:hover,.fl-node-$id .tnit-slider-arrows .tnit-slider-nav:hover",
		'props' => array(
			'color' => $settings->arrows_hvr_color,
		),
	)
);
// BG Color
FLBuilderCSS::rule(
	array(
		'selector' => ".fl-node-$id .tnit-portfolio-slider-wrapper .tnit-slider-nav,.fl-node-$id .tnit-slider-arrows .tnit-slider-nav",
		'props' 	=> array(
			'background-color' => $settings->arrows_bg_color,
		),
	)
);
// BG Hover Color
FLBuilderCSS::rule(
	array(
		'selector' => ".fl-node-$id .tnit-portfolio-slider-wrapper .tnit-slider-nav:hover,.fl-node-$id .tnit-slider-arrows .tnit-slider-nav:hover",
		'props' 	=> array(
			'background-color' => $settings->arrows_bg_hvr_color,
		),
	)
);
// Size
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'arrows_size', // As in $settings->align.
		'selector' => ".fl-node-$id .tnit-portfolio-slider-wrapper .tnit-slider-nav,.fl-node-$id .tnit-slider-arrows .tnit-slider-nav",
		'prop'			=> 'font-size',
		'unit'			=> 'px',
	)
);
// BG Size - Simple
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'arrows_bgsize', // As in $settings->align.
		'selector' => ".fl-node-$id .tnit-portfolio-slider-wrapper .tnit-slider-nav,.fl-node-$id .tnit-slider-arrows .tnit-slider-nav",
		'prop'			=> 'width',
		'unit'			=> 'px',
	)
);
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'arrows_bgsize', // As in $settings->align.
		'selector' => ".fl-node-$id .tnit-portfolio-slider-wrapper .tnit-slider-nav,.fl-node-$id .tnit-slider-arrows .tnit-slider-nav",
		'prop'			=> 'height',
		'unit'			=> 'px',
	)
);

// Arrows border
FLBuilderCSS::border_field_rule(
	array(
		'settings' 		=> $settings,
		'setting_name' 	=> 'arrows_border', // As in $settings->item_border
		'selector' => ".fl-node-$id .tnit-portfolio-slider-wrapper .tnit-slider-nav,.fl-node-$id .tnit-slider-arrows .tnit-slider-nav",
	)
);

FLBuilderCSS::rule(
	array(
		'selector' => ".fl-node-$id .tnit-portfolio-slider-wrapper .tnit-slider-nav:hover,.fl-node-$id .tnit-slider-arrows .tnit-slider-nav:hover",
		'props' 	=> array(
			'border-color' => $settings->arrows_border_hvr,
		),
	)
);




/*----------------------------------*/
/* Slider Dots Navigation Css */
/*----------------------------------*/

// Dots Size
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'dots_size', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-portfolio-slider-wrapper .owl-dots .owl-dot span",
		'prop'			=> 'width',
		'unit'			=> 'px',
	)
);
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'dots_size', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-portfolio-slider-wrapper .owl-dots .owl-dot span",
		'prop'			=> 'height',
		'unit'			=> 'px',
	)
);
// Dots BG Color
FLBuilderCSS::rule( array(
	'selector' 	=> ".fl-node-$id .tnit-portfolio-slider-wrapper .owl-dots .owl-dot span",
	'props' 	=> array(
		'background-color' 	=> $settings->dots_bg_color,
	),
));
// Dots BG Active Color
FLBuilderCSS::rule( array(
	'selector' 	=> ".fl-node-$id .tnit-portfolio-slider-wrapper .owl-dots .owl-dot.active span",
	'props' 	=> array(
		'background-color' 	=> $settings->dots_bg_active_color,
	),
));
// Dots Border
FLBuilderCSS::border_field_rule(
	array(
		'settings' 		=> $settings,
		'setting_name' 	=> 'dots_border', // As in $settings->item_border
		'selector' 		=> ".fl-node-$id .tnit-portfolio-slider-wrapper .owl-dots .owl-dot span",
	)
);
// Dots Border Active
FLBuilderCSS::border_field_rule(
	array(
		'settings' 		=> $settings,
		'setting_name' 	=> 'dots_border_active', // As in $settings->item_border
		'selector' 		=> ".fl-node-$id .tnit-portfolio-slider-wrapper .owl-dots .owl-dot.active span",
	)
);
// Dots Spacing
FLBuilderCSS::rule( array(
	'selector' 	=> ".fl-node-$id .tnit-portfolio-slider-wrapper .owl-dots .owl-dot span",
	'media' 	=> 'default',
	'props' 	=> array(
		'margin-left' 	=> ( '' !== $settings->dots_spacing ) ? $settings->dots_spacing . 'px' : '',
		'margin-right' 	=> ( '' !== $settings->dots_spacing ) ? $settings->dots_spacing . 'px' : '',
	),
));
FLBuilderCSS::rule( array(
	'selector' 	=> ".fl-node-$id .tnit-portfolio-slider-wrapper .owl-dots .owl-dot span",
	'media' 	=> 'medium',
	'props' 	=> array(
		'margin-left' 	=> ( '' !== $settings->dots_spacing_medium ) ? $settings->dots_spacing_medium . 'px' : '',
		'margin-right' 	=> ( '' !== $settings->dots_spacing_medium ) ? $settings->dots_spacing_medium . 'px' : '',
	),
));
FLBuilderCSS::rule( array(
	'selector' 	=> ".fl-node-$id .tnit-portfolio-slider-wrapper .owl-dots .owl-dot span",
	'media' 	=> 'responsive',
	'props' 	=> array(
		'margin-left' 	=> ( '' !== $settings->dots_spacing_responsive ) ? $settings->dots_spacing_responsive . 'px' : '',
		'margin-right' 	=> ( '' !== $settings->dots_spacing_responsive ) ? $settings->dots_spacing_responsive . 'px' : '',
	),
));
// Dots Offset
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'dots_offset', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-portfolio-slider-wrapper .owl-dots",
		'prop'			=> 'margin-top',
		'unit'			=> 'px',
	)
);


/*----------------------------------*/
/* Menu
/*----------------------------------*/

// Typography
FLBuilderCSS::typography_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'menu_typography', // As in $settings->typography
		'selector' 	=> ".fl-node-$id .tnit-slider-full-half .tnit-portfolio-menu li > a,
						.fl-node-$id .tnit-slider-full .tnit-portfolio-menu li > a",
	)
);

FLBuilderCSS::rule( array(
	'selector' 	=> ".fl-node-$id .tnit-slider-full-half .tnit-portfolio-menu li > a,
					.fl-node-$id .tnit-slider-full .tnit-portfolio-menu li > a",
	'props' 	=> array(
		'color' 	=> $settings->menu_color,
	),
));

FLBuilderCSS::rule( array(
		'selector' 	=> ".fl-node-$id .tnit-slider-full-half .tnit-portfolio-menu li > a::after,
					.fl-node-$id .tnit-slider-full .tnit-portfolio-menu li > a::after",
		'props' 	=> array(
		'color' 	=> $settings->menu_hcolor,
	),
));

FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'space_between', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-slider-full-half .tnit-portfolio-menu li > a,
							.fl-node-$id .tnit-slider-full-half .tnit-portfolio-menu li > a::after,
							.fl-node-$id .tnit-slider-full .tnit-portfolio-menu li > a,
							.fl-node-$id .tnit-slider-full .tnit-portfolio-menu li > a::after",
		'prop'			=> 'padding-top',
		'unit'			=> 'px',
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'space_between', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-slider-full-half .tnit-portfolio-menu li > a,
							.fl-node-$id .tnit-slider-full-half .tnit-portfolio-menu li > a::after,
							.fl-node-$id .tnit-slider-full .tnit-portfolio-menu li > a,
							.fl-node-$id .tnit-slider-full .tnit-portfolio-menu li > a::after",
		'prop'			=> 'padding-bottom',
		'unit'			=> 'px',
	)
);


/*-------------------*/
/* Preview Css */
/*-------------------*/

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .tnit-portfolio-loader li",
		'props' 	=> array(
			'background-color' 	=> $settings->preview_overlay_color,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview",
		'props' 	=> array(
			'background-color' 	=> $settings->preview_background_color,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview .xpro-preview-header, .fl-node-$id .xpro-preview-arrow, .fl-node-$id .xpro-preview-demo-name, .fl-node-$id .xpro-preview-close, .fl-node-$id .xpro-preview-footer",
		'props' 	=> array(
			'border-color' 	=> $settings->preview_background_outline,
		),
	)
);

//Close Button
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview-close",
		'props' 	=> array(
			'color' 	=> $settings->close_icon_color,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview-close",
		'props' 	=> array(
			'background-color' 	=> $settings->close_icon_bgcolor,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview-close:hover",
		'props' 	=> array(
			'color' 	=> $settings->close_icon_hcolor,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview-close:hover",
		'props' 	=> array(
			'background-color' 	=> $settings->close_icon_hbgcolor,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview-close",
		'props' 	=> array(
			'border-color' 	=> $settings->close_icon_bdr_color,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview-close:hover",
		'props' 	=> array(
			'border-color' 	=> $settings->close_icon_hbdr_color,
		),
	)
);

//Next/Prev Button
FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview-prev-demo, .fl-node-$id .xpro-preview-next-demo, .fl-node-$id .xpro-preview-nav-layout-5 > .xpro-preview-arrow > span, .fl-node-$id .xpro-preview-nav-layout-6 > .xpro-preview-arrow > i",
		'props' 	=> array(
			'color' 	=> $settings->preview_nav_color,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview-prev-demo, .fl-node-$id .xpro-preview-next-demo, .fl-node-$id .xpro-preview-nav-layout-5 > .xpro-preview-arrow > span, .fl-node-$id .xpro-preview-nav-layout-6 > .xpro-preview-arrow > i",
		'props' 	=> array(
			'background-color' 	=> $settings->preview_nav_bgcolor,
		),
	)
);

FLBuilderCSS::rule(
	array(
        'selector' 	=> ".fl-node-$id .xpro-preview-prev-demo, .fl-node-$id .xpro-preview-next-demo, .fl-node-$id .xpro-preview-nav-layout-5 > .xpro-preview-arrow > span, .fl-node-$id .xpro-preview-nav-layout-6 > .xpro-preview-arrow > i",
		'props' 	=> array(
			'border-color' 	=> $settings->preview_nav_bdr_color,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview-prev-demo:hover, .fl-node-$id .xpro-preview-next-demo:hover, .fl-node-$id .xpro-preview-nav-layout-5 > .xpro-preview-arrow:hover > span, .fl-node-$id .xpro-preview-nav-layout-6 > .xpro-preview-arrow:hover > i",
		'props' 	=> array(
			'color' 	=> $settings->preview_nav_hcolor,
		),
	)
);

FLBuilderCSS::rule(
	array(
        'selector' 	=> ".fl-node-$id .xpro-preview-prev-demo:hover, .fl-node-$id .xpro-preview-next-demo:hover, .fl-node-$id .xpro-preview-nav-layout-5 > .xpro-preview-arrow:hover > span, .fl-node-$id .xpro-preview-nav-layout-6 > .xpro-preview-arrow:hover > i",
		'props' 	=> array(
			'background-color' 	=> $settings->preview_nav_hbgcolor,
		),
	)
);

FLBuilderCSS::rule(
	array(
        'selector' 	=> ".fl-node-$id .xpro-preview-prev-demo:hover, .fl-node-$id .xpro-preview-next-demo:hover, .fl-node-$id .xpro-preview-nav-layout-5 > .xpro-preview-arrow:hover > span, .fl-node-$id .xpro-preview-nav-layout-6 > .xpro-preview-arrow:hover > i",
		'props' 	=> array(
			'border-color' 	=> $settings->preview_nav_hbdr_color,
		),
	)
);


//Title
FLBuilderCSS::rule(
	array(
		'selector'  	=> ".fl-node-$id .xpro-preview-demo-name",
		'props' 	=> array(
			'color' 	=> $settings->preview_title_color,
		),
	)
);

FLBuilderCSS::typography_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'preview_title_typography', // As in $settings->typography
		'selector'  	=> ".fl-node-$id .xpro-preview-demo-name",
	)
);



//Carousel

FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'enabled' 	    => 'true' === $settings->preview_auto_width,
		'setting_name'	=> 'preview_auto_width_value', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-carousel-layout .item",
		'prop'			=> 'width',
	)
);

// Gallery

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .tnit-portfolio-preview-full .cbp-item",
		'enabled' 	    => 'grid' === $settings->preview_gallery_for_bb_layout,
		'props' 	=> array(
			'height' 	=> ( $settings->preview_gallery_for_bb_height != '' ) ? $settings->preview_gallery_for_bb_height . 'px' : '400px',
		),
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'preview_gallery_for_bb_height',
		'selector'		=> ".fl-node-$id .tnit-portfolio-preview-full .cbp-item",
		'prop'			=> 'height',
		'unit'			=> 'px',
	)
);


// Preview Sub Title

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview-content .sub-title",
		'props' 	=> array(
			'color' 	=> $settings->preview_sub_title_color,
		),
	)
);

FLBuilderCSS::typography_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'preview_sub_title_typo', // As in $settings->typography
		'selector'  	=> ".fl-node-$id .xpro-preview-content .sub-title",
	)
);


// Margin
FLBuilderCSS::dimension_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'preview_sub_title_margin', // As in $settings->align.
		'selector'  	=> ".fl-node-$id .xpro-preview-content .sub-title",
		'unit'			=> 'px', // Omit if custom unit select is used.
		'props'			=> array(
			'margin-top' 	=> 'preview_sub_title_margin_top',
			'margin-right'  => 'preview_sub_title_margin_right',
			'margin-bottom' => 'preview_sub_title_margin_bottom',
			'margin-left' 	=> 'preview_sub_title_margin_left',
		),
	)
);


// Preview Title

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview-content .title",
		'props' 	=> array(
		'color' 	=> $settings->preview_title_color,
		),
	)
);

FLBuilderCSS::typography_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'preview_title_typo', // As in $settings->typography
		'selector'  	=> ".fl-node-$id .xpro-preview-content .title",
	)
);

// Margin
FLBuilderCSS::dimension_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'preview_title_margin', // As in $settings->align.
		'selector'  	=> ".fl-node-$id .xpro-preview-content .title",
		'unit'			=> 'px', // Omit if custom unit select is used.
		'props'			=> array(
			'margin-top' 	=> 'preview_title_margin_top',
			'margin-right'  => 'preview_title_margin_right',
			'margin-bottom' => 'preview_title_margin_bottom',
			'margin-left' 	=> 'preview_title_margin_left',
		),
	)
);


// Preview Description

FLBuilderCSS::rule(
	array(
		'selector' 	=> ".fl-node-$id .xpro-preview-content .desc,.fl-node-$id .xpro-preview-content-right .desc",
		'props' 	=> array(
			'color' 	=> $settings->preview_desc_color,
		),
	)
);

FLBuilderCSS::typography_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'preview_desc_typo', // As in $settings->typography
		'selector'   	=> ".fl-node-$id .xpro-preview-content .desc,.fl-node-$id .xpro-preview-content-right .desc",
	)
);

// Margin
FLBuilderCSS::dimension_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'preview_desc_margin',
		'selector'  	=> ".fl-node-$id .xpro-preview-content .desc,.fl-node-$id .xpro-preview-content-right .desc",
		'unit'			=> 'px', // Omit if custom unit select is used.
		'props'			=> array(
			'margin-top' 	=> 'preview_desc_margin_top',
			'margin-right'  => 'preview_desc_margin_right',
			'margin-bottom' => 'preview_desc_margin_bottom',
			'margin-left' 	=> 'preview_desc_margin_left',
		),
	)
);


// Preview Social

FLBuilderCSS::rule(
	array(
		'selector'  	=> ".fl-node-$id .xpro-preview-social .tnit-share-title",
		'props' 	=> array(
			'color' 	=> $settings->preview_social_title_color,
		),
	)
);

FLBuilderCSS::typography_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'preview_social_title_typo', // As in $settings->typography
		'selector'  	=> ".fl-node-$id .xpro-preview-social .tnit-share-title",
	)
);

// Margin
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'preview_social_margin',
		'selector'  	=> ".fl-node-$id .xpro-preview-social .tnit-social-links a i",
		'prop'			=> 'margin',
		'unit'			=> 'px',
	)
);

// Feature Image
FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'preview_feature_image_height', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-portfolio-preview-full .tnit-portfolio-feature-area,.fl-node-$id .portfolio-preview-layout-3 .xpro-preview-content-area",
		'prop'			=> 'height',
		'unit'			=> 'px',
	)
);

FLBuilderCSS::dimension_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'preview_feature_image_margin',
		'selector'  	=> ".fl-node-$id .tnit-portfolio-preview-full .tnit-portfolio-feature-area,.fl-node-$id .tnit-portfolio-preview-full .tnit-carousel-layout,.fl-node-$id .portfolio-preview-layout-3 .xpro-preview-content-area",
		'unit'			=> 'px', // Omit if custom unit select is used.
		'props'			=> array(
			'margin-top' 	=> 'preview_feature_image_margin_top',
			'margin-right'  => 'preview_feature_image_margin_right',
			'margin-bottom' => 'preview_feature_image_margin_bottom',
			'margin-left' 	=> 'preview_feature_image_margin_left',
		),
	)
);


// Social Icon

FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'preview_social_size', // As in $settings->align.
		'selector'		=> ".fl-node-$id .xpro-preview-social .tnit-social-links a i",
		'prop'			=> 'font-size',
		'unit'			=> 'px',
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'preview_social_bg_size', // As in $settings->align.
		'selector'		=> ".fl-node-$id .xpro-preview-social .tnit-social-links a i",
		'prop'			=> 'height',
		'unit'			=> 'px',
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'preview_social_bg_size', // As in $settings->align.
		'selector'		=> ".fl-node-$id .xpro-preview-social .tnit-social-links a i",
		'prop'			=> 'width',
		'unit'			=> 'px',
	)
);

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .xpro-preview-social .tnit-social-links a i",
		'props' 	=> array(
			'color' 	=> $settings->preview_social_icon_color,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .xpro-preview-social .tnit-social-links a i",
		'props' 	=> array(
			'background-color' 	=> $settings->preview_social_icon_bgcolor,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .xpro-preview-social .tnit-social-links a i:hover",
		'props' 	=> array(
			'color' 	=> $settings->preview_social_icon_hcolor,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .xpro-preview-social .tnit-social-links a i:hover",
		'props' 	=> array(
			'background-color' 	=> $settings->preview_social_icon_hbgcolor,
		),
	)
);

FLBuilderCSS::border_field_rule(
	array(
		'settings' 		=> $settings,
		'setting_name' 	=> 'preview_social_icon_border', // As in $settings->item_border
		'selector'		=> ".fl-node-$id .xpro-preview-social .tnit-social-links a i",
	)
);

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .xpro-preview-social .tnit-social-links a i:hover",
		'props' 	=> array(
			'border-color' 	=> $settings->preview_social_icon_hbgcolor,
		),
	)
);


//Navigation

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .tnit-nav-text",
		'props' 	=> array(
			'color' 	=> $settings->preview_navigation_color,
		),
	)
);


FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .xpro-preview-navigation button:hover .tnit-nav-text, .fl-node-$id .xpro-preview-navigation button:hover .tnit-nav-text i",
		'props' 	=> array(
			'color' 	=> $settings->preview_navigation_hcolor,
		),
	)
);

FLBuilderCSS::typography_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'preview_navigation_typo', // As in $settings->typography
		'selector' 		=> ".fl-node-$id .xpro-preview-navigation button .tnit-nav-text",
	)
);

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .tnit-navigation-text",
		'props' 	=> array(
			'color' 	=> $settings->preview_navigation_title_color,
		),
	)
);

FLBuilderCSS::typography_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'preview_navigation_title_typo', // As in $settings->typography
		'selector'		=> ".fl-node-$id .tnit-navigation-text",
	)
);

FLBuilderCSS::dimension_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'preview_navigation_margin',
		'selector'  	=> ".fl-node-$id .xpro-preview-navigation",
		'unit'			=> 'px', // Omit if custom unit select is used.
		'props'			=> array(
			'margin-top' 	=> 'preview_navigation_margin_top',
			'margin-right'  => 'preview_navigation_margin_right',
			'margin-bottom' => 'preview_navigation_margin_bottom',
			'margin-left' 	=> 'preview_navigation_margin_left',
		),
	)
);


//Content Box


FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-content-area",
		'props' 	=> array(
			'background-color' 	=> $settings->preview_content_box_bg,
		),
	)
);

FLBuilderCSS::dimension_field_rule(
	array(
		'settings'		=> $settings,
		'setting_name' 	=> 'preview_navigation_margin',
		'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-content-area",
		'unit'			=> 'px', // Omit if custom unit select is used.
		'props'			=> array(
			'padding-top' 	=> 'preview_content_box_padding_top',
			'padding-right'  => 'preview_content_box_padding_right',
			'padding-bottom' => 'preview_content_box_padding_bottom',
			'padding-left' 	=> 'preview_content_box_padding_left',
		),
	)
);

FLBuilderCSS::border_field_rule(
	array(
		'settings' 		=> $settings,
		'setting_name' 	=> 'preview_content_box_border', // As in $settings->item_border
		'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-content-area",
	)
);

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-slider-nav",
		'enabled' 	    => 'false' === $settings->preview_content_box_nav_enable,
		'props' 	=> array(
			'display' 	=> 'none',
		),
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'preview_content_box_nav_size', // As in $settings->align.
		'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-slider-nav button",
		'prop'			=> 'font-size',
		'unit'			=> 'px',
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'preview_content_box_nav_bg_size', // As in $settings->align.
		'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-slider-nav button",
		'prop'			=> 'height',
		'unit'			=> 'px',
	)
);

FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'preview_content_box_nav_bg_size', // As in $settings->align.
		'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-slider-nav button",
		'prop'			=> 'width',
		'unit'			=> 'px',
	)
);

FLBuilderCSS::rule( array(
	'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-slider-nav",
	'media' 	=> 'default',
	'props' 	=> array(
		'right' 	=> ( '' !== $settings->preview_content_box_nav_bg_size ) ? ( - $settings->preview_content_box_nav_bg_size / 2) . 'px' : '',

	),
));
FLBuilderCSS::rule( array(
	'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-slider-nav button",
	'media' 	=> 'medium',
	'props' 	=> array(
		'right' 	=> ( '' !== $settings->preview_content_box_nav_bg_size_medium ) ? ( - $settings->preview_content_box_nav_bg_size_medium / 2) . 'px' : '',
	),
));
FLBuilderCSS::rule( array(
	'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-slider-nav button",
	'media' 	=> 'responsive',
	'props' 	=> array(
	'right' 	=> ( '' !== $settings->preview_content_box_nav_bg_size_responsive ) ? ( - $settings->preview_content_box_nav_bg_size_responsive / 2) . 'px' : '',
	),
));

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-slider-nav button",
		'props' 	=> array(
			'color' 	=> $settings->preview_content_box_nav_color,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-slider-nav button",
		'props' 	=> array(
			'background-color' 	=> $settings->preview_content_box_nav_bgcolor,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-slider-nav button:hover",
		'props' 	=> array(
			'color' 	=> $settings->preview_content_box_nav_hcolor,
		),
	)
);

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-slider-nav button:hover",
		'props' 	=> array(
			'background-color' 	=> $settings->preview_content_box_nav_hbgcolor,
		),
	)
);

FLBuilderCSS::border_field_rule(
	array(
		'settings' 		=> $settings,
		'setting_name' 	=> 'preview_content_box_nav_border', // As in $settings->item_border
		'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-slider-nav button",
	)
);

FLBuilderCSS::rule(
	array(
		'selector'		=> ".fl-node-$id .portfolio-preview-layout-8 .xpro-preview-slider-nav button:hover",
		'props' 	=> array(
			'border-color' 	=> $settings->preview_content_box_nav_hbdrcolor,
		),
	)
);


FLBuilderCSS::responsive_rule(
	array(
		'settings'		=> $settings,
		'setting_name'	=> 'preview_carousel_height', // As in $settings->align.
		'selector'		=> ".fl-node-$id .tnit-carousel-layout .item",
		'prop'			=> 'height',
		'unit'			=> 'px',
	)
);
