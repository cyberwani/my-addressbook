<?php
/**
 * Get all address
 *
 * @param $args array
 *
 * @return array
 */
function myaddressbook_get_all_address( $args = array() ) {
	global $wpdb;

	$defaults = array(
		'number'     => 20,
		'offset'     => 0,
		'orderby'    => 'id',
		'order'      => 'ASC',
	);

	$args      = wp_parse_args( $args, $defaults );
	$cache_key = 'address-all';
	$items     = wp_cache_get( $cache_key, 'my-addressbook' );

	if ( false === $items ) {
		$items = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'addressbook ORDER BY ' . $args['orderby'] .' ' . $args['order'] .' LIMIT ' . $args['offset'] . ', ' . $args['number'] );

		wp_cache_set( $cache_key, $items, 'my-addressbook' );
	}

	return $items;
}

/**
 * Fetch all address from database
 *
 * @return array
 */
function myaddressbook_get_address_count() {
	global $wpdb;

	return (int) $wpdb->get_var( 'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'addressbook' );
}

/**
 * Fetch a single address from database
 *
 * @param int   $id
 *
 * @return array
 */
function myaddressbook_get_address( $id = 0 ) {
	global $wpdb;

	return $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'addressbook WHERE id = %d', $id ) );
}