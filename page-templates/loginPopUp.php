<?php
/**
 * Template Name: PopUp
 */
get_header('login'); ?>
<?php while ( have_posts() ) : the_post(); ?>

    <button data-modal="#popUp">OPEN</button>


    <div style="display: none;" class="popUp modal" id="popUp" tabindex="-1">
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




    <!--[if lte IE 8]>
    <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
    <![endif]-->
    <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>

    <script src="https://cdn.auth0.com/js/auth0/9.14/auth0.min.js"></script>
    <script src="https://cdn.auth0.com/js/polyfills/1.0/object-assign.min.js"></script>
<?php endwhile; // end of the loop. ?>
<?php get_footer('login'); ?>