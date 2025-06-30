<?php

namespace PolylangRestapiHelper\ATA;

function str($text, $domain = ATAConfig::TEXT_DOMAIN)
{
    return _e($text, $domain);
}

function files_in($folder)
{

    if ($handle = opendir($folder)) {
        while (false !== ($entry = readdir($handle))) {
            if (strpos($entry, '.php') !== false) $files[] = $folder . $entry;
        }
        closedir($handle);
    }
    return $files;
}

function current_tab()
{
    $default_tab = null;
    return isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
}
