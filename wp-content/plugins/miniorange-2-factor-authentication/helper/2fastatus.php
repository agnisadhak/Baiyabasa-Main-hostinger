<?php
/**
 * This file contains all function to show users 2fa details.
 *
 * @package miniorange-2-factor-authentication/userstwofastatus/helper
 */

// Needed in both.

use TwoFA\Helper\MoWpnsConstants;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Function to show user details
 *
 * @return void
 */
function mo2f_show_user_details() {
	global $mo2fdb_queries,$wpdb;
	$users = $wpdb->get_results( // phpcs:ignore WordPress.DB.DirectDatabaseQuery.NoCaching , WordPress.DB.DirectDatabaseQuery.DirectQuery -- Direct database call without caching detected.
		'SELECT * FROM ' . $wpdb->base_prefix . 'mo2f_user_details'
	);

	foreach ( $users as $user ) {
		$user_roles = ( get_userdata( $user->user_id )->roles );
		$user_role  = '';
		foreach ( $user_roles as $userrole ) {
			if ( get_site_option( 'mo2fa_' . $userrole ) ) {
				$user_role = $userrole;
			}
		}
		$wp_user = get_user_by( 'id', $user->user_id );
		if ( get_site_option( 'mo2fa_' . $user_role ) ) {
						$mo2f_method_selected          = $mo2fdb_queries->get_user_detail( 'mo2f_configured_2FA_method', $user->user_id );
						$mo2f_user_registration_status = $mo2fdb_queries->get_user_detail( 'mo_2factor_user_registration_status', $user->user_id );
						echo '<tr><td>' . esc_html( $wp_user->user_login ) .
						'</td><td>' . esc_html( $user->mo2f_user_email ) .
						'</td><td>' . esc_html( $user_role ) .
						'</td><td>' .
						'<span>';
						echo esc_html( ( empty( $mo2f_method_selected ) ) ? 'None' : $mo2f_method_selected );
						echo '</span>';

						echo '</td><td>';
			if ( ( 'MO_2_FACTOR_INITIALIZE_TWO_FACTOR' === $mo2f_user_registration_status || 'MO_2_FACTOR_PLUGIN_SETTINGS' === $mo2f_user_registration_status ) && ( get_option( 'mo2f_email' ) !== $user->mo2f_user_email || MO2F_IS_ONPREM ) ) {    ?>
							<form action="<?php echo esc_url( wp_nonce_url( 'users.php?page=reset&amp;action=reset_edit&amp;user_id=' . esc_attr( $user->user_id ), 'reset_edit', 'mo2f_reset-2fa' ) ); ?>" method="post" name="reset2fa" id="reset2fa">
							<input type="submit" name="mo2f_reset_2fa" id="mo2f_reset_2fa" value="Reset 2FA" class="mo2f-reset-settings-button" />
						</form>
							<?php
			}

						echo '</td> </tr>';
		} else {
			continue;
		}
	}

}
