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

                <div class="wrapper">
                    <div class="form__wrapper">
                        <form id="login-form" method="GET">
                            <h1 class="form__header">Welcome back!<br>Sign into your account</h1>
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
                        <h2>Create your account</h2>
                    </div>
                    <div class="register_wrapper__subtitle">
                        <h2>Sentimate gives you free access 600 million opinions and insights into consumer sentiment on any product on the Internet</h2>
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