<a href="<?php echo get_permalink(); ?>" class="product-card">
    <div class="compare-trigger" data-modal="#popUp" data-link="/product-analysis/<?= get_field('product_uuid'); ?>/comparison?q=&compBcat=false&compBuuid=">
        <img src="<?= get_template_directory_uri() ?>/img/icons/compare.svg" alt="">
        <span>
            Compare
        </span>
    </div>
    <div class="card-image">
        <img src="<?php echo get_field('product_image');?>" alt="<?php the_title(); ?>">
    </div>
    <div class="card-content">
        <ul class="card-info">
            <?php
            $avarageSatisfaction=round(get_field('sentiment'),0);
            if($avarageSatisfaction>0){
            ?>
            <li>
                <strong>Sentiment:</strong>
                <div class="item-value <?php if($avarageSatisfaction>80){ ?> excellent <?php } ?> <?php if($avarageSatisfaction<=80 and $avarageSatisfaction>=60){ ?> good  <?php } ?> <?php if($avarageSatisfaction<60){ ?>poor <?php } ?>"><?php echo $avarageSatisfaction; ?>%</div>
            </li>
            <?php } ?>
            <li>
                <strong>Star Rating:</strong>


                <?php
                $average = round(get_field('star_rating'), 2);
                ?>
                <div class="star-rating">
                    <div class="rate-star star <?php echo ($average >= 0 && $average < 1 ? 'half' :( $average >= 1 ? 'full' : '') );?>"></div>
                    <div class="rate-star star <?php echo ($average >= 1 && $average < 2 ? 'half' :( $average >= 2 ? 'full' : '') );?>"></div>
                    <div class="rate-star star <?php echo ($average >= 2 && $average < 3 ? 'half' :( $average >= 3 ? 'full' : '') );?>"></div>
                    <div class="rate-star star <?php echo ($average >= 3 && $average < 4 ? 'half' :( $average >= 4 ? 'full' : '') );?>"></div>
                    <div class="rate-star star <?php echo ($average >= 4 && $average < 5 ? 'half' :( $average >= 5 ? 'full' : '') );?>"></div>
                </div>

                <div class="item-value  <?php if($average>4.5){ ?> excellentstar <?php } ?> <?php if($average<=4.5 and $average>=4){ ?> goodstar  <?php } ?> <?php if($average<4){ ?>poorstar <?php } ?>"><?php echo number_format($average, 1);?></div>
            </li>
        </ul>

        <div class="card-description">
            <p><?php
                $f= strip_tags (get_the_title());
                if(strlen ( $f )>80){
                    echo mb_substr($f,0,80);
                    echo"...";
                }
                else{
                    echo mb_substr($f,0,80);
                }
               ?></p>
        </div>

        <div class="card-footer">
            <div class="more-link">
                <span class="link-text">View Report</span>
            </div>
        </div>
    </div>
</a>