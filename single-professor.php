<?php get_header() ?>

<?php

while (have_posts()) {
  the_post();
  pageBannerTemplate();
}
?>

<div class="container container--narrow page-section">
  <!-- <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo site_url('/events'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Event Home </a> <span class="metabox__main">Posted by <?php the_author_posts_link(); ?> on <?php the_time('F j Y') ?> in <?php the_category(', '); ?></span>
        </p>
      </div> -->
  <div class="generic-content">

    <div class="row group">
      <div class="one-third">
        <?php the_post_thumbnail('professorSinglePage') ?>
      </div>
      <div class="two-third">
        <?php the_content(); ?>
      </div>
    </div>

    <hr class="section-break">
    <h2 class="headline headline--medium">Subjects Taught</h2>
    <?php
    $relatedPrograms = get_field('related_programs');

    if ($relatedPrograms) {
      foreach ($relatedPrograms as $program) {
    ?>

        <ul class="link-list min-list">
          <li>
            <a href="<?php echo get_the_permalink($program) ?>"><?php echo get_the_title($program) ?></a>
          </li>
        </ul>

    <?php
      }
    } else {
      echo '<p>No related programs found.</p>';
    }


    ?>
  </div>
</div>


<?php get_footer() ?>