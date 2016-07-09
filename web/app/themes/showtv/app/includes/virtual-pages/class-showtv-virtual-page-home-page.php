<?php

class ShowTV_Virtual_Page_Home_Page
{
  private static $instance = null;

  public function __construct()
  {
    $this->template_file = 'template-home.php';
    $this->hooks();
  }

  public function hooks()
  {
    add_filter('template_include', array($this, 'display_page'));
  }

  public function display_page($template)
  {
    if (is_front_page()) {
      add_filter('body_class', array($this, 'set_body_class'));
      $template = locate_template(array($this->template_file));
    }

    return $template;
  }

  /**
   * @return null|ShowTV_Virtual_Page_Home_Page
   */
  public static function get_instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new ShowTV_Virtual_Page_Home_Page;
    }

    return self::$instance;
  }

  /**
   * Sets the body class
   *
   * @param array $classes
   * @return array
   */
  public function set_body_class($classes = array())
  {
    $classes[] = 'page-home';

    return $classes;
  }
}