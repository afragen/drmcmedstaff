<?php

add_action('init', 'drmc_child_github_updater_init');
function drmc_child_github_updater_init() {

	include_once('updater.php');

	//define('WP_GITHUB_FORCE_UPDATE', true);

	if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin

		$config = array(
			'slug' => plugin_basename(__FILE__),
			'proper_folder_name' => basename(plugin_basename(__FILE__)),
			'api_url' => 'https://api.github.com/repos/afragen/drmcmedstaff',
			'raw_url' => 'https://raw.github.com/afragen/drmcmedstaff/master',
			'github_url' => 'https://github.com/afragen/drmcmedstaff',
			'zip_url' => 'https://github.com/afragen/drmcmedstaff/zipball/master',
			'sslverify' => true,
			'requires' => '3.0',
			'tested' => '3.3',
			'readme' => 'readme.txt'
		);

		new WPGitHubUpdater($config);

	}

}

?>