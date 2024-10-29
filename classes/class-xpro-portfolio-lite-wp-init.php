<?php
/**
 * A class that handles loading custom modules and custom
 * fields if the builder is installed and activated.
 */
if( !class_exists( "Xpro_Portfolio_Lite_For_WP_Init" ) ) {
    class Xpro_Portfolio_Lite_For_WP_Init
    {

        /**
         * Initializes the class once all plugins have loaded.
         */
        static public function init()
        {

            self::includes();

            add_action('init', __CLASS__ . '::load_modules');
        }

        /**
         * Loads our custom modules.
         */
        public static function load_modules()
        {
            require_once XPRO_PORTFOLIO_FOR_BB_LITE_DIR . 'modules/tnit-portfolio/tnit-portfolio.php';
        }

        static public function includes()
        {
            require_once XPRO_PORTFOLIO_FOR_BB_LITE_DIR . 'classes/class-xpro-plugins-helper.php';
        }
    }
}
Xpro_Portfolio_Lite_For_WP_Init::init();
