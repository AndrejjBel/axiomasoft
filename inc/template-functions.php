<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Axiomasoft
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function axiomasoft_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'axiomasoft_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function axiomasoft_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'axiomasoft_pingback_header' );

// Footer link
function axiomasoft_footer_link() {
    if ( is_front_page() ) {
        $link = '/projects';
        $title_link = 'projects';
    } elseif ( is_page('services') ) {
        $link = '/about';
        $title_link = 'about';
    } elseif ( is_page('about') ) {
        $link = '/';
        $title_link = 'home';
    } elseif ( is_post_type_archive('projects') ) {
        $link = '/services';
        $title_link = 'services';
    }

    if ( !is_front_page() ) {

    echo '<div class="site-footer__link">
            <a href="' . $link . '"></a>
            <div class="site-footer__link__title galderglynn-CdRg">' . $title_link . '</div>
            <div class="site-footer__link__icon">
                <svg width="65" height="64" viewBox="0 0 65 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M41.9485 19.7813L21.7192 19.7813L21.7192 14.448L51.0525 14.448L51.0525 43.7813L45.7192 43.7813L45.7192 23.552L18.2712 51L14.5005 47.2293L41.9485 19.7813Z" fill="#2B2B2B"/>
                </svg>
            </div>
        </div>';
    }
}

// Partners logo
function axiomasoft_partners_logo() {
    $partners_logos = carbon_get_theme_option( 'partners_logo' );
    foreach ($partners_logos as $partner_logo) {
        echo '<img class="lazy" alt="" decoding="async" src="' . wp_get_attachment_image_url( $partner_logo['partners_item_img'], 'full' ) . '" data-src="' . wp_get_attachment_image_url( $partner_logo['partners_item_img'], 'full' ) . '" />';
    }
}

// Partners cards
function axiomasoft_projects_items($numberposts, $layouts) {
	$my_posts = get_posts( array(
		'numberposts' => $numberposts,
		'orderby'     => 'date',
		'order'       => 'ASC',
		'post_type'   => 'projects',
		'suppress_filters' => true,
	) );
	global $post;
	if ($layouts == 'cards') {
		$card_number = 1;
		foreach( $my_posts as $post ){
			setup_postdata( $post );
			$term_list = wp_get_post_terms( $post->ID, 'services', array('fields' => 'names') );
			$img_id = carbon_get_post_meta( $post->ID, 'image_back' );
			if ( $post->ID != 37 && $post->ID != 51 && $post->ID != 54 ) {
				$st = ' style="display:none;"';
				$img_cl = '';
				$url = '#';
			} else {
				$st = '';
				$img_cl = ' front';
				$url = get_permalink();
			}
		?>
		<div class="featured__content__card" data-id="<?php echo $post->ID; ?>">
			<div class="featured__content__card-number<?php echo $card_number; ?>">
				<a class="featured__content__card__link" href="<?php the_permalink(); ?>"<?php echo $st; ?>></a>
				<div class="featured__content__card__img<?php echo $img_cl; ?>"><?php the_post_thumbnail(); ?></div>
				<div class="featured__content__card__img back" style="background: url(<?php echo wp_get_attachment_url( $img_id ); ?>);
			        background-position: center; background-repeat: no-repeat; background-size: cover;"<?php echo $st; ?>></div>
				<div class="featured__content__card__title">
					<a href="<?php echo $url; ?>"><?php the_title(); ?></a>
				</div>
				<div class="featured__content__card__text"><?php echo implode(", " ,  $term_list);;?></div>
			</div>
		</div>
		<?php
		if ($card_number == 6) {
			$card_number = 0;
		}
		++$card_number;
		}
	} elseif ($layouts == 'list') {
		foreach( $my_posts as $post ){
			setup_postdata( $post );
			$term_list = wp_get_post_terms( $post->ID, 'services', array('fields' => 'names') );
			if ( $post->ID != 37 && $post->ID != 51 && $post->ID != 54 ) {
				$url = '#';
			} else {
				$url = get_permalink();
			}
		?>
		<div class="extras__content__list">
			<a class="extras__content__list__link" href="<?php echo $url; ?>"></a>
			<div class="extras__content__list__title"><?php the_title(); ?></div>
			<div class="extras__content__list__industry"><?php echo axiomasoft_industryes_post($post->ID, ' / '); ?></div>
			<div class="extras__content__list__text"><?php echo implode(", " ,  $term_list);?></div>
			<div class="extras__content__list__img" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
		</div>
		<?php
		}
	}
	wp_reset_postdata();
}

// Services list
function axiomasoft_services_list() {
	$args = [
		'taxonomy'      => [ 'services' ],
		'hide_empty'    => false,
		'orderby' => 'term_id',
		'order'         => 'ASC',
	];
	$terms = get_terms( $args );
	foreach ($terms as $term) {
	?>
	<div class="services__content__item">
		<div class="services__content__item__title galderglynn-CdRg"><?php echo $term->name;?></div>
		<div class="services__content__item__description"><?php echo $term->description;?></div>
	</div>
	<?php
	}
}

// Services button
function axiomasoft_services_items() {
	$args = [
		'taxonomy'      => [ 'services' ],
		// 'hide_empty'    => false,
		'orderby' => 'term_id',
		'order'         => 'ASC',
	];
	$terms = get_terms( $args );
	foreach ($terms as $term) {
	?>
	<button id="<?php echo $term->term_id;?>" class="section-filtr__items__button site-btn" type="button" name="button">
		<span class="section-filtr__items__button-text"><?php echo $term->name;?></span>
		<span class="section-filtr__items__button-count"><?php echo $term->count;?></span>
	</button>
	<?php
	}
}

// Services contact list
function axiomasoft_services_contact_list() {
	$args = [
		'taxonomy'      => [ 'services' ],
		'hide_empty'    => false,
		'orderby' => 'term_name',
		'order'         => 'ASC',
	];
	$terms = get_terms( $args );
	foreach ($terms as $term) {
	?>
	<span class="contact-form-modal__content__form__select__options__item">
		<span class="contact-form-modal__content__form__select__options__item__text"><?php echo $term->name;?></span>
		<svg class="contact-form-modal__content__form__select__options__item__check" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M16.6668 5.41675L7.50016 14.5834L3.3335 10.4167" stroke="#2B2B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
	</span>
	<?php
	}
}

// Industryes
function axiomasoft_industryes_post($post_id, $razd) {
	$post_industryes = carbon_get_post_meta( $post_id, 'industryes' );
	$industryes = [];
	foreach ($post_industryes as $post_industry) {
		$industryes[] = $post_industry;
	}
	return implode($razd,  $industryes);
}

add_action( 'wp_ajax_nopriv_axiomasoft', 'axiomasoft_ajax' );
add_action( 'wp_ajax_axiomasoft', 'axiomasoft_ajax' );
function axiomasoft_ajax(){
	if ( $_POST['term'] == 'all' ) {
		$my_posts = get_posts( array(
			'numberposts' => -1,
			'orderby'     => 'date',
			'order'       => 'ASC',
			'post_type'   => 'projects',
			'suppress_filters' => true
		) );

	} else {
		$my_posts = get_posts( array(
			'numberposts' => -1,
			'orderby'     => 'date',
			'order'       => 'ASC',
			'post_type'   => 'projects',
			'suppress_filters' => true,
			'tax_query' => [
				[
					'taxonomy' => 'services',
					'field'    => 'term_id',
					'terms'    => $_POST['term']
					]
					]
				) );
	}
	global $post;
	$card_number = 1;
	$posts = '';
	foreach( $my_posts as $post ){
		setup_postdata( $post );
		$term_list = wp_get_post_terms( $post->ID, 'services', array('fields' => 'names') );

		$img_id = carbon_get_post_meta( $post->ID, 'image_back' );
		if ( $post->ID != 37 && $post->ID != 51 && $post->ID != 54 ) {
			$st = ' style="display:none;"';
			$img_cl = '';
			$url = '#';
		} else {
			$st = '';
			$img_cl = ' front';
			$url = get_permalink();
		}
		?>
		<div class="featured__content__card" data-id="<?php echo $post->ID; ?>">
			<div class="featured__content__card-number<?php echo $card_number; ?>">
				<a class="featured__content__card__link" href="<?php the_permalink(); ?>"<?php echo $st; ?>></a>
				<div class="featured__content__card__img<?php echo $img_cl; ?>"><?php the_post_thumbnail(); ?></div>
				<div class="featured__content__card__img back" style="background: url(<?php echo wp_get_attachment_url( $img_id ); ?>);
				background-position: center; background-repeat: no-repeat; background-size: cover;"<?php echo $st; ?>></div>
				<div class="featured__content__card__title">
					<a href="<?php echo $url; ?>"><?php the_title(); ?></a>
				</div>
				<div class="featured__content__card__text"><?php echo implode(", " ,  $term_list);;?></div>
			</div>
		</div>
		<?php

		if ($card_number == 6) {
			$card_number = 0;
		}
		++$card_number;
	}
	$posts_list = '';
	foreach( $my_posts as $post ){
		setup_postdata( $post );
		$term_list = wp_get_post_terms( $post->ID, 'services', array('fields' => 'names') );

		if ( $post->ID != 37 && $post->ID != 51 && $post->ID != 54 ) {
			$url = '#';
		} else {
			$url = get_permalink();
		}
		?>
		<div class="extras__content__list">
			<a class="extras__content__list__link" href="<?php echo $url; ?>"></a>
			<div class="extras__content__list__title"><?php the_title(); ?></div>
			<div class="extras__content__list__industry"><?php echo axiomasoft_industryes_post($post->ID, ' / '); ?></div>
			<div class="extras__content__list__text"><?php echo implode(", " ,  $term_list);?></div>
			<div class="extras__content__list__img" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
		</div>
		<?php
	}
	wp_reset_postdata();

	//echo $posts;

	$posts_grid = json_encode($posts, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	$posts_lists = json_encode($posts_list, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

	echo json_encode(array('grid' => $posts_grid, 'list' => $posts_lists));

	wp_die();
}

// Reviews
function axiomasoft_reviews() {
	$reviews = carbon_get_theme_option( 'reviews' );
	foreach ($reviews as $review) { ?>
		<div class="swiper-slide slide-review">
			<div class="slide-review__img">
				<?php if ( $review['review_img'] ) { ?>
					<img src="<?php echo wp_get_attachment_image_url( $review['review_img'], 'full' );?>" alt="">
				<?php } ?>
			</div>
			<div class="slide-review__text"><?php echo $review['review_text'];?></div>
			<div class="slide-review__meta">
				<span class="slide-review__meta__name"><?php echo $review['review_title'];?></span>
				<span class="slide-review__meta__job"><?php echo $review['review_job'];?></span>
			</div>
		</div>
	<?php }
}

// Additional blocks
function axiomasoft_additional_blocks_post($post_id) {
	$additional_blocks = carbon_get_post_meta( $post_id, 'additional_blocks' );
	foreach ($additional_blocks as $additional_block) { ?>
		<div class="project-blocks__item">
			<h2 class="project-blocks__item__title section-title fw200 galderglynn-CdRg border-bottom container">
		    	<?php echo $additional_block['block_title'];?>
		    </h2>
			<div class="project-blocks__item__content container">
				<div class="project-blocks__item__content__text">
					<div class="project-blocks__item__content__text__title">
						<span><?php echo $additional_block['block_subtitle'];?></span>
					</div>
					<div class="project-blocks__item__content__text__text">
						<div class="project-blocks__item__content__text__text__wrap"><?php echo $additional_block['block_text'];?></div>
					</div>
				</div>
				<div class="project-blocks__item__content__gallery">
					<?php foreach ($additional_block['block_gallery'] as $image) {
						echo '<img src="' . wp_get_attachment_image_url( $image, 'full' ) . '" alt="">';
					}?>
				</div>
		    </div>
		</div>
	<?php }
}
