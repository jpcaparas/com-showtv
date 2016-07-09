<?php

class ShowTV_Virtual_Page_TV_Show
{
  protected $slug_pattern = '';
  protected $cache_key = 'tv_shows';
  private static $instance = null;

  public function __construct()
  {
    $this->template_file = 'template-show.php';
    $this->hooks();
  }

  public function hooks()
  {
    add_action('init', array($this, 'register_tv_show_page'));
    add_action('after_theme_setup', array($this, 'flush_data'));
    add_action('after_switch_theme', array($this, 'flush_data'));
    add_action('save_options', array($this, 'flush_data'));
    add_filter('template_include', array($this, 'display_tv_show_page'));
  }

  public function flush_data()
  {
    flush_rewrite_rules();
    $this->flush_tv_show_cache();
  }

  protected function flush_tv_show_cache()
  {
    wp_cache_delete($this->cache_key);
  }

  public function register_tv_show_page()
  {
    add_rewrite_rule('^show/([0-9]+)/?', 'index.php?show_id=$matches[1]', 'top');
    add_rewrite_tag('%show_id%', '([0-9]+)');
  }

  /**
   * @return string
   */
  public function display_tv_show_page($template)
  {
    /**
     * @type WP_Query $wp_query
     */
    global $wp_query;

    $show_id = !empty($wp_query->query_vars['show_id']) ? $wp_query->query_vars['show_id'] : null;

    if ($show_id != '') {
      try {
        $cache = wp_cache_get($show_id);

        if (!is_array($cache)) {
          $cache = array();
        }

        if (isset($cache[$show_id])) {
          $show_data = $cache[$show_id];
        } else {
          $show_obj = new ShowTV_API_TMDB_TV_Show;
          $show_data = $show_obj->get($show_id);
          $cache[$show_id] = $show_data;
          wp_cache_set($this->cache_key, $cache);
        }
      } catch (\Tmdb\Exception\TmdbApiException $e) {
        error_log($e);
        wp_redirect(home_url());
        exit;
      }

      $new_template = locate_template(array($this->template_file));

      if ($new_template != '') {
        /**
         * Add ShowTV config
         */
        $wp_query->set('showtv_config', get_option('showtv', array()));

        /**
         * Add TMDB data
         */
        $wp_query->set('tmdb_show_data', $show_data);
        $show_config = new ShowTV_API_TMDB_TV_Config();
        $wp_query->set('tmdb_config', $show_config->get_configuration());

        /**
         * Add YouTube data
         */
        $youtube_client = new ShowTV_API_Youtube();
        $youtube_trailers = $youtube_client->search($show_data['name']);
        $youtube_trailers = $youtube_trailers ? array_slice($youtube_trailers, 0, 6) : array();
        $wp_query->set('youtube_trailers', $youtube_trailers);

        add_filter('body_class', array($this, 'set_body_class'));

        return $new_template;
      }
    }

    return $template;
  }

  /**
   * Sets the body class
   *
   * @param array $classes
   * @return array
   */
  public function set_body_class($classes = array())
  {
    $classes[] = 'page-tv-show';

    return $classes;
  }

  /**
   * @return null|ShowTV_Virtual_Page_TV_Show
   */
  public static function get_instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new ShowTV_Virtual_Page_TV_Show;
    }

    return self::$instance;
  }
}