<?php

/*
Plugin Name: Ws Bootstrap VC
Plugin URI: http://wplagoo.com/ws-bootstrap-vc
Description: Add Bootstrap to your Wordpress, plugin add great shortcodes which you can use to create Jumbotron, Popover, Cards, Modals etc.
Author: Wojciech Skrzek
Author URI: http://wplagoo.com/
Version: 1.0.2
Text Domain: ws-bootstrap-vc
*/

if ( function_exists( 'wbv_fs' ) ) {
    wbv_fs()->set_basename( false, __FILE__ );
} else {
    
    if ( !function_exists( 'wbv_fs' ) ) {
        // Create a helper function for easy SDK access.
        function wbv_fs()
        {
            global  $wbv_fs ;
            
            if ( !isset( $wbv_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $wbv_fs = fs_dynamic_init( array(
                    'id'             => '4236',
                    'slug'           => 'ws-bootstrap-vc',
                    'type'           => 'plugin',
                    'public_key'     => 'pk_576ffebbd31fae01b1376f51b8f94',
                    'is_premium'     => false,
                    'premium_suffix' => 'Premium',
                    'has_addons'     => false,
                    'has_paid_plans' => true,
                    'trial'          => array(
                    'days'               => 7,
                    'is_require_payment' => false,
                ),
                    'menu'           => array(
                    'slug'    => 'ws-bootstrap-vc',
                    'support' => false,
                ),
                    'is_live'        => true,
                ) );
            }
            
            return $wbv_fs;
        }
        
        // Init Freemius.
        wbv_fs();
        // Signal that SDK was initiated.
        do_action( 'wbv_fs_loaded' );
    }
    
    // ... Freemius integration snippet ...
}

if ( !class_exists( 'Ws_Bootstrap_Vc' ) ) {
    class Ws_Bootstrap_Vc
    {
        /** @var Ws_Bootstrap_Vc $instance */
        public static  $instance ;
        /** @var string $slug Contains plugin text domain */
        public static  $slug = 'ws-bootstrap-vc' ;
        /** @var string $plugin_path Path to plugin directory */
        public static  $plugin_path = '' ;
        /** @var string $plugin_url URL address to plugin directory */
        public static  $plugin_url = '' ;
        /**
         * Ws_Bootstrap_Vc constructor.
         */
        public function __construct()
        {
            self::$instance = $this;
            if ( empty(self::$plugin_path) ) {
                self::$plugin_path = plugin_dir_path( __FILE__ );
            }
            if ( empty(self::$plugin_url) ) {
                self::$plugin_url = plugin_dir_url( __FILE__ );
            }
            require_once 'admin/admin.php';
            require_once 'lib/shortcodes/Shortcodes_Class.php';
            /* Registers */
            add_action( 'plugins_loaded', array( $this, 'init' ), 100 );
            /* Info */
            add_action( 'admin_notices', array( $this, 'ws_bootstrap_trial_info' ) );
        }
        
        /**
         * Perform an initialization
         */
        function init()
        {
            /* Registers */
            add_action( 'wp_enqueue_scripts', array( $this, 'registerScripts' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'adminRegisterScripts' ) );
            /* Shortcodes */
            Ws_Bootstrap_Vc_Shortcodes::instance();
        }
        
        /**
         * Create and return instance
         *
         * @return Ws_Bootstrap_Vc
         */
        public static function instance()
        {
            if ( self::$instance === null ) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        
        /**
         * Register Front End scripts and styles
         */
        function registerScripts()
        {
            wp_enqueue_style(
                self::$slug,
                self::$plugin_url . 'ws-bootstrap-vc.css',
                array(),
                null
            );
            wp_enqueue_script(
                'boostrap',
                self::$plugin_url . 'lib/bootstrap/js/bootstrap.min.js',
                array( 'jquery' ),
                null,
                true
            );
            wp_enqueue_script( 'popper', self::$plugin_url . 'lib/bootstrap/js/popper.min.js' );
            wp_enqueue_style(
                'bootstrap-style',
                self::$plugin_url . 'lib/bootstrap/css/bootstrap.min.css',
                array(),
                null
            );
            wp_enqueue_script(
                self::$slug,
                self::$plugin_url . 'ws-bootstrap-vc.js',
                array( 'jquery' ),
                null,
                true
            );
        }
        
        function adminRegisterScripts()
        {
            wp_enqueue_style(
                'admin-style',
                self::$plugin_url . 'admin/assets/style.css',
                array(),
                null
            );
        }
        
        function ws_bootstrap_trial_info()
        {
            ob_start();
            ?>
			<div style="padding: 1rem;" class="notice notice-info is-dismissible">
				<p>Hey! How do you like <strong>WS BOOTSTRAP</strong> Plugin so far? Test all our awesome premium features with a 7-day free trial. No credit card required!</p>
				<a href="https://checkout.freemius.com/mode/dialog/plugin/4236/plan/6881/?trial=free" target="_blank" class="button button-primary"><?php 
            echo  __( 'Start Free Trial! ->', 'ws-bootstrap-vc' ) ;
            ?></a>
			</div>
			<?php 
            ob_end_flush();
        }
    
    }
}
Ws_Bootstrap_Vc::instance();