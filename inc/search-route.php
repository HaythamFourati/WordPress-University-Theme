<?php
add_action('rest_api_init', 'university_register_search');

function university_register_search()
{
  register_rest_route('university/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'university_search_results',
  ));
};

function university_search_results($data)
{

  // assigning what post type we want to loop over
  $mainDataArray = new WP_Query(array(
    'post_type' => array('post', 'page', 'professor'),
    'posts_per_page' => -1,
    's' => sanitize_text_field($data['keyword'])
  ));

  // Empty Array For Future Results
  $filteredResults = array(
    'posts' => array(),
    'professors' => array(),
    'pages' => array(),
  );

  // While Loop To filter Only the info we need 
  while ($mainDataArray->have_posts()) {
    $mainDataArray->the_post();
    if (get_post_type() == 'post') {
      array_push($filteredResults['posts'], array(
        'ID' => get_the_ID(),
        'Name' => get_the_title(),
        'Link' => get_the_permalink(),
      ));
    }
    if (get_post_type() == 'page') {
      array_push($filteredResults['pages'], array(
        'ID' => get_the_ID(),
        'Name' => get_the_title(),
        'Link' => get_the_permalink(),
      ));
    }

    if (get_post_type() == 'professor') {
      array_push($filteredResults['professors'], array(
        'ID' => get_the_ID(),
        'Name' => get_the_title(),
        'Link' => get_the_permalink(),
        'Picture' => get_the_post_thumbnail_url(0, 'professorSquare'),
      ));
    }
  }

  // we return the final filtered results as JSON
  return $filteredResults;
}
