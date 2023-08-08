<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Axiomasoft
 */

get_header();

if ( is_front_page() ) {
	get_template_part( 'template-parts/page/front' );
} elseif ( is_page('services') ) {
	get_template_part( 'template-parts/page/services' );
} elseif ( is_page('about') ) {
	get_template_part( 'template-parts/page/about-us' );
} else {

?>

	<main id="primary" class="site-main container">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
}
// get_sidebar();
get_footer();
