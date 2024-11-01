<?php

/*
Plugin Name: Webseo Admin Theme
Plugin URI: 
Description: Plugin tùy chỉnh trang quản trị Wordpress - Webseo.com.vn
Author: Huy Tap
Version: 2.1
Author URI: http://webseo.com.vn
*/

function webseo_files() {
  wp_enqueue_style( 'webseo-admin-theme', plugins_url('css/webseo.css', __FILE__), array(), '1.1.7' );
  wp_enqueue_script( 'webseo', plugins_url( "js/webseo.js", __FILE__ ), array( 'jquery' ), '1.1.7' );
}
add_action( 'admin_enqueue_scripts', 'webseo_files' );
add_action( 'login_enqueue_scripts', 'webseo_files' );

function webseo_add_editor_styles() {
    add_editor_style( plugins_url('css/editor-style.css', __FILE__ ) );
}
add_action( 'after_setup_theme', 'webseo_add_editor_styles' );
add_filter('admin_footer_text', 'webseo_admin_footer_text_output');
function webseo_admin_footer_text_output($text) {
	$text = '<?php echo get_site_url(); ?>';
  return $text;
}
add_action( 'admin_head', 'webseo_colors' );
add_action( 'login_head', 'webseo_colors' );
function webseo_colors() {
	include( 'css/dynamic.php' );
}
function webseo_get_user_admin_color(){
	$user_id = get_current_user_id();
	$user_info = get_userdata($user_id);
	if ( !( $user_info instanceof WP_User ) ) {
		return; 
	}
	$user_admin_color = $user_info->admin_color;
	return $user_admin_color;
}

// Remove the hyphen before the post state
add_filter( 'display_post_states', 'webseo_post_state' );
function webseo_post_state( $post_states ) {
	if ( !empty($post_states) ) {
		$state_count = count($post_states);
		$i = 0;
		foreach ( $post_states as $state ) {
			++$i;
			( $i == $state_count ) ? $sep = '' : $sep = '';
			echo "<span class='post-state'>$state$sep</span>";
		}
	}
}

?>
