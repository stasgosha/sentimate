<footer class="footer" role="contentinfo">
    <div class="footer-row first">
        <div class="container">
            <div class="footer-inner">
                <div class="footer-block">
                    <a href="<?php echo get_home_url(); ?>" class="logo-block">
                        <img src="<?php echo get_field('logo','option')['url']; ?>" alt="<?php echo get_field('logo','option')['alt']; ?>">
                        <div class="block-text">
                           <?php echo get_field('text_logo','option');?>
                        </div>
                    </a>
                </div>
            
                <div class="footer-block">
                    <div class="footer-small-nav">
                            <?php
                            $args = array(
                                'theme_location'  => '',
                                'menu'            => 'Terms',
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
                                'items_wrap'      => '<ul  class="nav-links">%3$s</ul>',
                                'depth'           => 0
                            );
            
                            wp_nav_menu(  $args  );
                            ?>
            
                        <ul class="socials-list">
                            <?php if( have_rows('social','option') ): ?>
                                <?php
                                $i=0;
                                while( have_rows('social','option') ): the_row(); ?>
                                    <li>
                                        <a href="<?php echo get_sub_field('link');?>" target="_blank" rel="noopener nofollow" aria-label="<?php echo get_sub_field('icon');?>">
                                            <svg class="link-icon">
                                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#<?php echo get_sub_field('icon');?>"></use>
                                            </svg>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-row second">
        <div class="container">
            <div class="footer-inner">
                <div class="footer-block">
                    <p><?php echo get_field('footer_logo_text','option');?></p>
                </div>
            
                <div class="footer-block">
                    <p class="footer-copyright"><?php echo get_field('copyright','option');?></p>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<div class="modal video-modal" id="video-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <button class="modal-close" aria-label="Закрыть попап">
                <svg class="btn-icon">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#modal-close"></use>
                </svg>
            </button>
            <div class="modal-video">
                <div id="modal-video-iframe"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal white-bg" id="contact-sales-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <button class="modal-close" aria-label="Close modal"></button>

            <div class="contact-sales-block">
                <div class="logo-block">
                    <img src="<?php echo get_field('logo','option')['url'];?>" alt="<?php echo get_field('logo','option')['alt'];?>">
                    <div class="block-text">
                       <?php echo get_field('modal_logo','option');?>
                    </div>
                </div>

                <h2 class="block-caption"><?php echo get_field('modal_title','option');?></h2>

                <div class="block-text">
                    <p><?php echo get_field('modal_text','option');?></p>
                </div>

                <div class="contact-form form">
                    <?php echo do_shortcode('[contact-form-7 id="9" title="Contact Us"]');?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//www.youtube.com/iframe_api"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/slick.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/Revuze/js/product_template-demo.js"></script>
<script>
    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
</script>
<?php wp_footer(); ?>
</body>
</html>