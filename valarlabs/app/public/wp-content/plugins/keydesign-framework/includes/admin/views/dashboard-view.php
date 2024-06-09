<?php
namespace KeyDesign;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use KeyDesign\Utils;

$theme_name = Utils::get_parent_theme_name();
$license_key = License\Admin::get_license_key();
$update_data = License\API::check_update( false /* Use Cache */ );

// Load Welcome Panel template
require_once KEYDESIGN_PATH . 'includes/admin/views/welcome-panel.php';
?>
<div class="kdadmin-dashboard">
	<div class="kdadmin-welcome-box">
		<div class="kdadmin-column-container">
			<h2 class="first-title"><?php esc_html_e( 'Theme Registration', 'keydesign-framework' ); ?></h2>
			<?php require_once KEYDESIGN_PATH . 'includes/admin/views/deactivate-notice.php'; ?>
			<div class="kdadmin-activate-wrapper">
				<?php
					// Load Activation Box template
					require_once KEYDESIGN_PATH . 'includes/admin/views/activation-box.php';
				?>
				<?php
					// Load Update Box template
					require_once KEYDESIGN_PATH . 'includes/admin/views/update-box.php';
				?>
				<?php
				 	// Load Support Box template
					require_once KEYDESIGN_PATH . 'includes/admin/views/support-box.php';
				?>
			</div>
	        <div class="kdadmin-column-container">
				<h2><?php esc_html_e( 'What\'s New', 'keydesign-framework' ); ?></h2>
				<div class="kdadmin-panel-column">
					<h3><span class="dashboard-icon lnricons-home"></span><?php printf( esc_html__( 'Welcome to %1$s', 'keydesign-framework' ), Utils::get_parent_theme_name() ); ?></h3>
					<p class="welcome-message"><?php esc_html_e( 'Thank you for choosing our theme. Create a site no time with stacks of layout designs, rich theme options and drag and drop content builder elements.', 'keydesign-framework' ); ?></p>

				</div>
				<?php if ( $license_key && $update_data[ 'status' ] ) : ?>
				<div class="kdadmin-panel-column">
					<h3><span class="dashboard-icon lnricons-history"></span><?php printf( esc_html__( 'What\'s new on version %1$s', 'keydesign-framework' ), $update_data['version'] ); ?></h3>
					<p><?php esc_html_e( 'View features, bug fixes or any other changes in the latest theme version.', 'keydesign-framework' ); ?></p>
					<?php add_thickbox(); ?>
					<div id="keydesign-changelog-modal" style="display:none;">
						<?php echo strip_tags( $update_data['changelog'], '<ol><ul><li><i><b><strong><span><p><br><a><blockquote>' ); ?>
					</div>
					<a title="<?php printf( esc_html__( 'What\'s new on version %1$s', 'keydesign-framework' ), $update_data['version'] ); ?>" class="kdadmin-button thickbox" href="#TB_inline?&width=720&height=550&inlineId=keydesign-changelog-modal"><?php esc_html_e( 'View changelog', 'keydesign-framework' ); ?></a>
				</div>
				<?php endif; ?>
				<div class="kdadmin-panel-column">
					<h3><span class="dashboard-icon lnricons-envelope"></span><?php esc_html_e( 'Subscribe', 'keydesign-framework' ); ?></h3>
					<p><?php esc_html_e( 'Subscribe to our newsletter to get notified for theme sales and promotional offers.', 'keydesign-framework' ); ?></p>

					<!-- Begin Mailchimp Signup Form -->
					<div id="mc_embed_signup">
						<form action="https://keydesign-themes.us5.list-manage.com/subscribe/post?u=8c94cdcb6defe2dc7cf56111c&amp;id=5e9df74e67&amp;f_id=004421ebf0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<div id="mc_embed_signup_scroll">
						<div class="mc-field-group">
						<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email Address">
						<span id="mce-EMAIL-HELPERTEXT" class="helper_text"></span>
					</div>
						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>
						<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_8c94cdcb6defe2dc7cf56111c_5e9df74e67" tabindex="-1" value=""></div>
						<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
						</div>
					</form>
					</div>
					<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
					<!--End mc_embed_signup-->
				</div>


				</div>
			</div>
			<div class="kdadmin-column-container">
				<h2><?php esc_html_e( 'Help & Support', 'keydesign-framework' ); ?></h2>
				<div class="kdadmin-panel-column">
					<h3><span class="dashboard-icon lnricons-book2"></span><?php esc_html_e( 'View Documentation', 'keydesign-framework' ); ?></h3>
					<p><?php esc_html_e( 'Helpful information about theme setup, capabilities, features and options.', 'keydesign-framework' ); ?></p>
					<a class="kdadmin-button" href="https://docs.keydesign.xyz/" target="_blank"><?php esc_html_e( 'Read documentation', 'keydesign-framework' ); ?></a>
				</div>
				<div class="kdadmin-panel-column">
					<h3><span class="dashboard-icon lnricons-lifebuoy"></span><?php esc_html_e( 'Support Center', 'keydesign-framework' ); ?></h3>
					<p><?php esc_html_e( 'Got a question or need help with the theme? You can always submit a support ticket.', 'keydesign-framework' ); ?></p>
					<a class="kdadmin-button" href="https://keydesign.ticksy.com/" target="_blank"><?php esc_html_e( 'Submit a ticket', 'keydesign-framework' ); ?></a>
				</div>
				<div class="kdadmin-panel-column">
					<h3><span class="dashboard-icon lnricons-users"></span><?php esc_html_e( 'Join the Community', 'keydesign-framework' ); ?></h3>
					<p><?php esc_html_e( 'Share your expertise, seek guidance, and connect with fellow enthusiasts.', 'keydesign-framework' ); ?></p>
					<a class="kdadmin-button" href="https://www.facebook.com/groups/354058971888447/" target="_blank"><?php esc_html_e( 'Join now', 'keydesign-framework' ); ?></a>
				</div>

			</div>

		</div>
	</div>

</div>