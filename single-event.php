<?php get_header() ?>

<?php

while (have_posts()) {
  the_post();
  pageBannerTemplate();
}
?>

<div class="container container--narrow page-section">
  <div class="metabox metabox--position-up metabox--with-home-link">
    <p>
      <a class="metabox__blog-home-link" href="<?php echo site_url('/events'); ?>">
        <i class="fa fa-home" aria-hidden="true"></i> Event Home
      </a>
      <span class="metabox__main">
        <?php
        $eventDate = new DateTime(get_field('event_date'));
        ?>
        Date:
        <span><?php echo $eventDate->format('d'); ?></span> /
        <span><?php echo $eventDate->format('M'); ?></span> /
        <span><?php echo $eventDate->format('Y'); ?></span>

      </span>
    </p>
  </div>
  <div class="generic-content">
    <?php the_content(); ?>

    <?php
    $relatedPrograms = get_field('related_programs');

    if ($relatedPrograms) { ?>
      <hr class="section-break">
      <h2 class="headline headline--medium">Related Programs</h2>
      <?php foreach ($relatedPrograms as $program) { ?>

        <ul class="link-list min-list">
          <li>
            <a href="<?php echo get_the_permalink($program) ?>"><?php echo get_the_title($program) ?></a>
          </li>
        </ul>

    <?php
      }
    }


    ?>
  </div>
</div>


<?php get_footer() ?>