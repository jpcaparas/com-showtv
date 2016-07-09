<?php

class ShowTV_Hook_Action_Search
{
  /**
   * @var array
   */
  public $tv_shows = array();

  private $post_count = false;
  private $tv_show_post_count = false;
  private $search_string_has_value = false;

  private static $instance = null;

  public function __construct()
  {
    add_action('pre_get_posts', array($this, 'check_regular_search_results'));
    add_action('pre_get_posts', array($this, 'check_tmdb_search_results'));
  }

  /**
   * @return false|ShowTV_Hook_Action_Search
   */
  public static function get_instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new ShowTV_Hook_Action_Search;
    }

    return self::$instance;
  }

  /**
   * @param WP_Query $query
   */
  public function check_regular_search_results($query)
  {
    if ($query->is_search() && $query->is_main_query()) {
      $this->post_count = $query->post_count;
    }
  }

  /**
   * @param WP_Query $query
   */
  public function check_tmdb_search_results($query)
  {
    if ($query->is_search() && $query->is_main_query()) {
      $search_string = trim($query->query['s']);

      if (!strlen($search_string)) {
        $this->search_string_has_value = false;
        return;
      }

      $this->search_string_has_value = true;

      $api_key = showtv_get_option('api_key');
      $tmdb_search = new ShowTV_API_TMDB_Search($api_key);

      $page = !empty($_GET['tv_results_page']) && $_GET['tv_results_page'] > 0 ? abs(intval($_GET['tv_results_page'])) : 1;
      $this->tv_shows = $tmdb_search->search_tv(
        $query->query['s'],
        array(
          'page' => $page
        )
      );

      $this->tv_show_post_count = $this->tv_shows['total_results'];
      add_action('tv_show_search_results', array($this, 'add_tmdb_search_results'));
    }
  }

  /**
   * @return void
   */
  public function add_tmdb_search_results()
  {
    if ($this->tv_shows['total_results'] > 0) {
      include(plugin_dir_path(__FILE__) . 'views/html-tv-show-search-results.php');
    } else {
      include(plugin_dir_path(__FILE__) . 'views/html-tv-show-search-no-results.php');
    }
  }
}