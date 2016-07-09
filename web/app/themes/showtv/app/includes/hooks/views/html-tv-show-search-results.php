<?php
$base_url = get_bloginfo('url');

// Create pagination
$total_pages = $this->tv_shows['total_pages'];
$current_page = $this->tv_shows['page'];
$results = $this->tv_shows['results'];
$url = get_bloginfo('url');
$request_uri = $_SERVER['REQUEST_URI'];
?>

<?php
$pagination_block = '';
$pagination_items = get_pagination_items($current_page, $total_pages);

if ($total_pages > 1): $pagination_block .= "<div class=\"text-center\"><ul class=\"pagination\">";
    $start = 1;
    $middle = $total_pages / 2;
    $end = $total_pages;

    foreach ($pagination_items as $item):
        if (is_numeric($item)) {
            $pagination_block .= sprintf(
                '<li class="%1$s"><a href="%2$s" title="%3$s">%4$s</a></li>',
                $current_page === $item ? 'active' : null,
                add_query_arg(array(
                    'tv_results_page' => $item,
                ), $request_uri),
                esc_attr('Page ' . $item . ' of ' . $total_pages . ' of TV show results'),
                $item
            );
        } else {
            $pagination_block .= sprintf(
                '<li class="disabled"><a href="#">...</a></li>'
            );
        }

    endforeach;
    $pagination_block .= "</ul></div>";
endif;

?>
<?php echo $pagination_block; ?>
<?php foreach ($this->tv_shows['results'] as $tv_show): ?>
    <article>
        <header><h3 class="entry-title"><a href="<?php
                echo add_query_arg('show_id', $tv_show['id'], $base_url);
                ?>">
                    <?php echo apply_filters('the_title', $tv_show['name']); ?>
                </a></h3>
        </header>
        <div class="entry-summary">
            <?php
            echo apply_filters('showtv_show_overview', $tv_show['overview']);
            ?>
        </div>
    </article>
    <hr/>
<?php endforeach; ?>
<?php echo $pagination_block; ?>
