<!-- Generate the slider -->
<?php include_once(ABSPATH . 'wp-admin/includes/plugin.php'); ?>

<?php if (is_plugin_active('ml-slider/ml-slider.php')): ?>
  <?php
  $metaslider_id = showtv_get_option('home_page_slider_id');
  ?>
  <?php if ($metaslider_id): ?>
    <div class="row">
      <div class="col-xs-12">
        <?php echo do_shortcode('[metaslider id=' . $metaslider_id . ']'); ?>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>

<!-- Generate the content -->
<div class="row">
  <div class="col-xs-12">
    <?php the_content(); ?>
  </div>
</div>
