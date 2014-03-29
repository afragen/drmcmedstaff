<?php

//add_filter('tribe_events_mobile_breakpoint','tribe_events_mobile_breakpoint_override');
function tribe_events_mobile_breakpoint_override ($original) {
	// Return the minimum width (in pixels) that a screen can be before before being switched to responsive view
	return 650;
}
