/**
 * add cta button format to wysiwyg editor
 */
function atg_mce_buttons_2( $buttons ) {
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
function mce_before_init( $settings ) {
  $style_formats = array(
    array(
      'title' => 'CTA button',
      'selector' => 'a',
      'classes' => 'btn btn-cta'
    )
  );
  $settings['style_formats'] = json_encode( $style_formats );
  return $settings;
}
add_filter( 'mce_buttons_2', __NAMESPACE__ . '\\atg_mce_buttons_2' );
add_filter( 'tiny_mce_before_init', __NAMESPACE__ . '\\mce_before_init' );