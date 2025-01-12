
<?php
function university_theme_files() {
  wp_enqueue_script('main-university-script', get_theme_file_uri('/build/index.js'),array('jquery'), '1.0', true);
  wp_enqueue_style('main-styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('extra-styles', get_theme_file_uri('/build/index.css'));
  wp_enqueue_style('font-awsome', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}
add_action('wp_enqueue_scripts', 'university_theme_files');

?>