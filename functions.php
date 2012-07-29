<?php

// REMOVE TWENTY ELEVEN DEFAULT HEADER IMAGES
function wptips_remove_header_images() {
    unregister_default_headers( array('wheel','shore','trolley','pine-cone','chessboard','lanterns','willow','hanoi')
    );
}
add_action( 'after_setup_theme', 'wptips_remove_header_images', 11 );

//ADD NEW DEFAULT HEADER IMAGES
function wptips_new_default_header_images() {
    $child2011_dir = get_bloginfo('stylesheet_directory');
	$images = array();

	$page = get_page_by_title('The Headers');
	/*
	echo ">>>";
	print_r($page);
	echo "<<<";

	echo "]]]";*/
	$attachments = get_children(
		array(
			'post_parent' => $page->ID,
			'post_type' => 'attachment',
			'orderby' => 'menu_order ASC, ID',
			'order' => 'DESC'
		) 
	);
	/*
	print_r($attachments);
	echo "[[[";
	 */
	foreach($attachments as $id => $info) {
		$image_id = $info->ID;
		$url = wp_get_attachment_image_src($image_id, 'full');
		$thumb = wp_get_attachment_image_src($image_id, 'medium');
		$images[] = array(
			'url' => $url[0],
			'thumbnail_url' =>  $thumb[0],
			'description' => __($info->post_title, 'twentyelevenheaders')
		);
	}

    register_default_headers($images);
}
add_action( 'after_setup_theme', 'wptips_new_default_header_images' );



?>