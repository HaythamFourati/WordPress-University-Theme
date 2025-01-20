<?php get_header();

while (have_posts()) {
  the_post();
  pageBannerTemplate();
}
?>



<div class="container container--narrow page-section">
  <div class="metabox metabox--position-up metabox--with-home-link">
    <p>
      <a class="metabox__blog-home-link" href="<?php echo site_url('/programs'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs </a> <span class="metabox__main">Posted by <?php the_author_posts_link(); ?> on <?php the_time('F j Y') ?> in <?php the_category(', '); ?></span>
    </p>
  </div>
  <div class="generic-content">
    <?php the_content(); ?>
  </div>
  <?php

  $relatedProfesssors = new WP_Query(array(
    'posts_per_page' => -1,
    'post_type' => 'professor',
    'orderby' => 'title',
    'order' => 'ASC',
    'meta_query' => array(
      array(
        'key' => 'related_programs',
        'compare' => 'LIKE',
        'value' => '"' . get_the_ID() . '"',
      ),
    ),
  ));
  ?>

  <?php
  if ($relatedProfesssors->have_posts()) {
  ?>
    <hr class="section-break">
    <h2 class="headline headline--medium">Taught by</h2>
    <ul class="professor-cards">
      <?php while ($relatedProfesssors->have_posts()) {
        $relatedProfesssors->the_post(); ?>

        <li class="professor-card__list-item">
          <a class="professor-card" href="<?php the_permalink() ?>">
            <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorSquare') ?>">
            <span class="professor-card__name">
              <?php the_title() ?>
            </span>
          </a>
        </li>
      <?php } ?>
    </ul>

  <?php } ?>

  <?php wp_reset_postdata(); ?>

  <?php
  $today = date('Ymd');
  $homePageEvents = new WP_Query(array(
    'posts_per_page' => 2,
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'meta_query' => array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      ),
      array(
        'key' => 'related_programs',
        'compare' => 'LIKE',
        'value' => '"' . get_the_ID() . '"',
      ),
    ),
  ));
  ?>

  <?php
  if ($homePageEvents->have_posts()) {  ?>
    <hr class="section-break">
    <h2 class="headline headline--medium">Upcoming <?php the_title() ?> Related Events</h2>

  <?php
    while ($homePageEvents->have_posts()) {
      $homePageEvents->the_post();
      get_template_part('template-parts/event');
    }
  }
  ?>

</div>


<?php get_footer(); ?>