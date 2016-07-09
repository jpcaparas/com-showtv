<?php

/**
 * Hooks web fonts
 *
 * Class ShowTV_Hook_WebFonts
 */
class ShowTV_Hook_Action_WebFonts
{
  /**
   * @return null|ShowTV_Hook_Action_WebFonts
   */
  private static $instance = null;

  public static function get_instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new ShowTV_Hook_Action_WebFonts();
    }

    return self::$instance;
  }

  public function __construct()
  {
    $this->hooks();
  }

  public function hooks()
  {
    // Fonts should have higher priorities
    $priority = 1;

    add_action('wp_enqueue_scripts', array($this, 'queue_fontawesome'), $priority);
    add_action('wp_enqueue_scripts', array($this, 'queue_google_fonts'), $priority);
  }

  public function queue_fontawesome()
  {
    $handle = 'fontawesome';
    $src = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css';
    wp_enqueue_style($handle, $src);
  }

  public function queue_google_fonts()
  {
    $fonts = array(
      array(
        'handle' => 'passion-one',
        'src' => 'https://fonts.googleapis.com/css?family=Passion+One:400,700,900'
      ),
      array(
        'handle' => 'source-sans-pro',
        'src' => 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300'
      )
    );

    foreach ($fonts as $font) {
      wp_enqueue_style($font['handle'], $font['src']);
    }
  }
}