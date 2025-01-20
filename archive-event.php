<?php
get_header();
pageBannerTemplate(array(
  'title' => 'All Events',
  'subtitle' => 'See What Is Going On In Our World.',
  'photo' => site_url('wp-content/uploads/2025/01/Home-Page-Banner-or-Footer-16-1.jpg'),
))
?>

<div class="container container--narrow page-section">
  <!-- <h2 class="headline headline--small-plus t-center">Upcoming Events</h2> -->

  <?php while (have_posts()) {
    the_post();
    get_template_part('template-parts/event');
  } ?>
  <?php echo paginate_links(); ?>
  <br>
  <hr>
  <br>
  <p>Looking for a recap of past events? Check out our<strong> <a href="<?php echo site_url('/past-events') ?>">Past Events Archive</a></strong></p>
</div>


<?php
get_footer()
?>