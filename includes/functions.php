<?php
// if accessed directly than exit
if (!defined('ABSPATH')) exit;

/* ************************************* --- WHERE TO GO --- **************************************** */

if (!function_exists('get_template_part')):
    function get_template_part($template_prefix = NULL, $folder_name = NULL, $args = array())
    {
        global $dbh, $helper;
        if ($template_prefix == NULL)
            return;
        if (!empty($args))
            extract($args);

        if ($folder_name == NULL)
            require ABSPATH . 'templates/' . $template_prefix . '-template.php';
        else
            require ABSPATH . 'templates/' . $folder_name . '/' . $template_prefix . '-template.php';
    }
endif;

/* ************************************* --- STRIPSLASHES --- **************************************** */

if (!function_exists('_e')):
    function _e($text)
    {
        echo stripslashes($text);
    }
endif;

if (!function_exists('__')):
    function __($text)
    {
        return stripslashes($text); // Show html codes from database into html through this function
    }
endif;
