<?php

function pageBannerTemplate($args = NULL)
{
  // Ensure $args is always an array
  if (!is_array($args)) {
    $args = [];
  }

  // Set default values if not provided in $args
  if (!isset($args['title']) || empty($args['title'])) {
    $args['title'] = get_the_title();
  }

  if (!isset($args['subtitle']) || empty($args['subtitle'])) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }

  $pageBannerImage = get_field('page_banner_background_image');
  if (!isset($args['photo']) || empty($args['photo'])) {
    if ($pageBannerImage) {
      $args['photo'] = $pageBannerImage['sizes']['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  }

?>
  <!-- Page Default Banner HTML Template -->
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url('<?php echo esc_url($args['photo']); ?>')">
    </div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo esc_html($args['title']); ?></h1>
      <div class="page-banner__intro">
        <p><?php echo esc_html($args['subtitle']); ?></p>
      </div>
    </div>
  </div>
<?php
}





function university_theme_files()
{
  wp_enqueue_script('main-university-script', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('main-styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('extra-styles', get_theme_file_uri('/build/index.css'));
  wp_enqueue_style('font-awsome', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}
add_action('wp_enqueue_scripts', 'university_theme_files');



function university_features()
{
  register_nav_menu('headerMenu', 'Header Menu Location');
  register_nav_menu('footerMenu1', 'Footer Menu Location1');
  register_nav_menu('footerMenu2', 'Footer Menu Location2');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('professorSquare', 400, 400, true);
  add_image_size('professorSinglePage', 480, 650, true);
  add_image_size('pageBanner', 1400, 350, true);
};

function university_adjust_queries($query)
{

  if (!is_admin() and is_post_type_archive('program') and $query->is_main_query()) {

    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  };



  if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
    $today = date('Ymd');
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'DATE'
      )
    ));
  }
};


add_action('after_setup_theme', 'university_features');
add_action('pre_get_posts', 'university_adjust_queries');


?>