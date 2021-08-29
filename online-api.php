<?php
/*
Plugin Name: ONLINE-API
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Im working on Plugin for get api from other website
Author: shayan khorshidfard
Text Domain: Online-api
Domain Path:/languages/
Version: 1.0.0
Author URI: git@github.com:madavemger/online-api.git
*/
define('WP_APIS_DIR', plugin_dir_path(__FILE__)); //name and cap
define('WP_APIS_URL', plugin_dir_url(__FILE__)); //name and cap
define('WP_APIS_INC', WP_APIS_DIR . '/inc/'); //name and cap
define('WP_APIS_TPL', WP_APIS_DIR . '/tpl/'); //name and cap

register_activation_hook(__FILE__, 'simple_plugin_activation');
register_deactivation_hook(__FILE__, 'simple_plugin_deactivation');

function simple_plugin_activation()
{

}

function simple_plugin_deactivation()
{

}

if (is_admin())
{
    include WP_APIS_INC. 'admin/menus.php';
    include WP_APIS_INC. 'admin/mtaboxes.php';
}
include WP_APIS_INC. 'ajax.php';