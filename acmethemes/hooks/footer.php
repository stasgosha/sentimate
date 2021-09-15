<?php
/**
 * Footer content
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'corporate_plus_footer' ) ) :

    function corporate_plus_footer() {

        global $corporate_plus_customizer_all_values;
        ?>
    <div class="clearfix"></div>
	<footer class="site-footer">
		<div class="container">
            <div class="bottom">
				<?php
				if(
					is_active_sidebar('footer-col-one') ||
					is_active_sidebar('footer-col-two') ||
					is_active_sidebar('footer-col-three') ||
					is_active_sidebar('footer-col-four')
				){
					$footer_top_col = 'col-md-3';
					?>
                    <div id="footer-top">
                        <div class="footer-columns clearfix">

							<div class="col-sm-12 col-md-8">
								<div class="row">
								<?php if( is_active_sidebar( 'footer-col-two' ) ) : ?>
								<div class="footer-sidebar col-sm-3 col-md-3">
									<?php dynamic_sidebar( 'footer-col-two' ); ?>
								</div>
								<?php endif;
								if( is_active_sidebar( 'footer-col-three' ) ) : ?>
								<div class="footer-sidebar col-sm-5 col-md-5">
									<?php dynamic_sidebar( 'footer-col-three' ); ?>
								</div>
								<?php endif;
								if( is_active_sidebar( 'footer-col-four' ) ) : ?>
								<div class="footer-sidebar col-sm-4 col-md-4">
									<?php dynamic_sidebar( 'footer-col-four' ); ?>
								</div>
								<?php endif; ?>
								
								<div class="clearfix"></div>
								
								<?php if( is_active_sidebar( 'footer-col-six' ) ) : ?>
								<div class="footer-sidebar double-column col-sm-8 col-md-8">
									<?php dynamic_sidebar( 'footer-col-six' ); ?>
								</div>
								<?php endif;
								if( is_active_sidebar( 'footer-col-seven' ) ) : ?>
								<div class="footer-sidebar col-sm-4 col-md-4">
									<?php dynamic_sidebar( 'footer-col-seven' ); ?>
								</div>
								<?php endif; ?>
								</div>
							</div>
							<?php if( is_active_sidebar( 'footer-col-five' ) ) : ?>
							<div class="footer-sidebar col-sm-12 col-md-4">
								<div class="footer-form">
									<?php dynamic_sidebar( 'footer-col-five' ); ?>
								</div>
							</div>
							<?php endif; ?>
                        </div>
                    </div><!-- #foter-top -->
                    <div class="clearfix"></div>
					<?php
				}
				?>
            </div><!-- bottom-->
            
            <?php
             if ( 1 == $corporate_plus_customizer_all_values['corporate-plus-enable-social'] ) {
                    /**
                     * Social Sharing
                     * corporate_plus_action_social_links
                     * @since Corporate Plus 1.1.0
                     *
                     * @hooked corporate_plus_social_links -  10
                     */
                    do_action('corporate_plus_action_social_links');
                }
             ?>
			<div class="clearfix"></div>
			
            <a href="#page" class="sm-up-container"><i class="fa fa-arrow-circle-up sm-up"></i></a>
		</div>
    </footer>

    <div class="footer-copyright border text-center">
        <div class="site-info">
			<?php if( is_active_sidebar( 'footer-col-one' ) ) : ?>
			<div class="copyright-info">
				<?php dynamic_sidebar( 'footer-col-one' ); ?>
			</div>
			<?php endif; ?>
			<?php if( isset( $corporate_plus_customizer_all_values['corporate-plus-footer-copyright'] ) ): ?>
			<p class="init-animate text-center animated fadeInLeft">
				<?php echo wp_kses_post( $corporate_plus_customizer_all_values['corporate-plus-footer-copyright'] ); ?>
				<a href="<?php echo esc_url( __( '/terms', 'corporate-plus' ) ); ?>"><?php printf( esc_html__( 'Terms of Use', 'corporate-plus' ) ); ?></a>
			</p><?php endif; ?>
			
        </div><!-- .site-info -->
    </div>
    <?php
    }
endif;
add_action( 'corporate_plus_action_footer', 'corporate_plus_footer', 10 );

/**
 * Page end
 *
 * @since Corporate Plus 1.1.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'corporate_plus_page_end' ) ) :

    function corporate_plus_page_end() {
        ?>
        </div><!-- #page -->
    <?php
    }
endif;
add_action( 'corporate_plus_action_after', 'corporate_plus_page_end', 10 );