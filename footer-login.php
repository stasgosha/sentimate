<footer class="footer" role="contentinfo">
    <div class="footer-row second">
            <div class="footer-block">
                <p class="footer-copyright"><?php echo get_field('copyright','option');?></p>
            </div>
    </div>
</footer>


<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<!--<script src="//www.youtube.com/iframe_api"></script>-->
<script src="<?php echo get_template_directory_uri(); ?>/js/iframe_api.js?v=10"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/slick.min.js?v=10"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js?v=111"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js?v=111"></script>

<script src="<?php echo get_template_directory_uri(); ?>/Revuze/js/product_template-demo.js?v=10"></script>

<!--[if lte IE 8]>
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
<![endif]-->
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>

<script src="https://cdn.auth0.com/js/auth0/9.14/auth0.min.js"></script>
<script src="https://cdn.auth0.com/js/polyfills/1.0/object-assign.min.js"></script>

<script>
    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
    var uuid='';
    <?php if(is_singular('products')){ ?>
    var uuid='<?php echo get_field('product_uuid');?>';
    <?php } ?>
</script>
<?php wp_footer(); ?>
</body>
</html>