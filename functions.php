
<?php
function university_theme_files() {
  wp_enqueue_script('main-university-script', get_theme_file_uri('/build/index.js'),array('jquery'), '1.0', true);
  wp_enqueue_style('main-styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('extra-styles', get_theme_file_uri('/build/index.css'));
  wp_enqueue_style('font-awsome', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}
add_action('wp_enqueue_scripts', 'university_theme_files');



function university_features(){
  register_nav_menu('headerMenu', 'Header Menu Location');
  register_nav_menu('footerMenu1', 'Footer Menu Location1');
  register_nav_menu('footerMenu2', 'Footer Menu Location2');
  add_theme_support('title-tag');
}

add_action('after_setup_theme', 'university_features');

?>

