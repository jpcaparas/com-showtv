<?php get_template_part('templates/page', 'header'); ?>

<?php do_action('search_results_alert'); ?>

<?php //if (!have_posts()) : ?>
<!--  <div class="alert alert-warning">-->
<!--    --><?php //_e('Sorry, no results were found.', 'sage'); ?>
<!--  </div>-->
<!--  --><?php //get_search_form(); ?>
<?php //endif; ?>

<?php do_action('search_results_message'); ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'search'); ?>
<?php endwhile; ?>

<?php do_action('tv_show_search_results'); ?>

<?php the_posts_navigation(); ?>
