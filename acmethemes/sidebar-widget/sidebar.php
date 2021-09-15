<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function corporate_plus_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'corporate-plus' ),
        'id'            => 'corporate-plus-sidebar',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2><div class="line"><span></span></div>',
    ) );

    register_sidebar(array(
        'name' => __('Home Main Content Area', 'corporate-plus'),
        'id'   => 'corporate-plus-home',
        'description' => __('Displays widgets on home page main content area.', 'corporate-plus'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2><div class="line"><span></span></div>',
    ));

	register_sidebar(array(
		'name' => __('Footer Column One', 'corporate-plus'),
		'id' => 'footer-col-one',
		'description' => __('Displays items in copyright.', 'corporate-plus'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Footer Column Two', 'corporate-plus'),
		'id' => 'footer-col-two',
		'description' => __('Displays items on top footer section.', 'corporate-plus'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Footer Column Three', 'corporate-plus'),
		'id' => 'footer-col-three',
		'description' => __('Displays items on top footer section.', 'corporate-plus'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Footer Column Four', 'corporate-plus'),
		'id' => 'footer-col-four',
		'description' => __('Displays items on top footer section.', 'corporate-plus'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __('Footer Column Five', 'corporate-plus'),
		'id' => 'footer-col-five',
		'description' => __('Displays items on top footer section.', 'corporate-plus'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __('Footer Column six (double column)', 'corporate-plus'),
		'id' => 'footer-col-six',
		'description' => __('Displays items on top footer section.', 'corporate-plus'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __('Footer Column seven', 'corporate-plus'),
		'id' => 'footer-col-seven',
		'description' => __('Displays items on top footer section.', 'corporate-plus'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
    register_sidebar(array(
		'name' => __('Header top bar Left', 'corporate-plus'),
		'id' => 'header-left',
		'description' => __('Displays items on top bar Left', 'corporate-plus'),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
    register_sidebar(array(
		'name' => __('Header top bar Right', 'corporate-plus'),
		'id' => 'header-right',
		'description' => __('Displays items on top bar Right', 'corporate-plus'),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
    register_sidebar(array(
		'name' => __('Single Post bottom Part', 'corporate-plus'),
		'id' => 'post-content-after',
		'description' => __('Single Post bottom Part', 'corporate-plus'),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
}

add_action( 'widgets_init', 'corporate_plus_widgets_init' );