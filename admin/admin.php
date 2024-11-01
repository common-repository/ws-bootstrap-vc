<?php

require_once( 'Admin_Page_Class.php' );

add_action( 'admin_menu', array( 'Ws_Bootstrap_Vc_Admin_Page', 'createAdminMenu' ) );
add_action( 'admin_init', array( 'Ws_Bootstrap_Vc_Register_Setting', 'wsRegisterSettings' ) );