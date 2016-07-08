<?php
$base_url = get_bloginfo('url');
?>

<?php foreach ($this->tv_shows['results'] as $tv_show): ?>
    <article>
        <header><h2 class="entry-title"><a href="<?php
                echo add_query_arg('show_id', $tv_show['id'], $base_url);
                ?>">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <?php echo apply_filters('the_title', $tv_show['name']); ?>
                </a></h2>
        </header>
        <div class="entry-summary">
            <?php
            $overview = $tv_show['overview'];
            $excerpt = strlen($overview) ? $overview : 'There is no overview available for this TV show.';
            echo apply_filters('the_excerpt', $excerpt);
            ?>
        </div>
    </article>
    <hr/>
<?php endforeach; ?>