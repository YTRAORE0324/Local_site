<?php
/**
 * Theme header
 *
 * This is the template that displays all of the <head> section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
 
 use KeyDesign\Utils;

defined( 'ABSPATH' ) || exit;

?><!DOCTYPE html>
<?php keydesign_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
    <?php keydesign_head_top(); ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
    <?php keydesign_head_bottom(); ?>
</head>

<body <?php body_class();?>>
<?php keydesign_body_top(); ?>
<?php wp_body_open(); ?>
    <div id="page" class="site">
        <?php
            keydesign_header_before();
            keydesign_header();
            keydesign_header_after();
            keydesign_content_before();
    	?>
        <div id="content" class="site-content">
            <?php keydesign_content_top(); ?>
