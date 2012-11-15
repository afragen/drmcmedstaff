<?php

add_action( 'register_form', 'drmc_username' );
function drmc_username() {
	$html = '<p class="message">You must use your DRMC username as your <strong>Username</strong> or your registration will be denied.</p><br />';
	echo $html;
}

?>