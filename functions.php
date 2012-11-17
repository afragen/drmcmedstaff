<?php

add_action( 'register_form', 'drmc_username' );
function drmc_username() {
	$html = '<p class="message">You must use your DRMC username as your <strong>Username</strong> or your registration will be denied.</p><br />';
	echo $html;
}

//http://nathany.com/redirecting-wordpress-subscribers
function change_login_redirect($redirect_to, $request_redirect_to, $user) {
  if (is_a($user, 'WP_User') && $user->has_cap('edit_posts') === false) {
    return get_bloginfo('siteurl');
  }
  return $redirect_to;
}
// add filter with default priority (10), filter takes (3) parameters
add_filter('login_redirect','change_login_redirect', 10, 3);


?>