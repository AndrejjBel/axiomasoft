<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

function multiselect_industryes() {
	$results = carbon_get_theme_option( 'industryes' );
    $results_arr = [];
    foreach ($results as $result) {
        $results_arr[$result['industry']] = $result['industry'];
    }

	return $results_arr;
}

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
    $partners_labels = array(
        'plural_name' => 'Partners',
        'singular_name' => 'Partner',
    );
    $industryes_labels = array(
        'plural_name' => 'Industryes',
        'singular_name' => 'Industry',
    );
	$reviews_labels = array(
        'plural_name' => 'Reviews',
        'singular_name' => 'Review',
    );
	$blocks_labels = array(
        'plural_name' => 'Blocks',
        'singular_name' => 'Block',
    );

    Container::make( 'theme_options', __( 'Theme Options' ) )
        ->set_page_menu_position( 4 )
        ->set_icon( 'dashicons-admin-customizer' )
        ->add_tab( __( 'General' ), array(
            Field::make( 'text', 'email_send', __( 'E-mail to send messages' ) ),
			Field::make( 'checkbox', 'collect_addresses', 'Сollect e-mail for mailing?' )
    			->set_option_value( 'yes' ),
            Field::make( 'complex', 'industryes', __( 'Industryes' ) )
                ->setup_labels( $industryes_labels )
                ->set_collapsed( 'boolean' )
                ->add_fields( array(
                    Field::make( 'text', 'industry', __( 'Industry' ) )
                ) )
                ->set_header_template( '
                    <% if (industry) { %>
                        Industry: <%- industry %>
                    <% } %>
                ' )
        ) )

        ->add_tab( __( 'Partners' ), array(
            Field::make( 'complex', 'partners_logo', __( 'Partners logo' ) )
                ->setup_labels( $partners_labels )
                ->set_collapsed( 'boolean' )
                ->add_fields( array(
                    Field::make( 'text', 'partner_title', __( 'Title partner' ) )
                        ->set_required( true ),
                    Field::make( 'image', 'partners_item_img', __( 'Partner logo' ) )
                    // ->set_value_type( 'url' ),
                ) )
                ->set_header_template( '
                    <% if (partner_title) { %>
                        Partner: <%- partner_title %>
                    <% } %>
                ' )
        ) )

		->add_tab( __( 'Reviews' ), array(
            Field::make( 'complex', 'reviews', __( 'Reviews' ) )
                ->setup_labels( $reviews_labels )
                ->set_collapsed( 'boolean' )
                ->add_fields( array(
                    Field::make( 'text', 'review_title', __( 'Review title' ) )
                        ->set_required( true ),
					Field::make( 'text', 'review_job', __( 'Job title' ) )
                        ->set_required( true ),
					Field::make( 'textarea', 'review_text', __( 'Review text' ) )
						->set_required( true ),
                    Field::make( 'image', 'review_img', __( 'Partner logo' ) )
                    // ->set_value_type( 'url' ),
                ) )
                ->set_header_template( '
                    <% if (review_title) { %>
                        Review: <%- review_title %>
                    <% } %>
                ' )
        ) );

    // Project
	Container::make( 'post_meta', 'Additionally' )
        ->where( 'post_type', '=', 'projects' )
        ->add_tab( __( 'Project review' ), array(
            Field::make( 'text', 'title_general', __( 'Title block' ) ),
            Field::make( 'rich_text', 'brief', __( 'Brief' ) ),
            Field::make( 'text', 'year', __( 'Year' ) )
                ->set_attribute( 'type', 'number' ),
            Field::make( 'text', 'live_site', __( 'Live site' ) ),
            //Field::make( 'text', 'industry', __( 'Industry' ) ),
            Field::make( 'multiselect', 'industryes', __( 'Industryes' ) )
            	->set_options( 'multiselect_industryes' ),
            Field::make( 'image', 'general_img', __( 'Image' ) ),
        ))

		->add_tab( __( 'Additional blocks' ), array(
			Field::make( 'complex', 'additional_blocks', __( 'Additional blocks' ) )
                ->setup_labels( $blocks_labels )
                ->set_collapsed( 'boolean' )
                ->add_fields( array(
                    Field::make( 'text', 'block_title', __( 'Title block' ) ),
					Field::make( 'text', 'block_subtitle', __( 'Subtitle block' ) ),
					Field::make( 'textarea', 'block_text', __( 'Text block' ) ),
					Field::make( 'media_gallery', 'block_gallery', __( 'Media Gallery block' ) )
                ) )
                ->set_header_template( '
                    <% if (block_title) { %>
                        Block: <%- block_title %>
                    <% } %>
                ' )
        ))

		->add_tab( __( 'Image back' ), array(
			Field::make( 'image', 'image_back', __( 'Image back' ) ),
        ));

	// Reviews
	// Container::make( 'post_meta', 'Additionally' )
	// 	->where( 'post_type', '=', 'reviews' )
	// 	->add_fields( array(
	// 		Field::make( 'text', 'reviews_job', __( 'Job title' ) )
	// 	));
}
