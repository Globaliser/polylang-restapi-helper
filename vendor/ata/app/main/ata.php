<?php

namespace PolylangRestapiHelper\ATA;

use \load_plugin_textdomain;

class Ata extends Core
{

  public function __construct()
  {
    parent::__construct();
    $this->on('init', 'load_language_translations');
    $this->on('plugins_loaded', 'load_routes');
  }

  public static function load_language_translations()
  {
    load_plugin_textdomain(ATAConfig::TEXT_DOMAIN, false, ATAConfig::$plugin_folder . '/vendor/ata/languages');
  }

  public function load_routes()
  {
    $ata_router = new Router();

    $routes_dir = ATAConfig::$plugin_path . "/app/routes/";

    if (is_dir($routes_dir) && count(files_in($routes_dir))) :

      foreach (files_in($routes_dir) as $file) require_once $file;

      $ata_router->init();
    endif;
  }
}
