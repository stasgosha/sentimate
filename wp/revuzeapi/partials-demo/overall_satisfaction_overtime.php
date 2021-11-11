<?php $baseAssetUrl = get_stylesheet_directory_uri() . '/Revuze/'; ?>

<div class="mg__item mg__item__lg">
    <div class="mg__title">
        <!-- <div class="block_title"><h2>Overall Customer Satisfaction</h2></div> -->
        <a href="#" data-modal="#contact-sales-modal"  class="v_all"><?php echo get_field('customer_satisfaction_big_grafbtn','option');?><img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
    </div>
    <div class="mg__content">
        <div class="mg__graphic" style="flex-wrap: wrap; width: 100%;">
            <div class="satisfaction-head" style="width: 100%;">
                <div class="chart__blurb">
                    <div class="chart__blurb-wrap" data-seties-id="0">
                        <div class="chart__blurb-title">Overall satisfaction</div>
                        <div class="stat" data-id="overallSatisfactionStat"></div>
                        <div class="chart__blurb-chart"><div id="overallSatisfaction"></div></div>
                    </div>
                </div>
                <div class="chart__blurb">
                    <div class="chart__blurb-wrap" data-seties-id="1">
                        <div class="chart__blurb-title">brand equity</div>
                        <div class="stat" data-id="brandEquityStat"></div>
                        <div class="chart__blurb-chart"><div id="brandEquity"></div></div>
                    </div>
                </div>
                <div class="chart__blurb">
                    <div class="chart__blurb-wrap" data-seties-id="2">
                        <div class="chart__blurb-title">Value For Money</div>
                        <div class="stat" data-id="valueForMoneyStat"></div>
                        <div class="chart__blurb-chart"><div id="valueForMoney"></div></div>
                    </div>
                </div>
                <div class="chart__blurb">
                    <div class="chart__blurb-wrap" data-seties-id="3">
                        <div class="chart__blurb-title">Product Quality</div>
                        <div class="stat" data-id="productQualityStat"></div>
                        <div class="chart__blurb-chart"><div id="productQuality"></div></div>
                    </div>
                </div>
                <div class="chart__blurb">
                    <div class="chart__blurb-wrap" data-seties-id="4">
                        <div class="chart__blurb-title">Shopping Experience</div>
                        <div class="stat" data-id="shoppingExperienceStat"></div>
                        <div class="chart__blurb-chart"><div id="shoppingExperience"></div></div>
                    </div>
                </div>

            </div>
            <div id="satisfactionOverTime" style="width: 100%;
            height: 350px;">
            </div>
        </div>
    </div>
</div>
