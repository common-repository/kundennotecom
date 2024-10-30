<?php
/*
 * Plugin Name: Kundennote.com Bewertungssiegel
 * Plugin URI: https://kundennote.com
 * Description: Fügen Sie Ihr kundennote.com Bewertungssiegel über Shortcode oder Widget ein.
 * Version: 3.1.6
 * Author: Bewertungsportal kundennote.com
 * Author URI: https://kundennote.com
 * License: GPLv2 or later
 */

define( 'KUNDENNOTE_VERSION', '3.1.6' );
define( 'KUNDENNOTE_FILE', __FILE__ ); // this file 
define( 'KUNDENNOTE_BASENAME', plugin_basename( KUNDENNOTE_FILE ) ); // plugin name as known by WP 
define( 'KUNDENNOTE_DIR', dirname( KUNDENNOTE_FILE ) ); // our directory 
define( 'KUNDENNOTE_URL', 'https://kundennote.com/app/' ); // our directory 


function getCurrentLang(){
	$currentLang=get_bloginfo('language');
	$knURL=KUNDENNOTE_URL.'en/';
	if($currentLang=='de' || $currentLang=='de-DE'){
		$knURL=KUNDENNOTE_URL.'';
	}
	return $knURL;
}



require_once( plugin_dir_path( __FILE__ ) . 'kundennote_options.php' );
require_once( plugin_dir_path( __FILE__ ) . 'kundennote_shortcode.php' );
require_once( plugin_dir_path( __FILE__ ) . 'kundennote_widget.php' );
require_once( plugin_dir_path( __FILE__ ) . 'kundennote_aiopro_widget.php' );

?>