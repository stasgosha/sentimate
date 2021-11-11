<?php 
$baseAssetUrl = get_stylesheet_directory_uri() . '/Revuze/';


$product_monthly_reviews_array = get_field('product_monthly_reviews');

$product_monthly_reviews = json_decode($product_monthly_reviews_array);

$product_monthly_reviews_length = count($product_monthly_reviews);
?>

<div class="mg__item" id="product_monthly_reviews" data-info='<?php echo json_encode($product_monthly_reviews);?>'>
    <div class="mg__title">
        <div class="block_title">Customer Satisfaction</div>
        <a href="#" data-modal="#contact-sales-modal"  class="v_all"><?php echo get_field('customer_satisfaction_btn','option');?> <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
    </div>
    <div class="mg__content">
        <div class="mg__numbers">
            <div class="numbers_top">
                <p>score</p>
            </div>
            <div class="numbers_mid"><p data-id="satisfactionScore">75.8%</p></div>
            <div class="numbers_bottom"> <span class="mark up mark__gr"  data-id="satisfactionChange">7.1%</span></div>
        </div>
        <div class="mg__graphic" style="width: calc(100% - 175px);">
            <div id="satisfaction" style="width: 100%;" class=""></div>
        </div>
    </div>
</div>
