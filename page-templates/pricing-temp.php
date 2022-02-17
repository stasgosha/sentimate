<?php
/**
 * Template Name: Pricing Temp Page
 */
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <main class="page-content">
        <section class="first-screen-section">
            <div class="container">
                <h1 class="page-caption"><?php echo get_field('title');?></h1>

                <div class="section-text">
                    <p><?php echo get_field('text');?></p>
                </div>
            </div>
        </section>
        <section class="pricingForm">
            <div class="container">
                <div class="pricing-grid">
                    <div class="popUp-wrapper pricing-column_wrapper">
                        <div class="popUp-form metrics-card">
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
                                                    <label class="form__label" for="signin_email">Email</label>
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
                                                            Create <span>Your Free</span> Account
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
                        </div>
                    </div>
                    <div class="card-image pricing-column_wrapper">
                        <div class="pricing-video_wrapper">
                            <?php if (get_field('image')) { ?>
                                <img src="<?php echo get_field('image')['url'];?>" alt="<?php echo get_field('image')['alt'];?>">
                            <?php } else { ?>
                                <video width="100%" src="<?php echo get_field('animate'); ?>" loop muted playsinline autoplay poster="<?php echo get_field('animate'); ?>"></video>
                            <?php } ?>
                        </div>
                        <div class="pricing-temp__side-bar">
                            <div class="left">
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
            </div>
        </section>
        <section class="big-stats-section">
            <div class="container">
                <div class="stats-grid">
                    <?php if( have_rows('product_counters','option') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('product_counters','option') ): the_row(); ?>
                            <div class="stats-card">
                                <h3 class="card-caption"><strong style="color: <?php echo get_sub_field('color_counter');?>;"><?php echo get_sub_field('counter');?></strong> <?php echo get_sub_field('title');?></h3>

                                <div class="card-text">
                                    <p><?php echo get_sub_field('text');?></p>
                                </div>

                                <ul class="card-tags">
                                    <?php if( get_sub_field('tags') ): ?>
                                        <?php while( has_sub_field('tags') ): ?>
                                            <li>
                                                <?php if(get_sub_field('image')['url']){ ?>
                                                    <img src="<?php echo get_sub_field('image')['url']; ?>" alt="<?php echo get_sub_field('image')['alt']; ?>">
                                                <?php }else{ ?>
                                                    <?php if(get_sub_field('link')){ ?>
                                                        <a href="<?php echo get_sub_field('link');?>">
                                                    <?php } ?>
                                                    <?php echo get_sub_field('text');?>
                                                    <?php if(get_sub_field('link')){ ?>
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </li>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                    <?php if(get_sub_field('text_tags')){ ?>
                                        <li class="pale"><?php echo get_sub_field('text_tags');?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>