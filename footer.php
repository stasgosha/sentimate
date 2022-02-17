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


<?php if (getPageByTemplate('page-templates/pricing-temp.php') != get_the_ID()) : ?>
    <div class="popUp modal" id="popUp" tabindex="-1">
        <div class="popUp-dialog modal-dialog">
            <div class="popUp-content modal-content">
                <button  class="popUp-close js-modal-close" aria-label="Закрыть попап">
                    <svg class="btn-icon">
                        <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/content-images/modals/jam_close-circle-f.svg#close-popUp"></use>
                    </svg>
                </button>
                <div class="popUp-wrapper">
                    <div class="popUp-form">
                        <div class="popUp-form__main">
                            <div id="login_wrapper" style="display: none">
                                <div class="wrapper">
                                    <div class="form__wrapper">
                                        <form id="login-form" method="GET">
                                            <h2 class="form__header">Welcome back!<br>Sign into your account</h2>
                                            <div class="google-button-wrapper">
                                                <button id="signin_google" type="button"
                                                        class="registration registration-button registration-button--google">
                                                    <div class="registration-button--google__icon"></div>
                                                    Sign in with google
                                                    <div class="registration button-corner"></div>
                                                </button>
                                            </div>
                                            <p class="option-text"><span>or</span></p>
                                            <div class="form__group form__group__email">
                                                <label class="form__label" for="email">User email</label>
                                                <input type="text" id="email" name="email" class="form__input"
                                                       autocomplete="new-password" />
                                                <div class="error-message error-message__email"></div>
                                            </div>
                                            <div class="form__group form__group__password">
                                                <label class="form__label" for="password_login">Password</label>
                                                <input type="password" id="password_login" name="password" class="form__input"
                                                       autocomplete="new-password" />
                                                <div class="error-message error-message__password"></div>
                                                <div class="eye-icon eye-icon--hide togglePassword_login"></div>
                                                <a href="#" id="reset_password" class="forgot-password">Forgot Password?</a>
                                            </div>
                                            <div class="form__group">
                                                <div class="error-message" style="display: none;" id="error-message-login"></div>
                                            </div>
                                            <div class="buttons-wrapper">
                                                <div class="button-wrapper">
                                                    <button type="button" id="login" class="login login-button">
                                                        Sign In
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="noAccount">
                                                <p class="noAccount__text">Don't have an account?</p>
                                                <a class="noAccount__link" href="#" id="signup" rel="nooStyledLinksener noreferrer">Sign
                                                    up
                                                    here</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                            <div id="register_wrapper">
                                <div class="wrapper">
                                    <div class="register_wrapper__title">
                                        <h2>Create your account</h2>
                                    </div>

                                    <div class="form__wrapper">
                                        <form id="signup-form" method="POST">

                                            <div class="google-button-wrapper">
                                                <button id="signup_google" type="button"
                                                        class="registration registration-button registration-button--google">
                                                    <div class="registration-button--google__icon"></div>
                                                    Sign up with google
                                                    <div class="registration button-corner"></div>
                                                </button>
                                            </div>
                                            <p class="option-text"><span>or</span></p>

                                            <div class="form__group form__group__email">
                                                <label class="form__label" for="signin_email">email</label>
                                                <input type="text" id="signin_email" name="email" class="form__input"
                                                       autocomplete="email" />
                                                <div class="error-message error-message__email"></div>
                                            </div>
                                            <div class="form__group form__group__password">
                                                <label class="form__label" for="signin_password">Create password</label>
                                                <input type="password" id="signin_password" name="password" class="form__input"
                                                       autocomplete="new-password" />
                                                <div class="error-message error-message__password"></div>
                                                <div class="eye-icon eye-icon--hide togglePassword_signin"></div>
                                            </div>
                                            <div class="form__group form__group__password-confirmation">
                                                <label class="form__label" for="password-confirmation">Confirm password</label>
                                                <input type="password" name="password-confirmation" id="password-confirmation" class="form__input"
                                                       autocomplete="new-password" />
                                                <span class="error-message error-message__password-confirmation"></span>
                                                <div data-input-id="password-confirmation"
                                                     class="eye-icon eye-icon--hide togglePassword_signin_confirm"></div>
                                            </div>
                                            <div class="form__group">
                                                <div class="error-message" style="display: none;" id="error-message-signin"></div>
                                            </div>

                                            <div class="footer-menu">
                                                <div>
                                                    By clicking "Create your account", you agree to Sentimate’s
                                                    <a class="footer-menu__list-item__link" href="/terms-of-use/" target="_blank"
                                                       rel="nooStyledLinksener noreferrer">Terms of Service</a>
                                                    and
                                                    <a class="footer-menu__list-item__link" href="/privacy-policy/" target="_blank"
                                                       rel="nooStyledLinksener noreferrer">Privacy Policy</a>
                                                </div>
                                            </div>

                                            <div class="buttons-wrapper">
                                                <div class="registration-button-wrapper">
                                                    <button type="button" id="signin"
                                                            class="registration registration-button registration-button--colored">
                                                        Create Your Account
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="noAccount">
                                                <p class="noAccount__text">Already have an account?</p>
                                                <a class="noAccount__link" href="#" id="switchToSignIn" rel="nooStyledLinksener noreferrer">Sign in
                                                    here</a>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="popUp-form__side">
                            <div class="popUp-form__side-list">
                                <ul>
                                    <li>
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/modals/img1.png" alt="">
                                    </li>
                                    <li>
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/modals/img2.png" alt="">
                                    </li>
                                    <li>
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/content-images/modals/img3.png" alt="">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>



<!--<div class="modal white-bg" id="contact-sales-modalpage" tabindex="-1">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <button class="modal-close" aria-label="Close modal"></button>-->
<!---->
<!--            <div class="contact-sales-block">-->
<!--                <div class="logo-block">-->
<!--                    <img src="--><?php //echo get_field('logo','option')['url'];?><!--" alt="--><?php //echo get_field('logo','option')['alt'];?><!--">-->
<!--                    <div class="block-text">-->
<!--                       --><?php //echo get_field('modal_logo','option');?>
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <h2 class="block-caption">--><?php //echo get_field('modal_title','option');?><!--</h2>-->
<!---->
<!--                <div class="block-text">-->
<!--                    <p>--><?php //echo get_field('modal_text','option');?><!--</p>-->
<!--                </div>-->
<!---->
<!--                <div class="contact-form form">-->
<!--                    --><?php //echo do_shortcode('[contact-form-7 id="3672" title="Contact Us product"]');?>
<!---->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="modal white-bg" id="contact-sales-modal" tabindex="-1">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <button class="modal-close" aria-label="Close modal"></button>-->
<!---->
<!--            <div class="contact-sales-block">-->
<!--                <div class="logo-block">-->
<!--                    <img src="--><?php //echo get_field('logo','option')['url'];?><!--" alt="--><?php //echo get_field('logo','option')['alt'];?><!--">-->
<!--                    <div class="block-text">-->
<!--                       --><?php //echo get_field('modal_logo_product','option');?>
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <h2 class="block-caption">--><?php //echo get_field('modal_title_product','option');?><!--</h2>-->
<!---->
<!--                <div class="block-text">-->
<!--                    <p>--><?php //echo get_field('modal_text_product','option');?><!--</p>-->
<!--                </div>-->
<!---->
<!--                <div class="contact-form form">-->
<!--                    --><?php //echo do_shortcode('[contact-form-7 id="9" title="Contact Us"]');?>
<!---->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--Current popup-->
<!--<div class="modal keep-me-posted-modal" id="keep-me-posted-modal" tabindex="-1">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <button class="modal-close" aria-label="Close modal">-->
<!--                <svg class="btn-icon">-->
<!--                    <use xlink:href="--><?//= get_template_directory_uri() ?><!--/img/icons-sprite.svg#modal-close"></use>-->
<!--                </svg>-->
<!--            </button>-->
<!--            <div class="keep-me-posted-block">-->
<!--                <div class="block-top new-popup-text">-->
<!--                    <h3 class="block-caption">--><?php //echo get_field('modal_info_title','option');?><!--</h3>-->
<!--                   --><?php //echo get_field('modal_info_text','option');?>
<!--                </div>-->
<!--                <div class="block-inner">-->
<!--                    <div class="block-form">-->
<!--                        <div class="keep-me-posted-form form">-->
<!--                            --><?php //echo do_shortcode('[contact-form-7 id="3740" title="Contact Us modal info"]');?>
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="block-image">-->
<!--                        <img src="--><?php //echo get_field('modal_info_image','option')['url']; ?><!--" alt="--><?php //echo get_field('modal_info_image','option')['alt']; ?><!--">-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--New popup as sign up page-->
<!--<div class="modal keep-me-posted-modal modal-as-signup" id="keep-me-posted-modal" tabindex="-1">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <button class="modal-close" aria-label="Close modal">-->
<!--                <svg class="btn-icon">-->
<!--                    <use xlink:href="--><?//= get_template_directory_uri() ?><!--/img/icons-sprite.svg#modal-close"></use>-->
<!--                </svg>-->
<!--            </button>-->
<!--            <div class="login-page__main-bar">-->
<!--                <div class="right">-->
<!--                    <div id="register_wrapper"  --><?php //if(get_field('signup_page','option') == get_the_ID()){ ?><!-- style="display: none" --><?php //} ?><!-->
<!--                        <div class="wrapper">-->
<!--                            <div class="register_wrapper__title">-->
<!--                                <h2>Create a Free Account </h2>-->
<!--                            </div>-->
<!--                            <div class="register_wrapper__subtitle">-->
<!--                                <h2>Get instant access to more than <strong>1B+ product insights</strong> and consumer opinions.</h2>-->
<!--                            </div>-->
<!--                            <div class="register_wrapper__text">-->
<!--                                <h2 class="register-list__subtitle">By Registering You Will Gain:</h2>-->
<!--                                <ul>-->
<!--                                    <li>-->
<!--                                <span>-->
<!--                                    <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                        <path d="M2.65207 2.66428C2.51362 2.8013 2.29082 2.80181 2.15175 2.66542L1.50229 2.02848C1.36165 1.89056 1.1358 1.89286 0.997998 2.03361L0.249375 2.79828C0.111651 2.93895 0.114049 3.16464 0.254732 3.30236L2.15887 5.16636C2.29798 5.30254 2.52062 5.30192 2.65897 5.16498L6.34379 1.5178C6.48366 1.37937 6.48487 1.15378 6.34651 1.01384L5.59482 0.253593C5.45636 0.113557 5.23058 0.112334 5.09061 0.250861L2.65207 2.66428Z" fill="white"/>-->
<!--                                    </svg>-->
<!--                                </span>-->
<!--                                        Advanced Market Research-->
<!--                                    </li>-->
<!--                                    <li>-->
<!--                                <span>-->
<!--                                    <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                        <path d="M2.65207 2.66428C2.51362 2.8013 2.29082 2.80181 2.15175 2.66542L1.50229 2.02848C1.36165 1.89056 1.1358 1.89286 0.997998 2.03361L0.249375 2.79828C0.111651 2.93895 0.114049 3.16464 0.254732 3.30236L2.15887 5.16636C2.29798 5.30254 2.52062 5.30192 2.65897 5.16498L6.34379 1.5178C6.48366 1.37937 6.48487 1.15378 6.34651 1.01384L5.59482 0.253593C5.45636 0.113557 5.23058 0.112334 5.09061 0.250861L2.65207 2.66428Z" fill="white"/>-->
<!--                                    </svg>-->
<!--                                </span>-->
<!--                                        Instant SWOT Analysis-->
<!--                                    </li>-->
<!--                                    <li>-->
<!--                                <span>-->
<!--                                    <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                        <path d="M2.65207 2.66428C2.51362 2.8013 2.29082 2.80181 2.15175 2.66542L1.50229 2.02848C1.36165 1.89056 1.1358 1.89286 0.997998 2.03361L0.249375 2.79828C0.111651 2.93895 0.114049 3.16464 0.254732 3.30236L2.15887 5.16636C2.29798 5.30254 2.52062 5.30192 2.65897 5.16498L6.34379 1.5178C6.48366 1.37937 6.48487 1.15378 6.34651 1.01384L5.59482 0.253593C5.45636 0.113557 5.23058 0.112334 5.09061 0.250861L2.65207 2.66428Z" fill="white"/>-->
<!--                                    </svg>-->
<!--                                </span>-->
<!--                                        Extensive Reports on Products-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                            <div class="form__wrapper">-->
<!--                                <form id="signup-form" method="POST">-->
<!---->
<!--                                    <div class="google-button-wrapper">-->
<!--                                        <button id="signup_google" type="button"-->
<!--                                                class="registration registration-button registration-button--google">-->
<!--                                            <div class="registration-button--google__icon"></div>-->
<!--                                            Sign up with google-->
<!--                                            <div class="registration button-corner"></div>-->
<!--                                        </button>-->
<!--                                    </div>-->
<!--                                    <p class="option-text"><span>or</span></p>-->
<!---->
<!--                                    <div class="form__group form__group__email">-->
<!--                                        <label class="form__label" for="signin_email">email</label>-->
<!--                                        <input type="text" id="signin_email" name="email" class="form__input"-->
<!--                                               autocomplete="email" />-->
<!--                                        <div class="error-message error-message__email"></div>-->
<!--                                    </div>-->
<!--                                    <div class="form__group form__group__password">-->
<!--                                        <label class="form__label" for="signin_password">Create password</label>-->
<!--                                        <input type="password" id="signin_password" name="password" class="form__input"-->
<!--                                               autocomplete="new-password" />-->
<!--                                        <div class="error-message error-message__password"></div>-->
<!--                                        <div class="eye-icon eye-icon--hide togglePassword_signin"></div>-->
<!--                                    </div>-->
<!--                                    <div class="form__group form__group__password-confirmation">-->
<!--                                        <label class="form__label" for="password-confirmation">Confirm password</label>-->
<!--                                        <input type="password" name="password-confirmation" id="password-confirmation" class="form__input"-->
<!--                                               autocomplete="new-password" />-->
<!--                                        <span class="error-message error-message__password-confirmation"></span>-->
<!--                                        <div data-input-id="password-confirmation"-->
<!--                                             class="eye-icon eye-icon--hide togglePassword_signin_confirm"></div>-->
<!--                                    </div>-->
<!--                                    <div class="form__group">-->
<!--                                        <div class="error-message" style="display: none;" id="error-message-signin"></div>-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="footer-menu">-->
<!--                                        <div>-->
<!--                                            By clicking "Create Your Account", you agree to Sentimate's-->
<!--                                            <a class="footer-menu__list-item__link" href="--><?php //echo get_permalink(15223); ?><!--" target="_blank"-->
<!--                                               rel="nooStyledLinksener noreferrer">terms of use</a>-->
<!--                                            and-->
<!--                                            <a class="footer-menu__list-item__link" href="--><?php //echo get_permalink(15190); ?><!--" target="_blank"-->
<!--                                               rel="nooStyledLinksener noreferrer">privacy policy.</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="buttons-wrapper">-->
<!--                                        <div class="registration-button-wrapper">-->
<!--                                            <button type="button" id="signin"-->
<!--                                                    class="registration registration-button registration-button--colored">-->
<!--                                                Create Your Account-->
<!--                                                <div class="registration button-corner"></div>-->
<!--                                            </button>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="noAccount">-->
<!--                                        <p class="noAccount__text">Already have an account?</p>-->
<!--                                        <a class="noAccount__link" href="--><?php //echo get_permalink(get_field('singin_page','option'));?><!--" id="switchToSignIn1" rel="nooStyledLinksener noreferrer">Sign in-->
<!--                                            here</a>-->
<!--                                    </div>-->
<!--                                </form>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--<div class="modal keep-me-posted-modal" id="keep-me-posted-modal-2" tabindex="-1">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <button class="modal-close" aria-label="Close modal">-->
<!--                <svg class="btn-icon">-->
<!--                    <use xlink:href="--><?//= get_template_directory_uri() ?><!--/img/icons-sprite.svg#modal-close"></use>-->
<!--                </svg>-->
<!--            </button>-->
<!---->
<!--            <div class="keep-me-posted-block">-->
<!--                <div class="block-top new-popup-text">-->
<!--                    <h3 class="block-caption">Sentimate is a <strong>great resource</strong> if you want to...</h3>-->
<!--                    <ul>-->
<!--                        <li>Monitor online conversations on retail products</li>-->
<!--                        <li>Check how your competitors are doing</li>-->
<!--                        <li>Track progress over time</li>-->
<!--                    </ul>-->
<!--                    <div class="register_wrapper__title">-->
<!--                        <h2>Create a Free Account </h2>-->
<!--                    </div>-->
<!--                    <div class="register_wrapper__subtitle">-->
<!--                        <h2>Get instant access to more than <strong>1B+ product insights</strong> and consumer opinions.</h2>-->
<!--                    </div>-->
<!--                    <div class="register_wrapper__text">-->
<!--                        <h2 class="register-list__subtitle">By Registering You Will Gain:</h2>-->
<!--                        <ul>-->
<!--                            <li>-->
<!--                                <span>-->
<!--                                    <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                        <path d="M2.65207 2.66428C2.51362 2.8013 2.29082 2.80181 2.15175 2.66542L1.50229 2.02848C1.36165 1.89056 1.1358 1.89286 0.997998 2.03361L0.249375 2.79828C0.111651 2.93895 0.114049 3.16464 0.254732 3.30236L2.15887 5.16636C2.29798 5.30254 2.52062 5.30192 2.65897 5.16498L6.34379 1.5178C6.48366 1.37937 6.48487 1.15378 6.34651 1.01384L5.59482 0.253593C5.45636 0.113557 5.23058 0.112334 5.09061 0.250861L2.65207 2.66428Z" fill="white"/>-->
<!--                                    </svg>-->
<!--                                </span>-->
<!--                                Advanced Market Research-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <span>-->
<!--                                    <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                        <path d="M2.65207 2.66428C2.51362 2.8013 2.29082 2.80181 2.15175 2.66542L1.50229 2.02848C1.36165 1.89056 1.1358 1.89286 0.997998 2.03361L0.249375 2.79828C0.111651 2.93895 0.114049 3.16464 0.254732 3.30236L2.15887 5.16636C2.29798 5.30254 2.52062 5.30192 2.65897 5.16498L6.34379 1.5178C6.48366 1.37937 6.48487 1.15378 6.34651 1.01384L5.59482 0.253593C5.45636 0.113557 5.23058 0.112334 5.09061 0.250861L2.65207 2.66428Z" fill="white"/>-->
<!--                                    </svg>-->
<!--                                </span>-->
<!--                                Instant SWOT Analysis-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <span>-->
<!--                                    <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                        <path d="M2.65207 2.66428C2.51362 2.8013 2.29082 2.80181 2.15175 2.66542L1.50229 2.02848C1.36165 1.89056 1.1358 1.89286 0.997998 2.03361L0.249375 2.79828C0.111651 2.93895 0.114049 3.16464 0.254732 3.30236L2.15887 5.16636C2.29798 5.30254 2.52062 5.30192 2.65897 5.16498L6.34379 1.5178C6.48366 1.37937 6.48487 1.15378 6.34651 1.01384L5.59482 0.253593C5.45636 0.113557 5.23058 0.112334 5.09061 0.250861L2.65207 2.66428Z" fill="white"/>-->
<!--                                    </svg>-->
<!--                                </span>-->
<!--                                Extensive Reports on Products-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="block-inner">-->
<!--                    <div class="block-bg">-->
<!--                        <img src="--><?//= get_template_directory_uri() ?><!--/img/content-images/modals/keep-me-posted-bg.jpg" alt="">-->
<!--                    </div>-->
<!--                    <div class="block-form">-->
<!--                        <div class="keep-me-posted-form form">-->
<!--                            <form action="">-->
<!--                                <div class="form-fields">-->
<!--                                    <div class="form-field wide">-->
<!--                                        <p class="form-label">Email</p>-->
<!--                                        <input type="text" class="input-field" placeholder="laracroft@email.com">-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="form-field">-->
<!--                                        <p class="form-label">Full Name</p>-->
<!--                                        <input type="text" class="input-field" placeholder="Lara Croft">-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="form-field">-->
<!--                                        <p class="form-label">Company Name</p>-->
<!--                                        <input type="text" class="input-field" placeholder="Tomb">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="form-footer">-->
<!--                                    <button class="btn">Keep me posted</button>-->
<!--                                </div>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="block-image shifted">-->
<!--                        <img src="--><?//= get_template_directory_uri() ?><!--/img/content-images/modals/keep-me-posted-2.png" alt="">-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<!--<script src="//www.youtube.com/iframe_api"></script>-->
<script src="<?php echo get_template_directory_uri(); ?>/js/iframe_api.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/slick.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js?v=111"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js?v=111"></script>

<script src="<?php echo get_template_directory_uri(); ?>/Revuze/js/product_template-demo.js?v=133"></script>

<!--[if lte IE 8]>
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
<![endif]-->
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>

<script src="https://cdn.auth0.com/js/auth0/9.14/auth0.min.js"></script>
<script src="https://cdn.auth0.com/js/polyfills/1.0/object-assign.min.js"></script>

<script>
    $('.component-search-with-autocomplete:not(.with-link) #searchinput').keyup(function(){
        var val=$(this).val();
        $('.cmp-suggestions').removeClass('visible');
        if(val.length>3){
            var data = {
                'action': 'loadsearch',
                'val': val,

            };
            $.ajax({
                url: ajaxurl,
                data: data,
                type: 'POST',
                beforeSend: function (xhr) {
                    $('body').addClass('loading');
                },
                success: function (data) {
                    if (data) {
                        $('.cmp-suggestions').addClass('visible');
                        $('#search_rezult').html(data);
                    }
                },
            });
        }

    });

    $('.component-search-with-autocomplete.with-link').each(function(i, el){
        const input = $(el).find('#searchinput');
        const link = $(el).find('a.btn');
        const form = $(el).find('form');

        input.keyup(function(e){
            link.attr('href', 'https://pro.sentimate.com/product-analysis/search-results?q=' + encodeURIComponent(input.val()));

            if (e.key == "Enter") {
                // window.location.href = 'https://pro.sentimate.com/product-analysis/search-results?q=' + encodeURIComponent(input.val());
                showModal('#popUp')
                return false
            }
        });

    });
</script>

<script>
    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
    var uuid='';
    <?php if(is_singular('products')){ ?>
    var uuid='<?php echo get_field('product_uuid');?>';
    <?php } ?>
</script>
<?php wp_footer(); ?>
<button type="button" id="hs_show_banner_button"
        style="background-color: #660091; border: 1px solid #660091;
         border-radius: 3px; padding: 10px 16px; text-decoration: none; color: #fff;
         font-family: inherit; font-size: inherit; font-weight: normal; line-height: inherit;
         text-align: left; text-shadow: none;"
        onClick="(function(){
    var _hsp = window._hsp = window._hsp || [];
    _hsp.push(['showBanner']);
  })()"
>
    Cookie Settings
</button>
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5244251.js"></script>
</body>
</html>