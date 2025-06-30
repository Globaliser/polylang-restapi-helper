<?php

// Autoloader defined at Global level but works for the plugin namespace

spl_autoload_register(function ($class) {

    //  Autoload only classes inside the plugin namespace
    if (strpos($class, PolylangRestapiHelper\ATA\ATAConfig::$plugin_namespace) !== false) :

        $class_types = ['Controller', 'Model', 'Service', 'Api'];

        foreach ($class_types as $type) :

            if (strpos($class, $type)) :

                include_once PolylangRestapiHelper\ATA\ATAConfig::$plugin_path .
                    '/app/' .
                    strtolower($type) .
                    's/' .
                    strtolower(str_replace(
                        PolylangRestapiHelper\ATA\ATAConfig::$plugin_namespace . '\\',
                        '',
                        str_replace($type, '', $class)
                    )) .
                    '-' .
                    strtolower($type) . '.php';

                return true;

            endif;

        endforeach;

    endif;

    return false;
});
