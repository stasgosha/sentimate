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
                <p data-id="reviews">2457</p>
                <div class="numbers_bottom"> <span class="mark down mark__red" data-id="reviewsRise">57</span></div>
            </div>
        </div>

        <div class="mg__numbers mg__custom">
            <div class="numbers_top">
                <p>reviewers</p>
            </div>

            <div class="numbers_mid">
                <p data-id="reviewers">14678</p>
                <div class="numbers_bottom"><span class="mark up mark__red" data-id="reviewersRise">1398</span></div>
            </div>
        </div>
        <div class="numbers_top line_bottom">
            <p>Star Rating distribution</p>
            <div class="line_progress" data-id="ratingDistribution">
                <div class="lp lp__red" style="width: 19.9813%;"></div>
                <div class="lp lp__gray" style="width: 4.22955%;"></div>
                <div class="lp lp__green" style="width: 75.7892%;"></div>
            </div>
        </div>
    </div>
</div>
