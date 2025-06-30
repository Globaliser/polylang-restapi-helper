<?php
/*
   Plugin Name: Polylang RestAPI Helper
   Plugin URI: https://www.globaliser.com/wordpress-hosting/
   Description:  Polylang Plugin Wordpress RestAPI extender.
   Version: 1.0.0
   Author: PolylangRestapiHelper, Inc.
   Author URI: https://www.globaliser.com
   License: GPL2
*/

namespace PolylangRestapiHelper;

use \WP_Query;

// If this file is called directly, abort. //
if (!defined('WPINC')) die;

// Constants
define('PolylangRestapiHelper\PLUGIN_FILE', __FILE__);
define('PolylangRestapiHelper\PLUGIN_PATH', plugin_dir_path(PLUGIN_FILE));
define('PolylangRestapiHelper\PLUGIN_VER', get_file_data(PLUGIN_FILE, ['Version' => 'Version'], 'plugin')['Version']);

require_once  PLUGIN_PATH . '/inc/main.php';

// Init Controller
$globaliser = new PolylangRestapiHelperController();

// Activate Plugin
register_activation_hook(PLUGIN_FILE, [$globaliser, 'activate']);

// Deactivate Plugin
register_deactivation_hook(PLUGIN_FILE, [$globaliser, 'deactivate']);
