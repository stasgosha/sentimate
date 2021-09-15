<?php 
$baseAssetUrl = get_stylesheet_directory_uri() . '/Revuze/';


$product_star_rating_array = get_field('product_star_rating');

$product_star_rating = json_decode($product_star_rating_array);

$product_star_rating_length = count($product_star_rating);

// Avarage
$avarageSum = 0;
$averageCount = 0;
foreach($product_star_rating as $rating){
    if($rating->average > 0){
        $avarageSum += $rating->average;
        $averageCount++;
    }
}
$average = round($avarageSum/$averageCount, 2);

$last = $product_star_rating[$product_star_rating_length - 1];
$secondToLast = $product_star_rating[$product_star_rating_length - 2];
$starRatingChange = round($last->average - $secondToLast->average, 1);

$starRatingChangeClass = $starRatingChange > 0 ? 'up mark__gr' : 'down mark__red';

?>

<div class="mg__item" id="product_star_rating" data-info='<?php echo json_encode($product_star_rating);?>'>
    <div class="mg__title">
        <div class="block_title">User Rating

            <div class="info_icn"><img src="<?= $baseAssetUrl; ?>img/icons/info.svg" alt="info_icon">
                <div class="info_icn__content">
                    <p>Avg. Star Rating</p>
                    <p>Average star rating of all reviews in the analyzed set of data, as given by the reviewer (1-5 star scale).</p>
                </div>
            </div>

            </div>

            <a href="#" class="v_all">View All <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
        </div>
    <div class="mg__content">
        <div class="mg__numbers">
            <div class="numbers_top">
                <div class="rating_box main-star-rating">
                    <span class="rate-star <?php echo ($average >= 0 && $average < 1 ? 'half' :( $average >= 1 ? 'full' : '') );?>"></span>
                    <span class="rate-star <?php echo ($average >= 1 && $average < 2 ? 'half' :( $average >= 2 ? 'full' : '') );?>"></span>
                    <span class="rate-star <?php echo ($average >= 2 && $average < 3 ? 'half' :( $average >= 3 ? 'full' : '') );?>"></span>
                    <span class="rate-star <?php echo ($average >= 3 && $average < 4 ? 'half' :( $average >= 4 ? 'full' : '') );?>"></span>
                    <span class="rate-star <?php echo ($average >= 4 && $average < 5 ? 'half' :( $average >= 5 ? 'full' : '') );?>"></span>
                </div>
            </div>

            <div class="numbers_mid"><p data-id="productStarRating"><?php echo number_format($average, 2);?></p></div>
            <div class="numbers_bottom"><span class="mark <?php echo $starRatingChangeClass;?>" data-id="starRatingChange"><?php echo $starRatingChange;?></span></div>
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
