<?php
/**
 * About This Version administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once( dirname( __FILE__ ) . '/admin.php' );

if ( ! wp_is_mobile() ) {
	wp_enqueue_style( 'wp-mediaelement' );
	wp_enqueue_script( 'wp-mediaelement' );
	wp_localize_script( 'mediaelement', '_wpmejsSettings', array(
		'pluginPath'        => includes_url( 'js/mediaelement/', 'relative' ),
		'pauseOtherPlayers' => '',
	) );
}

/**
 * Replaces the height and width attributes with values for full size.
 *
 * wp_video_shortcode() limits the width to 640px.
 *
 * @since 4.6.0
 * @ignore
 *
 * @param $output Video shortcode HTML output.
 * @return string Filtered HTML content to display video.
 */
function _wp_override_admin_video_width_limit( $output ) {
	return str_replace( array( '640', '384' ), array( '1050', '630' ), $output );
}

$video_url = 'https://videopress.com/embed/GbdhpGF3?hd=true';
$locale    = str_replace( '_', '-', get_locale() );
list( $locale ) = explode( '-', $locale );
if ( 'en' !== $locale ) {
	$video_url = add_query_arg( 'defaultLangCode', $locale, $video_url );
}

$title = __( 'About' );

list( $display_version ) = explode( '-', $wp_version );

include( ABSPATH . 'wp-admin/admin-header.php' );
?>
	<div class="wrap about-wrap">
		<h2><?php  echo "Wlcome to Department of Public Enterprises Bloging System ." ?></h2>

	</div>	


		

		
