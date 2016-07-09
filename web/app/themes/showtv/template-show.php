<?php
$showtv_config = get_query_var('showtv_config');
$tmdb_config = get_query_var('tmdb_config');
$tmdb_show_data = get_query_var('tmdb_show_data');
$youtube_trailers = get_query_var('youtube_trailers');
?>

<?php
// Hero image
if (!empty($tmdb_show_data['backdrop_path'])) {
    $hero_image = $tmdb_config['images']['secure_base_url'] . $tmdb_config['images']['backdrop_sizes'][2] . $tmdb_show_data['backdrop_path'];
} else {
    // Use fallback image set from options
    $hero_image = !empty($showtv_config['hero_image']) ? $showtv_config['hero_image'] : null;
}
?>

<div
    class="jumbotron"
    style="background-image:url(<?php echo esc_attr($hero_image); ?>)"
>
    <div class="content">
        <h1 class="text-center">
            <?php echo apply_filters('the_title', $tmdb_show_data['name']); ?>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-md-10 col-md-offset-1">
        <blockquote class="text-center">
            <p class="text-center"><i class="fa fa-chevron-down"></i></p>
            <em><?php echo apply_filters('showtv_show_overview', $tmdb_show_data['overview']); ?></em>
        </blockquote>

        <hr/>

        <h3><i class="fa fa-info-circle"></i> Show information</h3>

        <?php
        // Show creators
        $creators = array();
        array_walk($tmdb_show_data['created_by'], function ($creator) use (&$creators) {
            $creators[] = $creator['name'];
        });
        ?>
        <?php if (!empty($creators)): ?>
            <p>
                <strong>Creator/s: </strong>
                <?php echo join(', ', $creators); ?>
            </p>
        <?php endif; ?>

        <?php
        // Genres
        $genres = array();
        array_walk($tmdb_show_data['genres'], function ($genre) use (&$genres) {
            $genres[] = $genre['name'];
        });
        ?>
        <?php if (!empty($genres)): ?>
            <p>
                <strong>Genre/s: </strong>
                <?php echo join(', ', $genres); ?>
            </p>
        <?php endif; ?>

        <?php
        // Networks
        $networks = array();
        array_walk($tmdb_show_data['networks'], function ($network) use (&$networks) {
            $networks[] = $network['name'];
        });
        ?>
        <?php if (!empty($networks)): ?>
            <p>
                <strong>Network/s: </strong>
                <?php echo join(', ', $networks); ?>
            </p>
        <?php endif; ?>

        <?php
        // Origin countries
        $origin_countries = array();
        array_walk($tmdb_show_data['origin_country'], function ($origin_country) use (&$origin_countries) {
            $origin_countries[] = $origin_country;
        });
        ?>
        <?php if (!empty($origin_countries)): ?>
            <p>
                <strong>Origin country: </strong>
                <?php echo join(', ', $origin_countries); ?>
            </p>
        <?php endif; ?>

        <?php
        // Show status
        ?>
        <p>
            <strong>Show status: </strong>
            <?php echo $tmdb_show_data['status']; ?>
        </p>

        <?php
        // Show number of seasons
        ?>
        <p>
            <strong>Number of season/s: </strong>
            <?php echo count($tmdb_show_data['seasons']); ?>
        </p>

        <?php
        // Show number of episodes
        ?>
        <p>
            <strong>Number of episode/s: </strong>
            <?php echo $tmdb_show_data['number_of_episodes']; ?>
        </p>

        <hr/>

        <?php if (!empty($youtube_trailers)): ?>
            <h3>
                <i class="fa fa-play"></i> Clips you might like
            </h3>

            <p class="small">
                <em>* Powered by <a href="https://www.youtube.com/">YouTube &copy;</a></em>
            </p>

            <ul class="nav nav-tabs">
                <?php for ($i = 1; $i <= count($youtube_trailers); $i++): ?>
                    <li class="<?php echo $i == 1 ? 'active' : null; ?>">
                        <a data-toggle="tab" href="<?php echo '#trailer-' . $i; ?>"><?php echo 'Trailer #' . $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>

            <div class="tab-content">
                <?php for ($i = 1; $i <= count($youtube_trailers); $i++): ?>
                    <?php $trailer = $youtube_trailers[$i - 1]; ?>
                    <div id="trailer-<?php echo $i; ?>"
                         class="tab-pane fade in <?php echo $i == 1 ? 'active' : null; ?>">
                        <?php if ($trailer->snippet): ?>
                            <h3><?php echo apply_filters('the_title', $trailer->snippet->title); ?></h3>
                            <p><?php echo apply_filters('the_excerpt', $trailer->snippet->description); ?></p>
                        <?php endif; ?>
                        <hr/>
                        <?php if (!empty($trailer->id->playlistId)): ?>
                            <iframe width="100%" height="400"
                                    src="https://www.youtube.com/embed/?list=<?php echo $trailer->id->playlistId; ?>"
                                    frameborder="0"
                                    allowfullscreen></iframe>
                        <?php else: ?>
                            <iframe width="100%" height="400"
                                    src="https://www.youtube.com/embed/<?php echo $trailer->id->videoId; ?>"
                                    frameborder="0" allowfullscreen></iframe>
                        <?php endif; ?>
                        <p>&nbsp;</p>
                    </div>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

