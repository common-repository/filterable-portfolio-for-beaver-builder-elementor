<?php

/**
 * @class TNITPortfolioLiteClass
 */

if ( ! class_exists( 'TNITPortfolioLiteClass' ) ) {

    class TNITPortfolioLiteClass extends FLBuilderModule {

        /**
         * @method __construct
         *
         */
        public function __construct()
        {
            parent::__construct(array(
                'name'            => __( 'Filterable Portfolio - Lite', 'xpro-bb-addons' ),
                'description'     => __( 'An awesome addition by Xpro team!', 'xpro-bb-addons' ),
                'group'           => XPRO_Plugins_Helper::$branding_modules,
                'category'        => XPRO_Plugins_Helper::$advance_module,
                'dir'             => XPRO_PORTFOLIO_FOR_BB_LITE_DIR . 'modules/tnit-portfolio/',
                'url'             => XPRO_PORTFOLIO_FOR_BB_LITE_URL . 'modules/tnit-portfolio/',
                'editor_export'   => true,
                'enabled'         => true,
                'partial_refresh' => true,
            ));

        }

        /**
         * @method enqueue_scripts
         *
         */
        public function enqueue_scripts()
        {
            // Already registered
            $this->add_css('font-awesome');
            $this->add_css('font-awesome-5');
            $this->add_css('foundation-icons');

            // Register and enqueue your own
            $this->add_css('xpro-grid', $this->url . 'css/xpro-grid.css');
            $this->add_css('cubeportfolio', $this->url . 'css/cubeportfolio.min.css','','4.4.0');
            $this->add_css('owl-carousel', $this->url . 'css/owl.carousel.min.css','','2.3.4');
            $this->add_css('slick', $this->url . 'css/slick.min.css','','2.3.4');
            $this->add_css('slim-select', $this->url . 'css/slimselect.min.css');

            $this->add_js('cubeportfolio', $this->url . 'js/jquery.cubeportfolio.min.js', array('jquery'), '4.4.0', true);
            $this->add_js('owl-carousel', $this->url . 'js/owl.carousel.min.js', array('jquery'), '2.3.4', true);
            $this->add_js('slick', $this->url . 'js/slick.min.js', array('jquery'), '2.3.4', true);
            $this->add_js('slim-select', $this->url . 'js/slimselect.min.js', array('jquery'), '', true);
            $this->add_js('gsap', $this->url . 'js/gsap.min.js', array('jquery'), '3.2.4', true);

        }

        /**
         * Function string filter
         *
         * @method clean
         */
        function clean($string) {
            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
            $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
            return strtolower( $string );
        }

        /**
         * Function that renders Portfolio Title
         *
         * @method render_portfolio_title
         */

        public function render_portfolio_title( $photos)
        {
            $settings = $this->settings;

            $html = '';

            if ( 'yes' === $settings->enable_title ) {
                if ( '' != $photos->portfolio_title ) {

                    $title = '';

                    $title = $photos->portfolio_title;

                    $html .= '<' . $settings->title_tag . ' class="title">';
                    $html .= $title;
                    $html .= '</' . $settings->title_tag . '>';
                }
            }

            echo $html;
        }

        /**
         * Function that renders Portfolio Description
         *
         * @method render_portfolio_description
         */
        public function render_portfolio_description( $photos)
        {
            $settings = $this->settings;

            $html = '';

            if ( 'yes' === $settings->enable_description ) {
                if ( '' != $photos->description) {

                    $description = '';

                    $description = $photos->description;

                    $html .= '<p class="desc">';
                    $html .= $description;
                    $html .= '</p>';
                }
            }

            echo $html;
        }

        /**
         * Function that renders Featured Image
         *
         * @method render_featured_image
         */
        public function render_featured_image( $photos)
        {
            $settings = $this->settings;

            /**
             * Get photo data
             *
             * @variable $photo
             */
            if ( !empty( $photos->featured_img ))
            {
                $photo = FLBuilderPhoto::get_attachment_data( $photos->featured_img );

                // get src
                $src =  (!empty($photos->featured_img_src)) ? $photos->featured_img_src : '' ;
                $alt = '';

                // get alt
                if( !empty( $photo->alt ) ) {
                    $alt = htmlspecialchars( $photo->alt );
                }
                else if( !empty( $photo->description ) ) {
                    $alt = htmlspecialchars( $photo->description );
                }
                else if( !empty( $photo->caption ) ) {
                    $alt = htmlspecialchars( $photo->caption );
                }
                else if( !empty( $photo->title ) ) {
                    $alt = htmlspecialchars( $photo->title );
                }

                // get classes
                $photo_classes = array( 'tnit-image' );

                if ( is_object( $photo ) )
                {
                    $photo_classes[] = 'wp-image-' . $photo->id;

                    if ( isset( $photo->sizes ) )
                    {
                        foreach ( $photo->sizes as $key => $size )
                        {
                            if ( $size->url == $photos->featured_img_src ) {
                                $photo_classes[] = 'size-' . $key;
                                break;
                            }
                        }
                    }
                }

                $photo_classes = implode( ' ', $photo_classes );

                // echo photo
                $html = '<img src="' . $src . '" class="' . $photo_classes . '" alt="' . $alt . '">';

                echo $html;
            }
            else {
                $html = '<img src="' . $this->url . 'img/placeholder-lg.jpg" class="tnit-image tnit-image-placeholder" alt="placeholder-image">';

                echo $html;
            }

        }

        /**
         * Function that renders Featured Image
         *
         * @method render_featured_image_url
         */

        public function render_featured_image_url( $photos)
        {
            $settings = $this->settings;

            /**
             * Get photo data
             *
             * @variable $photo
             */
            if ( !empty( $photos->featured_img ))
            {
                $photo = FLBuilderPhoto::get_attachment_data( $photos->featured_img );

                // echo photo
                $html = $photo->url;

                echo $html;
            }
            else {
                $html =$this->url . 'img/placeholder-lg.jpg';

                echo $html;
            }

        }

        /**
         * Function that renders Overlay Icon
         *
         * @method render_overlay_icon
         */
        public function render_overlay_icon( $photos)
        {
            $settings = $this->settings;

            $html = '';

            if ( !empty( $settings->overlay_icon ) )
            {
                $html .= '<span class="tnit-overlay-icon">';
                $html .= '<i class="' . $settings->overlay_icon . '" aria-hidden="true"></i>';
                $html .= '</span>';
            }

            echo $html;
        }

        /**
         * Function that renders Portfolio Button
         *
         * @method render_portfolio_button
         */
        public function render_portfolio_button( $photos)
        {
            $settings = $this->settings;

            $html = '';

            if ( 'yes' === $settings->enable_button ) {
                if ( '' != $settings->button_text) {
                    $html .= '<a href="javascript:void(0);" class="btn">';
                    $html .= $settings->button_text;
                    $html .= '</a>';
                }
            }
            echo $html;
        }

    }

    /**
     * Register the module and its form settings.
     */
    FLBuilder::register_module( 'TNITPortfolioLiteClass', array(
        'general_tab'      => array(
            'title'         => __( 'General', 'xpro-bb-addons' ),
            'sections'      => array(
                'general'       => array(
                    'title'         => '',
                    'fields'        => array(
                        'portfolio_layout' => array(
                            'type'      => 'select',
                            'label'     => __('Portfolio Layout', 'xpro-bb-addons'),
                            'default'   => 'grid',
                            'options'   => array(
                                'grid'		=> __('Grid', 'xpro-bb-addons'),
                                'disable0' 	=> __('Masonry - Pro', 'xpro-bb-addons'),
                                'disable1' 	=> __('Mosaic - Pro', 'xpro-bb-addons'),
                                'disable2' 	=> __('Carousel - Pro', 'xpro-bb-addons'),
                                'disable3' 	=> __('Innovative - Pro', 'xpro-bb-addons'),
                                'disable4' 	=> __('Minimal - Pro', 'xpro-bb-addons'),
                                'disable5' 	=> __('Agency - Pro', 'xpro-bb-addons'),
                                'disable6' 	=> __('Modern - Pro', 'xpro-bb-addons'),
                            ),
                            'toggle'    => array(
                                'grid'     => array(
                                    'fields'   	=> array('items_height','overlay_hover_effect','items_spacing','portfolio_items_border'),
                                    'tabs'   	=> array('filter'),
                                    'sections'   	=> array('number_of_photos','overlay_styles','overlay_icon_style','title_style','description_style','button_style','title_typo','description_typo','button_typo'),
                                ),
                                'masonry'     => array(
                                    'fields'   	=> array('overlay_hover_effect','items_spacing','portfolio_items_border'),
                                    'tabs'   	=> array('filter'),
                                    'sections'   	=> array('number_of_photos','overlay_styles','overlay_icon_style','title_style','description_style','button_style','title_typo','description_typo','button_typo'),
                                ),
                                'mosaic'     => array(
                                    'fields'   	=> array('items_height','items_spacing','sort_by_dimension','mosaic_info','mosaic_grid_info', 'overlay_hover_effect','portfolio_items_border'),
                                    'tabs'   	=> array('filter'),
                                    'sections'   	=> array('number_of_photos','overlay_styles','overlay_icon_style','title_style','description_style','button_style','title_typo','description_typo','button_typo'),
                                ),
                                'carousel'     => array(
                                    'fields'   	=> array('items_height','items_spacing','slider_overlay_hvr_effect','item_center_bg','auto_width','item_center','nav_dots','nav_dots','portfolio_items_border'),
                                    'tabs'   	=> array('carousel'),
                                    'sections'   	=> array('number_of_photos','overlay_styles','overlay_icon_style','title_style','description_style','button_style','dots_style','title_typo','description_typo','button_typo'),
                                ),
                                'innovative'     => array(
                                    'fields'   	=> array('items_height','auto_width','item_center','content_box_bgcolor'),
                                    'tabs'   	=> array('carousel'),
                                    'sections'   	=> array('number_of_photos','overlay_styles','overlay_icon_style','title_style','description_style','button_style','dots_style','title_typo','description_typo','button_typo'),
                                ),
                                'minimal'     => array(
                                    'fields'   	=> array('wrapper_height','content_box_bgcolor','portfolio_items_border'),
                                    'tabs'   	=> array('carousel'),
                                    'sections'   	=> array('title_style','description_style','button_style','title_typo','description_typo','button_typo'),
                                ),
                                'agency'     => array(
                                    'fields'   	=> array('wrapper_height','content_box_bgcolor','portfolio_items_border'),
                                    'sections'   	=> array('menu_style','menu_typo'),
                                ),
                                'modern'     => array(
                                    'fields'   	=> array('wrapper_height','content_box_bgcolor','modern_overaly_color','portfolio_items_border'),
                                    'sections'   	=> array('menu_style','menu_typo'),
                                ),
                            ),
                        ),
                        'items_height' => array(
                            'type'        	=> 'unit',
                            'label'       	=> __('Item Height', 'xpro-bb-addons'),
                            'units'      => array('px', 'vh', '%',),
                            'responsive'  	=> true,
                            'slider'  		=> true,
                            'placeholder'   => '400',
                            'help'			=> 'Select the row height of items (optional).',
                        ),
                        'wrapper_height' => array(
                            'type'        	=> 'unit',
                            'label'       	=> __('Wrapper Height', 'xpro-bb-addons'),
                            'units'      => array('px', 'vh', '%',),
                            'responsive'  	=> true,
                            'slider'  		=> true,
                            'placeholder'   => '800',
                            'help'			=> 'Select the row height of items (optional).',
                        ),
                        'items_spacing' => array(
                            'type'        	=> 'unit',
                            'label'       	=> 'Photo Spacing',
                            'placeholder'   => '30',
                            'units' 		=> array( 'px' ),
                            'slider' 		=> true,
                            'responsive' 	=> true,
                            'help'			=> 'Adjust the space between portfolio items.',
                        ),
                    ),
                ),
                'number_of_photos'       => array(
                    'title'         => 'Photos to Show', // Section Title
                    'fields'        => array(
                        'sort_by_dimension' 		=> array(
                            'type'      => 'select',
                            'label'     => __('Sort By Dimension', 'xpro-bb-addons'),
                            'default'   => 'false',
                            'help'			=> 'Random Sorting of Images.',
                            'options'   => array(
                                'false' => __('No', 'xpro-bb-addons'),
                                'true' => __('Yes', 'xpro-bb-addons'),
                            ),
                        ),
                        'grid_numbers' 		=> array(
                            'type' 			=> 'unit',
                            'label'       	=> __( 'Grid Numbers', 'xpro-bb-addons' ),
                            'units'        	=> array('column(s)'),
                            'slider'      	=> true,
                            'responsive'    => array(
                                'placeholder'   => array(
                                    'default' 		=> '2',
                                    'medium' 		=> '2',
                                    'responsive' 	=> '1',
                                ),
                            ),
                            'help' 			=> __( 'This is how many items you want to show in a row.', 'xpro-bb-addons' ),
                        ),
                        'mosaic_grid_info' => array(
                            'type'    => 'raw',
                            'label'   => 'Mosaic Layout Grid',
                            'content' => '<strong>Mosaic</strong> will work according to the width of the images, smaller item is equal to one column.',
                        ),
                    ),
                ),
                'preview_settings'       => array(
                    'title'         => 'Preview Settings', // Section Title
                    'fields'        => array(
                        'preview_type' => array(
                            'type'      => 'select',
                            'label'     => __('Preview Type', 'xpro-bb-addons'),
                            'default'   => 'link',
                            'options'   => array(
                                'popup'		=> __('Popup Page', 'xpro-bb-addons'),
                                'link' 	=> __('External Link', 'xpro-bb-addons'),
                            ),
                            'toggle'    => array(
                                'popup'     => array(
                                    'fields'   	=> array('popup_layout','popup_preview','preview_animation'),
                                    'tabs'   	=> array('preview_tab'),
                                ),
                                'link'     => array(
                                    'fields'   	=> array('page_target'),
                                ),
                            ),
                        ),
                        'popup_layout' => array(
                            'type'      => 'select',
                            'label'     => __('Popup Layout', 'xpro-bb-addons'),
                            'default'   => 'external_link',
                            'options'   => array(
                                'layout-1'		=> __('Layout 1', 'xpro-bb-addons'),
                                'disable0' 	=> __('Layout 2', 'xpro-bb-addons'),
                                'disable1' 	=> __('Layout 3', 'xpro-bb-addons'),
                                'disable2' 	=> __('Layout 4', 'xpro-bb-addons'),
                                'disable3' 	=> __('Layout 5', 'xpro-bb-addons'),
                                'disable4' 	=> __('Layout 6', 'xpro-bb-addons'),
                                'disable5' 	=> __('Layout 7', 'xpro-bb-addons'),
                                'disable6' 	=> __('Layout 8', 'xpro-bb-addons'),
                                'disable7' 	=> __('Layout 9', 'xpro-bb-addons'),
                                'disable8' 	=> __('Layout 10', 'xpro-bb-addons'),
                            ),
                        ),
                        'preview_animation' => array(
                            'type'      => 'select',
                            'label'     => __('Popup Animation', 'xpro-bb-addons'),
                            'default'   => 'style-1',
                            'options'   => array(
                                'style-1'	=> __('Slice Left', 'xpro-bb-addons'),
                                'disable0' 	=> __('Slice Right', 'xpro-bb-addons'),
                                'disable1' 	=> __('Slot Top', 'xpro-bb-addons'),
                                'disable2' 	=> __('Slot bottom', 'xpro-bb-addons'),
                                'disable3' 	=> __('Reveal Left', 'xpro-bb-addons'),
                                'disable4' 	=> __('Reveal Right', 'xpro-bb-addons'),
                                'disable5' 	=> __('Reveal Top', 'xpro-bb-addons'),
                                'disable6' 	=> __('Reveal Bottom', 'xpro-bb-addons'),
                            ),
                        ),
                        'popup_preview'	=> array(
                            'type'			=> 'button',
                            'label'			=> __('Preview Popup', 'xpro-bb-addons'),
                            'class'			=> 'tnit-portfolio-popup-preview',
                        ),
                        'page_target'     => array(
                            'type'      => 'select',
                            'label'     => __('Target', 'xpro-bb-addons'),
                            'default'   => '_blank',
                            'help'     => __('Specifies where to open the linked document.', 'xpro-bb-addons'),
                            'options'   => array(
                                '_blank'      => __('Blank', 'xpro-bb-addons'),
                                '_self'     => __('Self', 'xpro-bb-addons'),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'filter_tab'      => array(
            'title'         => __( 'Filters', 'xpro-bb-addons' ),
            'sections'      => array(
                'filter_general'       => array(
                    'title'         => '',
                    'fields'        => array(
                        'enable_filter'     => array(
                            'type'      => 'select',
                            'label'     => __('Enable Filter', 'xpro-bb-addons'),
                            'default'   => '0',
                            'options'   => array(
                                '0'	=> __('No', 'xpro-bb-addons'),
                                'disable0' => __('Yes - Pro', 'xpro-bb-addons'),
                            ),
                            'toggle'    => array(
                                '1'     => array(
                                    'fields'   	=> array('all_filter_custom_text','filter_name', 'filters_typo', 'filter_animation', 'filter_dropdown','filters_dropdown_preview_button','filters_dropdown_toggle'),
                                    'sections'  => array('filters_style', 'filters_responsive', 'filters_typo', 'filters_overall_styles'),
                                ),
                            ),
                            'help'     => __('This is whether you want to show filters or not.', 'xpro-bb-addons'),
                        ),
                        'all_filter_custom_text'         => array(
                            'type'          => 'text',
                            'label'         => __('Customize "All" Text', 'xpro-bb-addons'),
                            'default'       => __('All', 'xpro-bb-addons'),
                            'help'			=> __('This is to customize the "All" filter text.', 'xpro-bb-addons'),
                        ),
                        'filter_name'         => array(
                            'type'          => 'text',
                            'label'         => __('Filter Name', 'xpro-bb-addons'),
                            'placeholder'       => __('Filter', 'xpro-bb-addons'),
                            'help'			=> __('Name of filter category.', 'xpro-bb-addons'),
                            'multiple'      => true,
                        ),
                        'filter_animation'     => array(
                            'type'      => 'select',
                            'label'     => __('Animation Type', 'xpro-bb-addons'),
                            'default'   => 'sequentially',
                            'options'   => array(
                                'quicksand' 	=> __('Quick Sand', 'xpro-bb-addons'),
                                'fadeOut'		=> __('Fade Out', 'xpro-bb-addons'),
                                'disable0'		=> __('3D Flip - Pro', 'xpro-bb-addons'),
                                'disable1'		=> __('Flip Out - Pro', 'xpro-bb-addons'),
                                'disable2'	    => __('Flip Out Delay - Pro', 'xpro-bb-addons'),
                                'disable3'	    => __('Flip Bottom - Pro', 'xpro-bb-addons'),
                                'disable4'	    => __('Fade Out Top - Pro', 'xpro-bb-addons'),
                                'disable5'  	=> __('Bounce Left - Pro', 'xpro-bb-addons'),
                                'disable6' 	    => __('Bounce Top - Pro', 'xpro-bb-addons'),
                                'disable7' 	    => __('Bounce Bottom - Pro', 'xpro-bb-addons'),
                                'disable8' 		=> __('Move Left - Pro', 'xpro-bb-addons'),
                                'disable9' 	    => __('Slide Left - Pro', 'xpro-bb-addons'),
                                'disable10' 	=> __('Slide Delay - Pro', 'xpro-bb-addons'),
                                'disable11' 	=> __('Rotate Sides - Pro', 'xpro-bb-addons'),
                                'disable12' 	=> __('Sequentially - Pro', 'xpro-bb-addons'),
                                'disable13' 	=> __('Skew - Pro', 'xpro-bb-addons'),
                                'disable14' 	=> __('Fold Left - Pro', 'xpro-bb-addons'),
                                'disable15' 	=> __('Unfold - Pro', 'xpro-bb-addons'),
                                'disable16' 	=> __('Scale Down - Pro', 'xpro-bb-addons'),
                                'disable17' 	=> __('Scale Sides - Pro', 'xpro-bb-addons'),
                                'disable18' 	=> __('Front Row - Pro', 'xpro-bb-addons'),
                                'disable19' 	=> __('Rotate Room - Pro', 'xpro-bb-addons'),
                            ),
                            'help'     => __('Defines which animation to use for items that will be shown or hidden after a filter has been activated.', 'xpro-bb-addons'),
                        ),
                        'filter_dropdown'     => array(
                            'type'      => 'select',
                            'label'     => __('Show Filter Dropdown', 'xpro-bb-addons'),
                            'default'   => 'small',
                            'options'   => array(
                                'always'		=> __('Always', 'xpro-bb-addons'),
                                'medium-small' 	=> __('Medium & Small Devices', 'xpro-bb-addons'),
                                'small' 		=> __('Small Devices', 'xpro-bb-addons'),
                            ),
                            'help'     => __('This is to show filters dropdown on default, medium or small devices.', 'xpro-bb-addons'),
                        ),
                        'filters_dropdown_preview_button'	=> array(
                            'type'			=> 'button',
                            'label'			=> __('Preview Responsive', 'xpro-bb-addons'),
                            'class'			=> 'tnit-portfolio-filter-dropdown-preview',
                        ),
                        'filters_dropdown_toggle'	=> array(
                            'type'			=> 'button',
                            'label'			=> __('Toggle Dropdown', 'xpro-bb-addons'),
                            'class'			=> 'tnit-portfolio-filters-dropdown-toggle',
                            'description'   => __('Show/Hide dropdown', 'xpro-bb-addons'),
                        ),
                    ),
                ),
                'filters_style'       => array(
                    'title'         => 'Filters',
                    'collapsed'     => true,
                    'fields'        => array(
                        'filters_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'help'    		=> 'This is the text color for all filters.',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-l-filters-button .cbp-filter-item',
                                        'property'     => 'color'
                                    ),
                                ),
                            ),
                        ),
                        'filters_hvr_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Hover Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'help'    		=> 'This is filters text color on hover',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-l-filters-button .cbp-filter-item:hover',
                                        'property'     => 'color'
                                    ),
                                ),
                            ),
                        ),
                        'filters_active_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Active Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'help'    		=> 'This is the text color for active filter',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-filter-item.cbp-filter-item-active',
                                        'property'     => 'color'
                                    ),
                                ),
                            ),
                        ),
                        'filters_bg_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'help'    		=> 'This is the background color for all filters.',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-l-filters-button .cbp-filter-item',
                                        'property'     => 'background-color'
                                    ),
                                ),
                            ),
                        ),
                        'filters_bg_hvr_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background Hover Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'help'    		=> 'This is the background hover color for all filters.',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-l-filters-button .cbp-filter-item:hover',
                                        'property'     => 'background-color'
                                    ),
                                ),
                            ),
                        ),
                        'filters_bg_active_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background Active Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'help'    		=> 'This is the background color for active filter.',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-filter-item.cbp-filter-item-active',
                                        'property'     => 'background-color'
                                    ),
                                ),
                            ),
                        ),
                        'filters_alignment'    => array(
                            'type'        	=> 'align',
                            'label'       	=> __( 'Alignment', 'xpro-bb-addons' ),
                            'help' 			=> 'This is filters horizontal alignment.',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-filter ul',
                                        'property'     => 'text-align'
                                    ),
                                ),
                            ),
                        ),
                        'filters_typography'    => array(
                            'type'        	=> 'typography',
                            'label'       	=> __( 'Typography', 'xpro-bb-addons' ),
                            'responsive'  	=> true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-portfolio-filter .cbp-l-filters-button .cbp-filter-item,.tnit-portfolio-dropdown .select-option',
                            ),
                        ),
                        'filters_border' => array(
                            'type'       => 'border',
                            'label'      => __('Border', 'xpro-bb-addons'),
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-l-filters-button .cbp-filter-item',
                                    ),
                                ),
                            ),
                        ),
                        'filters_border_hover' => array(
                            'type'       => 'border',
                            'label'      => __('Border on Hover', 'xpro-bb-addons'),
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-filter-item:not(.cbp-filter-item-active):hover',
                                    ),
                                ),
                            ),
                        ),
                        'filters_border_active' => array(
                            'type'       => 'border',
                            'label'      => __('Border on Active', 'xpro-bb-addons'),
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-filter:not(.tnit-portfolio-dropdown) .cbp-filter-item.cbp-filter-item-active',
                                    ),
                                ),
                            ),
                        ),
                        'filters_spacing' => array(
                            'type'        	=> 'unit',
                            'label'       	=> 'Filters Spacing',
                            'placeholder'   => '10',
                            'units' 		=> array('px'),
                            'slider' 		=> true,
                            'help'    		=> 'Adjust the spacing between filters',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-filter .cbp-l-filters-button .cbp-filter-item',
                                        'property'     => 'margin-right'
                                    ),
                                    array(
                                        'selector'     => '.tnit-portfolio-filter .cbp-l-filters-button .cbp-filter-item',
                                        'property'     => 'margin-left'
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                'filters_responsive'       => array(
                    'title'         => 'Filters Dropdown',
                    'collapsed'     => true,
                    'fields'        => array(
                        'filters_color_resp' => array(
                            'type'          => 'color',
                            'label'         => __( 'Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'help'    		=> 'This setting is for filter text color',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-dropdown .cbp-l-filters-button .cbp-filter-item',
                                        'property'     => 'color'
                                    ),
                                ),
                            ),
                        ),
                        'filters_hvr_color_resp' => array(
                            'type'          => 'color',
                            'label'         => __( 'Hover Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'help'    		=> 'This setting is for filter text color',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-dropdown .cbp-l-filters-button .cbp-filter-item:hover',
                                        'property'     => 'color'
                                    ),
                                ),
                            ),
                        ),
                        'filters_active_color_resp' => array(
                            'type'          => 'color',
                            'label'         => __( 'Active Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'help'    		=> 'Active color will also apply to the text on hover.',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-dropdown .select-option',
                                        'property'     => 'color'
                                    ),
                                ),
                            ),
                        ),
                        'filters_bg_color_resp' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-dropdown .cbp-l-filters-button .cbp-filter-item',
                                        'property'     => 'background-color'
                                    ),
                                ),
                            ),
                        ),
                        'filters_bg_hvr_color_resp' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background Hover Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-dropdown .cbp-l-filters-button .cbp-filter-item:hover',
                                        'property'     => 'background-color'
                                    ),
                                ),
                            ),
                        ),
                        'filters_bg_active_color_resp' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background Active Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'help'    		=> 'Background active color will also apply to the filter background on hover.',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-dropdown .select-option',
                                        'property'     => 'background-color'
                                    ),
                                ),
                            ),
                        ),
                        'filters_separator'   => array(
                            'type'      => 'select',
                            'label'     => __('Show Separator', 'xpro-bb-addons'),
                            'default'   => 'yes',
                            'options'   => array(
                                'yes'     => __('Yes', 'xpro-bb-addons'),
                                'no'      => __('No', 'xpro-bb-addons'),
                            ),
                            'toggle'    => array(
                                'yes'     => array(
                                    'fields'   	=> array('filters_separator_style', 'filters_separator_size', 'filters_separator_color'),
                                ),
                            ),
                        ),
                        'filters_separator_style'   => array(
                            'type'      => 'select',
                            'label'     => __('Separator Style', 'xpro-bb-addons'),
                            'default'   => 'solid',
                            'options'   => array(
                                'solid'     => __('Solid', 'xpro-bb-addons'),
                                'dashed'    => __('Dashed', 'xpro-bb-addons'),
                                'dotted'    => __('Dotted', 'xpro-bb-addons'),
                                'doubled'   => __('Doubled', 'xpro-bb-addons'),
                            ),
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-dropdown .cbp-l-filters-button .cbp-filter-item',
                                        'property'     => 'border-bottom-style'
                                    ),
                                ),
                            ),
                        ),
                        'filters_separator_size' => array(
                            'type'        	=> 'unit',
                            'label'       	=> 'Separator Size',
                            'units' 		=> array( 'px' ),
                            'slider' 		=> true,
                            'placeholder'   => '1',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-dropdown .cbp-l-filters-button .cbp-filter-item',
                                        'property'     => 'border-bottom-width'
                                    ),
                                ),
                            ),
                        ),
                        'filters_separator_color'   => array(
                            'type'          => 'color',
                            'label'         => __('Separator Color', 'xpro-bb-addons'),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-dropdown .cbp-l-filters-button .cbp-filter-item',
                                        'property'     => 'border-bottom-color'
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                'filters_overall_styles'       => array(
                    'title'         => 'Miscellaneous',
                    'collapsed'     => true,
                    'fields'        => array(
                        'filters_padding' => array(
                            'type'        	=> 'dimension',
                            'label'       	=> 'Filter Padding',
                            'units' 		=> array('px'),
                            'slider' 		=> true,
                            'responsive' => array(
                                'placeholder'   => array(
                                    'default' 	 => array(
                                        'top'        => '5',
                                        'right'      => '20',
                                        'bottom'     => '5',
                                        'left'       => '20',
                                    ),
                                    'medium' 	 => array(),
                                    'responsive' => array(),
                                ),
                            ),
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-filter .cbp-l-filters-button .cbp-filter-item',
                                        'property'     => 'padding'
                                    ),
                                ),
                            ),
                        ),
                        'filters_bottom_spacing' => array(
                            'type'        	=> 'unit',
                            'label'       	=> 'Bottom Spacing',
                            'placeholder'   => '30',
                            'units' 		=> array('px'),
                            'slider' 		=> true,
                            'responsive'  	=> true,
                            'help'    		=> 'Adjust the spacing between filter and photos',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-filter',
                                        'property'     => 'margin-bottom'
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'portfolio_tab'      => array(
            'title'         => __( 'Portfolio', 'xpro-bb-addons' ), // Tab title
            'sections'      => array( // Tab Sections
                'general'       => array( // Section
                    'title'         => '', // Section Title
                    'fields'        => array( // Section Fields
                        'filterable_portfolio'     => array(
                            'type'          => 'form',
                            'label'         => __( 'Photo Group', 'xpro-bb-addons' ),
                            'form'          => 'portfolio_form', // ID from registered form below
                            'preview_text'  => 'portfolio_title', // Name of a field to use for the preview text
                            'multiple'      => true,
                            'limit'         => 8,
                            'default'      	=> array(
                                array(
                                    'portfolio_title'   => 'Portfolio Title 1',
                                    'description'   => 'Our Creative Portfolio',
                                    'preview_sub_title'   => 'Preview Sub Title 1',
                                    'preview_title'   => 'Preview Title 1',
                                    'preview_description'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque auctor nibh eu nibh scelerisque malesuada.',
                                ),
                                array(
                                    'portfolio_title'   => 'Portfolio Title 2',
                                    'description'   => 'Our Creative Portfolio',
                                    'preview_sub_title'   => 'Preview Sub Title 2',
                                    'preview_title'   => 'Preview Title 2',
                                    'preview_description'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque auctor nibh eu nibh scelerisque malesuada.',
                                ),
                            ),
                        ),
                        'portfolio_limit_info' => array(
                            'type'    => 'raw',
                            'label'   => ' ',
                            'content' => '<strong>Note: </strong> In portfolio lite version you can add only 8 items, To enable all features please  <a href="https://beaver.wpxpro.com/creative-portfolio/" target="_blank">Upgrade</a> Portfolio.',
                        ),
                    ),
                ),
            ),
        ),
        'carousel'      => array(
            'title'         => __( 'Carousel', 'xpro-bb-addons' ),
            'sections'      => array(
                'carousel_settings'       => array(
                    'title'         => 'Carousel Settings',
                    'fields'        => array(
                        'slide_loop' => array(
                            'type'    		=> 'select',
                            'label'   		=> __( 'Loop', 'xpro-bb-addons' ),
                            'default' 		=> 'false',
                            'options' 		=> array(
                                'true'   		=> 'Yes',
                                'false'  		=> 'No',
                            ),
                            'toggle'    => array(
                                'false'     => array(
                                    'fields'   	=> array('start_position'),
                                ),
                            ),
                            'help' 			=> __( 'Infinity loop, Duplicate last and first items to get loop illusion.', 'xpro-bb-addons' ),
                        ),
                        'lazy_load' => array(
                            'type'    		=> 'select',
                            'label'   		=> __( 'Lazy Load', 'xpro-bb-addons' ),
                            'default' 		=> 'true',
                            'options' 		=> array(
                                'true'   		=> 'Yes',
                                'false'  		=> 'No',
                            ),
                            'help' 			=> __( 'Infinity loop, Duplicate last and first items to get loop illusion.', 'xpro-bb-addons' ),
                        ),
                        'item_center' => array(
                            'type'    		=> 'select',
                            'label'   		=> __( 'Center', 'xpro-bb-addons' ),
                            'default' 		=> 'false',
                            'options' 		=> array(
                                'true'   		=> 'Yes',
                                'false'  		=> 'No',
                            ),
                            'help' 			=> __( 'Add center to setup, Keep in mind that dots are not working here like a pagination.', 'xpro-bb-addons' ),
                        ),
                        'start_position' => array(
                            'type'         	=> 'unit',
                            'label'        	=> 'Start Position',
                            'placeholder'	=> '1',
                            'slider' 		=> array(
                                'min'  	=> 0,
                                'max'  	=> 10,
                                'step' 	=> 1,
                            ),
                            'help' 			=> __( 'Start position of slider items.', 'xpro-bb-addons' ),
                        ),
                        'auto_width' => array(
                            'type'    		=> 'select',
                            'label'   		=> __( 'Auto Width', 'xpro-bb-addons' ),
                            'default' 		=> 'false',
                            'options' 		=> array(
                                'true'   		=> 'Yes',
                                'false'  		=> 'No',
                            ),
                            'toggle'    => array(
                                'true'     => array(
                                    'fields'   	=> array('auto_width_value'),
                                ),
                            ),
                            'help' 			=> __( 'Use width style on elements to get the result you want.', 'xpro-bb-addons' ),
                        ),
                        'auto_width_value' => array(
                            'type'         	=> 'unit',
                            'label'        	=> 'Width',
                            'units'      => array('px', 'vw', '%',),
                            'placeholder'	=> '400',
                            'default'	=> '400',
                            'slider'		=> true,
                            'responsive'    => true,
                        ),
                        'autoplay' => array(
                            'type'    		=> 'select',
                            'label'   		=> __( 'Autoplay', 'xpro-bb-addons' ),
                            'default' 		=> 'false',
                            'options' 		=> array(
                                'true'   		=> 'Yes',
                                'false'  		=> 'No',
                            ),
                            'toggle'    => array(
                                'true'     => array(
                                    'fields'   	=> array('autoplay_hover_pause','speed'),
                                ),
                            ),
                            'help'      => __( 'Select "Yes" if you want the slider to continuously rotate after the end of the slider.', 'xpro-bb-addons' ),
                        ),
                        'autoplay_hover_pause'     => array(
                            'type'      => 'select',
                            'label'     => __('Autoplay Hover Pause', 'xpro-bb-addons'),
                            'default'   => 'true',
                            'options'   => array(
                                'true' 		=> __('Yes', 'xpro-bb-addons'),
                                'false' 	=> __('No', 'xpro-bb-addons'),
                            ),
                            'help'      => __( 'Select "Yes" if you want slides pause on hover.', 'xpro-bb-addons' ),
                        ),
                        'speed' => array(
                            'type'         	=> 'unit',
                            'label'        	=> 'Speed',
                            'units'	       	=> array( 'ms' ),
                            'default'	   	=> '5000',
                            'placeholder'	=> '5000',
                            'slider' 		=> array(
                                'min'  	=> 0,
                                'max'  	=> 10000,
                                'step' 	=> 100,
                            ),
                            'help'      => __( 'This is the slider rotation speed in milliseconds.', 'xpro-bb-addons' ),
                        ),
                        'nav_arrows' => array(
                            'type'    		=> 'select',
                            'label'   		=> __( 'Show Navigation Arrows', 'xpro-bb-addons' ),
                            'options' 		=> array(
                                'true'      	=> 'Yes',
                                'false' 		=> 'No',
                            ),
                            'responsive'	=> array(
                                'default' => array(
                                    'default' 	 => 'true',
                                    'medium'  	 => '',
                                    'responsive' => 'false',
                                ),
                            ),
                        ),
                        'nav_dots' => array(
                            'type'    		=> 'select',
                            'label'   		=> __( 'Show Navigation Dots', 'xpro-bb-addons' ),
                            'options' 		=> array(
                                'true'      	=> 'Yes',
                                'false' 		=> 'No',
                            ),
                            'responsive'	=> array(
                                'default' => array(
                                    'default' 	 => 'false',
                                    'medium'  	 => '',
                                    'responsive' => 'true',
                                ),
                            ),
                        ),
                    ),
                ),
                'arrows_style'       => array(
                    'title'         => 'Navigation Arrows Style',
                    'collapsed'     => true,
                    'fields'        => array(
                        'arrows_style' => array(
                            'type'    		=> 'select',
                            'label'   		=> __( 'Background Style', 'xpro-bb-addons' ),
                            'default' 		=> 'square',
                            'options' 		=> array(
                                'simple'   		=> 'Simple',
                                'square'   		=> 'Square Background',
                                'circle'  		=> 'Circle Background',
                                'custom'  		=> 'Design your own',
                            ),
                            'toggle'		=> array(
                                'square' 		=> array(
                                    'fields' => array('arrows_bg_color', 'arrows_bg_hvr_color'),
                                ),
                                'circle' 		=> array(
                                    'fields' => array('arrows_bg_color', 'arrows_bg_hvr_color'),
                                ),
                                'custom' 		=> array(
                                    'fields' => array('arrows_bg_color', 'arrows_bg_hvr_color', 'arrows_border', 'arrows_border_hvr'),
                                ),
                            ),
                        ),
                        'arrows_size' => array(
                            'type'         	=> 'unit',
                            'label'        	=> 'Arrow Size',
                            'units'	       	=> array( 'px' ),
                            'placeholder'	=> '25',
                            'slider'		=> true,
                            'responsive'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-portfolio-slider-wrapper .tnit-slider-nav,.tnit-slider-arrows .tnit-slider-nav',
                                'property'     => 'font-size'
                            ),
                        ),
                        'arrows_bgsize' => array(
                            'type'         	=> 'unit',
                            'label'        	=> 'Arrow Background Size',
                            'units'	       	=> array( 'px' ),
                            'placeholder'	=> '50',
                            'slider'		=> true,
                            'responsive'    => true,

                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-portfolio-slider-wrapper .tnit-slider-nav,.tnit-slider-arrows .tnit-slider-nav',
                                        'property'     => 'height'
                                    ),
                                    array(
                                        'selector'     => '.tnit-portfolio-slider-wrapper .tnit-slider-nav,.tnit-slider-arrows .tnit-slider-nav',
                                        'property'     => 'width'
                                    ),
                                ),
                            ),
                        ),
                        'arrows_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-portfolio-slider-wrapper .tnit-slider-nav,.tnit-slider-arrows .tnit-slider-nav',
                                'property'     => 'color'
                            ),
                        ),
                        'arrows_hvr_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Hover Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-portfolio-slider-wrapper .tnit-slider-nav:hover,.tnit-slider-arrows .tnit-slider-nav:hover',
                                'property'     => 'color'
                            ),
                        ),
                        'arrows_bg_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-portfolio-slider-wrapper .tnit-slider-nav,.tnit-slider-arrows .tnit-slider-nav',
                                'property'     => 'background-color'
                            ),
                        ),
                        'arrows_bg_hvr_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background Hover Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-portfolio-slider-wrapper .tnit-slider-nav:hover,.tnit-slider-arrows .tnit-slider-nav:hover',
                                'property'     => 'background-color'
                            ),
                        ),
                        'arrows_border' => array(
                            'type'      	=> 'border',
                            'label' 		=> 'Border',
                            'responsive'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-portfolio-slider-wrapper .tnit-slider-nav,.tnit-slider-arrows .tnit-slider-nav',
                            ),
                        ),
                        'arrows_border_hvr' => array(
                            'type'      	=> 'color',
                            'label' 		=> 'Border Hover',
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-portfolio-slider-wrapper .tnit-slider-nav:hover,.tnit-slider-arrows .tnit-slider-nav:hover',
                                'property'     => 'border-color'
                            ),
                        ),
                    ),
                ),
                'dots_style'       => array(
                    'title'         => 'Navigation Dots Style',
                    'collapsed'     => true,
                    'fields'        => array(
                        'dots_size' => array(
                            'type'         	=> 'unit',
                            'label'        	=> 'Dots Size',
                            'units'	       	=> array( 'px' ),
                            'placeholder'	=> '12',
                            'slider'		=> true,
                            'responsive'    => true,
                        ),
                        'dots_bg_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                        ),
                        'dots_bg_active_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background Active Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                        ),
                        'dots_border' => array(
                            'type'          => 'border',
                            'label' 	    => 'Border',
                        ),
                        'dots_border_active' => array(
                            'type'      => 'border',
                            'label' 	=> 'Border Active',
                        ),
                        'dots_spacing' => array(
                            'type'         	=> 'unit',
                            'label'        	=> 'Space between',
                            'units'	       	=> array( 'px' ),
                            'placeholder'	=> '6',
                            'slider'		=> true,
                            'responsive'    => true,
                            'help'         	=> __( 'This is the space between dots.', 'xpro-bb-addons' ),
                        ),
                        'dots_offset' => array(
                            'type'         	=> 'unit',
                            'label'        	=> 'Dots Offset',
                            'units'	       	=> array( 'px' ),
                            'placeholder'	=> '20',
                            'slider'		=> true,
                            'responsive'    => true,
                            'help'         	=> __( 'Space between dots and slider boundary.', 'xpro-bb-addons' ),
                        ),
                    ),
                ),
            ),
        ),
        'style_tab'      => array(
            'title'         => __( 'Style', 'xpro-bb-addons' ),
            'sections'      => array(
                'portfolio_boxes'       => array(
                    'title'         => 'Portfolio Boxes',
                    'fields'        => array(
                        'portfolio_items_border' 	=> array(
                            'type'       => 'border',
                            'label'      => __( 'Border', 'xpro-bb-addons' ),
                            'responsive' => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-portfolio-wrapper .cbp-item,.tnit-portfolio-slider .item-img,.tnit-slick-slider-full,.tnit-slider-full-half,.tnit-slider-full,.xpro-item-before .owl-item .xpro-item-inner::before',
                            ),
                        ),
                        'content_box_bgcolor' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-slider-innovative .item-content,.tnit-slick-slider-full,.tnit-slider-full-half,.tnit-slider-full',
                                'property'     => 'background-color'
                            ),
                        ),
                        'modern_overaly_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Overaly Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-slider-full .tnit-full-content:before',
                                'property'     => 'background-color'
                            ),
                        ),
                        'item_center_bg' => array(
                            'type'          => 'color',
                            'label'         => __( 'Center Item Before', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-item-before .owl-item .xpro-item-inner:before',
                                'property'     => 'background-color'
                            ),
                        ),
                    ),
                ),
                'overlay_styles'       => array(
                    'title'         => 'Overlay Styles',
                    'collapsed'     => true,
                    'fields'        => array(
                        'overlay_hover_effect'     => array(
                            'type'      => 'select',
                            'label'     => __('Hover Effect', 'xpro-bb-addons'),
                            'default'   => 'zoom',
                            'options'   => array(
                                'fadeIn'	=> __('FadeIn', 'xpro-bb-addons'),
                                'zoom'		=> __('Zoom', 'xpro-bb-addons'),
                                'disable0'	=> __('Zoom Top-Bottom - Pro', 'xpro-bb-addons'),
                                'disable1'	=> __('Zoom Center-Bottom - Pro', 'xpro-bb-addons'),
                                'disable2'	=> __('Zoom Box - Pro', 'xpro-bb-addons'),
                                'disable3'	=> __('Zoom Box Out - Pro', 'xpro-bb-addons'),
                                'disable4'	=> __('Innovative Title - Pro', 'xpro-bb-addons'),
                                'disable5'	=> __('Title Top Bottom - Pro', 'xpro-bb-addons'),
                                'disable6'	=> __('Move Right - Pro', 'xpro-bb-addons'),
                                'disable7'	=> __('Rotate - Pro', 'xpro-bb-addons'),
                                'disable8'	=> __('Push Top - Pro', 'xpro-bb-addons'),
                                'disable9'	=> __('Push Down - Pro', 'xpro-bb-addons'),
                                'disable10'	=> __('Reveal Bottom - Pro', 'xpro-bb-addons'),
                                'disable11'	=> __('Reveal Top - Pro', 'xpro-bb-addons'),
                                'disable12'	=> __('Reveal Left - Pro', 'xpro-bb-addons'),
                                'disable13'	=> __('Minimal - Pro', 'xpro-bb-addons'),
                                'disable14'	=> __('Outside Text - Pro', 'xpro-bb-addons'),
                            ),
                            'toggle'    => array(
                                'zoom-box'     => array(
                                    'fields'   	=> array('overlay_border_style','overlay_border_color','overlay_border_size'),
                                ),
                                'zoom-box-out'     => array(
                                    'fields'   	=> array('overlay_border_style','overlay_border_color','overlay_border_size'),
                                ),
                                'innovative-top-bottom'     => array(
                                    'fields'   	=> array('overlay_border_color','overlay_border_size'),
                                ),
                                'outside-text'     => array(
                                    'fields'   	=> array('overlay_border_color','overlay_border_size','overlay_outside_aligment'),
                                ),
                            ),
                            'help'     => __('This is the overlay appearing effect that is shown when you put the mouse over an item.', 'xpro-bb-addons'),
                        ),
                        'slider_overlay_hvr_effect'     => array(
                            'type'      => 'select',
                            'label'     => __('Hover Effect', 'xpro-bb-addons'),
                            'default'   => 'slide-zoom',
                            'options'   => array(
                                'slide-zoom'			=> __('Zoom', 'xpro-bb-addons'),
                                'slide-zoom-box'		=> __('Zoom Box', 'xpro-bb-addons'),
                                'slide-rotate'			=> __('Rotate', 'xpro-bb-addons'),
                                'slide-right'			=> __('Slide Left', 'xpro-bb-addons'),
                                'slide-left'			=> __('Slide Right', 'xpro-bb-addons'),
                                'slide-fade-top-bottom'			=> __('Fade Bottom', 'xpro-bb-addons'),
                                'slide-fade-top-bottom left'			=> __('Fade Left Bottom', 'xpro-bb-addons'),
                                'outside-text'			=> __('Out Side Text', 'xpro-bb-addons'),
                            ),
                            'toggle'    => array(
                                'slide-zoom-box'     => array(
                                    'fields'   	=> array('overlay_border_style','overlay_border_color','overlay_border_size'),
                                ),
                                'outside-text'     => array(
                                    'fields'   	=> array('overlay_outside_aligment'),
                                ),
                            ),
                            'help'     => __('This is the overlay appearing effect that is shown when you put the mouse over an item.', 'xpro-bb-addons'),
                        ),
                        'overlay_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Overlay Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-portfolio-module .tnit-portfolio-wrapper .cbp-caption-activeWrap,.tnit-portfolio-slider .slide-caption,.cbp-caption-innovative-top-bottom .cbp-caption:hover .cbp-caption-activeWrap,.cbp-caption-innovative-title .cbp-caption:hover .cbp-caption-activeWrap,.tnit-portfolio-slider.slide-fade-bottom .tnit-overlay-content,.tnit-slider-innovative .slide-caption',
                                'property'     => 'background-color'
                            ),
                        ),
                        'overlay_border_style'     => array(
                            'type'      => 'select',
                            'label'     => __('Overlay Border Style', 'xpro-bb-addons'),
                            'default'   => 'solid',
                            'options'   => array(
                                'solid'			=> __('Solid', 'xpro-bb-addons'),
                                'dashed'		=> __('Dashed', 'xpro-bb-addons'),
                                'dotted'		=> __('Dotted', 'xpro-bb-addons'),
                                'double'		=> __('Double', 'xpro-bb-addons'),
                            ),
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.cbp-caption-zoom-box .cbp-caption-activeWrap:after,.cbp-caption-zoom-box-out .cbp-caption-activeWrap:after,.tnit-portfolio-slider.slide-zoom-box .slide-caption:after',
                                        'property'     => 'border-left-style'
                                    ),
                                    array(
                                        'selector'     => '.cbp-caption-zoom-box .cbp-caption-activeWrap:after,.cbp-caption-zoom-box-out .cbp-caption-activeWrap:after,.tnit-portfolio-slider.slide-zoom-box .slide-caption:after',
                                        'property'     => 'border-right-style'
                                    ),
                                    array(
                                        'selector'     => '.cbp-caption-zoom-box .cbp-caption-activeWrap:before,.cbp-caption-zoom-box-out .cbp-caption-activeWrap:before,.tnit-portfolio-slider.slide-zoom-box .slide-caption:before',
                                        'property'     => 'border-top-style'
                                    ),
                                    array(
                                        'selector'     => '.cbp-caption-zoom-box .cbp-caption-activeWrap:before,.cbp-caption-zoom-box-out .cbp-caption-activeWrap:before,.tnit-portfolio-slider.slide-zoom-box .slide-caption:before',
                                        'property'     => 'border-bottom-style'
                                    ),
                                ),
                            ),
                        ),
                        'overlay_border_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Overlay Border Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                        ),
                        'overlay_border_size' => array(
                            'type'        	=> 'unit',
                            'label'       	=> 'Overlay Border Size',
                            'placeholder'   => '1',
                            'units'   		=> array('px'),
                            'slider'   		=> true,
                        ),
                        'overlay_outside_aligment'    => array(
                            'type'        	=> 'align',
                            'label'       	=> __( 'Text Alignment', 'xpro-bb-addons' ),
                            'help' 			=> 'This is outside text horizontal alignment.',
                        ),
                        'overlay_padding' => array(
                            'type'        	=> 'dimension',
                            'label'       	=> 'Padding',
                            'units'   		=> array('px'),
                            'slider'   		=> true,
                            'responsive' => true,
                        ),
                    ),
                ),
                'overlay_icon_style'       => array(
                    'title'         => 'Overlay Icon',
                    'collapsed'     => true,
                    'fields'        => array(
                        'overlay_icon' => array(
                            'type'          => 'icon',
                            'label'         => __( 'Select Icon', 'xpro-bb-addons' ),
                            'show_remove'   => true,
                            'default'		=> 'fas fa-expand-arrows-alt',
                        ),
                        'overlay_icon_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Icon Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-icon i',
                                'property'     => 'color'
                            ),
                        ),
                        'overlay_icon_bg_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-icon i',
                                'property'     => 'background-color'
                            ),
                        ),
                        'overlay_icon_size' => array(
                            'type'        	=> 'unit',
                            'label'       	=> 'Icon Size',
                            'placeholder'   => '20',
                            'units'   		=> array('px'),
                            'slider'   		=> true,
                            'responsive'   	=> true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-icon i',
                                'property'     => 'font-size'
                            ),
                        ),
                        'overlay_icon_bg_size' => array(
                            'type'        	=> 'unit',
                            'label'       	=> 'Background Size',
                            'placeholder'   => '45',
                            'units'   		=> array('px'),
                            'slider'   		=> true,
                            'responsive'   	=> true,
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.tnit-overlay-icon i',
                                        'property'     => 'height'
                                    ),
                                    array(
                                        'selector'     => '.tnit-overlay-icon i',
                                        'property'     => 'line-height'
                                    ),
                                    array(
                                        'selector'     => '.tnit-overlay-icon i',
                                        'property'     => 'width'
                                    ),
                                ),
                            ),
                        ),
                        'overlay_icon_border' => array(
                            'type'       	=> 'border',
                            'label'      	=> __('Border', 'xpro-bb-addons'),
                            'responsive'   	=> true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-icon i',
                            ),
                        ),
                    ),
                ),
                'title_style'       => array(
                    'title'         => 'Title',
                    'collapsed'     => true,
                    'fields'        => array(
                        'enable_title'     => array(
                            'type'      => 'select',
                            'label'     => __('Show Title', 'xpro-bb-addons'),
                            'default'   => 'yes',
                            'options'   => array(
                                'yes'	=> __('Yes', 'xpro-bb-addons'),
                                'no' 	=> __('No', 'xpro-bb-addons'),
                            ),
                            'toggle'    => array(
                                'yes'     => array(
                                    'fields'   	=> array('title_color', 'title_margin_top', 'title_margin_bottom','title_tag','title_typography'),
                                ),
                            ),
                        ),
                        'title_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .title,.tnit-bottom-content .title,.tnit-right-content .title,.tnit-slick-slider-full .title',
                                'property'     => 'color'
                            ),
                        ),
                        'title_tag' => array(
                            'type'          => 'select',
                            'label'         => __( 'HTML Tag', 'xpro-bb-addons' ),
                            'default'       => 'h4',
                            'options'       => array(
                                'h1'    => __( 'H1', 'xpro-bb-addons' ),
                                'h2'    => __( 'H2', 'xpro-bb-addons' ),
                                'h3'    => __( 'H3', 'xpro-bb-addons' ),
                                'h4'    => __( 'H4', 'xpro-bb-addons' ),
                                'h5'    => __( 'H5', 'xpro-bb-addons' ),
                                'h6'    => __( 'H6', 'xpro-bb-addons' ),
                            ),
                        ),
                        'title_typography'    => array(
                            'type'        	=> 'typography',
                            'label'       	=> __( 'Typography', 'xpro-bb-addons' ),
                            'responsive'  	=> true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .title,.tnit-bottom-content .title,.tnit-right-content .title,.tnit-slick-slider-full .title',
                            ),
                        ),
                        'title_margin_top' => array(
                            'type'         	=> 'unit',
                            'label'        	=> 'Margin Top',
                            'units'	       	=> array( 'px' ),
                            'placeholder'	=> '0',
                            'slider'		=> true,
                            'responsive'	=> true,
                            'help'          => __('Adjust space above the title.', 'xpro-bb-addons'),
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .title,.tnit-bottom-content .title,.tnit-right-content .title,.tnit-slick-slider-full .title',
                                'property'     => 'margin-top'
                            ),
                        ),
                        'title_margin_bottom' => array(
                            'type'         	=> 'unit',
                            'label'        	=> 'Margin Bottom',
                            'units'	       	=> array( 'px' ),
                            'placeholder'	=> '0',
                            'slider'		=> true,
                            'responsive'	=> true,
                            'help'          => __('Adjust space below the title.', 'xpro-bb-addons'),
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .title,.tnit-bottom-content .title,.tnit-right-content .title,.tnit-slick-slider-full .title',
                                'property'     => 'margin-bottom'
                            ),
                        ),
                    ),
                ),
                'description_style'       => array(
                    'title'         => 'Description',
                    'collapsed'     => true,
                    'fields'        => array(
                        'enable_description'     => array(
                            'type'      => 'select',
                            'label'     => __('Show Description', 'xpro-bb-addons'),
                            'default'   => 'yes',
                            'options'   => array(
                                'yes'	=> __('Yes', 'xpro-bb-addons'),
                                'no' 	=> __('No', 'xpro-bb-addons'),
                            ),
                            'toggle'    => array(
                                'yes'     => array(
                                    'fields'   	=> array('description_color', 'description_margin_top', 'description_margin_bottom','description_typography'),
                                ),
                            ),
                        ),
                        'description_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .desc,.tnit-bottom-content .desc,.tnit-right-content .desc,.tnit-slick-slider-full .desc',
                                'property'     => 'color'
                            ),
                        ),
                        'description_typography'    => array(
                            'type'        	=> 'typography',
                            'label'       	=> __( 'Typography', 'xpro-bb-addons' ),
                            'responsive'  	=> true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .desc,.tnit-bottom-content .desc,.tnit-right-content .desc,.tnit-slick-slider-full .desc',
                            ),
                        ),
                        'description_margin_top' => array(
                            'type'         	=> 'unit',
                            'label'        	=> 'Margin Top',
                            'units'	       	=> array( 'px' ),
                            'placeholder'	=> '2',
                            'slider'		=> true,
                            'responsive'	=> true,
                            'help'          => __('Adjust space above the description.', 'xpro-bb-addons'),
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .desc,.tnit-bottom-content .desc,.tnit-right-content .desc,.tnit-slick-slider-full .desc',
                                'property'     => 'margin-top'
                            ),
                        ),
                        'description_margin_bottom' => array(
                            'type'         	=> 'unit',
                            'label'        	=> 'Margin Bottom',
                            'units'	       	=> array( 'px' ),
                            'placeholder'	=> '0',
                            'slider'		=> true,
                            'responsive'	=> true,
                            'help'          => __('Adjust space below the description.', 'xpro-bb-addons'),
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .desc,.tnit-bottom-content .desc,.tnit-right-content .desc,.tnit-slick-slider-full .desc',
                                'property'     => 'margin-bottom'
                            ),
                        ),
                    ),
                ),
                'button_style'       => array(
                    'title'         => 'Button',
                    'collapsed'     => true,
                    'fields'        => array(
                        'enable_button'     => array(
                            'type'      => 'select',
                            'label'     => __('Show Button', 'xpro-bb-addons'),
                            'default'   => 'yes',
                            'options'   => array(
                                'yes'	=> __('Yes', 'xpro-bb-addons'),
                                'no' 	=> __('No', 'xpro-bb-addons'),
                            ),
                            'toggle'    => array(
                                'yes'     => array(
                                    'fields'   	=> array('button_text','button_color','button_bg','button_border','button_hover_color','button_hover_bg','button_hover_border','button_padding','button_margin','button_typography'),
                                ),
                            ),
                        ),
                        'button_text' => array(
                            'type'          => 'text',
                            'label'         => __( 'Button Text', 'xpro-bb-addons' ),
                            'default'       => __('Read More', 'xpro-bb-addons'),
                        ),
                        'button_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Text Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .btn,.tnit-bottom-content .btn,.tnit-right-content .btn,.tnit-slick-slider-full .btn',
                                'property'     => 'color'
                            ),
                        ),
                        'button_bg' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .btn,.tnit-bottom-content .btn,.tnit-right-content .btn,.tnit-slick-slider-full .btn',
                                'property'     => 'background-color'
                            ),
                        ),
                        'button_border' => array(
                            'type'          => 'border',
                            'label'         => __( 'Border', 'xpro-bb-addons' ),
                            'responsive'   	=> true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .btn,.tnit-bottom-content .btn,.tnit-right-content .btn,.tnit-slick-slider-full .btn',
                            ),
                        ),
                        'button_hover_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Hover Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .btn:hover,.tnit-bottom-content .btn:hover,.tnit-right-content .btn:hover,.tnit-slick-slider-full .btn:hover',
                                'property'     => 'color'
                            ),
                        ),
                        'button_hover_bg' => array(
                            'type'          => 'color',
                            'label'         => __( 'Hover Background', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .btn:hover,.tnit-bottom-content .btn:hover,.tnit-right-content .btn:hover,.tnit-slick-slider-full .btn:hover',
                                'property'     => 'background-color'
                            ),
                        ),
                        'button_hover_border' => array(
                            'type'          => 'color',
                            'label'         => __( 'Hover Border', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .btn:hover,.tnit-bottom-content .btn:hover,.tnit-right-content .btn:hover,.tnit-slick-slider-full .btn:hover',
                                'property'     => 'border-color'
                            ),
                        ),
                        'button_typography'    => array(
                            'type'        	=> 'typography',
                            'label'       	=> __( 'Typography', 'xpro-bb-addons' ),
                            'responsive'  	=> true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .btn,.tnit-bottom-content .btn,.tnit-right-content .btn,.tnit-slick-slider-full .btn',
                            ),
                        ),
                        'button_padding' => array(
                            'type'         	=> 'dimension',
                            'label'         => __( 'Padding', 'xpro-bb-addons' ),
                            'units'	       	=> array( 'px' ),
                            'slider'		=> true,
                            'responsive'	=> true,
                            'help'          => __('Adjust space inside the button.', 'xpro-bb-addons'),
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .btn,.tnit-bottom-content .btn,.tnit-right-content .btn,.tnit-slick-slider-full .btn',
                                'property'     => 'padding'
                            ),
                        ),
                        'button_margin' => array(
                            'type'         	=> 'dimension',
                            'label'         => __( 'Margin', 'xpro-bb-addons' ),
                            'units'	       	=> array( 'px' ),
                            'slider'		=> true,
                            'responsive'	=> true,
                            'help'          => __('Adjust space outside the button.', 'xpro-bb-addons'),
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-overlay-content .btn,.tnit-bottom-content .btn,.tnit-right-content .btn,.tnit-slick-slider-full .btn',
                                'property'     => 'margin'
                            ),
                        ),
                    ),
                ),
                'menu_style'       => array(
                    'title'         => 'Menu',
                    'collapsed'     => true,
                    'fields'        => array(
                        'menu_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Menu Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                        ),
                        'menu_hcolor' => array(
                            'type'          => 'color',
                            'label'         => __( 'Menu Hover Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                        ),
                        'menu_typography'    => array(
                            'type'        	=> 'typography',
                            'label'       	=> __( 'Typography', 'xpro-bb-addons' ),
                            'responsive'  	=> true,
                        ),
                        'space_between' => array(
                            'type'         	=> 'unit',
                            'label'         => __( 'Space Between', 'xpro-bb-addons' ),
                            'units'	       	=> array( 'px' ),
                            'slider'		=> true,
                            'responsive'	=> true,
                            'help'          => __('Adjust space between menus.', 'xpro-bb-addons'),
                        ),
                    ),
                ),
            ),
        ),
        'preview_tab'      => array(
            'title'         => __( 'Preview', 'xpro-bb-addons' ), // Tab title
            'sections'      => array( // Tab Sections
                'general'       => array( // Section
                    'title'         => '', // Section Title
                    'fields'        => array( // Section Fields
                        'preview_overlay_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Preview Overlay Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'help'    		=> 'Preview animated overlay Color.',
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.tnit-portfolio-loader li',
                                'property'     => 'background-color'
                            ),
                        ),
                        'preview_background_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Preview Background Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'help'    		=> 'Preview background Color.',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.xpro-preview',
                                        'property'     => 'background-color'
                                    ),
                                ),
                            ),
                        ),
                        'preview_background_outline' => array(
                            'type'          => 'color',
                            'label'         => __( 'Preview Outlines', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'help'    		=> 'Preview borders/outlines Color.',
                            'preview'       => array(
                                'type'          => 'css',
                                'rules'           => array(
                                    array(
                                        'selector'     => '.xpro-preview .xpro-preview-header, .xpro-preview-arrow, .xpro-preview-demo-name, .xpro-preview-close',
                                        'property'     => 'border-color'
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                'close_btn'       => array( // Section
                    'title'         => 'Close Button', // Section Title
                    'collapsed'     => true,
                    'fields'        => array( // Section Fields
                        'close_icon_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Icon Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-close',
                                'property'     => 'color'
                            ),
                        ),
                        'close_icon_hcolor' => array(
                            'type'          => 'color',
                            'label'         => __( 'Icon Hover Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-close:hover',
                                'property'     => 'color'
                            ),
                        ),
                        'close_icon_bgcolor' => array(
                            'type'          => 'color',
                            'label'         => __( 'Icon Background', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-close',
                                'property'     => 'background-color'
                            ),
                        ),
                        'close_icon_hbgcolor' => array(
                            'type'          => 'color',
                            'label'         => __( 'Icon Hover Background', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-close:hover',
                                'property'     => 'background-color'
                            ),
                        ),
                        'close_icon_bdr_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Icon Border Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-close',
                                'property'     => 'border-color'
                            ),
                        ),
                        'close_icon_hbdr_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Icon Hover Border', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-close:hover',
                                'property'     => 'border-color'
                            ),
                        ),
                    ),
                ),
                'navigation_btn'       => array( // Section
                    'title'         => 'Next/Prev Button', // Section Title
                    'collapsed'     => true,
                    'fields'        => array( // Section Fields
                        'preview_nav_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-prev-demo,.xpro-preview-next-demo',
                                'property'     => 'color'
                            ),
                        ),
                        'preview_nav_hcolor' => array(
                            'type'          => 'color',
                            'label'         => __( 'Hover Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-prev-demo:hover,.xpro-preview-next-demo:hover',
                                'property'     => 'color'
                            ),
                        ),
                        'preview_nav_bgcolor' => array(
                            'type'          => 'color',
                            'label'         => __( 'Background', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-prev-demo,.xpro-preview-next-demo',
                                'property'     => 'background-color'
                            ),
                        ),
                        'preview_nav_hbgcolor' => array(
                            'type'          => 'color',
                            'label'         => __( 'Hover Background', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-prev-demo:hover,.xpro-preview-next-demo:hover',
                                'property'     => 'background-color'
                            ),
                        ),
                        'preview_nav_bdr_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Border Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-prev-demo,.xpro-preview-next-demo',
                                'property'     => 'border-color'
                            ),
                        ),
                        'preview_nav_hbdr_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Hover Border', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-prev-demo:hover,.xpro-preview-next-demo:hover',
                                'property'     => 'border-color'
                            ),
                        ),
                        'preview_nav_typography'    => array(
                            'type'        	=> 'typography',
                            'label'       	=> __( 'Typography', 'xpro-bb-addons' ),
                            'responsive'  	=> true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-prev-demo,.xpro-preview-next-demo',
                            ),
                        ),
                    ),
                ),
                'preview_title'       => array( // Section
                    'title'         => 'Preview Title', // Section Title
                    'collapsed'     => true,
                    'fields'        => array( // Section Fields
                        'preview_title_color' => array(
                            'type'          => 'color',
                            'label'         => __( 'Color', 'xpro-bb-addons' ),
                            'show_reset'    => true,
                            'show_alpha'    => true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-demo-name',
                                'property'     => 'color'
                            ),
                        ),
                        'preview_title_typography'    => array(
                            'type'        	=> 'typography',
                            'label'       	=> __( 'Typography', 'xpro-bb-addons' ),
                            'responsive'  	=> true,
                            'preview'       => array(
                                'type'          => 'css',
                                'selector'     => '.xpro-preview-demo-name',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ) );

    /**
     * Register a settings form to use in the "form" field type above.
     */
    FLBuilder::register_settings_form('portfolio_form', array(
        'title' => __('Add Photo Group', 'xpro-bb-addons'),
        'tabs'  => array(
            'general_tab'      => array(
                'title'         => __('General', 'xpro-bb-addons'),
                'sections'      => array(
                    'general'       => array(
                        'title'         => '',
                        'fields'        => array(
                            'multi_filter_category' => array(
                                'type'          => 'select',
                                'label'         => __( 'Category Name', 'xpro-bb-addons' ),
                                'multi-select'  => true,
                                'class'			=> 'tnit-filter-cat',
                                'help'   		=> 'Mention the name of the filter you want to show',
                            ),
                        ),
                    ),
                    'media'       => array(
                        'title'         => 'Media',
                        'fields'        => array(
                            'portfolio_title'         => array(
                                'type'          => 'text',
                                'label'         => __('Title', 'xpro-bb-addons'),
                                'default'     	=> __('Portfolio Title', 'xpro-bb-addons'),
                                'help'   		=> 'Mention the title of the portfolio item',
                            ),
                            'description' => array(
                                'type'          => 'textarea',
                                'label'         => __( 'Description', 'xpro-bb-addons' ),
                                'rows'          => '3',
                                'help'   		=> 'Description of the portfolio album item',
                            ),
                            'featured_img'       => array(
                                'type'      	=> 'photo',
                                'label'     	=> __('Featured Image', 'xpro-bb-addons'),
                                'show_remove'   => true,
                                'help'   		=> 'Add the featured image for instant view.',
                            ),
                        ),
                    ),
                    'link'       => array(
                        'title'         => 'Preview Link',
                        'fields'        => array(
                            'preview_link' => array(
                                'type'          => 'link',
                                'label'         => __( 'Preview Link', 'xpro-bb-addons' ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ));

}