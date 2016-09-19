<?php
// lists files only for the directory which this script is run from
//$default_dir = "/medstaff-docs/";
//$default_dir is now passed variable when this file is call using include(locate_template( './templates/list-files.php' ));

function file_ext_strip( $filename ) {
    return preg_replace( '/\.[^.]*$/', '', $filename );
}

function file_replace_spacer( $filename ) {
	return preg_replace( '/[_-]+/', ' ', $filename );
}

function file_title_case( $filename ) {
	return ucwords( $filename );
}

function list_directory( $dir ) {
	$dir_list = array();

	// Only add .txt/.pdf files
	foreach ( glob( $dir . "*.{txt,pdf}", GLOB_BRACE ) as $file ) {
		array_push( $dir_list, basename( $file ) );
	}
	natcasesort( $dir_list ); // case-insensitive sort

	return $dir_list;
}

// print out html
echo "\t" . '<ul>' . "\r\n\t";
$directory_array = list_directory( WP_CONTENT_DIR . $default_dir );

foreach ( $directory_array as $fn ) {
	$fn_ext = $fn;
	$fn = file_ext_strip( $fn );
	$fn = file_replace_spacer( $fn );
	$fn = file_title_case( $fn );
	echo "<li><a href=" . chr(34) . content_url() . $default_dir . $fn_ext . chr(34) . ">" . $fn . "</a></li>\r\n\t";
}

echo '</ul>' . "\r\n\t";
