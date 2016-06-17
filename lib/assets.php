<?php

function asset_path( $file ) {
  $dist_path = get_template_directory_uri(). '/dist/';
  return $dist_path . $file;
}

function assets() {
  wp_enqueue_style('base_css', asset_path('main.css'), false, null);
  wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', [], null, true);
  wp_enqueue_script('base_js', asset_path('main.js'), [], null, true);
}
add_action('wp_enqueue_scripts', 'assets', 100);