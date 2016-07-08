<?php

class ShowTV_Hook_Search
{
    /**
     * @var array
     */
    public $tv_shows = array();

    private $post_count = false;
    private $tv_show_post_count = false;

    public function __construct()
    {
        add_action('pre_get_posts', array($this, 'check_regular_search_results'));
        add_action('pre_get_posts', array($this, 'check_tmdb_search_results'));
        add_action('search_results_message', array($this, 'write_search_results_message'));
    }

    public static function get_instance()
    {
        return new ShowTV_Hook_Search();
    }

    public function write_search_results_message()
    {
        $out = '';

        if (!$this->post_count && !$this->tv_show_post_count) {
            $out .= '<div class="alert alert-danger">';
            $out .= 'There are no results with your search.';
            $out .= '</div>';
        } else {
            $out = '<div class="alert alert-info">';
            $out .= sprintf('There were %1$s page/s that match your query.', $this->post_count);
            $out .= '<br />';
            $out .= sprintf('There were %1$s TV show/s that match your query.', $this->tv_show_post_count);
            $out .= '</div>';
        }

        echo $out;
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
            $api_key = 'a50704bbb73eaab69fa7b5225cd8854c';
            $tmdb_search = new ShowTV_API_TMDB_Search($api_key);

            $this->tv_shows = $tmdb_search->search_tv($query->query['s']);
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
        }
    }
}