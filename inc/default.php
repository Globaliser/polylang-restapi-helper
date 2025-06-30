<?php

namespace PolylangRestapiHelper;

// If this file is called directly, abort. //
if (!defined('WPINC')) die;

// Configs
require_once PLUGIN_PATH . '/config/plugin-config.php';

// APP Base Classes
require_once PLUGIN_PATH . '/base/core-base.php';
require_once PLUGIN_PATH . '/base/controller-base.php';
require_once PLUGIN_PATH . '/base/model-base.php';
require_once PLUGIN_PATH . '/base/api-base.php';


// Constants
require_once PLUGIN_PATH . '/constants/general.php';


// Helpers
require_once PLUGIN_PATH . '/app/helpers/general-helper.php';
