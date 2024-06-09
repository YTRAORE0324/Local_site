<?php
/**
 * Theme footer
 *
 * The template for displaying the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

defined( 'ABSPATH' ) || exit;
?>

<?php keydesign_content_bottom(); ?>
</div><!-- #content -->
<?php
	keydesign_content_after();
	keydesign_footer_before();
	keydesign_footer();
	keydesign_footer_after();
?>
</div><!-- #page -->

<?php
	keydesign_body_bottom();
	wp_footer();
?>

</body>
</html>
