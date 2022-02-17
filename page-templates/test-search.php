<?php
/**
 * Template Name: Test search
 */
get_header(); ?>
<main class="page-content">
    <div class="component-search-with-autocomplete">
        <div class="cmp-field">
            <form action="">
                <svg class="field-icon">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#search"></use>
                </svg>
                <input type="text" name="s" placeholder="<?php echo get_field('placeholder_field','option');?>" id="search-new-input">
                <button class="btn" type="submit">Go</button>
            </form>
        </div>
        <div class="cmp-suggestions">
            <ul id="search_rezult">

            </ul>
        </div>
    </div>
</main>

<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
<![endif]-->
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
<script>
    hbspt.forms.create({
        region: "na1",
        portalId: "5244251",
        formId: "febc8be7-2a2f-498e-a729-b91db308a19c"
    });
</script>
<button type="button" id="hs_show_banner_button"
        style="background-color: #00bda5; border: 1px solid #00bda5;
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

<?php get_footer(); ?>
