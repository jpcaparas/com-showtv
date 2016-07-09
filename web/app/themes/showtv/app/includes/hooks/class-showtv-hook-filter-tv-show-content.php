<?php

/**
 * Class ShowTV_Hook_Filter_TV_Show_Content
 */
class ShowTV_Hook_Filter_TV_Show_Content
{
  private static $instance = null;

  /**
   * ShowTV_Hook_Filter_TV_Show_Content constructor.
   *
   * @return null|ShowTV_Hook_Filter_TV_Show_Content
   */
  public static function get_instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new ShowTV_Hook_Filter_TV_Show_Content();
    }

    return self::$instance;
  }

  public function __construct()
  {
    $this->filters();
  }

  public function filters()
  {
    add_filter('showtv_show_overview', array($this, 'filter_showtv_show_overview'), 10, 2);
  }

  public function filter_showtv_show_overview($str, $default_text = null)
  {
    $max_length = 250;
    $str = trim($str);

    $default_text = is_null($default_text) ? 'There is no overview available for this TV show at the moment.' : $default_text;
    $str = $str === '' ? $default_text : $str;

    if (strlen($str) > $max_length) {
      $str = substr($str, 0, $max_length) . '...';
    }

    return apply_filters('the_excerpt', $str);
  }
}