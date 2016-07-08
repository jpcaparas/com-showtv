<?php
/**
 * Template Name: TV Show
 */

$tmdb_config = get_query_var('tmdb_config');
$tmdb_show_data = get_query_var('tmdb_show_data');
$youtube_trailers = get_query_var('youtube_trailers');
?>

<div
    class="jumbotron"
    style="background-image:url(<?php echo $tmdb_config['images']['secure_base_url'] . $tmdb_config['images']['backdrop_sizes'][2] . $tmdb_show_data['backdrop_path']; ?>)"
>
    <div class="content">
        <h1 class="text-center"><?php echo apply_filters('the_title', $tmdb_show_data['name']); ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-md-10 col-md-offset-1">
        <blockquote class="text-center">
            <em><?php echo apply_filters('the_content', $tmdb_show_data['overview']); ?></em>
        </blockquote>

        <hr/>

        <table class="table table-striped table-responsive">
            <thead>
            <tr>
                <th>Created by</th>
                <th>Networks</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <?php
                    foreach ($tmdb_show_data['created_by'] as $created_by) {
                        echo $created_by['name'] . ', ';
                    }
                    ?>
                </td>
            </tr>
            </tbody>
        </table>

        <hr />

        <?php if (!empty($youtube_trailers)): ?>
            <h3>
                <i class="fa fa-youtube-play"></i> Trailers you might like
            </h3>

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
                    <div id="trailer-<?php echo $i; ?>" class="tab-pane fade in <?php echo $i == 1 ? 'active' : null; ?>">
                        <p>&nbsp;</p>
                        <?php if (!empty($trailer->id->playlistId)): ?>?>
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

