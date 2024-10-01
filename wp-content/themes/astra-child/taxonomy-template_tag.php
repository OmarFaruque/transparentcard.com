<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<style>
	div#templatetagtemplate .ast-container {
		display: block;
	}
</style>



<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div style="margin-top:0;" id="primary" <?php astra_primary_class(); ?>>

		<?php// astra_primary_content_top(); ?>

		<?php //astra_archive_header(); ?>

		<div id="templatetagtemplate" class="template-tags-page">
		<?php 
			$term = get_queried_object();

			// Check if the term is valid and has an ID
			if ($term && !is_wp_error($term)) {
				// Get the term ID
				$term_id = $term->term_id;

				// Output the term ID (for debugging or other purposes)
				echo do_shortcode( '[nbdesigner_gallery row="6" pagination="true" per_row="5" term_id="'.$term_id.'" ][/nbdesigner_gallery]', false );		
			}
		?>
		</div>

		<?php //astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
