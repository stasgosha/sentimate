<?php 
$baseAssetUrl = get_stylesheet_directory_uri() . '/Revuze/';

$product_monthly_rankString = get_field('product_monthly_rank');

$product_monthly_rank = json_decode($product_monthly_rankString);

$values = $product_monthly_rank->values;
$currentRankChange = 0;

$valuesArray = (array)$values;
$dates = array_keys($valuesArray);
$lengthValues = count($valuesArray);

if(isset($valuesArray[$dates[$lengthValues - 1]]) && isset($valuesArray[$dates[$lengthValues - 2]])) {
    $currentRankChange = $valuesArray[$dates[$lengthValues - 1]] - $valuesArray[$dates[$lengthValues - 2]];
}

$currentRankChangeClass = $currentRankChange < 0 ? 'up mark__gr' : 'down mark__red';
$currentRankChangeClass = $currentRankChange === 0 ? '' : $currentRankChangeClass;

?>
<div class="mg__item" id="product_monthly_rank" data-info='<?php echo json_encode($product_monthly_rank);?>'>
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
            <div class="numbers_mid"><p data-id="currentRank"><?php echo $product_monthly_rank->rank;?></p><span data-id="rankOutOf">/ <?php echo $product_monthly_rank->total;?></span></div>
            <div class="numbers_bottom"><span class="mark <?php echo $currentRankChangeClass; ?>" data-id="currentRankChange"><?php echo $currentRankChange;?></span></div>
        </div>
        <div class="mg__graphic" style="width: calc(100% - 175px);">
            <div id="rankOverTime" style="width: 100%;"></div>
        </div>
    </div>
</div>
