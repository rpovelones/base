<?php 
/*
 * Register theme API routes
 */
function register_theme_routes() {
	register_rest_route( 'base', '/post', [
        'methods' => 'GET',
        'callback' => 'register_post_route'
    ] );
    register_rest_route( 'base', '/page', [
        'methods' => 'GET',
        'callback' => 'register_page_route'
    ] );
    register_rest_route( 'base', '/all', [
        'methods' => 'GET',
        'callback' => 'register_all_route'
    ] );
}
add_action( 'rest_api_init', 'register_theme_routes');

/*
 * Callbacks for register_theme_routes()
 * Functions make a call to the register_route function, which returns the post data
 */
function register_post_route( $data ) {
	$filtered = register_route( $data, 'post' );
	return $filtered;
}
function register_page_route( $data) {
	$filtered = register_route( $data, 'page' );
	return $filtered;
}
function register_all_route($data) {
	$filtered = register_route( $data, array('post','page') );
	return $filtered;
}

/*
 * Load template part function
 */
function load_template_part( $id, $template ) {
	ob_start();
	if( file_exists( get_template_directory().'/templates/content-'.$template.'.php' ) ) {
    	include( get_template_directory().'/templates/content-'.$template.'.php' );
    } else {
    	include( get_template_directory().'/templates/content.php' );
    }
    return ob_get_clean();
}

/*
 * Function that takes params from callbacks and then returns the posts 
 * @param $data - data from API (don't change this)
 * @param $post_type - accepts an array or single post type
 */
function register_route( $data, $post_type ) {

	// add the query params from API request to an array
	$params = $data->get_query_params();
	// build the query args array
	$args['post_type'] = $post_type;

	// loop through the params and add to query args
	foreach( $params as $param => $value ){
		$args[$param] = $value;
	}
	$posts = get_posts($args);

	// get the template we need to load
	if( is_array($post_type) ) {
		$template = implode('_', $post_type);
	} else {
		$template = $post_type;
	}

	// loop through posts and load the html
	$i = 0; 
	$homeID = '';
	foreach( $posts as $post => $value ) {
		$id = $value->ID;

		if( $id == get_option( 'page_on_front' ) ) {
			$template = 'home';
		}

		$results[$i] = new stdClass();
		$results[$i]->ID = $id;
		$results[$i]->html = load_template_part( $id, $template );
		$results[$i]->pageTitle = get_the_title($id).' - '. get_bloginfo();
		$i++;
	}

	return $results;
}

