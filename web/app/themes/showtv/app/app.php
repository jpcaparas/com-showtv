<?php

defined("SHOWTV_PATH") OR define("SHOWTV_PATH", dirname(__FILE__));
defined("SHOWTV_URI") OR define("SHOWTV_URI", get_template_directory_uri() . '/app');
defined("SHOWTV_ASSETS_URI") OR define("SHOWTV_ASSETS_URI", get_template_directory_uri() . '/app/assets');

// Load vendor libraries
if (file_exists(SHOWTV_PATH . '/vendor/cmb2/init.php')) {
  require_once SHOWTV_PATH . '/vendor/cmb2/init.php';
} elseif (file_exists(SHOWTV_PATH . '/vendor/CMB2/init.php')) {
  require_once SHOWTV_PATH . '/vendor/CMB2/init.php';
}

// Load app includes
include_once(SHOWTV_PATH . '/includes/helpers/pagination.php');
include_once(SHOWTV_PATH . '/class-showtv-autoloader.php');

// Hooks
ShowTV_Hook_Action_WebFonts::get_instance();
ShowTV_Hook_Filter_TV_Show_Content::get_instance();
ShowTV_Hook_Action_Search::get_instance();

// Virtual pages
ShowTV_Virtual_Page_Home_Page::get_instance();
ShowTV_Virtual_Page_TV_Show::get_instance();

// Meta boxes
ShowTV_Meta_Box::get_instance();
ShowTV_Meta_Box_TMDB::get_instance();
ShowTV_Meta_Box_YouTube::get_instance();
