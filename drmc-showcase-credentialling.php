<?php
/**
 * Template Name: DRMC Credentialing Document List Template
 * Description: A Page Template that showcases Sticky Posts, Asides, and Blog Posts
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

// Enqueue showcase script for the slider
wp_enqueue_script( 'twentyeleven-showcase', get_template_directory_uri() . '/js/showcase.js', array( 'jquery' ), '2011-04-28' );

get_header(); ?>

		<div id="primary" class="showcase">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/**
					 * We are using a heading by rendering the_content
					 * If we have content for this page, let's display it.
					 */
					if ( '' != get_the_content() )
						get_template_part( 'content', 'intro' );
				?>

				<?php endwhile; ?>

				<?php
					/**
					 * Begin the featured posts section.
					 *
					 * See if we have any sticky posts and use them to create our featured posts.
					 * We limit the featured posts at ten.
					 */
					$sticky = get_option( 'sticky_posts' );

					// Proceed only if sticky posts exist.
					if ( ! empty( $sticky ) ) :

					$featured_args = array(
						'post__in' => $sticky,
						'post_status' => 'publish',
						'posts_per_page' => 10,
						'no_found_rows' => true,
					);

					// The Featured Posts query.
					$featured = new WP_Query( $featured_args );

					// Proceed only if published posts exist
					if ( $featured->have_posts() ) :

					/**
					 * We will need to count featured posts starting from zero
					 * to create the slider navigation.
					 */
					$counter_slider = 0;

					// Compatibility with versions of WordPress prior to 3.4.
					if ( function_exists( 'get_custom_header' ) )
						$header_image_width = get_theme_support( 'custom-header', 'width' );
					else
						$header_image_width = HEADER_IMAGE_WIDTH;
				?>

				<div class="featured-posts">
					<h1 class="showcase-heading"><?php _e( 'Featured Post', 'twentyeleven' ); ?></h1>

				<?php
					// Let's roll.
					while ( $featured->have_posts() ) : $featured->the_post();

					// Increase the counter.
					$counter_slider++;

					/**
					 * We're going to add a class to our featured post for featured images
					 * by default it'll have the feature-text class.
					 */
					$feature_class = 'feature-text';

					if ( has_post_thumbnail() ) {
						// ... but if it has a featured image let's add some class
						$feature_class = 'feature-image small';

						// Hang on. Let's check this here image out.
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) );

						// Is it bigger than or equal to our header?
						if ( $image[1] >= $header_image_width ) {
							// If bigger, let's add a BIGGER class. It's EXTRA classy now.
							$feature_class = 'feature-image large';
						}
					}
					?>

					<section class="featured-post <?php echo $feature_class; ?>" id="featured-post-<?php echo $counter_slider; ?>">

						<?php
							/**
							 * If the thumbnail is as big as the header image
							 * make it a large featured post, otherwise render it small
							 */
							if ( has_post_thumbnail() ) {
								if ( $image[1] >= $header_image_width )
									$thumbnail_size = 'large-feature';
								else
									$thumbnail_size = 'small-feature';
								?>
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail( $thumbnail_size ); ?></a>
								<?php
							}
						?>
						<?php get_template_part( 'content', 'featured' ); ?>
					</section>
				<?php endwhile;	?>

				<?php
					// Show slider only if we have more than one featured post.
					if ( $featured->post_count > 1 ) :
				?>
				<nav class="feature-slider">
					<ul>
					<?php

						// Reset the counter so that we end up with matching elements
				    	$counter_slider = 0;

						// Begin from zero
				    	rewind_posts();

						// Let's roll again.
				    	while ( $featured->have_posts() ) : $featured->the_post();
				    		$counter_slider++;
							if ( 1 == $counter_slider )
								$class = 'class="active"';
							else
								$class = '';
				    	?>
						<li><a href="#featured-post-<?php echo $counter_slider; ?>" title="<?php printf( esc_attr__( 'Featuring: %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" <?php echo $class; ?>></a></li>
					<?php endwhile;	?>
					</ul>
				</nav>
				<?php endif; // End check for more than one sticky post. ?>
				</div><!-- .featured-posts -->
				<?php endif; // End check for published posts. ?>
				<?php endif; // End check for sticky posts. ?>


				<div class="widget-area" role="complementary">
					<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>

						<?php
						the_widget( 'Twenty_Eleven_Ephemera_Widget', '', array( 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>' ) );
						?>

					<?php endif; // end sidebar widget area ?>
				</div><!-- .widget-area -->

<!-- ******* -->
<?php
$default_dir = "/medstaff-docs/drmc-credentialing/"; // lists files only for the directory which this script is run from

function file_ext_strip($filename) {
    return preg_replace('/\.[^.]*$/', '', $filename);
}

function file_replace_spacer($filename) {
	return preg_replace('/[_-]+/', ' ', $filename);
}

function list_directory($dir) {
	$narray=array();

	$dir_handle = @opendir($dir) or die("Unable to open $dir");
	$i=0;
	$skip_files = array(".", "..", ".htaccess", "index.php");
	//while($file = readdir($dir_handle)) {
	while (false !== ($file = readdir($dir_handle))) {
		if(!in_array($file, $skip_files)) {
			$narray[$i]=$file;
			$i++;
		}
	}
	natcasesort($narray); // case-insensitive sort
	return $narray;
	closedir($dir_handle); //closing the directory
}

// print out html
echo "\t" . '<ul>' . "\r\n\t";
$directory_array = list_directory(WP_CONTENT_DIR . $default_dir);
for($i=0; $i<sizeof($directory_array); $i++) {
	$fn = $directory_array[$i];
	$fn = file_ext_strip($fn);
	$fn = file_replace_spacer($fn);
	echo "<li><a href=".chr(34) . content_url() . $default_dir . $directory_array[$i] .chr(34). ">" . $fn . "</a></li>\r\n\t";
}
echo '</ul>' . "\r\n\t";
?>

<!-- ****** -->

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>