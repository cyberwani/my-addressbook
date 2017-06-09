<?php
/**
 * Insert a new address
 *
 * @param array $args
 */
function myaddressbook_insert_address( $args = array() ) {
	global $wpdb;

	$defaults = array(
		'id'         => null,
		'name' => '',
		'phone' => '',
		'email' => '',
		'website' => '',
		'address' => '',

	);

	$args       = wp_parse_args( $args, $defaults );
	$table_name = $wpdb->prefix . 'addressbook';

	// some basic validation
	if ( empty( $args['name'] ) ) {
		return new WP_Error( 'no-name', __( 'No Name provided.', 'my-addressbook' ) );
	}

	// remove row id to determine if new or update
	$row_id = (int) $args['id'];
	unset( $args['id'] );

	if ( ! $row_id ) {

		$args['date'] = current_time( 'mysql' );

		// insert a new
		if ( $wpdb->insert( $table_name, $args ) ) {
			return $wpdb->insert_id;
		}

	} else {

		// do update method here
		if ( $wpdb->update( $table_name, $args, array( 'id' => $row_id ) ) ) {
			return $row_id;
		}
	}

	return false;
}