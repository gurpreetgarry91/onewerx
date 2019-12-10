<?php
/*
Plugin Name: PWP-Lytebox
Plugin URI: http://p-api-shop.ru
Description: The fast and simple way to make all links pointing to images open in popup modal window. 
Version: 1.3.2
Author: Polkan
Author URI: http://pwpcode.ru
License: GPL2 or later
*/

// don't call file directly
if ( !defined( 'ABSPATH' ) ) 
    exit;

define('PWPL_MAIN_FILE', plugin_basename( __FILE__ ));

require_once( dirname( __FILE__ ) . '/main.php' );

$pwplytebox = new PWP_Lytebox;
