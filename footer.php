<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Axiomasoft
 */

	get_template_part( 'template-parts/header-footer/footer' );
	get_template_part( 'template-parts/popups/contact-form' );
	get_template_part( 'template-parts/popups/contact-form-error' );
	get_template_part( 'template-parts/popups/contact-form-success' );
	wp_nonce_field( 'axiomasoft', 'axiomasoft' );

?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
