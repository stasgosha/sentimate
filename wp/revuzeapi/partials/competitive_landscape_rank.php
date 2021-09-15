<?php $baseAssetUrl = get_stylesheet_directory_uri() . '/Revuze/'; ?>
<div class="mg__item">
    <div class="mg__title">
        <div class="block_title">Market Rank</div>
        <a href="#" class="v_all">View All <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
    </div>
    <div class="mg__content">
        <div class="mg__numbers">
            <div class="numbers_top">
                <p>value</p>
                <div class="info_icn"><img src="<?= $baseAssetUrl; ?>img/icons/info.svg" alt="info_icon"></div>
            </div>
            <div class="numbers_mid"><p data-id="currentRank">27</p><span data-id="rankOutOf">/ 366</span></div>
            <div class="numbers_bottom"><span class="mark" data-id="currentRankChange">4</span></div>
        </div>
        <div class="mg__graphic" style="width: calc(100% - 175px);">
            <div id="rankOverTime" style="width: 100%;"></div>
        </div>
    </div>
</div>
