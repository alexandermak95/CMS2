<?php
/*
	Plugin Name: CMS 2 Labb 1 Cookie Notice
	Author: Alexander Maktabi
	Version: 1.00
	Description: A plugin to show a cookie banner
*/
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function activate_cookie_banner() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cookie-banner-activator.php';
	Cookie_Banner_Activator::activate();
}

function deactivate_cookie_banner() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cookie-banner-deactivator.php';
	Cookie_Banner_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cookie_banner' );
register_deactivation_hook( __FILE__, 'deactivate_cookie_banner' );

require plugin_dir_path( __FILE__ ) . 'includes/class-cookie-banner.php';

function run_cookie_banner() {

	$plugin = new Cookie_Banner();
	$plugin->run();

}
run_cookie_banner();
