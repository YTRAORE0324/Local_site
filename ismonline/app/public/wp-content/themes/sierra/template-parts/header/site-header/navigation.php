<?php
/**
 * Navigation layout.
 */
?>

<div class="main-navigation-wrapper main-menu-container" id="main-navigation-wrapper">
    <button aria-controls="nav" id="nav-toggle" class="nav-toggle" type="button">
        <span class="icon-bar"></span>
    </button>

    <nav id="nav" class="nav-primary nav-menu">
        <?php wp_nav_menu( array(
            'theme_location' => 'primary',
            'container'      => false,
            'depth'          => 4,
            'menu_class'     => 'menu-items',
            'menu_id'        => 'main-menu',
            'echo'           => true,
            'fallback_cb'    => '\Nav_Walker::fallback',
            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'has_dropdown'   => true,
            'walker'         => new Nav_Walker(),
        ) ); ?>
  </nav><!-- #nav -->
</div>
