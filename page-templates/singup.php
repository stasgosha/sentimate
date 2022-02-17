<?php
/**
 * Template Name: Singup
 */
get_header('login'); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <?php if(get_field('signup_page','option')!=get_the_ID()){ ?>
        <script>
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': 'login-page',
        });
    </script>
     <?php }else{ ?>
        <script>
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                'event': 'signup-page',
            });
        </script>
     <?php } ?>
    <div class="main">

    <div class="login-page__main-bar">
        <div class="right">

            <div id="login_wrapper" <?php if(get_field('signup_page','option')==get_the_ID()){ ?> style="display: none" <?php } ?>>

                <div class="wrapper wrapper-with-normal-overflow">
                    <div class="form__wrapper">
                        <form id="login-form" method="GET">
                            <h2 class="form__header">Welcome back!<br>Sign into your account</h2>
                            <div class="google-button-wrapper">
                                <a class="register__google-btn" id="signup_google"  href="#">
                                    <img src="<?= get_template_directory_uri() ?>/img/login/google-icon.svg" alt="">
                                    <span>Continue With Google</span>
                                    <div class="register__google-corner"></div>
                                </a>
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
                                        <div class="login button-corner"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="noAccount">
                                <p class="noAccount__text">Don't have an account?</p>
                                <a class="noAccount__link" href="<?php echo get_permalink(get_field('signup_page','option'));?>" id="signup1" rel="nooStyledLinksener noreferrer">Sign
                                    up
                                    here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="register_wrapper"  <?php if(get_field('signup_page','option')!=get_the_ID()){ ?> style="display: none" <?php } ?>>
                <div class="wrapper">
                    <div class="register_wrapper__title">
                        <h2>Create a Free Account </h2>
                    </div>
                    <div class="register_wrapper__subtitle">
                        <h2>Get instant access to more than <strong>1B+ product insights</strong> and consumer opinions.</h2>
                    </div>
                    <div class="register_wrapper__text">
                        <h2 class="register-list__subtitle">By Registering You Will Gain:</h2>
                        <ul>
                            <li>
                                <span>
                                    <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.65207 2.66428C2.51362 2.8013 2.29082 2.80181 2.15175 2.66542L1.50229 2.02848C1.36165 1.89056 1.1358 1.89286 0.997998 2.03361L0.249375 2.79828C0.111651 2.93895 0.114049 3.16464 0.254732 3.30236L2.15887 5.16636C2.29798 5.30254 2.52062 5.30192 2.65897 5.16498L6.34379 1.5178C6.48366 1.37937 6.48487 1.15378 6.34651 1.01384L5.59482 0.253593C5.45636 0.113557 5.23058 0.112334 5.09061 0.250861L2.65207 2.66428Z" fill="white"/>
                                    </svg>
                                </span>
                                Advanced Market Research
                            </li>
                            <li>
                                <span>
                                    <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.65207 2.66428C2.51362 2.8013 2.29082 2.80181 2.15175 2.66542L1.50229 2.02848C1.36165 1.89056 1.1358 1.89286 0.997998 2.03361L0.249375 2.79828C0.111651 2.93895 0.114049 3.16464 0.254732 3.30236L2.15887 5.16636C2.29798 5.30254 2.52062 5.30192 2.65897 5.16498L6.34379 1.5178C6.48366 1.37937 6.48487 1.15378 6.34651 1.01384L5.59482 0.253593C5.45636 0.113557 5.23058 0.112334 5.09061 0.250861L2.65207 2.66428Z" fill="white"/>
                                    </svg>
                                </span>
                                Instant SWOT Analysis
                            </li>
                            <li>
                                <span>
                                    <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.65207 2.66428C2.51362 2.8013 2.29082 2.80181 2.15175 2.66542L1.50229 2.02848C1.36165 1.89056 1.1358 1.89286 0.997998 2.03361L0.249375 2.79828C0.111651 2.93895 0.114049 3.16464 0.254732 3.30236L2.15887 5.16636C2.29798 5.30254 2.52062 5.30192 2.65897 5.16498L6.34379 1.5178C6.48366 1.37937 6.48487 1.15378 6.34651 1.01384L5.59482 0.253593C5.45636 0.113557 5.23058 0.112334 5.09061 0.250861L2.65207 2.66428Z" fill="white"/>
                                    </svg>
                                </span>
                                Extensive Reports on Products
                            </li>
                        </ul>
                    </div>
                    <div class="register__google">
                        <a class="register__google-btn" id="signin_google"  href="#">
                            <img src="<?= get_template_directory_uri() ?>/img/login/google-icon.svg" alt="">
                            <span>Continue With Google</span>
                            <div class="register__google-corner"></div>
                        </a>
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
                                    By clicking "Create Your Account", you agree to Sentimate's
                                    <a class="footer-menu__list-item__link" href="<?php echo get_permalink(15223); ?>" target="_blank"
                                    rel="nooStyledLinksener noreferrer">terms of use</a>
                                    and
                                    <a class="footer-menu__list-item__link" href="<?php echo get_permalink(15190); ?>" target="_blank"
                                    rel="nooStyledLinksener noreferrer">privacy policy.</a>
                                </div>
                            </div>

                            <div class="buttons-wrapper">
                                <div class="registration-button-wrapper">
                                    <button type="button" id="signin"
                                            class="registration registration-button registration-button--colored">
                                            Create Your Account
                                        <div class="registration button-corner"></div>
                                    </button>
                                </div>
                            </div>

                            <div class="noAccount">
                                <p class="noAccount__text">Already have an account?</p>
                                <a class="noAccount__link" href="<?php echo get_permalink(get_field('singin_page','option'));?>" id="switchToSignIn1" rel="nooStyledLinksener noreferrer">Sign in
                                    here</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
        <div class="login-page__side-bar">
            <div class="left">
                <div class="left__video">
                <video src="<?= get_template_directory_uri() ?>/img/login/Animation_1.webm" loop muted playsinline autoplay poster="<?= get_template_directory_uri() ?>/img/login/image-poster.jpg"></video>
                </div>
                <div class="left__brand">
                    <div class="left__brand-title">
                        <div class="left__brand-title-line"></div>
                        <h4>TRUSTED BY</h4>
                        <div class="left__brand-title-line"></div>
                    </div>
                    <div class="left__list">
                        <div class="left__list-item">
                            <img src="<?= get_template_directory_uri() ?>/img/login/icon-1.svg" alt="">
                        </div>
                        <div class="left__list-item">
                            <img src="<?= get_template_directory_uri() ?>/img/login/icon-2.svg" alt="">
                        </div>
                        <div class="left__list-item">
                            <img src="<?= get_template_directory_uri() ?>/img/login/icon-3.svg" alt="">
                        </div>
                        <div class="left__list-item">
                            <img src="<?= get_template_directory_uri() ?>/img/login/icon-4.svg" alt="">
                        </div>
                        <div class="left__list-item">
                            <img src="<?= get_template_directory_uri() ?>/img/login/icon-5.svg" alt="">
                        </div>
                        <div class="left__list-item">
                            <img src="<?= get_template_directory_uri() ?>/img/login/icon-6.svg" alt="">
                        </div>
                        <div class="left__list-item">
                            <img src="<?= get_template_directory_uri() ?>/img/login/icon-7.svg" alt="">
                        </div>
                        <div class="left__list-item">
                            <img src="<?= get_template_directory_uri() ?>/img/login/icon-8.svg" alt="">
                        </div>
                        <div class="left__list-item">
                            <img src="<?= get_template_directory_uri() ?>/img/login/icon-9.svg" alt="">
                        </div>
                        <div class="left__list-item">
                            <img src="<?= get_template_directory_uri() ?>/img/login/icon-10.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>





<?php endwhile; // end of the loop. ?>
<?php get_footer('login'); ?>