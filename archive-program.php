<?php
get_header();
pageBannerTemplate(array(
  'title' => 'All Programs',
  'subtitle' => 'There is something for everyone, have a look around!',
  'photo' => site_url('/wp-content/uploads/2025/01/avoin-yliopisto-koulutustarjonta-herokuva.jpg'),
))
?>




<div class="container container--narrow page-section">
  <!-- <h2 class="headline headline--small-plus t-center">Upcoming Events</h2> -->

  <ul class="link-list min-list">
    <?php while (have_posts()) {
      the_post(); ?>
      <li><a href="<?php the_permalink() ?>"> <?php the_title() ?> </a></li>

    <?php } ?>
  </ul>
  <?php echo paginate_links(); ?>

</div>


<?php
get_footer()
?>