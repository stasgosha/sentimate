<?php $baseAssetUrl = get_stylesheet_directory_uri() . '/Revuze/'; ?>

<div class="mg__item">
    <div class="mg__title">
        <div class="block_title">Customer Satisfaction</div>
        <a href="https://pro.sentimate.com/product-analysis/<?php echo get_field('product_uuid');?>/overview" class="v_all">View All <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
    </div>
    <div class="mg__content">
        <div class="mg__numbers">
            <div class="numbers_top">
                <p>score</p>
            </div>
            <div class="numbers_mid"><p data-id="satisfactionScore">100%</p></div>
            <div class="numbers_bottom"> <span class="mark"  data-id="satisfactionChange">0.2</span></div>
        </div>
        <div class="mg__graphic" style="width: calc(100% - 175px);">
            <div id="satisfaction" style="width: 100%;" class=""></div>
        </div>
    </div>
</div>
