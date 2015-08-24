<?php

/**
 * Security
 *
 * @package	Pilau_Starter
 * @since	0.1
 */


add_filter( 'clean_url', 'pilau_secure_internal_urls', 999999, 3 );
/**
 * Make sure any internal URL output using esc_url() uses HTTPS
 *
 * Since all URL output should go through esc_url(), this is a way of ensuring
 * internal URLs which may be manually entered into custom fields by editors
 * use the HTTPS protocol
 */
function pilau_secure_internal_urls( $url, $original_url, $_context ) {

	// Is this internal, and on a page using SSL?
	$url_parsed = parse_url( $url );
	if ( is_ssl() && $url_parsed['host'] == $_SERVER['HTTP_HOST'] ) {

		// Change HTTP to HTTPS
		$url = preg_replace( '/^http:\/\//', 'https://', $url );

	}

	return $url;
}


add_filter( 'image_send_to_editor', 'pilau_protocol_relative_image_urls', 999999 );
/**
 * Filter images sent to editor to make the URLs protocol-relative for possible SSL
 *
 * @since	0.1
 */
function pilau_protocol_relative_image_urls( $html ) {

	// Replace protocols with relative schema
	$html = str_replace( array( 'http://', 'https://' ), '//', $html );

	return $html;
}
