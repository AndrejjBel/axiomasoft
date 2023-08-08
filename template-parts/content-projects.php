<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Axiomasoft
 */

 $term_list = wp_get_post_terms( $post->ID, 'services', array('fields' => 'names') );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="section-page-title container">
	    <h1 class="section-page-title__title galderglynn-CdRg"><?php the_title(); ?></h1>
	</section>

	<section class="section-page container border-bottom">
	    <h2 class="section-title fw200 galderglynn-CdRg">
	    	<?php if ($post->_title_general) {
					echo $post->_title_general;
				} else {
					echo 'A relevant end-user-friendly strategy built on a strong sustainability message';
				}
			?>
	    </h2>
	</section>

	<section class="project-review container">
	    <div class="project-review__content">
	    	<span class="project-review__content__title">Project review:</span>
			<div class="project-review__content__item brief border-bottom">
				<div class="project-review__content__item__title">
					<span>Brief</span>
				</div>
				<div class="project-review__content__item__text">
					<div class="project-review__content__item__text__wrap"><?php echo $post->_brief;?></div>
				</div>
			</div>

			<div class="project-review__content__item border-bottom">
				<div class="project-review__content__item__title">
					<span>Services</span>
				</div>
				<div class="project-review__content__item__text">
					<div class="project-review__content__item__text__wrap"><?php echo implode(", " ,  $term_list);?></div>
				</div>
			</div>

			<div class="project-review__content__item border-bottom">
				<div class="project-review__content__item__title">
					<span>Industry</span>
				</div>
				<div class="project-review__content__item__text">
					<div class="project-review__content__item__text__wrap"><?php echo axiomasoft_industryes_post($post->ID, ', '); ?></div>
				</div>
			</div>

			<div class="project-review__content__item border-bottom">
				<div class="project-review__content__item__title">
					<span>Year</span>
				</div>
				<div class="project-review__content__item__text">
					<div class="project-review__content__item__text__wrap"><?php echo $post->_year; ?></div>
				</div>
			</div>

			<div class="project-review__content__item border-bottom">
				<div class="project-review__content__item__title">
					<span>Live site</span>
				</div>
				<div class="project-review__content__item__text">
					<div class="project-review__content__item__text__wrap"><?php echo $post->_live_site; ?></div>
				</div>
			</div>
	    </div>
	</section>

	<section class="section-page container thumbnail">
	    <div class="thumbnail__img">
			<?php if ($post->_general_img) { ?>
				<img src="<?php echo wp_get_attachment_image_url( $post->_general_img, 'full' ); ?>" alt="">
			<?php } else { ?>
				<img src="/wp-content/uploads/2023/06/post-banner-scaled.jpg" alt="">
			<?php } ?>
	    	<?php //axiomasoft_post_thumbnail(); ?>
	    </div>
	</section>

    <section class="project-blocks">
        <?php axiomasoft_additional_blocks_post($post->ID);?>
    </section>

	<section class="extras">
	    <h2 class="section-title section-title-number container galderglynn-CdRg">
	        <span class="section-title-number__text">Extras</span>
	        <span class="section-title-number__number">(<?php echo wp_count_posts('projects')->publish;?>)</span>
	    </h2>

	    <div class="extras__content container">
	        <?php axiomasoft_projects_items(6, 'list'); ?>
	    </div>
	</section>

	<div class="entry-content">

	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
