<?php

require_once 'Register_Settings_Class.php';
require_once 'Subadmin_Page_Class.php';
class Ws_Bootstrap_Vc_Admin_Page
{
    public static function createAdminMenu()
    {
        add_menu_page(
            __( 'WS Bootstrap', 'ws-bootstrap-vc' ),
            'WS Bootstrap',
            'manage_options',
            'ws-bootstrap-vc',
            array( 'Ws_Bootstrap_Vc_Admin_Page', 'adminMenuCallback' ),
            'dashicons-admin-plugins',
            99
        );
    }
    
    public static function adminMenuCallback()
    {
        include plugin_dir_path( __FILE__ ) . '/pages/admin-page.php';
    }

}