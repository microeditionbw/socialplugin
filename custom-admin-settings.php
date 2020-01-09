<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the
 * plugin admin area. This file also defines a function that starts the plugin.
 *
 * @link              
 * @since             1.0.0
 * @package           V2B
 *
 * @wordpress-plugin
 * Plugin Name:       Поделиться (Share) V2B
 * Plugin URI:        
 * Description:       Поделиться ссылкой на ваши страницы
 * Version:           1.0.0
 * Author:            Valeriy2B
 * Author URI:        https://vk.com/float999
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
     die;
}
define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
// Include the shared and public dependencies.
include_once( plugin_dir_path( __FILE__ ) . 'shared/class-deserializer.php' );
include_once( plugin_dir_path( __FILE__ ) . 'public/class-content-messenger.php' );

// Include the dependencies needed to instantiate the plugin.
foreach ( glob( plugin_dir_path( __FILE__ ) . 'admin/*.php' ) as $file ) {
    include_once $file;
}

add_action( 'plugins_loaded', 'tutsplus_custom_admin_settings' );
/**
 * Starts the plugin.
 *
 * @since 1.0.0
 */
function tutsplus_custom_admin_settings() {

    $serializer = new Serializer();
    $serializer->init();
 
    $deserializer = new Deserializer();
 
    $plugin = new Submenu( new Submenu_Page( $deserializer ) );
    $plugin->init();
 
     // Setup the public facing functionality.
    $public = new Content_Messenger( $deserializer );
    $public->init();
}

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'salcode_add_plugin_page_settings_link');
function salcode_add_plugin_page_settings_link( $links ) {
    $links[] = '<a href="' .
        admin_url( 'options-general.php?page=custom-admin-page' ) .
        '">' . __('Settings') . '</a>';
    return $links;
}
