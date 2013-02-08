<?php
/**
 * Template Name: Credentialing List Template
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>



<?php $default_dir = "/medstaff-docs/drmc-credentialing/"; ?>// lists files only for the directory which this script is run from
<?php locate_template( 'list-files.php' ); ?>


			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>