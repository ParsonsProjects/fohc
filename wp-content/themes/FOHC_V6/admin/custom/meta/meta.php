<?php

$meta_boxes = array();
$meta_boxes = apply_filters ( 'cmb_meta_boxes' , $meta_boxes );
foreach ( $meta_boxes as $meta_box ) {
	$my_box = new cmb_Meta_Box( $meta_box );
}

/**
 * Defines the url to which is used to load local resources.
 * This may need to be filtered for local Window installations.
 * If resources do not load, please check the wiki for details.
 */
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
       //winblows
    define( 'CMB_META_BOX_URL', trailingslashit( str_replace( DIRECTORY_SEPARATOR, '/', str_replace( str_replace( '/', DIRECTORY_SEPARATOR, WP_CONTENT_DIR ), WP_CONTENT_URL, dirname(__FILE__) ) ) ) );

} else {
  define('CMB_META_BOX_URL', apply_filters('cmb_meta_box_url',
    trailingslashit(str_replace(
      array(WP_CONTENT_DIR, WP_PLUGIN_DIR),
      array(WP_CONTENT_URL, WP_PLUGIN_URL),
      dirname( __FILE__ )
    ))
  ));
}


/**
 * Create meta boxes
 */
class cmb_Meta_Box {
	protected $_meta_box;

	function __construct( $meta_box ) {

		if ( !is_admin() ) return;

		$this->_meta_box = $meta_box;

		add_action( 'admin_menu', array( &$this, 'add' ) );
		add_action( 'save_post', array( &$this, 'save' ), 10, 2 );

	}

	// Add metaboxes
	function add() {

		$this->_meta_box['context'] = empty($this->_meta_box['context']) ? 'normal' : $this->_meta_box['context'];
		$this->_meta_box['priority'] = empty($this->_meta_box['priority']) ? 'high' : $this->_meta_box['priority'];
		$this->_meta_box['show_on'] = empty( $this->_meta_box['show_on'] ) ? array('key' => false, 'value' => false) : $this->_meta_box['show_on'];

		foreach ( $this->_meta_box['pages'] as $page ) {
			// if( apply_filters( 'cmb_show_on', true, $this->_meta_box ) )
				add_meta_box( $this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']) ;
		}

	}

	// Show fields
	function show() {

		global $post;

		// Use nonce for verification
		echo '<input type="hidden" name="wp_meta_box_nonce" value="', wp_create_nonce( basename(__FILE__) ), '" />';
		echo '<table class="form-table cmb_metabox">';

		foreach ( $this->_meta_box['fields'] as $field ) {
			// Set up blank or default values for empty ones
			if ( !isset( $field['name'] ) ) $field['name'] = '';
			if ( !isset( $field['desc'] ) ) $field['desc'] = '';
			$field['std'] = apply_filters( 'cmb_std_filter', ( isset( $field['std'] ) ? $field['std'] : '' ), $field );
			if ( 'file' == $field['type'] && !isset( $field['allow'] ) ) $field['allow'] = array( 'url', 'attachment' );
			if ( 'file' == $field['type'] && !isset( $field['save_id'] ) )  $field['save_id']  = false;
			if ( 'multicheck' == $field['type'] ) $field['multiple'] = true;

			$meta = get_post_meta( $post->ID, $field['id'], 'multicheck' != $field['type'] /* If multicheck this can be multiple values */ );

			echo '<tr class="cmb-type-'. sanitize_html_class( $field['type'] ) .' cmb_id_'. sanitize_html_class( $field['id'] ) .'">';

			if ( $field['type'] == "title" ) {
				echo '<td colspan="2">';
			} else {
				if( $this->_meta_box['show_names'] == true ) {
					echo '<th style="width:18%"><label for="', $field['id'], '">', $field['name'], '</label></th>';
				} else {
					echo '<label style="display:none;" for="', $field['id'], '">', $field['name'], '</label></th>';
				}
				echo '<td>';
			}

			switch ( $field['type'] ) {

				case 'title':
					echo '<h5 class="cmb_metabox_title">', $field['name'], '</h5>';
					echo '<p class="cmb_metabox_description">', $field['desc'], '</p>';
				break;

				case 'btns':
					$nonce = wp_create_nonce( 'user_nonce' );
					echo '<span class="spinner"></span>';
					foreach ( $field['options'] as $button ) {
						echo '<a href="" data-nonce="' . $nonce . '" data-post_id="' . $post->ID .'" ' . $button['data'] . ' class="' . $button['class'] . '" id="' . $button['id'] . '">' . $button['name'] . '</a>';
					}
				break;

				case 'text':
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" />','<p class="cmb_metabox_description">', $field['desc'], '</p>';
				break;

				case 'text_medium':
					echo '<input class="cmb_text_medium" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" /><span class="cmb_metabox_description">', $field['desc'], '</span>';
				break;

				case 'text_date':
					echo '<input class="cmb_text_small cmb_datepicker" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" /><span class="cmb_metabox_description">', $field['desc'], '</span>';
				break;

				case 'text_time':
					echo '<input class="cmb_timepicker text_time" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" /><span class="cmb_metabox_description">', $field['desc'], '</span>';
				break;

				case 'text_datetime_timestamp':
					echo '<input class="cmb_text_small cmb_datepicker" type="text" name="', $field['id'], '[date]" id="', $field['id'], '_date" value="', '' !== $meta ? date( 'm\/d\/Y', $meta ) : $field['std'], '" />';
					echo '<input class="cmb_timepicker text_time" type="text" name="', $field['id'], '[time]" id="', $field['id'], '_time" value="', '' !== $meta ? date( 'h:i A', $meta ) : $field['std'], '" /><span class="cmb_metabox_description" >', $field['desc'], '</span>';
				break;

				case 'text_money':
					echo ! empty( $field['before'] ) ? '' : '£', ' <input class="cmb_text_money" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" /><span class="cmb_metabox_description">', $field['desc'], '</span>';
				break;				

				case 'textarea':
					echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="10">', '' !== $meta ? $meta : $field['std'], '</textarea>','<p class="cmb_metabox_description">', $field['desc'], '</p>';
				break;

				case 'colorpicker':
					$meta = '' !== $meta ? $meta : $field['std'];
					$hex_color = '(([a-fA-F0-9]){3}){1,2}$';
					if ( preg_match( '/^' . $hex_color . '/i', $meta ) ) // Value is just 123abc, so prepend #.
						$meta = '#' . $meta;
					elseif ( ! preg_match( '/^#' . $hex_color . '/i', $meta ) ) // Value doesn't match #123abc, so sanitize to just #.
						$meta = "#";
					echo '<input class="cmb_colorpicker cmb_text_small" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta, '" /><span class="cmb_metabox_description">', $field['desc'], '</span>';
				break;

				case 'select':
					if( empty( $meta ) && !empty( $field['std'] ) ) $meta = $field['std'];
					echo '<select name="', $field['id'], '" id="', $field['id'], '">';
					foreach ($field['options'] as $option) {
						echo '<option value="', $option['value'], '"', $meta == $option['value'] ? ' selected="selected"' : '', '>', $option['name'], '</option>';
					}
					echo '</select>';
					echo '<p class="cmb_metabox_description">', $field['desc'], '</p>';
				break;

				case 'radio':
					if( empty( $meta ) && !empty( $field['std'] ) ) $meta = $field['std'];
					echo '<ul>';
					$i = 1;
					foreach ($field['options'] as $option) {
						echo '<li><input type="radio" name="', $field['id'], '" id="', $field['id'], $i,'" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' /><label for="', $field['id'], $i, '">', $option['name'].'</label></li>';
						$i++;
					}
					echo '</ul>';
					echo '<p class="cmb_metabox_description">', $field['desc'], '</p>';
				break;

				case 'checkbox':
					echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
					echo '<span class="cmb_metabox_description">', $field['desc'], '</span>';
				break;

				case 'multicheck':
					echo '<ul>';
					$i = 1;
					foreach ( $field['options'] as $value => $name ) {
						// Append `[]` to the name to get multiple values
						// Use in_array() to check whether the current option should be checked
						echo '<li><input type="checkbox" name="', $field['id'], '[]" id="', $field['id'], $i, '" value="', $value, '"', in_array( $value, $meta ) ? ' checked="checked"' : '', ' /><label for="', $field['id'], $i, '">', $name, '</label></li>';
						$i++;
					}
					echo '</ul>';
					echo '<span class="cmb_metabox_description">', $field['desc'], '</span>';
				break;

				case 'wp_users':
					$output = '<div id="select_users" class="clearfix">';
					$meta = get_post_meta( $post->ID, $field['id'], false);
					
					if(empty($meta)) {

						$wp_users = get_users('orderby=nicename');
						$nonce = wp_create_nonce( 'user_nonce' );

						$output .= '<div id="users_unselected">';
							$output .= '<div class="users_header">';
				            	$output .= '<h4>All Users</h4>';
				            $output .= '</div>';
							$output .= '<ul>';
							foreach ($wp_users as $user) { 
								$user_tags = get_the_author_meta( '_user_teams', $user->ID );
		                    	$user_position = get_the_author_meta( '_user_position', $user->ID );
		                    	$teams = '';
		                    	if ( !empty($user_tags) ) {
									foreach( $user_tags as $user_tag ) { 
										$teams = ' in-teams-' . $user_tag;
									}
								}

								$output .= '<li class="user clearfix">';
									$output .= '<div class="user_avatar">' . get_avatar( $user->ID, 42 ) . '</div>';
									$output .= '<label for="user_' . $user->ID . '">';
									$output .= '<input class="' . $teams . '" id="user_' . $user->ID . '" type="checkbox" name="' . $field['id'] . '[]" class="" value="' . $user->ID . '" /></label>';
									$output .= '<div class="user_name">' . esc_attr( $user->display_name ) . '' . esc_attr($user_position) . '</div>';
									$output .= '<div class="actions">';
			                            $output .= '<a href="" class="select_user button button-primary">Select</a>';
			                            $output .= '<span class="spinner"></span>';
			                            $output .= '<a style="display:none;" data-email_type="single" data-nonce="' . $nonce . '" data-user_id="' . $user->ID . '" class="re_send_email button">Re-Send</a>';
			                        $output .= '</div>';
								$output .= '</li>';

							}
							$output .= '</ul>';
						$output .= '</div>';
						$output .= '<div id="users_selected">';
							$output .= '<div class="users_header">';
				            	$output .= '<h4>Selected Users</h4>';
				            $output .= '</div>';
							$output .= '<ul>';
							$output .= '</ul>';
						$output .= '</div>';

					} else {

						$wp_users_selected =  implode(",",$meta['0']); 
						$wp_users = get_users('orderby=nicename&exclude=' . $wp_users_selected);
						$nonce = wp_create_nonce( 'user_nonce' );

						$output .= '<div id="users_unselected">';
							$output .= '<div class="users_header">';
				            	$output .= '<h4>All Users</h4>';
				            $output .= '</div>';
							$output .= '<ul>';
							foreach ($wp_users as $user) { 

								$user_tags 			= get_the_author_meta( '_user_teams', $user->ID );
		                    	$user_position 		= get_the_author_meta( '_user_position', $user->ID );
		                    	$post_meta          = get_post_meta($post->ID, '_events_meta', true);
		                    	$post_meta_status  	= ($post_meta != '') ? $post_meta[$user->ID]["status"] : array();
		                    	$teams = '';	
		                    	if ( !empty($user_tags) ) {
									foreach( $user_tags as $user_tag ) { 
										$teams = ' in-teams-' . $user_tag;
									}
								}	                    	

								$output .= '<li class="user clearfix">';
									$output .= '<div class="user_avatar">' . get_avatar( $user->ID, 42 ) . '</div>';
									$output .= '<label for="user_' . $user->ID . '">';
									$output .= '<input class="' . $teams . '" id="user_' . $user->ID . '" type="checkbox" name="' . $field['id'] . '[]" class="" value="' . $user->ID . '" /></label>';
									$output .= '<div class="user_name">' . esc_attr( $user->display_name ) . '' . esc_attr($user_position) . '</div>';
									$output .= '<div class="actions">';
			                            $output .= '<a href="" class="select_user button button-primary">Select</a>';
			                            $output .= '<span class="spinner"></span>';
			                            $output .= '<a style="display:none;" data-email_type="single" data-nonce="' . $nonce . '" data-user_id="' . $user->ID . '" class="re_send_email button">Re-Send</a>';
			                        $output .= '</div>';
								$output .= '</li>';
							}
							$output .= '</ul>';
						$output .= '</div>';

						$wp_users = get_users('orderby=nicename&include=' . $wp_users_selected);

						$output .= '<div id="users_selected">';
							$output .= '<div class="users_header">';
				            	$output .= '<h4>Selected Users</h4>';
				            $output .= '</div>';
							$output .= '<ul>';
							foreach ($wp_users as $user) { 

								$user_tags 			= get_the_author_meta( '_user_teams', $user->ID );
		                    	$user_position 		= get_the_author_meta( '_user_position', $user->ID );
		                    	$post_meta          = get_post_meta($post->ID, '_events_meta', true);
		                    	$post_meta_status  	= ($post_meta != '') ? $post_meta[$user->ID]["status"] : array();
		                    	$teams = '';
		                    	if ( !empty($user_tags) ) {
									foreach( $user_tags as $user_tag ) { 
										$teams = ' in-teams-' . $user_tag;
									}
								}

								$output .= '<li class="user clearfix">';
									$output .= '<div class="user_avatar">' . get_avatar( $user->ID, 42 ) . '</div>';
									$output .= '<label for="user_' . $user->ID . '">';
									$output .= '<input class="' . $teams . '" checked="checked" id="user_' . $user->ID . '" type="checkbox" name="' . $field['id'] . '[]" class="" value="' . $user->ID . '" /></label>';
									$output .= '<div class="user_name">' . esc_attr( $user->display_name ) . '' . esc_attr($user_position) . '</div>';
									switch ($post_meta_status) {
		                                case 'accepted':
		                                    $output .= '<div class="user_status">Attending</div>';
		                                break;

		                                case 'declined':
		                                    $output .= '<div class="user_status">Declined</div>';
		                                break;

		                                default:
		                                    $output .= '<div class="user_status">No Response</div>';
		                                break;
		                            } 
									$output .= '<div class="actions">';
			                            $output .= '<a href="" class="select_user button button-primary">Select</a>';
			                            $output .= '<span class="spinner"></span>';
			                            $output .= '<a data-email_type="single" data-nonce="' . $nonce . '" data-user_id="' . $user->ID . '" class="re_send_email button">Re-Send</a>';
			                        $output .= '</div>';
								$output .= '</li>';
							}
							$output .= '</ul>';
						$output .= '</div>';

					}

					$output .= '</div>';
					$output .= '<span class="cmb_metabox_description">' . $field['desc'] . '</span>';

					echo $output;
				break;

				default:
					do_action('cmb_render_' . $field['type'] , $field, $meta);
			}

			echo empty( $field['after'] ) ? '' : $field['after'];

			echo '</td>','</tr>';
		}
		echo '</table>';
		do_action( 'cmb_after_table', $post, $this->_meta_box );

	}

	// Save data from metabox
	function save( $post_id, $post )  {

		// verify nonce
		if ( ! isset( $_POST['wp_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['wp_meta_box_nonce'], basename(__FILE__) ) ) {
			return $post_id;
		}

		// check autosave
		if ( defined('DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// check permissions
		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		// get the post types applied to the metabox group
		// and compare it to the post type of the content
		$post_type = $post->post_type;
		$meta_type = $this->_meta_box['pages'];
		$type_comp = in_array($post_type, $meta_type) ? true : false;

		foreach ( $this->_meta_box['fields'] as $field ) {
			$name = $field['id'];

			if ( ! isset( $field['multiple'] ) )
				$field['multiple'] = ( 'multicheck' == $field['type'] ) ? true : false;

			$old = get_post_meta( $post_id, $name, !$field['multiple'] /* If multicheck this can be multiple values */ );
			$new = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : null;

			if ( $type_comp == true && in_array( $field['type'], array( 'taxonomy_select', 'taxonomy_radio', 'taxonomy_multicheck' ) ) )  {
				$new = wp_set_object_terms( $post_id, $new, $field['taxonomy'] );
			}

			if ( ($field['type'] == 'textarea') || ($field['type'] == 'textarea_small') ) {
				$new = htmlspecialchars( $new );
			}

			if ( ($field['type'] == 'textarea_code') ) {
				$new = htmlspecialchars_decode( $new );
			}

			if ( $type_comp == true && $field['type'] == 'text_date_timestamp' ) {
				$new = strtotime( $new );
			}

			if ( $type_comp == true && $field['type'] == 'text_datetime_timestamp' ) {
				$string = $new['date'] . ' ' . $new['time'];
				$new = strtotime( $string );
			}

			$new = apply_filters('cmb_validate_' . $field['type'], $new, $post_id, $field);

			// validate meta value
			if ( isset( $field['validate_func']) ) {
				$ok = call_user_func( array( 'cmb_Meta_Box_Validate', $field['validate_func']), $new );
				if ( $ok === false ) { // pass away when meta value is invalid
					continue;
				}
			} elseif ( $field['multiple'] ) {
				delete_post_meta( $post_id, $name );
				if ( !empty( $new ) ) {
					foreach ( $new as $add_new ) {
						add_post_meta( $post_id, $name, $add_new, false );
					}
				}
			} elseif ( '' !== $new && $new != $old  ) {
				update_post_meta( $post_id, $name, $new );
			} elseif ( '' == $new ) {
				delete_post_meta( $post_id, $name );
			}

		}

	}

}

/**
 * Adding scripts and styles
 */
function cmb_scripts( $hook ) {
	global $wp_version;
	// only enqueue our scripts/styles on the proper pages
	if ( $hook == 'post.php' || $hook == 'post-new.php' || $hook == 'page-new.php' || $hook == 'page.php' ) {
		// scripts required for cmb
		$cmb_script_array = array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'media-upload', 'thickbox' );
		// styles required for cmb
		$cmb_style_array = array( 'thickbox' );
		// if we're 3.5 or later, user wp-color-picker
		if ( 3.5 <= $wp_version ) {
			$cmb_script_array[] = 'wp-color-picker';
			$cmb_style_array[] = 'wp-color-picker';
		} else {
			// otherwise use the older 'farbtastic'
			$cmb_script_array[] = 'farbtastic';
			$cmb_style_array[] = 'farbtastic';
		}
		wp_register_script( 'cmb-timepicker', CMB_META_BOX_URL . 'js/jquery.timePicker.min.js' );
		wp_register_script( 'cmb-scripts', CMB_META_BOX_URL . 'js/cmb.js', $cmb_script_array, '0.9.4' );
		wp_localize_script( 'cmb-scripts', 'cmb_ajax_data', array( 'ajax_nonce' => wp_create_nonce( 'ajax_nonce' ), 'post_id' => get_the_ID() ) );
		wp_enqueue_script( 'cmb-timepicker' );
		wp_enqueue_script( 'cmb-scripts' );
		wp_register_style( 'cmb-styles', CMB_META_BOX_URL . 'css/style.css', $cmb_style_array );
		wp_register_style( 'jquery-ui-1.10.3.custom.min', CMB_META_BOX_URL . 'css/jquery-ui-1.10.3.custom.min.css', $cmb_style_array );
		wp_enqueue_style( 'jquery-ui-1.10.3.custom.min' );
		wp_enqueue_style( 'cmb-styles' );
	}
}
add_action( 'admin_enqueue_scripts', 'cmb_scripts', 10 );

?>