<?php $baseAssetUrl = get_stylesheet_directory_uri() . '/Revuze/'; ?>

<div class="mg__item">
    <div class="mg__title">
        <div class="block_title">User Engagement</div>
        <a href="#" class="v_all">View All <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
    </div>
    <div class="mg__content mg__content2">
        <div class="mg__numbers mg__custom">
            <div class="numbers_top">
                <p>reviews</p>
            </div>

            <div class="numbers_mid">
                <p data-id="reviews">147548</p>
                <div class="numbers_bottom"> <span class="mark" data-id="reviewsRise">224</span></div>
            </div>
        </div>

        <div class="mg__numbers mg__custom">
            <div class="numbers_top">
                <p>reviewers</p>
            </div>

            <div class="numbers_mid">
                <p data-id="reviewers">56732</p>
                <div class="numbers_bottom"><span class="mark" data-id="reviewersRise">154</span></div>
            </div>
        </div>
        <div class="numbers_top line_bottom">
            <p>Star Rating distribution</p>
            <div class="line_progress" data-id="ratingDistribution">
                <div class="lp lp__red"></div>
                <div class="lp lp__gray"></div>
                <div class="lp lp__green"></div>
            </div>
        </div>
    </div>
</div>
