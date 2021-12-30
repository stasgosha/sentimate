<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<!-- qwe -->
	<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-K2FJTH2');</script>
	<!-- End Google Tag Manager -->
	
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slick.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slick-theme.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css?v=5">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?v=5">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K2FJTH2"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	
<div class="wrapper" id="top">
    <header class="header">
        <div class="container">
            <div class="header-inner">
                <div class="header-block header-left">
                    <a href="<?php echo get_home_url();?>" class="logo-block">
                        <img src="<?php echo get_field('logo','option')['url'];?>" alt="<?php echo get_field('logo','option')['alt'];?>">
                        <div class="block-text">
                           <?php echo get_field('text_logo','option');?>
                        </div>
                    </a>

                    <nav class="top-nav md-hidden">
                        <?php
                        $args = array(
                            'theme_location'  => '',
                            'menu'            => 'Menu',
                            'container'       => '',
                            'container_class' => '',
                            'container_id'    => '',
                            'menu_class'      => 'menu',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_page_menu',
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul  class="">%3$s</ul>',
                            'depth'           => 0
                        );

                        wp_nav_menu(  $args  );
                        ?>
                    </nav>
                </div>

                <div class="header-block header-right md-hidden">
                    <?php if(!$_COOKIE['userid']){ ?>
                    <a href="<?php echo get_permalink('15284');?>"  class="auth-btn">
                        <svg class="btn-icon">
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#user"></use>
                        </svg>
                        <span class="btn-text"><?php echo get_field('login_text','option');?></span>
                    </a>
                    <?php }else{ ?>
                        <a href="#" id="logout"  class="auth-btn">
                            <svg class="btn-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#user"></use>
                            </svg>
                            <span class="btn-text">Logout</span>
                        </a>
                    <?php } ?>
                    <a href="<?php echo get_field('header_button_link','option');?>" class="btn"><?php echo get_field('header_button_text','option');?></a>
                </div>

                <div class="header-block md-visible">
                    <button class="menu-opener" aria-label="Show navigation">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="mobile-top-nav">
            <div class="nav-inner">
                <a href="<?php echo get_permalink(get_field('singin_page','option'));?>"  class="auth-btn">
                    <svg class="btn-icon">
                        <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#user"></use>
                    </svg>
                    <span class="btn-text"><?php echo get_field('login_text','option');?></span>
                </a>

                <?php
                $args = array(
                    'theme_location'  => '',
                    'menu'            => 'Menu',
                    'container'       => '',
                    'container_class' => '',
                    'container_id'    => '',
                    'menu_class'      => 'menu',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul  class="">%3$s</ul>',
                    'depth'           => 0
                );

                wp_nav_menu(  $args  );
                ?>

                <div class="nav-footer">
                    <a href="<?php echo get_field('header_button_link','option');?>" class="btn"><?php echo get_field('header_button_text','option');?></a>
                </div>
            </div>
        </div>
    </header>