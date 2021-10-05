<?php $baseAssetUrl = get_stylesheet_directory_uri() . '/Revuze/'; ?>

<div class="mg__item">
    <div class="mg__title">
        <div class="block_title">User Rating

            <div class="info_icn"><img src="<?= $baseAssetUrl; ?>img/icons/info.svg" alt="info_icon">
                <div class="info_icn__content">
                    <p>Avg. Star Rating</p>
                    <p>Average star rating of all reviews in the analyzed set of data, as given by the reviewer (1-5 star scale).</p>
                </div>
            </div>

            </div>

            <a href="https://pro.sentimate.com/product-analysis/<?php echo get_field('product_uuid');?>/overview" class="v_all">View All <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
        </div>
    <div class="mg__content">
        <div class="mg__numbers">
            <div class="numbers_top">
                <div class="rating_box main-star-rating">
                    <span class="rate-star"></span>
                    <span class="rate-star"></span>
                    <span class="rate-star"></span>
                    <span class="rate-star"></span>
                    <span class="rate-star"></span>
                </div>
            </div>

            <div class="numbers_mid"><p data-id="productStarRating">3.6</p></div>
            <div class="numbers_bottom"><span class="mark" data-id="starRatingChange">0.2%</span></div>
        </div>
        <div class="mg__graphic">
            <div id="chartdiv" style="width: 40%; height: 175px;"></div>
            <div class="stars-column">
                <ul>
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <li data-stars="<?= $i?>">
                        <div class="star-rating__icon">
                            <img src="<?= $baseAssetUrl . 'img/stars/Star-'.$i.'.svg'; ?>" />
                            <div class="star-rating__label"><?= $i?> star<?php if ($i > 1) echo 's'; ?></div>
                        </div>
                        <div class="star-rating__value"></div>
                    </li>
                    <?php } ?>
                </ul>
                <ul class="rating_general">
                    <li class="detractors">Negative</li>
                    <li class="neutral">Neutral</li>
                    <li class="promouters">Positive</li>
                </ul>
            </div>
        </div>
    </div>
</div>
