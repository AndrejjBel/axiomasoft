<?php
require get_template_directory() . '/inc/post-types.php';
require get_template_directory() . '/inc/carbon-fields/carbon-fields-plugin.php';
require get_template_directory() . '/inc/carbon-fields.php';

// Adds a main styles and scripts.
add_action( 'wp_enqueue_scripts', 'axiomasoft_main_scripts_old', 99 );
function axiomasoft_main_scripts_old() {
    wp_enqueue_style('swiper', get_stylesheet_directory_uri() . '/src/swiper/swiper-bundle.min.css', array(),
        filemtime( get_stylesheet_directory() . '/src/swiper/swiper-bundle.min.css' )
    );
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/dist/main.min.css',	array(),
        filemtime( get_stylesheet_directory() . '/dist/main.min.css' )
    );

    wp_enqueue_script('jq-marquee', get_stylesheet_directory_uri() . '/js/jquery.marquee.min.js', array('jquery'),
        filemtime( get_stylesheet_directory() . '/js/jquery.marquee.min.js' )
    );
    wp_enqueue_script('swiper', get_stylesheet_directory_uri() . '/src/swiper/swiper-bundle.min.js', array(),
        filemtime( get_stylesheet_directory() . '/src/swiper/swiper-bundle.min.js' )
    );
    wp_enqueue_script('main', get_stylesheet_directory_uri() . '/dist/bundle.min.js', array('jquery', 'jq-marquee'),
        filemtime( get_stylesheet_directory() . '/dist/bundle.min.js' )
    );
    wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js',	array(),
        filemtime( get_stylesheet_directory() . '/js/custom.js' )
    );
}

// Add defer to js
add_filter( 'script_loader_tag', 'axiomasoft_add_async_attribute', 10, 2 );
function axiomasoft_add_async_attribute( $tag, $handle ) {
	$handles = array(
        'jq-marquee',
		'main',
        'swiper',
        'custom'
	);
	foreach( $handles as $defer_script) {
		if ( $defer_script === $handle ) {
			return str_replace( ' src', ' defer="defer" src', $tag );
		}
	}
	return $tag;
}

// Mail
add_action( 'wp_ajax_nopriv_form_start', 'axiomasoft_submit' );
add_action( 'wp_ajax_form_start', 'axiomasoft_submit' );
function axiomasoft_submit(){
    $error = array();

    if ( !wp_verify_nonce( $_POST['nonce'], 'axiomasoft' ) ) {
      $error['empty_nonce'] = 'Возникли проблемы, попробуйте еще раз позже.';
    }
    if ( !$_POST['email'] ) {
      $error['email_error'] = 'Не указан email';
    }
    if ( !is_email( $_POST['email'] ) ) {
  	  $error['email_error_nocorrect'] = 'Указан не корректный E-mail.';
    }
    if ( !$_POST['message'] ) {
  	  $error['message_error'] = 'Не указан message';
    }
    if ( !$_POST['privacy-policy'] ) {
  	  $error['privacy_policy_error'] = 'Не указан privacy-policy';
    }

    if ( count( $error ) > 0 ) {
      $error['class'] = 'errors';
      $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
      echo $error_fin;
      wp_die();
    } else {
        $email_send = carbon_get_theme_option( 'email_send'); //'creat-sites@yandex.ru';
        //$admin_email = get_bloginfoget_bloginfo('admin_email');
        $from = 'webmaster@axiomasoft.com';

        $home_url = get_home_url() . $_POST['_wp_http_referer'];

        $mailTo = $email_send;
    	$subject = "Website message";
    	$headers= "MIME-Version: 1.0\r\n";
    	$headers .= "Content-type: text/html; charset=utf-8\r\n";
    	$headers .= 'From: ' . $from . ' <' . $from . '>\r\n';
    	$msgotprav = '<h1><b>Message</b></h1>';
        $msgotprav .= ( $_POST['first-name'] )? 'Full name: <b>' . $_POST['first-name'] . '</b><br>' : 'Full name: not indicated<br>';
        $msgotprav .= ( $_POST['last-name'] )? 'Last name: <b>' . $_POST['last-name'] . '</b><br>' : 'Last name: not indicated<br>';
        $msgotprav .= ( $_POST['company'] )? 'Company: <b>' . $_POST['company'] . '</b><br>' : 'Company: not indicated<br>';
        $msgotprav .= ( $_POST['job-title'] )? 'Job title: <b>' . $_POST['job-title'] . '</b><br>' : 'Job title: not indicated<br>';
        $msgotprav .= ( $_POST['interested'] )? 'Interested: <b>' . $_POST['interested'] . '</b><br>' : 'Interested: not indicated<br>';
        $msgotprav .= ( $_POST['message'] )? 'Message: <b>' . $_POST['message'] . '</b><br>' : 'Message: not indicated<br>';
        $msgotprav .= ( $_POST['phone'] )? 'Phone: <b>' . $_POST['phone'] . '</b><br>' : 'Phone: not indicated<br>';
        $msgotprav .= ( $_POST['email'] )? 'E-mail: <b>' . $_POST['email'] . '</b><br>' : 'E-mail: not indicated<br>';
        $msgotprav .= 'Sent from page: ' . $home_url;
    	if(mail($mailTo, $subject, $msgotprav, $headers)) {
            mail('a.dremlyuga@axiomasoft.com', $subject, $msgotprav, $headers);
            $error['class'] = 'success';
            $error['return'] = 'Thank you, we will send the answer to the specified by you E-mail: ' . $_POST['email'] . ' as soon as possible!';
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
    	} else {
    		echo "Message not sent!";
    	}

        $title = wp_date( 'H:i:s d-m-Y' );
        $post_data = array(
          'post_author'   => 1,
          'post_status'   => 'pending',
          'post_type'     => 'messages',
          'post_title'    => $title,
          'post_content'  => $msgotprav,
        );
        $post_id = wp_insert_post( $post_data );
        if ($post_id) {
            $new_title = '#'.$post_id;
            $post_update = array(
                'ID'         => $post_id,
                'post_title' => $new_title
            );
            wp_update_post( $post_update );
        }
        if ( get_option('_collect_addresses') == 'yes' ) {
            if ( $_POST['subscribe'] == 'yes' ) {
                $subscribe_emails = get_option('subscribe_emails');
                if ( $subscribe_emails ) {
                    array_push($subscribe_emails, $_POST['email']);
                } else {
                    $subscribe_emails = [];
                    array_push($subscribe_emails, $_POST['email']);
                }
                update_option( 'subscribe_emails', $subscribe_emails );
            }
        }

        wp_die();
    }
    wp_die();
}

$taxname = 'services';

// Поля при добавлении элемента таксономии
add_action("{$taxname}_add_form_fields", 'add_new_custom_fields');
// Поля при редактировании элемента таксономии
add_action("{$taxname}_edit_form_fields", 'edit_new_custom_fields');

// Сохранение при добавлении элемента таксономии
add_action("create_{$taxname}", 'save_custom_taxonomy_meta');
// Сохранение при редактировании элемента таксономии
add_action("edited_{$taxname}", 'save_custom_taxonomy_meta');

function edit_new_custom_fields( $term ) {
	?>
		<tr class="form-field">
			<th scope="row" valign="top"><label>Order</label></th>
			<td>
				<input type="number" name="extra[order]" value="<?php echo esc_attr( get_term_meta( $term->term_id, 'order', 1 ) ) ?>"><br />
			</td>
		</tr>
	<?php
}

function add_new_custom_fields( $taxonomy_slug ){
	?>
	<div class="form-field">
		<label for="tag-order">Order</label>
		<input name="extra[order]" id="tag-order" type="text" value="" />
	</div>
	<?php
}

function save_custom_taxonomy_meta( $term_id ) {
	if ( ! isset($_POST['extra']) ) return;
	if ( ! current_user_can('edit_term', $term_id) ) return;
	if (
		! wp_verify_nonce( $_POST['_wpnonce'], "update-tag_$term_id" ) && // wp_nonce_field( 'update-tag_' . $tag_ID );
		! wp_verify_nonce( $_POST['_wpnonce_add-tag'], "add-tag" ) // wp_nonce_field('add-tag', '_wpnonce_add-tag');
	) return;

	// Все ОК! Теперь, нужно сохранить/удалить данные
	$extra = wp_unslash($_POST['extra']);

	foreach( $extra as $key => $val ){
		// проверка ключа
		$_key = sanitize_key( $key );
		if( $_key !== $key ) wp_die( 'bad key'. esc_html($key) );

		// очистка
		if( $_key === 'tag_posts_shortcode_links' )
			$val = sanitize_textarea_field( strip_tags($val) );
		else
			$val = sanitize_text_field( $val );

		// сохранение
		if( ! $val )
			delete_term_meta( $term_id, $_key );
		else
			update_term_meta( $term_id, $_key, $val );
	}

	return $term_id;
}
