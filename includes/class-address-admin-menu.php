<?php
/**
 * Admin Menu
 */
class Address_Admin_Menu {

	/**
	 * Kick-in the class
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/**
	 * Add menu items
	 *
	 * @return void
	 */
	public function admin_menu() {

		/** Top Menu **/
		add_menu_page( __( 'Addressbook', 'my-addressbook' ), __( 'Addressbook', 'my-addressbook' ), 'manage_options', 'addressbook', array( $this, 'plugin_page' ), 'dashicons-groups', null );

		add_submenu_page( 'addressbook', __( 'Addressbook', 'my-addressbook' ), __( 'Addressbook', 'my-addressbook' ), 'manage_options', 'addressbook', array( $this, 'plugin_page' ) );
	}

	/**
	 * Handles the plugin page
	 *
	 * @return void
	 */
	public function plugin_page() {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
		$id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

		switch ($action) {
			case 'view':

				$template = dirname( __FILE__ ) . '/views/address-single.php';
				break;

			case 'edit':
				$template = dirname( __FILE__ ) . '/views/address-edit.php';
				break;

			case 'new':
				$template = dirname( __FILE__ ) . '/views/address-new.php';
				break;

			default:
				$template = dirname( __FILE__ ) . '/views/address-list.php';
				break;
		}

		if ( file_exists( $template ) ) {
			include $template;
		}
	}
}