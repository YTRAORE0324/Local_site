<?php
add_filter( 'keydesign_theme_options', function( $setup ) {

    $fields = array(
        'blog_page_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Blog Page', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Blog Page', 'keydesign-framework' ),
        ),
        'blog_hide_title_bar' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Hide Blog Title Bar', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to hide the title bar on the main Blog page.', 'keydesign-framework' ),
            'value' => false,
            'group' => 'started',
            'submenu' => esc_html__( 'Blog Page', 'keydesign-framework' ),
        ),
        'blog_subtitle' => array(
            'type' => 'textarea',
            'label' => esc_html__( 'Blog Subtitle', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter a subtitle text for the blog page. Visible only on the main blog page configured in Settings > Reading.', 'keydesign-framework' ),
            'dependency' => array(
                'key' => 'blog_hide_title_bar',
                'value' => 'empty'
            ),
            'group' => 'ended',
            'submenu' => esc_html__( 'Blog Page', 'keydesign-framework' ),
        ),
        'blog_article_layout' => array(
            'label' => esc_html__( 'Article Layout', 'keydesign-framework' ),
            'description' => esc_html__( 'Select the layout for the main blog and archive type pages.', 'keydesign-framework' ),
            'type' => 'radio',
            'options' => array(
                'blog-layout-classic' => esc_html__( 'Classic', 'keydesign-framework' ),
                'blog-layout-horizontal' => esc_html__( 'Horizontal', 'keydesign-framework' ),
                'blog-layout-grid' => esc_html__( 'Grid', 'keydesign-framework' ),
            ),
            'value' => 'blog-layout-classic',
            'submenu' => esc_html__( 'Blog Page', 'keydesign-framework' ),
        ),
        'blog_sidebar' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Blog Sidebar', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display the Main Sidebar on blog and archive pages.', 'keydesign-framework' ),
            'value' => true,
            'group' => 'started',
            'submenu' => esc_html__( 'Blog Page', 'keydesign-framework' ),
        ),
        'blog_sidebar_position' => array(
            'label' => esc_html__( 'Sidebar Position', 'keydesign-framework' ),
            'type' => 'radio',
            'options' => array(
                'sidebar-left' => esc_html__( 'Left', 'keydesign-framework' ),
                'sidebar-right' => esc_html__( 'Right', 'keydesign-framework' ),
            ),
            'value' => 'sidebar-right',
            'dependency' => array(
                'key' => 'blog_sidebar',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Blog Page', 'keydesign-framework' ),
        ),
        'blog_sticky_sidebar' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Sticky Sidebar', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to keep the sidebar sticky as users scroll.', 'keydesign-framework' ),
            'value' => true,
            'dependency' => array(
                'key' => 'blog_sidebar',
                'value' => 'not_empty'
            ),
            'group' => 'ended',
            'submenu' => esc_html__( 'Blog Page', 'keydesign-framework' ),
        ),
        'single_post_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Single Post', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
        ),
        'blog_single_layout' => array(
            'label' => esc_html__( 'Single Post Layout', 'keydesign-framework' ),
            'description' => esc_html__( 'Select the layout for the single blog post pages.', 'keydesign-framework' ),
            'type' => 'radio',
            'options' => array(
                'blog-single-layout-classic' => esc_html__( 'Classic', 'keydesign-framework' ),
                'blog-single-layout-modern' => esc_html__( 'Modern', 'keydesign-framework' ),
            ),
            'value' => 'blog-single-layout-classic',
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
        ),
        'blog_single_hide_featured_image' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Hide Featured Image', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to hide the featured image on single blog post pages.', 'keydesign-framework' ),
            'value' => false,
            'dependency' => array(
                'key' => 'blog_single_layout',
                'value' => 'blog-single-layout-classic'
            ),
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
        ),
        'blog_single_sidebar' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Single Post Sidebar', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display the Main Sidebar on single blog post pages.', 'keydesign-framework' ),
            'value' => true,
            'group' => 'started',
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
        ),
        'blog_single_sidebar_position' => array(
            'label' => esc_html__( 'Sidebar Position', 'keydesign-framework' ),
            'type' => 'radio',
            'options' => array(
                'sidebar-left' => esc_html__( 'Left', 'keydesign-framework' ),
                'sidebar-right' => esc_html__( 'Right', 'keydesign-framework' ),
            ),
            'value' => 'sidebar-right',
            'dependency' => array(
                'key' => 'blog_single_sidebar',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
        ),
        'blog_single_sticky_sidebar' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Sticky Sidebar', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to keep the sidebar sticky as users scroll.', 'keydesign-framework' ),
            'value' => true,
            'group' => 'ended',
            'dependency' => array(
                'key' => 'blog_single_sidebar',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
        ),
        'blog_single_social_share' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Social Sharing Buttons', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display social sharing buttons.', 'keydesign-framework' ),
            'value' => true,
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
        ),
        'blog_single_author' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Author Box', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display the author description box.', 'keydesign-framework' ),
            'value' => true,
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
        ),
        'blog_single_pagination' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Previous/Next Pagination', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display previous/next pagination.', 'keydesign-framework' ),
            'value' => true,
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
        ),
        'blog_single_related_switch' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Related Posts', 'keydesign-framework' ),
            'description' => esc_html__( 'Turn on to display related posts.', 'keydesign-framework' ),
            'value' => true,
            'group' => 'started',
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
        ),
        'blog_single_related_title' => array(
            'type' => 'text',
            'label' => esc_html__( 'Related Posts Title', 'keydesign-framework' ),
            'description' => esc_html__( 'Enter a title for the Related Posts section.', 'keydesign-framework' ),
            'dependency' => array(
                'key' => 'blog_single_related_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
        ),
        'blog_single_related_number' => array(
            'type' => 'range_slider',
            'label' => esc_html__( 'Number of Related Posts', 'keydesign-framework' ),
            'description' => esc_html__( 'Select the number of related posts.', 'keydesign-framework' ),
            'min' => 2,
            'max' => 4,
            'step' => 1,
            'value' => 3,
            'dependency' => array(
                'key' => 'blog_single_related_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
            'group' => 'ended',
        ),
        'reading_bar_switch' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Reading Bar', 'keydesign-framework' ),
            'value' => true,
            'description' => esc_html__( 'Turn on to display a reading progress indicator. As you read the post or scroll the page, the progress bar is filled with color.', 'keydesign-framework' ),
            'group' => 'started',
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
        ),
        'reading_bar_color' => array(
            'type' => 'select',
            'label' => esc_html__( 'Reading Bar Color', 'keydesign-framework' ),
            'options' => array(
                'primary-background-color' => esc_html__( 'Primary', 'keydesign-framework' ),
                'secondary-background-color' => esc_html__( 'Secondary', 'keydesign-framework' ),
                'dark-background-color' => esc_html__( 'Dark', 'keydesign-framework' ),
            ),
            'value' => 'primary-background-color',
            'dependency' => array(
                'key' => 'reading_bar_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
        ),
        'reading_bar_height' => array(
            'type' => 'range_slider',
            'label' => esc_html__( 'Reading Bar Height', 'keydesign-framework' ),
            'description' => esc_html__( 'Select the height value of the reading bar.', 'keydesign-framework' ),
            'min' => 2,
            'max' => 10,
            'step' => 1,
            'value' => 5,
            'dependency' => array(
                'key' => 'reading_bar_switch',
                'value' => 'not_empty'
            ),
            'submenu' => esc_html__( 'Single Post', 'keydesign-framework' ),
            'group' => 'ended',
        ),
        'blog_meta_tab_label' => array(
            'type' => 'group_title',
            'label' => esc_html__( 'Blog Meta', 'keydesign-framework' ),
            'description' => esc_html__( 'Control the display of the blog post meta data.', 'keydesign-framework' ),
            'submenu' => esc_html__( 'Blog Meta', 'keydesign-framework' ),
        ),
        'post_meta_categories' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Post Meta Categories', 'keydesign-framework' ),
            'value' => true,
            'submenu' => esc_html__( 'Blog Meta', 'keydesign-framework' ),
        ),
        'post_meta_date' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Post Meta Date', 'keydesign-framework' ),
            'value' => true,
            'submenu' => esc_html__( 'Blog Meta', 'keydesign-framework' ),
        ),
        'post_meta_author' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Post Meta Author', 'keydesign-framework' ),
            'value' => true,
            'submenu' => esc_html__( 'Blog Meta', 'keydesign-framework' ),
        ),
        'post_meta_comments' => array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Post Meta Comments', 'keydesign-framework' ),
            'value' => true,
            'submenu' => esc_html__( 'Blog Meta', 'keydesign-framework' ),
        ),
    );

    $customFields = array(
        'name' => esc_html__( 'Blog', 'keydesign-framework' ),
        'icon' => 'lnricons-register',
        'fields' => $fields
    );

    $setup[ 'blog' ] = $customFields;

    return $setup;

}, 10, 1 );
