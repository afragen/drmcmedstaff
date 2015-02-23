<?php //silence is golden

add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', 99 );
function enqueue_child_theme_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_uri(), array('parent-style')  );
}

//remove query strings from static resources. This ensures that they are cached like other elements.
add_filter( 'script_loader_src', 'ewp_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'ewp_remove_script_version', 15, 1 );
function ewp_remove_script_version( $src ){
	return remove_query_arg( 'ver', $src );
}

// secret ballots in wp-polls
add_filter( 'poll_log_show_log_filter', '__return_false' );
add_filter( 'poll_log_secret_ballot', '__return_empty_string' );