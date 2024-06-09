<?php
namespace KeyDesign;
use KeyDesign\Utils;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

require_once KEYDESIGN_PATH . 'includes/admin/views/welcome-panel.php'; ?>

<div class="kdadmin-dashboard kdadmin-help">
  <div class="kdadmin-docs-wrapper">
    <div class="kdadmin-welcome-box postbox">
      <div class="kdadmin-intro-text">
        <h2><?php echo esc_html__( 'Documentation', 'keydesign-framework' ); ?></h2>
        <p><?php echo sprintf( esc_html__( 'Choose the help section you want to explore or read the complete %s.', 'keydesign-framework' ), '<a href="https://docs.keydesign.xyz/" target="_blank">' . esc_html__( 'documentation', 'keydesign-framework' ) . '</a>' ); ?></p>
        </p>
      </div>
    </div>
    <div class="kdadmin-documentation">
      <ul>
        <li>
          <a href="https://docs.keydesign.xyz/article-categories/general/" target="_blank"><span class="cat-icon"></span><?php esc_html_e( 'General', 'keydesign-framework' ); ?></a>
        </li>
        <li>
          <a href="https://docs.keydesign.xyz/article-categories/getting-started/" target="_blank"><span class="cat-icon"></span><?php esc_html_e( 'Getting started', 'keydesign-framework' ); ?></a>
        </li>
        <li>
          <a href="https://docs.keydesign.xyz/article-categories/site-setup/" target="_blank"><span class="cat-icon"></span><?php esc_html_e( 'Site setup', 'keydesign-framework' ); ?></a>
        </li>
        <li>
          <a href="https://docs.keydesign.xyz/article-categories/blog/" target="_blank"><span class="cat-icon"></span><?php esc_html_e( 'Blog', 'keydesign-framework' ); ?></a>
        </li>
        <li>
          <a href="https://docs.keydesign.xyz/article-categories/portfolio/" target="_blank"><span class="cat-icon"></span><?php esc_html_e( 'Portfolio', 'keydesign-framework' ); ?></a>
        </li>
        <li>
          <a href="https://docs.keydesign.xyz/article-categories/shop/" target="_blank"><span class="cat-icon"></span><?php esc_html_e( 'Shop', 'keydesign-framework' ); ?></a>
        </li>
        <li>
          <a href="https://docs.keydesign.xyz/article-categories/how-to/" target="_blank"><span class="cat-icon"></span><?php esc_html_e( 'How to', 'keydesign-framework' ); ?></a>
        </li>
        <li>
          <a href="https://docs.keydesign.xyz/article-categories/troubleshooting/" target="_blank"><span class="cat-icon"></span><?php esc_html_e( 'Troubleshooting', 'keydesign-framework' ); ?></a>
        </li>
        <li>
          <a href="https://docs.keydesign.xyz/article-categories/developer/" target="_blank"><span class="cat-icon"></span><?php esc_html_e( 'Developer', 'keydesign-framework' ); ?></a>
        </li>
      </ul>
    </div>
  </div>
  	<div class="kdadmin-support-box">
  	<?php
	 	// Load Support Box
		require_once KEYDESIGN_PATH . 'includes/admin/views/support-box.php';
	?>
    <div class="kdadmin-support-info">
      <h2><?php echo esc_html__( 'Customer Support', 'keydesign-framework' ); ?></h2>
	    <p><?php echo sprintf( esc_html__( 'You can ask questions about the theme\'s features or report bugs. To get help, go to our %s and open a ticket.', 'keydesign-framework' ), '<a href="https://keydesign.ticksy.com/" target="_blank">' . esc_html__( 'support center', 'keydesign-framework' ) . '</a>' ); ?></p>
      <h3><?php echo esc_html__( 'Our support includes the following:', 'keydesign-framework' ); ?></h3>
      <ul>
        <li><span><i class="lnricons-checkmark-circle"></i><?php echo esc_html__( 'Answering any questions about theme functionality, and technical capabilities.', 'keydesign-framework' ); ?></span></li>
        <li><span><i class="lnricons-checkmark-circle"></i><?php echo esc_html__( 'Helping with setting up the features that are included in our themes and configuring theme settings.', 'keydesign-framework' ); ?></span></li>
        <li><span><i class="lnricons-checkmark-circle"></i><?php echo esc_html__( 'Fixing bugs or issues.', 'keydesign-framework' ); ?></span></li>
      </ul>
      <h3><?php echo esc_html__( 'Our support does not extend to:', 'keydesign-framework' ); ?></h3>
      <ul>
        <li><span><i class="lnricons-cross-circle"></i><?php echo esc_html__( 'Custom code or code modifications.', 'keydesign-framework' ); ?></span></li>
        <li><span><i class="lnricons-cross-circle"></i><?php echo esc_html__( 'Adding new functionality or third-party plug-ins.', 'keydesign-framework' ); ?></span></li>
      </ul>
    </div>
  </div>
</div>
