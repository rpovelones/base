<?php
/**
 * Theme includes
 */
$theme_includes = [
  'lib/assets.php', // Scripts and stylesheets
  'lib/init.php',   // Theme setup
  'lib/api.php',    // WP API routes
];

foreach ($theme_includes as $file) {
  require($file);
}