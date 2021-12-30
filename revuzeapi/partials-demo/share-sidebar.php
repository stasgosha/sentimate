<?php $baseAssetUrl = get_stylesheet_directory_uri() . '/Revuze/'; ?>
<div class="share-report__vertical">
    <a href="#" class="prod-btn prod-btn__share js-share-sidebar">
        <p><img src="<?= $baseAssetUrl; ?>img/icons/share.svg" alt=""></p>
        <span>Share Report</span>
    </a>
    <div class="share-post">
        <?php echo do_shortcode('[addtoany]'); ?>
    </div>
</div>
