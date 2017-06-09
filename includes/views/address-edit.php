<div class="wrap">
	<h1><?php _e( 'Add Address', 'my-addressbook' ); ?></h1>

	<?php $item = myaddressbook_get_address( $id ); ?>

	<form action="" method="post">

		<table class="form-table">
			<tbody>
				<tr class="row-name">
					<th scope="row">
						<label for="name"><?php _e( 'Name', 'my-addressbook' ); ?></label>
					</th>
					<td>
						<input type="text" name="name" id="name" class="regular-text" placeholder="<?php echo esc_attr( '', 'my-addressbook' ); ?>" value="<?php echo esc_attr( $item->name ); ?>" required="required" />
					</td>
				</tr>
				<tr class="row-phone">
					<th scope="row">
						<label for="phone"><?php _e( 'Phone', 'my-addressbook' ); ?></label>
					</th>
					<td>
						<input type="text" name="phone" id="phone" class="regular-text" placeholder="<?php echo esc_attr( '', 'my-addressbook' ); ?>" value="<?php echo esc_attr( $item->phone ); ?>" />
					</td>
				</tr>
				<tr class="row-email">
					<th scope="row">
						<label for="email"><?php _e( 'E-Mail', 'my-addressbook' ); ?></label>
					</th>
					<td>
						<input type="text" name="email" id="email" class="regular-text" placeholder="<?php echo esc_attr( '', 'my-addressbook' ); ?>" value="<?php echo esc_attr( $item->email ); ?>" />
					</td>
				</tr>
				<tr class="row-website">
					<th scope="row">
						<label for="website"><?php _e( 'Website', 'my-addressbook' ); ?></label>
					</th>
					<td>
						<input type="text" name="website" id="website" class="regular-text" placeholder="<?php echo esc_attr( '', 'my-addressbook' ); ?>" value="<?php echo esc_attr( $item->website ); ?>" />
					</td>
				</tr>
				<tr class="row-address">
					<th scope="row">
						<label for="address"><?php _e( 'Address', 'my-addressbook' ); ?></label>
					</th>
					<td>
						<textarea name="address" id="address"placeholder="<?php echo esc_attr( '', 'my-addressbook' ); ?>" rows="5" cols="30"><?php echo esc_textarea( $item->address ); ?></textarea>
					</td>
				</tr>
			 </tbody>
		</table>

		<input type="hidden" name="field_id" value="<?php echo $item->id; ?>">

		<?php wp_nonce_field( 'address-new' ); ?>
		<?php submit_button( __( 'Update Address', 'my-addressbook' ), 'primary', 'submit_address' ); ?>

	</form>
</div>