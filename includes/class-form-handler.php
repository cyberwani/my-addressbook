<?php
/**
 * Handle the form submissions
 *
 * @package Package
 * @subpackage Sub Package
 */
class Form_Handler {

	/**
	 * Hook 'em all
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'handle_form' ) );
	}

	/**
	 * Handle the address new and edit form
	 *
	 * @return void
	 */
	public function handle_form() {
		if ( ! isset( $_POST['submit_address'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'address-new' ) ) {
			die( __( 'Are you cheating?', 'my-addressbook' ) );
		}

		if ( ! current_user_can( 'read' ) ) {
			wp_die( __( 'Permission Denied!', 'my-addressbook' ) );
		}

		$errors   = array();
		$page_url = admin_url( 'admin.php?page=addressbook' );
		$field_id = isset( $_POST['field_id'] ) ? intval( $_POST['field_id'] ) : 0;

		$name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
		$phone = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
		$email = isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '';
		$website = isset( $_POST['website'] ) ? sanitize_text_field( $_POST['website'] ) : '';
		$address = isset( $_POST['address'] ) ? wp_kses_post( $_POST['address'] ) : '';

		// some basic validation
		if ( ! $name ) {
			$errors[] = __( 'Error: Name is required', 'my-addressbook' );
		}

		// bail out if error found
		if ( $errors ) {
			$first_error = reset( $errors );
			$redirect_to = add_query_arg( array( 'error' => $first_error ), $page_url );
			wp_safe_redirect( $redirect_to );
			exit;
		}

		$fields = array(
			'name' => $name,
			'phone' => $phone,
			'email' => $email,
			'website' => $website,
			'address' => $address,
		);

		// New or edit?
		if ( ! $field_id ) {

			$insert_id = myaddressbook_insert_address( $fields );

		} else {

			$fields['id'] = $field_id;

			$insert_id = myaddressbook_insert_address( $fields );
		}

		if ( is_wp_error( $insert_id ) ) {
			$redirect_to = add_query_arg( array( 'message' => 'error' ), $page_url );
		} else {
			$redirect_to = add_query_arg( array( 'message' => 'success' ), $page_url );
		}

		wp_safe_redirect( $redirect_to );
		exit;
	}
}

new Form_Handler();