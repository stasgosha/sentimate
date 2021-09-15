<footer class="footer" role="contentinfo">
    <div class="container">
        <div class="footer-row first">
            <div class="footer-inner">
                <div class="footer-block">
                    <div class="footer-left">
                        <a href="index.html" class="logo-block">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="">
                            <div class="block-text">
                                Senti<strong>Mate</strong>
                            </div>
                        </a>

                        <p>Something about our cool product and benefits to using it (three lines max)</p>

                        <a href="#" class="btn">Start for free</a>
                    </div>
                </div>

                <div class="footer-block">
                    <nav class="footer-nav">
                        <div class="nav-column">
                            <h3 class="footer-caption">Resources</h3>

                            <ul>
                                <li><a href="#">Glossary</a></li>
                                <li><a href="#">Customer Success Stories</a></li>
                            </ul>
                        </div>
                        <div class="nav-column">
                            <h3 class="footer-caption">About Sentimate</h3>

                            <ul>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Pricing</a></li>
                            </ul>
                        </div>
                        <div class="nav-column">
                            <h3 class="footer-caption">Resources</h3>

                            <ul>
                                <li><a href="#">Case studies</a></li>
                                <li><a href="#">Blog posts</a></li>
                                <li><a href="#">Reports</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="footer-row second">
            <div class="footer-inner">
                <div class="footer-block">
                    <p class="footer-copyright">© 2021 - Sentimate. All rights reserved.</p>
                </div>

                <div class="footer-block">
                    <div class="footer-small-nav">
                        <ul class="nav-links">
                            <li><a href="#">Terms</a></li>
                            <li><a href="#">Privacy</a></li>
                        </ul>

                        <ul class="socials-list">
                            <li>
                                <a href="#" target="_blank" rel="noopener nofollow" aria-label="facebook">
                                    <svg class="link-icon">
                                        <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#facebook"></use>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" rel="noopener nofollow" aria-label="twitter">
                                    <svg class="link-icon">
                                        <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#twitter"></use>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" rel="noopener nofollow" aria-label="linkedin">
                                    <svg class="link-icon">
                                        <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#linkedin"></use>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//www.youtube.com/iframe_api"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/slick.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/Revuze/js/product_template-demo.js"></script>
<?php wp_footer(); ?>
</body>
</html>