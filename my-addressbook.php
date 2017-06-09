<?php
/*
Plugin Name: My Address Book
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Lorem Ipsum
Author: Dinesh K
Version: 1.0
Author URI: http://ma.tt/
*/

add_action( 'init', function(){
	
	include dirname(__FILE__).'/includes/class-address-admin-menu.php';
	include dirname(__FILE__).'/includes/class-address-list-table.php';
	include dirname(__FILE__).'/includes/class-form-handler.php';
	include dirname(__FILE__).'/includes/address-functions.php';
	include dirname(__FILE__).'/includes/functions-address.php';
	
	new Address_Admin_Menu();
} );