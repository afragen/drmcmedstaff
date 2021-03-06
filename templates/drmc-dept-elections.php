<?php
/**
 * Template Name: Departmental Elections Template
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package    WordPress
 * @subpackage Twenty_Twelve
 * @since      Twenty Twelve 1.0
 */

namespace Fragen\DRMC;

$base  = Base::instance();
$terms = $base->get_department();
$args  = array(
	'post_type' => 'drmc_voting',
	'tax_query' => array(
		array(
			'taxonomy' => 'department',
			'field'    => 'slug',
			'terms'    => $terms,
		),
		array(
			'taxonomy' => 'department',
			'field'    => 'slug',
			'terms'    => array( 'voting-over', 'medical-staff' ),
			'operator' => 'NOT IN',
		),
	),
);

get_header(); ?>

<div id="primary">
	<div id="content" role="main">

		<article class="hentry drmc_voting">
			<div class="entry-class wrap clear">
				<header class="entry-header">
					<h1 class="entry-title">Items for voting - <?php echo ucwords( $terms[0] ); ?></h1>
				</header>
				<div class="entry-content">
					<p>Each item must be voted upon individually. Once cast, <strong>your vote cannot be changed</strong>.</p>

					<p>Changes and such will have the following styling. Additions will be
						<span class="des-insert">blue and underlined</span>. Deletions will be
						<span class="des-delete">red and strike-through</span>.</p>
				</div>
				<?php $my_query = new \WP_Query( $args ); ?>
				<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'page' ); ?>
					<?php
					global $withcomments;
					$withcomments = true;
					comments_template();
					?>
				<?php endwhile; // end of the loop.
				?>

				<?php if ( empty( $my_query->posts ) ): ?>
					<?php get_template_part( 'template-parts/content', 'page' ); ?>
					<?php echo '<div style="text-align:center;">There are no current items for voting.</div>'; ?>
				<?php endif; ?>

			</div><!-- .entry-class -->
		</article>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
