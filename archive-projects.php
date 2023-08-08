<?php
/**
 * The template for displaying archive projects pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Axiomasoft
 */

get_header();
?>

	<main id="primary" class="site-main">

            <section class="section-page-title container">
                <h1 class="section-page-title__title galderglynn-CdRg">projects</h1>
                <div class="section-page-title__count galderglynn-CdRg">(<?php echo wp_count_posts('projects')->publish;?>)</div>
            </section>

            <section class="section-filtr container">
                <div class="section-filtr__items">
					<button id="all" class="section-filtr__items__button site-btn active" type="button" name="button">
						<span class="section-filtr__items__button-text">All</span>
						<span class="section-filtr__items__button-count"><?php echo wp_count_posts('projects')->publish;?></span>
					</button>
					<?php axiomasoft_services_items();?>
                </div>
                <div class="section-filtr__buttons">
                	<div id="list" class="section-filtr__buttons__item">list</div>
					<div id="grid" class="section-filtr__buttons__item active">grid</div>
                </div>
            </section>

			<section id="projects-grid" class="section-projects projects-grid container active">
				<div class="featured__content">
			        <?php axiomasoft_projects_items(6, 'cards'); ?>
			    </div>
			</section>

			<section id="projects-list" class="section-projects projects-list">
				<div class="extras__content container">
			        <?php axiomasoft_projects_items(6, 'list'); ?>
			    </div>
			</section>

			<section class="section-page reviews">
			    <h2 class="section-title container galderglynn-CdRg">Clients’ reviews</h2>

			    <div class="services__content container">
					<div class="swiper reviewsSwiper">
						<div class="swiper-wrapper">
							<?php axiomasoft_reviews();?>
						</div>
					</div>
			    </div>
			</section>

	</main><!-- #main -->

<?php
get_footer();
