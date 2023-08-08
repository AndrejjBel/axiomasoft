<?php

add_action( 'init', 'axiomasoft_register_post_types' );

function axiomasoft_register_post_types(){
    register_taxonomy( 'services', [ 'projects' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Services',
			'singular_name'     => 'Service',
			'search_items'      => 'Search Services',
			'all_items'         => 'All Services',
			'view_item '        => 'View Service',
			'parent_item'       => 'Parent Service',
			'parent_item_colon' => 'Parent Service:',
			'edit_item'         => 'Edit Service',
			'update_item'       => 'Update Service',
			'add_new_item'      => 'Add New Service',
			'new_item_name'     => 'New Service Name',
			'menu_name'         => 'Service',
			'back_to_items'     => '← Back to Service',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		// 'publicly_queryable'    => null, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => true, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => null, // равен аргументу show_ui
		'hierarchical'          => true,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => true, // добавить в REST API
		'rest_base'             => true, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );

	register_post_type( 'projects', [
		'label'  => null,
		'labels' => [
			'name'               => 'Projects', // основное название для типа записи
			'singular_name'      => 'Project', // название для одной записи этого типа
			'add_new'            => 'Add new Project', // для добавления новой записи
			'add_new_item'       => 'Add new Project', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Edit Project', // для редактирования типа записи
			'new_item'           => 'New Project', // текст новой записи
			'view_item'          => 'View Project', // для просмотра записи этого типа.
			'search_items'       => 'Search Project', // для поиска по этим типам записи
			'not_found'          => 'No Project found', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'No Project found in Trash', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Projects', // название меню
		],
		'description'            => '',
		'public'                 => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'           => true, // показывать ли в меню админки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => true, // добавить в REST API. C WP 4.7
		'rest_base'           => true, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-portfolio',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => ['services'],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );

    // Messages post type
    register_post_type( 'messages', [
   	  // 'taxonomies' => ['nedvigimost-cat'],
      'label' => esc_html__( 'Messages', 'my-post-type' ),
      'labels' => array(
        'menu_name' => esc_html__( 'Messages', 'text-domain' ),
        'name_admin_bar' => esc_html__( 'Messages', 'text-domain' ),
        'add_new' => esc_html__( 'Add Message', 'text-domain' ),
        'add_new_item' => esc_html__( 'Add new Message', 'text-domain' ),
        'new_item' => esc_html__( 'New Message', 'text-domain' ),
        'edit_item' => esc_html__( 'Edit Message', 'text-domain' ),
        'view_item' => esc_html__( 'View Message', 'text-domain' ),
        'update_item' => esc_html__( 'Update Message', 'text-domain' ),
        'all_items' => esc_html__( 'Messages', 'text-domain' ),
        'search_items' => esc_html__( 'Search Message', 'text-domain' ),
        'parent_item_colon' => esc_html__( 'Parent Message', 'text-domain' ),
        'not_found' => esc_html__( 'No Messages found', 'text-domain' ),
        'not_found_in_trash' => esc_html__( 'No Messages found in Trash', 'text-domain' ),
        'name' => esc_html__( 'Messages', 'text-domain' ),
        'singular_name' => esc_html__( 'Message', 'text-domain' ),
      ),
      'public' => false,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-email-alt',
      'capability_type' => 'post',
      'hierarchical' => true,
      'has_archive' => true,
      'query_var' => true,
      'can_export' => true,
      'rewrite_no_front' => false,
      'supports' => array(
        'title',
        'editor',
        'author',
        // 'thumbnail',
        // 'excerpt',
        // 'trackbacks',
        'custom-fields',
        // 'comments',
        // 'page-attributes',
      ),
      'rewrite' => true,
    ]);

    // Reviews post type
    register_post_type( 'reviews', [
      'label' => esc_html__( 'Reviews', 'my-post-type' ),
      'labels' => array(
        'menu_name' => esc_html__( 'Reviews', 'text-domain' ),
        'name_admin_bar' => esc_html__( 'Reviews', 'text-domain' ),
        'add_new' => esc_html__( 'Add Review', 'text-domain' ),
        'add_new_item' => esc_html__( 'Add new Review', 'text-domain' ),
        'new_item' => esc_html__( 'New Review', 'text-domain' ),
        'edit_item' => esc_html__( 'Edit Review', 'text-domain' ),
        'view_item' => esc_html__( 'View Review', 'text-domain' ),
        'update_item' => esc_html__( 'Update Review', 'text-domain' ),
        'all_items' => esc_html__( 'Reviews', 'text-domain' ),
        'search_items' => esc_html__( 'Search Review', 'text-domain' ),
        'parent_item_colon' => esc_html__( 'Parent Review', 'text-domain' ),
        'not_found' => esc_html__( 'No Reviews found', 'text-domain' ),
        'not_found_in_trash' => esc_html__( 'No Reviews found in Trash', 'text-domain' ),
        'name' => esc_html__( 'Reviews', 'text-domain' ),
        'singular_name' => esc_html__( 'Review', 'text-domain' ),
      ),
      'public' => false,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-star-filled',
      'capability_type' => 'post',
      'hierarchical' => true,
      'has_archive' => true,
      'query_var' => true,
      'can_export' => true,
      'rewrite_no_front' => false,
      'supports' => array(
        'title',
        'editor',
        'author',
        'thumbnail',
        // 'excerpt',
        // 'trackbacks',
        'custom-fields',
        // 'comments',
        // 'page-attributes',
      ),
      'rewrite' => true,
    ]);
}
