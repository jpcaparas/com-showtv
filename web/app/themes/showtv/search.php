<?php get_template_part('templates/page', 'header'); ?>

<?php do_action('search_results_alert'); ?>

<?php //if (!have_posts()) : ?>
<!--  <div class="alert alert-warning">-->
<!--    --><?php //_e('Sorry, no results were found.', 'sage'); ?>
<!--  </div>-->
<!--  --><?php //get_search_form(); ?>
<?php //endif; ?>

<?php do_action('search_results_message'); ?>

<h2><i
    class="fa fa-tv"></i>&nbsp; <?php echo apply_filters('showtv_tv_show_results_title', 'TV Show search results'); ?>
</h2>
<?php do_action('tv_show_search_results'); ?>
<hr/>

<h2><i class="fa fa-wpforms"></i>&nbsp;Page results</h2>
<?php if (have_posts()): ?>
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content', 'search'); ?>
  <?php endwhile; ?>
<?php else: ?>
  <div class="alert alert-warning">
    <i class="fa fa-exclamation-circle"></i>&nbsp;There are no pages matching your query.
  </div>
<?php endif; ?>

<?php the_posts_navigation(); ?>
