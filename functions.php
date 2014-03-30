<?php

//add_filter( 'tribe_events_mobile_breakpoint', 'tribe_events_mobile_breakpoint_override' );
function tribe_events_mobile_breakpoint_override( $original ) {
	// Return the minimum width (in pixels) that a screen can be before before being switched to responsive view
	return 650;
}

add_filter( 'edd_downloads_query', 'sumobi_edd_downloads_query', 10, 2 );
function sumobi_edd_downloads_query( $query, $atts ) {
	global $wp_query;

	if ( 'cme-symposium-tickets' === $wp_query->query_vars['pagename'] ) {
		$query['meta_key'] = '_tribe_eddticket_for_event';
	}
	return $query;
}
