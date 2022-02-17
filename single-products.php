<?php
$baseAssetUrl = get_template_directory_uri().'/';
get_header(); ?>

    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<?php while ( have_posts() ) : the_post(); ?>
    <?php if(!get_field('old_template')){ ?>
        <?php
        $baseAssetUrl = get_stylesheet_directory_uri() . '/Revuze/';
        ?>

        <?php
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
        $currentRankChange=get_field('rank_trend');
        $currentRankChangeClass = $currentRankChange < 0 ? 'up' : 'down';
        $currentRankChangeClass = $currentRankChange === 0 ? '' : $currentRankChangeClass;
        ?>

        <?php
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

        $starRatingChangeClass = $starRatingChange > 0 ? 'up' : 'down';

        ?>

        <?php
        $product_monthly_reviews_array = get_field('product_monthly_reviews');
        $product_monthly_reviews = json_decode($product_monthly_reviews_array);
        $product_monthly_reviews_length = count($product_monthly_reviews);
        function get_term_top_most_parent( $active, $taxonomy ) {
            // Start from the current term
            $parent  = get_term( $active, $taxonomy );
            $res[] = $parent;
            // Climb up the hierarchy until we reach a term with parent = '0'
            while ( $parent->parent != '0' ) {
                $term_id = $parent->parent;
                $parent  = get_term( $term_id, $taxonomy);
                $res[] = $parent;
            }
            return array_reverse($res);
        }
        $termindustry = get_field('product_industry');
        $termcategory=get_field('product_category');
        $termindustry_l =str_replace('&','%26',$termindustry);
        $termcategory_l =str_replace('&','%26',$termcategory);
        $termindustry_l =str_replace('amp;','',$termindustry);
        $termcategory_l =str_replace('amp;','',$termcategory);
        $active_term = get_term_by('name', esc_attr($termcategory), 'product_category');
        if ($active_term) {
            $active = $active_term->term_id;
            $parents = get_term_top_most_parent($active, 'product_category');
        } else {
            $parents = '';
        }
        ?>

        <div id="singleProduct">
            <section class="product-page-section" id="overview">
                <div class="container">
                    <div class="breadcrumbs">
                        <ul itemscope itemtype="https://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope
                                itemtype="https://schema.org/ListItem">
                                <a itemprop="item" href="<?php echo get_home_url();?>">
                                    <span itemprop="name"><?php echo get_the_title( get_option('page_on_front') );?></span></a>
                                <meta itemprop="position" content="1" />
                            </li>
                            <!--                        <li itemprop="itemListElement" itemscope-->
                            <!--                            itemtype="https://schema.org/ListItem">-->
                            <!--                            <a itemscope itemtype="https://schema.org/WebPage"-->
                            <!--                               itemprop="item" itemid="--><?php //echo get_permalink('3495'); ?><!--"-->
                            <!--                               href="--><?php //echo get_permalink('3495'); ?><!--">-->
                            <!--                                <span itemprop="name">--><?php //echo get_the_title('3495'); ?><!--</span></a>-->
                            <!--                            <meta itemprop="position" content="2" />-->
                            <!--                        </li>-->
                            <!--                        <li itemprop="itemListElement" itemscope-->
                            <!--                            itemtype="https://schema.org/ListItem">-->
                            <!--                            <a itemscope itemtype="https://schema.org/WebPage"-->
                            <!--                               itemprop="item" itemid="--><?php //echo get_term_link($termindustry->term_id,'product_industry'); ?><!--"-->
                            <!--                               href="--><?php //echo get_term_link($termindustry->term_id,'product_industry'); ?><!--">-->
                            <!--                                <span itemprop="name">--><?php //echo $termindustry->name; ?><!--</span></a>-->
                            <!--                            <meta itemprop="position" content="3" />-->
                            <!--                        </li>-->
                            <!--                        <li itemprop="itemListElement" itemscope-->
                            <!--                            itemtype="https://schema.org/ListItem">-->
                            <!--                            <a itemscope itemtype="https://schema.org/WebPage"-->
                            <!--                               itemprop="item" itemid="--><?php //echo get_term_link($termcategory->term_id,'product_category'); ?><!--"-->
                            <!--                               href="--><?php //echo get_term_link($termcategory->term_id,'product_category'); ?><!--">-->
                            <!--                                <span itemprop="name">--><?php //echo get_name_category($termcategory->name); ?><!--</span></a>-->
                            <!--                            <meta itemprop="position" content="4" />-->
                            <!--                        </li>-->
                            <!--                        --><?php //$rd_terms = wp_get_post_terms( get_the_ID(), 'product_category', array( "fields" => "ids" ) ); // getting the term IDs
                            //                        $term_array = trim( implode( ',', (array) $rd_terms ), ' ,' );
                            //                        $neworderterms = get_terms('product_category', 'orderby=none&include=' . $term_array );
                            //                        if( $neworderterms && $term_array) {
                            //                            $neworderterms2 = array_reverse($neworderterms);
                            //                            foreach( $neworderterms2 as $x => $term ) : $orderterm = get_term($term, 'product_category'); ?>
                            <!--                                <li itemprop="itemListElement" itemscope-->
                            <!--                                    itemtype="https://schema.org/ListItem">-->
                            <!--                                    <a itemscope itemtype="https://schema.org/WebPage"-->
                            <!--                                       itemprop="item" itemid="--><?php //echo get_term_link($orderterm->term_id); ?><!--"-->
                            <!--                                       href="--><?php //echo get_term_link($orderterm->term_id); ?><!--">-->
                            <!--                                        <span itemprop="name">--><?php //echo $term->name; ?><!--</span></a>-->
                            <!--                                    <meta itemprop="position" content="--><?//= $x + 4; ?><!--" />-->
                            <!--                                </li>-->
                            <!--                            --><?php //endforeach;
                            //                        } ?>
                            <?php if ($parents) : foreach ($parents as $u => $parent) : ?>
                                <li itemprop="itemListElement" itemscope
                                    itemtype="https://schema.org/ListItem">
                                    <a itemprop="item" href="<?php echo get_term_link($parent,'product_category'); ?>">
                                        <span itemprop="name"><?php echo $parent->name; ?></span></a>
                                    <meta itemprop="position" content="<?= $u + 2; ?>" />
                                </li>
                            <?php endforeach; endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="container">
                    <div class="navigation-box">
                        <a class="navigation-item" href="#overview">
                            <div class="navigation-item__img">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M3.125 3.4375C3.125 3.18886 3.02623 2.9504 2.85041 2.77459C2.6746 2.59877 2.43614 2.5 2.1875 2.5C1.93886 2.5 1.7004 2.59877 1.52459 2.77459C1.34877 2.9504 1.25 3.18886 1.25 3.4375V26.5625C1.25 27.08 1.67 27.5 2.1875 27.5H25C25.2486 27.5 25.4871 27.4012 25.6629 27.2254C25.8387 27.0496 25.9375 26.8111 25.9375 26.5625C25.9375 26.3139 25.8387 26.0754 25.6629 25.8996C25.4871 25.7238 25.2486 25.625 25 25.625H3.125V3.4375Z" />
                                    <path
                                            d="M27.8499 9.72505C28.0155 9.54733 28.1057 9.31228 28.1014 9.0694C28.0971 8.82652 27.9987 8.59479 27.827 8.42302C27.6552 8.25126 27.4235 8.15287 27.1806 8.14858C26.9377 8.1443 26.7027 8.23445 26.5249 8.40005L19.3749 15.5501L14.7249 10.9001C14.5492 10.7245 14.3109 10.6259 14.0624 10.6259C13.814 10.6259 13.5757 10.7245 13.3999 10.9001L5.89995 18.4001C5.80784 18.4859 5.73396 18.5894 5.68272 18.7044C5.63148 18.8194 5.60393 18.9435 5.60171 19.0694C5.59949 19.1953 5.62264 19.3203 5.66979 19.437C5.71695 19.5538 5.78713 19.6598 5.87615 19.7488C5.96517 19.8379 6.07122 19.9081 6.18795 19.9552C6.30469 20.0024 6.42972 20.0255 6.5556 20.0233C6.68148 20.0211 6.80562 19.9935 6.92062 19.9423C7.03562 19.891 7.13912 19.8172 7.22495 19.7251L14.0624 12.8876L18.7124 17.5376C18.8882 17.7131 19.1265 17.8117 19.3749 17.8117C19.6234 17.8117 19.8617 17.7131 20.0374 17.5376L27.8499 9.72505Z" />
                                </svg>
                            </div>
                            <div class="navigation-box__title">
                                Overview
                            </div>
                        </a>
                        <a class="navigation-item" href="#star-rating">
                            <div class="navigation-item__img">
                                <svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M16.7131 1.39597C16.0118 -0.0263597 13.9846 -0.0263597 13.2833 1.39597L9.94285 8.16339L2.47276 9.24856C0.904514 9.47664 0.276931 11.4047 1.4131 12.5111L6.81768 17.7811L5.54268 25.2186C5.27351 26.7812 6.91401 27.9726 8.31793 27.2346L15.4919 23.4634C15.7414 23.3323 15.9286 23.1074 16.0123 22.8383C16.096 22.5691 16.0693 22.2778 15.9382 22.0283C15.8071 21.7788 15.5822 21.5917 15.3131 21.508C15.0439 21.4243 14.7526 21.4509 14.5031 21.5821L7.71018 25.1535L8.93135 18.0276C8.98359 17.7223 8.96085 17.4088 8.8651 17.1141C8.76936 16.8195 8.60346 16.5525 8.38168 16.3361L3.20518 11.29L10.3593 10.2501C10.9827 10.1595 11.521 9.76847 11.7987 9.20464L14.9975 2.72197L18.5236 9.86622C18.6114 10.0441 18.7472 10.1938 18.9157 10.2985C19.0842 10.4031 19.2787 10.4585 19.477 10.4584H28.1045C28.3863 10.4584 28.6566 10.3464 28.8558 10.1472C29.0551 9.94793 29.167 9.67768 29.167 9.39589C29.167 9.1141 29.0551 8.84385 28.8558 8.64459C28.6566 8.44533 28.3863 8.33339 28.1045 8.33339H20.1372L16.7131 1.39597Z" />
                                </svg>
                            </div>
                            <div class="navigation-box__title">
                                Star Rating
                            </div>
                        </a>
                        <a class="navigation-item" href="#customer-satisfaction">
                            <div class="navigation-item__img">
                                <svg width="26" height="23" viewBox="0 0 26 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M25.041 4.80861C24.6483 3.89935 24.0821 3.07538 23.374 2.38283C22.6654 1.68822 21.83 1.13622 20.9131 0.756857C19.9623 0.361914 18.9426 0.15976 17.9131 0.16213C16.4688 0.16213 15.0596 0.557638 13.835 1.30471C13.542 1.48342 13.2637 1.67971 13 1.89358C12.7363 1.67971 12.458 1.48342 12.165 1.30471C10.9404 0.557638 9.53125 0.16213 8.08691 0.16213C7.04687 0.16213 6.03906 0.361349 5.08691 0.756857C4.16699 1.13772 3.33789 1.68557 2.62598 2.38283C1.91698 3.0746 1.35062 3.89876 0.958984 4.80861C0.551758 5.7549 0.34375 6.75979 0.34375 7.79397C0.34375 8.76955 0.542969 9.78615 0.938477 10.8203C1.26953 11.6846 1.74414 12.5811 2.35059 13.4863C3.31152 14.919 4.63281 16.4131 6.27344 17.9278C8.99219 20.4385 11.6846 22.1729 11.7988 22.2432L12.4932 22.6885C12.8008 22.8848 13.1963 22.8848 13.5039 22.6885L14.1982 22.2432C14.3125 22.1699 17.002 20.4385 19.7236 17.9278C21.3643 16.4131 22.6855 14.919 23.6465 13.4863C24.2529 12.5811 24.7305 11.6846 25.0586 10.8203C25.4541 9.78615 25.6533 8.76955 25.6533 7.79397C25.6562 6.75979 25.4482 5.7549 25.041 4.80861ZM13 20.3711C13 20.3711 2.57031 13.6885 2.57031 7.79397C2.57031 4.80861 5.04004 2.38869 8.08691 2.38869C10.2285 2.38869 12.0859 3.584 13 5.3301C13.9141 3.584 15.7715 2.38869 17.9131 2.38869C20.96 2.38869 23.4297 4.80861 23.4297 7.79397C23.4297 13.6885 13 20.3711 13 20.3711Z" />
                                </svg>

                            </div>
                            <div class="navigation-box__title">
                                Satisfaction
                            </div>
                        </a>
                        <a class="navigation-item" href="#competitive-analysis">
                            <div class="navigation-item__img">
                                <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M12.1875 6.125C12.1875 5.60723 12.6072 5.1875 13.125 5.1875H26.7188C27.2365 5.1875 27.6562 5.60723 27.6562 6.125C27.6562 6.64277 27.2365 7.0625 26.7188 7.0625H13.125C12.6072 7.0625 12.1875 6.64277 12.1875 6.125Z" />
                                    <path
                                            d="M2.34375 6.125C2.34375 6.86668 2.56368 7.5917 2.97574 8.20839C3.38779 8.82507 3.97346 9.30572 4.65869 9.58955C5.34391 9.87338 6.09791 9.94764 6.82534 9.80295C7.55277 9.65825 8.22095 9.3011 8.7454 8.77665C9.26985 8.2522 9.627 7.58402 9.7717 6.85659C9.91639 6.12916 9.84213 5.37516 9.5583 4.68994C9.27447 4.00471 8.79382 3.41904 8.17714 3.00699C7.56045 2.59493 6.83543 2.375 6.09375 2.375C5.09953 2.37612 4.14635 2.77156 3.44333 3.47458C2.74031 4.1776 2.34487 5.13078 2.34375 6.125ZM6.09375 4.25C6.46459 4.25 6.8271 4.35997 7.13544 4.56599C7.44379 4.77202 7.68411 5.06486 7.82602 5.40747C7.96794 5.75008 8.00507 6.12708 7.93272 6.49079C7.86038 6.85451 7.6818 7.1886 7.41958 7.45083C7.15735 7.71305 6.82326 7.89163 6.45954 7.96397C6.09583 8.03632 5.71883 7.99919 5.37622 7.85727C5.03361 7.71536 4.74077 7.47504 4.53474 7.16669C4.32872 6.85835 4.21875 6.49584 4.21875 6.125C4.21931 5.62789 4.41703 5.1513 4.76854 4.79979C5.12005 4.44828 5.59664 4.25056 6.09375 4.25Z" />
                                    <path
                                            d="M12.1875 15.5C12.1875 14.9822 12.6072 14.5625 13.125 14.5625H26.7188C27.2365 14.5625 27.6562 14.9822 27.6562 15.5C27.6562 16.0178 27.2365 16.4375 26.7188 16.4375H13.125C12.6072 16.4375 12.1875 16.0178 12.1875 15.5Z" />
                                    <path
                                            d="M6.09375 19.25C6.83543 19.25 7.56045 19.0301 8.17714 18.618C8.79382 18.206 9.27447 17.6203 9.5583 16.9351C9.84213 16.2498 9.91639 15.4958 9.7717 14.7684C9.627 14.041 9.26985 13.3728 8.7454 12.8484C8.22095 12.3239 7.55277 11.9668 6.82534 11.8221C6.09791 11.6774 5.34391 11.7516 4.65869 12.0355C3.97346 12.3193 3.38779 12.7999 2.97574 13.4166C2.56368 14.0333 2.34375 14.7583 2.34375 15.5C2.34487 16.4942 2.74031 17.4474 3.44333 18.1504C4.14635 18.8534 5.09953 19.2489 6.09375 19.25ZM6.09375 13.625C6.46459 13.625 6.8271 13.735 7.13544 13.941C7.44379 14.147 7.68411 14.4399 7.82602 14.7825C7.96794 15.1251 8.00507 15.5021 7.93272 15.8658C7.86038 16.2295 7.6818 16.5636 7.41958 16.8258C7.15735 17.088 6.82326 17.2666 6.45954 17.339C6.09583 17.4113 5.71883 17.3742 5.37622 17.2323C5.03361 17.0904 4.74077 16.85 4.53474 16.5417C4.32872 16.2334 4.21875 15.8708 4.21875 15.5C4.21931 15.0029 4.41703 14.5263 4.76854 14.1748C5.12005 13.8233 5.59664 13.6256 6.09375 13.625Z" />
                                    <path
                                            d="M12.1875 24.875C12.1875 24.3572 12.6072 23.9375 13.125 23.9375H26.7188C27.2365 23.9375 27.6562 24.3572 27.6562 24.875C27.6562 25.3928 27.2365 25.8125 26.7188 25.8125H13.125C12.6072 25.8125 12.1875 25.3928 12.1875 24.875Z" />
                                    <path
                                            d="M6.09375 28.625C6.83543 28.625 7.56045 28.4051 8.17714 27.993C8.79382 27.581 9.27447 26.9953 9.5583 26.3101C9.84213 25.6248 9.91639 24.8708 9.7717 24.1434C9.627 23.416 9.26985 22.7478 8.7454 22.2234C8.22095 21.6989 7.55277 21.3418 6.82534 21.1971C6.09791 21.0524 5.34391 21.1266 4.65869 21.4105C3.97346 21.6943 3.38779 22.1749 2.97574 22.7916C2.56368 23.4083 2.34375 24.1333 2.34375 24.875C2.34487 25.8692 2.74031 26.8224 3.44333 27.5254C4.14635 28.2284 5.09953 28.6239 6.09375 28.625ZM6.09375 23C6.46459 23 6.8271 23.11 7.13544 23.316C7.44379 23.522 7.68411 23.8149 7.82602 24.1575C7.96794 24.5001 8.00507 24.8771 7.93272 25.2408C7.86038 25.6045 7.6818 25.9386 7.41958 26.2008C7.15735 26.463 6.82326 26.6416 6.45954 26.714C6.09583 26.7863 5.71883 26.7492 5.37622 26.6073C5.03361 26.4654 4.74077 26.225 4.53474 25.9167C4.32872 25.6084 4.21875 25.2458 4.21875 24.875C4.21931 24.3779 4.41703 23.9013 4.76854 23.5498C5.12005 23.1983 5.59664 23.0006 6.09375 23Z" />
                                </svg>
                            </div>
                            <div class="navigation-box__title">
                                Competitive
                                Analysis
                            </div>
                        </a>
                    </div>
                    <div class="product-main-info-block">
                        <div class="block-image">
                            <img src="<?php echo get_field('product_image');?>" alt="">
                        </div>
                        <div class="block-content">
                            <h1 class="product-name"><?php the_title();?></h1>

                            <ul class="product-rating">
                                <li>
                                    <strong>Sentiment:</strong>
                                    <div class="item-value excellent"><?php echo number_format(get_field('sentiment'), 2);?> %</div>
                                </li>
                                <li>
                                    <strong>Star Rating:</strong>
                                    <div class="star-rating">
                                        <div class="star <?php echo ($average >= 0 && $average < 1 ? 'half' :( $average >= 1 ? 'full' : '') );?>"></div>
                                        <div class="star <?php echo ($average >= 1 && $average < 2 ? 'half' :( $average >= 2 ? 'full' : '') );?>"></div>
                                        <div class="star <?php echo ($average >= 2 && $average < 3 ? 'half' :( $average >= 3 ? 'full' : '') );?>"></div>
                                        <div class="star <?php echo ($average >= 3 && $average < 4 ? 'half' :( $average >= 4 ? 'full' : '') );?>"></div>
                                        <div class="star <?php echo ($average >= 4 && $average < 5 ? 'half' :( $average >= 5 ? 'full' : '') );?>"></div>
                                    </div>
                                    <div class="item-value"><?php echo number_format($average, 2);?></div>
                                </li>
                            </ul>

                            <ul class="product-areas">
                                <li>
                                    <small>Industry</small>
                                    <?php echo $termindustry;?>
                                </li>
                                <li>
                                    <small>Brand</small>
                                    <?php echo get_field('product_brand_name');?>
                                </li>
                                <li>
                                    <small>Category</small>
                                    <?php echo $termcategory; ?>
                                </li>
                            </ul>
                        </div>
                        <?php if(get_field('product_brand_logo')){ ?>
                            <div class="block-product-logo">

                                <img src="<?php echo get_field('product_brand_logo');?>" alt="<?php echo get_the_title(); ?>">
                            </div>
                        <?php } ?>
                    </div>

                    <div class="product-stats-wrapper">
                        <div class="product-stats">

                            <div class="product-stats-card <?php  if(!get_field('rank')){ echo 'soon';} ?>" id="product_monthly_rank" data-info='<?php echo json_encode($product_monthly_rank);?>'>
                                <div class="card-header">
                                    <h3 class="card-caption">Market Rank</h3>
                                </div>
                                <div class="card-content">
                                    <div class="score-type">
                                        <p>Position</p>
                                        <!-- <div class="info-block">
                                            <button class="info-btn" aria-label="About Position"></button>
                                            <div class="block-hidden-content">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic sequi
                                                    ab natus, consectetur sit doloribus.</p>
                                            </div>
                                        </div> -->
                                    </div>
                                    <?php if (!empty(get_field('rank'))): ?>
                                    <div class="card-value"><?php echo get_field('rank');?></div>
                                    <div class="rating-change-block   <?php if(get_field('rank_trend')<=0){ ?>down<?php }else{ ?> up <?php } ?>"  "><?php echo get_field('rank_trend');?></div>

                                <a href="https://pro.sentimate.com/" data-link="/overview" data-modal="#popUp" class="more-link">
                                    <span class="link-text"><?php echo get_field('market_rank_btn','option');?></span>
                                </a>
                                <?php else: ?>
                                    <div class="rating-change-block soon">Coming soon</div>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="product-stats-card">
                            <div class="card-header">
                                <h3 class="card-caption">Star Rating</h3>
                            </div>
                            <div class="card-content">
                                <div class="card-star-rating">
                                    <div class="star-rating big">
                                        <div class="star <?php echo ($average >= 0 && $average < 1 ? 'half' :( $average >= 1 ? 'full' : '') );?>"></div>
                                        <div class="star <?php echo ($average >= 1 && $average < 2 ? 'half' :( $average >= 2 ? 'full' : '') );?>"></div>
                                        <div class="star <?php echo ($average >= 2 && $average < 3 ? 'half' :( $average >= 3 ? 'full' : '') );?>"></div>
                                        <div class="star <?php echo ($average >= 3 && $average < 4 ? 'half' :( $average >= 4 ? 'full' : '') );?>"></div>
                                        <div class="star <?php echo ($average >= 4 && $average < 5 ? 'half' :( $average >= 5 ? 'full' : '') );?>"></div>
                                    </div>
                                </div>

                                <p class="card-value"><?php  echo number_format($average, 2);?></p>
                                <span class="rating-change-block <?= $starRatingChangeClass ?>"><?php echo round($starRatingChange,2); ?></span>

                                <a href="https://pro.sentimate.com/" data-link="/star-rating" data-modal="#popUp" class="more-link">
                                    <span class="link-text"><?php echo get_field('user_rating_btn','option');?></span>
                                </a>
                            </div>
                        </div>

                        <div class="product-stats-card">
                            <div class="card-header">
                                <h3 class="card-caption">Engagement</h3>
                            </div>
                            <div class="card-content">
                                <div class="score-type">
                                    <p>Reviews</p>
                                </div>
                                <p class="card-value" data-id="reviews"></p>
                                <span class="rating-change-block " data-id="reviewsRise"></span>

                                <a href="https://pro.sentimate.com/" data-link="/overview" data-modal="#popUp" class="more-link">
                                    <span class="link-text">View All</span>
                                </a>
                            </div>
                        </div>

                        <div class="product-stats-card" id="product_monthly_reviews" data-info='<?php echo json_encode($product_monthly_reviews);?>'>
                            <div class="card-header">
                                <h3 class="card-caption">Satisfaction</h3>
                            </div>
                            <div class="card-content">
                                <div class="score-type">
                                    <p>CSAT SCORE</p>
                                </div>

                                <p class="card-value" data-id="satisfactionScore"></p>
                                <span class="rating-change-block down" data-id="satisfactionChange"></span>

                                <a href="https://pro.sentimate.com/" data-link="/satisfaction" data-modal="#popUp" class="more-link">
                                    <span class="link-text">View All</span>
                                </a>
                            </div>
                        </div>
                        <?php
                        $ddd = get_field('re-purchase');

                        $ddd = json_decode($ddd);
                        ?>

                        <!--  ////////////////////////////////////////// -->
                        <!-- TODO: Добавить проверку, когда будет API (как в первом блоке) -->
                        <div class="product-stats-card ">
                            <div class="card-header">
                                <h3 class="card-caption">Re-Purchase</h3>
                            </div>
                            <div class="card-content">
                                <div class="score-type">
                                    <p>Probability</p>
                                </div>

                                <div class="card-value">
                                    <?php
                                    $averageSentiment=$ddd[count($ddd)-1]->sentiment*100;
                                    $averageSentiment2=$ddd[count($ddd)-2]->sentiment*100;
                                    $averageSentimentTrend=$averageSentiment-$averageSentiment2;
                                    echo round($averageSentiment,1);
                                    ?>%
                                </div>
                                <?php if($averageSentimentTrend){ ?>
                                    <div class="rating-change-block <?php if($averageSentimentTrend<=0){ ?>down<?php }else{ ?> up <?php } ?>"><?php echo round($averageSentimentTrend,2); ?>%</div>
                                <?php } ?>
                                <a href="https://pro.sentimate.com/"  data-link="/satisfaction"  data-modal="#popUp" class="more-link">
                                    <span class="link-text">View All</span>
                                </a>

                                <!--                                    <div class="rating-change-block soon">Coming soon</div>-->
                            </div>
                        </div>
                        <!--  ////////////////////////////////////////// -->

                        <?php
                        $ddd = get_field('recommenders');
                        $ddd = json_decode($ddd);
                        ?>
                        <div class="product-stats-card">
                            <div class="card-header">
                                <h3 class="card-caption">Recommenders</h3>
                            </div>
                            <div class="card-content">
                                <div class="score-type">
                                    <p>Rate</p>
                                </div>

                                <div class="card-value">
                                    <?php
                                    $averageSentiment=$ddd[count($ddd)-1]->sentiment*100;
                                    $averageSentiment2=$ddd[count($ddd)-2]->sentiment*100;
                                    $averageSentimentTrend=$averageSentiment-$averageSentiment2;
                                    echo round($averageSentiment,1);
                                    ?>%
                                </div>
                                <?php if($averageSentimentTrend){ ?>
                                    <div class="rating-change-block <?php if($averageSentimentTrend<=0){ ?>down<?php }else{ ?> up <?php } ?>"><?php echo round($averageSentimentTrend,2); ?>%</div>
                                <?php } ?>



                                <a href="https://pro.sentimate.com/" data-link="/overview"  data-modal="#popUp" class="more-link">
                                    <span class="link-text">View All</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="product-subsection star-rating-analysis" id="star-rating">
                    <div class="subsection-caption">
                        <div class="sc-image">
                            <img src="<?= get_template_directory_uri() ?>/img/content-images/product-page/star-rating-analysis.svg" alt="">
                        </div>
                        <h2 class="sc-title">Star Rating Analysis</h2>
                    </div>

                    <div class="subsection-inner">
                        <div class="metrics-card">
                            <div class="card-header">
                                <div class="card-caption">
                                    <h3 class="card-title">Avg. Star Rating</h3>
                                    <div class="info-block big">
                                        <button class="info-btn" aria-label="About Avg. Star Rating"></button>
                                        <div class="block-hidden-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic sequi
                                                ab natus, consectetur sit doloribus.</p>
                                        </div>
                                    </div>
                                </div>

                                <a href="https://pro.sentimate.com/" data-link="/star-rating" data-modal="#popUp" class="more-link">
                                    <span class="link-text">View All</span>
                                </a>
                            </div>

                            <div class="card-content">
                                <div class="star-rating-metric-block">
                                    <div class="block-content">
                                        <div class="star-rating big">
                                            <div class="star full"></div>
                                            <div class="star full"></div>
                                            <div class="star half"></div>
                                            <div class="star"></div>
                                            <div class="star"></div>
                                        </div>

                                        <div class="block-value">3.26</div>
                                        <div class="rating-change-block down">2.1%</div>
                                    </div>

                                    <div class="block-chart" id="product_star_rating" data-info='<?php echo json_encode($product_star_rating);?>'>
                                        <div class="mg__graphic">
                                            <div id="chartdiv" style="width: 52%; height: 135px;"></div>
                                            <div class="stars-column" style="padding: 0;">
                                                <ul>
                                                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                                                        <li data-stars="<?= $i?>">
                                                            <div class="star-rating__icon">
                                                                <img src="<?= $baseAssetUrl . 'img/stars/Star-'.$i.'.svg'; ?>" />
                                                                <div class="star-rating__label"><?= $i?> star<?php if ($i > 1) echo 's'; ?></div>
                                                            </div>
                                                            <div class="star-rating__value" style="font-weight: bold;"></div>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                                <ul class="rating_general hidden">
                                                    <li class="detractors">Negative</li>
                                                    <li class="neutral">Neutral</li>
                                                    <li class="promouters">Positive</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="metrics-card">
                            <div class="card-header">
                                <div class="card-caption">
                                    <h3 class="card-title">Stars Contributors</h3>
                                    <div class="info-block big">
                                        <button class="info-btn" aria-label="About Stars Contributors"></button>
                                        <div class="block-hidden-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic sequi
                                                ab natus, consectetur sit doloribus.</p>
                                        </div>
                                    </div>
                                </div>

                                <a href="https://pro.sentimate.com/" data-link="/star-rating" data-modal="#popUp" class="more-link">
                                    <span class="link-text">View All</span>
                                </a>
                            </div>

                            <div class="card-content">
                                <div class="stars-contributors-metric-block">
                                    <div class="block-row">
                                        <div class="row-left">
                                            <p class="row-label">5 Stars Contributors</p>
                                            <div class="star-rating big">
                                                <div class="star full"></div>
                                                <div class="star full"></div>
                                                <div class="star full"></div>
                                                <div class="star full"></div>
                                                <div class="star full"></div>
                                            </div>
                                        </div>
                                        <div class="row-right">
                                            <ul class="row-tags positive">
                                                <?php
                                                $ddd = get_field('topicsadvdisadv');
                                                $ddd = json_decode($ddd);
                                                foreach($ddd as $value) {
                                                    foreach ($value as $v) {
                                                        if($v->sentiment>=70){
                                                            ?>
                                                            <li><?php echo $v->name; ?></li>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="block-row">
                                        <div class="row-left">
                                            <p class="row-label">1-2 Stars Contributors</p>
                                            <div class="star-rating big">
                                                <div class="star full"></div>
                                                <div class="star full"></div>
                                                <div class="star"></div>
                                                <div class="star"></div>
                                                <div class="star"></div>
                                            </div>
                                        </div>
                                        <div class="row-right">
                                            <ul class="row-tags negative">
                                                <?php
                                                foreach($ddd as $value) {
                                                    foreach ($value as $v) {
                                                        if($v->sentiment<70){
                                                            ?>
                                                            <li><?php echo $v->name; ?></li>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="product-subsection customer-satisfaction" id="customer-satisfaction">
                    <div class="subsection-caption">
                        <div class="sc-image">
                            <img src="<?= get_template_directory_uri() ?>/img/content-images/product-page/customer-satisfaction.svg" alt="">
                        </div>
                        <h2 class="sc-title">Customer Satisfaction</h2>
                    </div>

                    <div class="subsection-inner">
                        <div class="metrics-card">
                            <div class="card-header">
                                <div class="card-caption">
                                    <h3 class="card-title">Overall Customer Satisfaction</h3>
                                </div>

                                <a href="https://pro.sentimate.com/" data-link="/satisfaction" data-modal="#popUp" class="more-link xs-hidden">
                                    <span class="link-text">Explore More</span>
                                </a>
                            </div>

                            <div class="card-content">
                                <div class="customer-satisfaction-chart-wrapper">
                                    <div class="customer-satisfaction-chart section__product_satisfaction" id="product_satisfaction">
                                        <div class="mg__graphic" style="flex-wrap: wrap; width: 100%;">
                                            <div class="satisfaction-head" style="margin: 0; width: 100%;">
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
                            </div>
                        </div>

                        <div class="metrics-card">
                            <div class="card-header">
                                <div class="card-caption">
                                    <h3 class="card-title">Most Discussed Topics</h3>
                                </div>

                                <a href="https://pro.sentimate.com/"  data-link="/comparison" data-modal="#popUp" class="more-link">
                                    <span class="link-text">Explore More</span>
                                </a>
                            </div>

                            <div class="card-content">
                                <div class="most-discussed-topics-block mg__content" style="height: auto; display: block; width: 100%;">
                                    <?php
                                    $ddd = get_field('product_topic_monthly_sentiment');
                                    $ddd = json_decode($ddd);
                                    ?>
                                    <input type="hidden" id="product_topic_monthly_sentiment" name="product_topic_monthly_sentiment" value='<?php echo json_encode( $ddd );?>' />

                                    <?php

                                    $most_discussed_topics=array();
                                    $ddd = get_field('all_topics_data');
                                    $ddd = json_decode($ddd);
                                    ?>


                                    <!--  ////////////////////////////////////////// -->
                                    <div class="section__product_satisfaction" id="product_satisfaction" style="display: block;">
                                        <table class="block__table2 product-table-desktop" border="1">
                                            <tr class="tr tr__head">
                                                <td class="td__col td__head td__prod">Topic name</td>
                                                <td class="td__col td__head" style="text-align: center;">volume Share</td>
                                                <td class="td__col td__head" style="text-align: center;">satisfaction</td>
                                                <td class="td__col td__head td__last">Sentiment distribuion</td>
                                            </tr>
                                            <?php
                                            $i=0;
                                            foreach($ddd as $value) {
                                                foreach ($value as $va) {
                                                    $i++;
                                                    if($i<7){
                                                        ?>
                                                        <tr class="tr">
                                                            <td class="td__col td__prod"><?php  print_R($va->name);?></td>
                                                            <td class="td__col">
                                                                <div class="t_flbox" style="justify-content: center;"><?php  print_R(round($va->share,1));?>% <div class="numbers_bottom">-</div>
                                                                </div>
                                                            </td>
                                                            <td class="td__col">
                                                                <div class="t_flbox" style="justify-content: center;"><?php  print_R(round($va->averageSentiment,1));?>% <div class="numbers_bottom">-</div>
                                                                </div>
                                                            </td>
                                                            <td class="td__col td__last">

                                                                <div class="line_progress">
                                                                    <div class="lp lp__red"  style="width:  <?php print_R($va->sentimentsDeviation->negative);?>%  ;"></div>
                                                                    <div class="lp lp__gray"  style="width:  <?php print_R($va->sentimentsDeviation->neutral);?>% ;"></div>
                                                                    <div class="lp lp__green" style="width:  <?php print_R($va->sentimentsDeviation->positive);?>% ;"></div>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>

                                            <tr></tr>
                                        </table>



                                        <!--                                        Mobile table here-->
                                        <div class="block__table2 product-table-mobile" border="1">
                                            <div class="tr tr__head">
                                                <div class="td__col td__head td__prod">Topic name</div>
                                                <div class="td__col-rate">
                                                    <div class="td__col td__head" style="text-align: center;">SOD</div>
                                                    <div class="td__col td__head td__head-last" style="text-align: center;">SENTIMENT</div>
                                                </div>
                                            </div>
                                            <?php
                                            $i=0;
                                            foreach($ddd as $value) {
                                                foreach ($value as $va) {
                                                    $i++;
                                                    if($i<7){
                                                        ?>
                                                        <div class="tr tr-flex">
                                                            <div class="tr-flex_row">
                                                                <div class="td__col td__prod td__prod-mobile"><?php  print_R($va->name);?></div>
                                                                <div class="td__col-rate td__col-rate-precents">
                                                                    <div class="td__col">
                                                                        <div class="t_flbox" style="justify-content: center;"><?php  print_R(round($va->share,1));?>%
                                                                        </div>
                                                                    </div>
                                                                    <div class="td__col">
                                                                        <div class="t_flbox" style="justify-content: center;"><?php  print_R(round($va->averageSentiment,1));?>%
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="td__col td__last">

                                                                <div class="line_progress">
                                                                    <div class="lp lp__red"  style="width:  <?php print_R($va->sentimentsDeviation->negative);?>%  ;"></div>
                                                                    <div class="lp lp__gray"  style="width:  <?php print_R($va->sentimentsDeviation->neutral);?>% ;"></div>
                                                                    <div class="lp lp__green" style="width:  <?php print_R($va->sentimentsDeviation->positive);?>% ;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


                <div class="top-ranked-products-component">
                    <h3 class="cmp-caption">Top Ranked Products in the
                        <?php if ($active_term) {
                            echo '<a href="'. get_term_link( $active_term->term_id, 'product_category') .'">'. $active_term->name . ' ' .'</a>';
                        } else {
                            echo '<a href="">'. $termcategory . ' ' .'</a>';
                        } ?>
                        Category</h3>

                    <div class="top-ranked-slider">
                        <button type="button" data-modal="#popUp" data-link="/category-analysis/overview?q=&industry=<?php echo trim($termindustry_l); ?>&category=<?php echo trim($termcategory_l); ?>" class="slick-arrow slick-prev" aria-label="Previous"><svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 26"><path d="M.62 14.15l10.6 10.59c.4.41.88.61 1.47.61.6 0 1.08-.2 1.48-.61l1.23-1.22a2.13 2.13 0 000-2.96l-7.9-7.9 7.88-7.88a2.13 2.13 0 000-2.96L14.15.6a2 2 0 00-1.47-.6 2 2 0 00-1.47.6L.6 11.19a2.09 2.09 0 00.02 2.96z"/></svg></button>
                        <?php
                        $products=json_decode(get_field('category_top_10_products_data'))[0]->items;

                        $arr_products=array();
                        foreach ($products as $product) {
                            $arr_products[]=$product->uuid;
                        }
                        if ($products) {
                            $args= array(
                                'numberposts' => 5,
                                'post_type'   => 'products',
                                'meta_key' => 'sentiment',
                                'orderby' => 'meta_value_num',
                                'meta_query' => array(
                                    array(
                                        'key'       => 'product_uuid',
                                        'value' => $arr_products,
                                        'compare' => 'IN'
                                    )
                                )
                            );
                        } else {
                            $args= array(
                                'numberposts' => 5,
                                'post_type'   => 'products',
                                'exclude' => get_the_ID(),
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'product_category',
                                        'field'    => 'term_id',
                                        'terms'    => $active,
                                    )
                                ),
                                'meta_query' => array(
                                    'relation' => 'OR',
//                                        array(
//                                            'key' => 'star_rating',
//                                            'value' => [4, 5],
//                                            'compare' => 'BETWEEN',
//                                        ),
                                    array(
                                        'key' => 'sentiment',
                                        'value' => '80',
                                        'compare' => '>',
                                    )
                                )
                            );
                        }

                        $posts = get_posts( $args);

                        $h = 0;
                        foreach( $posts as $post ){$h++;

                            if ($h == 5) {
                                break;
                            }

                            setup_postdata($post);
                            ?>
                            <div class="slide">
                                <a href="<?php echo get_permalink(); ?>" class="product-card">
                                    <div class="card-number"><?php if($h<10){ ?>0 <?php } ?><?php echo $h;?></div>
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
                                            <div class="more-link" >
                                                <span class="link-text">View Report</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>



                            <?php

                        }

                        wp_reset_postdata(); // сброс

                        ?>

                        <button type="button" data-modal="#popUp" data-link="/category-analysis/overview?q=&industry=<?php echo trim($termindustry_l); ?>&category=<?php echo trim($termcategory_l); ?>" class="slick-arrow slick-next" aria-label="Next"><svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 26"><path d="M15.38 11.2L4.78.63C4.38.2 3.9 0 3.3 0c-.6 0-1.08.2-1.48.62L.6 1.83a2.13 2.13 0 000 2.96l7.9 7.9-7.88 7.89a2.13 2.13 0 000 2.96l1.23 1.21c.4.4.9.6 1.47.6a2 2 0 001.47-.6L15.4 14.17c.4-.42.6-.91.6-1.5a2.09 2.09 0 00-.62-1.46z"/></svg></button>
                    </div>
                </div>

                <div class="product-subsection competitive-analysis" id="competitive-analysis">
                    <div class="subsection-caption">
                        <div class="sc-image">
                            <img src="<?= get_template_directory_uri() ?>/img/content-images/product-page/customer-satisfaction.svg" alt="">
                        </div>
                        <h2 class="sc-title">Competitive Analysis</h2>
                    </div>
                    <div class="subsection-inner">
                        <div class="product-wrapper">
                            <div class="product-inner">
                                <div class="product-analysis">
                                    <div class="product-main-info-block">
                                        <div class="block-image">
                                            <img src="<?php echo get_field('product_image');?>" alt="">
                                        </div>
                                        <div class="block-content">
                                            <h3 class="product-name"><?php the_title();?></h3>

                                            <ul class="product-rating">
                                                <li>
                                                    <strong>Sentiment:</strong>
                                                    <div class="item-value excellent"><?php echo number_format(get_field('sentiment'), 2);?> %</div>
                                                </li>
                                                <li>
                                                    <strong>Star Rating:</strong>
                                                    <div class="star-rating">
                                                        <div class="star <?php echo ($average >= 0 && $average < 1 ? 'half' :( $average >= 1 ? 'full' : '') );?>"></div>
                                                        <div class="star <?php echo ($average >= 1 && $average < 2 ? 'half' :( $average >= 2 ? 'full' : '') );?>"></div>
                                                        <div class="star <?php echo ($average >= 2 && $average < 3 ? 'half' :( $average >= 3 ? 'full' : '') );?>"></div>
                                                        <div class="star <?php echo ($average >= 3 && $average < 4 ? 'half' :( $average >= 4 ? 'full' : '') );?>"></div>
                                                        <div class="star <?php echo ($average >= 4 && $average < 5 ? 'half' :( $average >= 5 ? 'full' : '') );?>"></div>
                                                    </div>
                                                    <div class="item-value"><?php echo number_format($average, 2);?></div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="block-content-footer">
                                            <ul class="product-areas">
                                                <li>
                                                    <small>Industry</small>
                                                    <?php echo $termindustry;?>
                                                </li>
                                                <li>
                                                    <small>Brand</small>
                                                    <?php echo get_field('product_brand_name');?>
                                                </li>
                                                <li>
                                                    <small>Category</small>
                                                    <?php echo $termcategory; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-compare">
                                    <div class="product-compare-icon">
                                        <img src="<?= get_template_directory_uri() ?>/img/icons/vs.svg" alt="">
                                    </div>
                                </div>

                                <div class="product-analysis">
                                    <div class="product-analysis-btn"  data-link="/comparison" data-modal="#popUp">
                                        <a href="https://pro.sentimate.com/" target="_blank">
                                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <rect class="bg" x="0.5" y="0.5" width="39" height="39" rx="1.5" />
                                                <line class="line" x1="20.5" y1="12.5" x2="20.5" y2="28.5"
                                                      stroke-linecap="round" />
                                                <line class="line-2" x1="28.5" y1="20.5" x2="12.5" y2="20.5"
                                                      stroke-linecap="round" />
                                            </svg>
                                        </a>
                                        <span>Add product to compare</span>
                                    </div>
                                </div>
                            </div>

                            <div class="product-graph">
                                <div class="metrics-card">
                                    <div class="card-header">
                                        <div class="card-caption">
                                            <h3 class="card-title">Most Discussed Topics of the Category</h3>
                                        </div>

                                        <a href="https://pro.sentimate.com/"  data-link="/comparison" data-modal="#popUp" class="more-link">
                                            <span class="link-text">Explore More</span>
                                        </a>
                                    </div>

                                    <div class="card-content">
                                        <div class="graph-area-scrollable-container">
                                            <div class="graph-area">
                                                <div class="graph-area-lines">
                                                    <div class="graph-area-wrapper">
                                                        <div class="graph-area-number">100</div>
                                                        <div class="graph-area-line"></div>
                                                    </div>
                                                    <div class="graph-area-wrapper">
                                                        <div class="graph-area-number">75</div>
                                                        <div class="graph-area-line"></div>
                                                    </div>
                                                    <div class="graph-area-wrapper">
                                                        <div class="graph-area-number">50</div>
                                                        <div class="graph-area-line"></div>
                                                    </div>
                                                    <div class="graph-area-wrapper">
                                                        <div class="graph-area-number">25</div>
                                                        <div class="graph-area-line"></div>
                                                    </div>
                                                    <div class="graph-area-wrapper">
                                                        <div class="graph-area-number">0</div>
                                                        <div class="graph-area-line"></div>
                                                    </div>
                                                </div>
                                                <?php
                                                $i=0;
                                                foreach($ddd as $value) {
                                                    foreach ($value as $va) {
                                                        $i++;
                                                        if($i<7){
                                                            ?>
                                                            <div class="graph-area-bar">
                                                                <div class="graph-area-bar-container">
                                                                    <div class="graph-area-bar-inner">
                                                                        <div class="graph-area-bar-wrapper">
                                                                            <div class="graph-area-block-first"
                                                                                 style="height: <?php print_R($va->sentimentsDeviation->positive);?>%;">
                                                                                <div class="graph-area-bar-percent">
                                                                                    <?php
                                                                                    if (round($va->sentimentsDeviation->positive, 1) > 0) {
                                                                                        print_R(round($va->sentimentsDeviation->positive, 1));
                                                                                        ?>%
                                                                                    <? } else { ?>
                                                                                        ?
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="graph-area-bar-inner">
                                                                        <div class="graph-area-bar-wrapper">
                                                                            <div class="graph-area-block-second"
                                                                                 style="height: 0%;">
                                                                                <div class="graph-area-bar-percent">?</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="graph-area-bar-name"><?php print_R($va->name);?></div>
                                                            </div>


                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-table">
                                <div class="metrics-card">
                                    <div class="card-header">
                                        <div class="card-caption">
                                            <h3 class="card-title">Most Discussed Topics</h3>
                                        </div>

                                        <a href="https://pro.sentimate.com/"  data-link="/comparison" data-modal="#popUp" class="more-link">
                                            <span class="link-text">Explore More</span>
                                        </a>
                                    </div>

                                    <div class="card-content mg__content" style="height: auto; display: block; width: 100%;">
                                        <div class="section__product_satisfaction analysis-table" id="product_satisfaction" style="display: block;">
                                            <table border="0">
                                                <thead>
                                                <th>Topic name</th>
                                                <th style="text-align: center;">Share Of Discussion</th>
                                                <th style="text-align: center;">SENTIMENT</th>
                                                <th style="display: none;">Sentiment distribuion</th>
                                                </thead>

                                                <tbody>
                                                <?php
                                                $i=0;
                                                foreach($ddd as $value) {
                                                    foreach ($value as $va) {
                                                        $i++;
                                                        if($i<7){
                                                            ?>
                                                            <tr class="tr">
                                                                <td class="td__col td__prod"><?php  print_R($va->name);?></td>
                                                                <td class="td__col">
                                                                    <div class="t_flbox" style="justify-content: center;"><?php  print_R(round($va->share,1));?>% <div class="numbers_bottom" style="padding: 0.2em">-</div>
                                                                    </div>
                                                                </td>
                                                                <td class="td__col">
                                                                    <div class="t_flbox" style="justify-content: center;"><?php  print_R(round($va->averageSentiment,1));?>% <div class="numbers_bottom" style="padding: 0.2em">-</div>
                                                                    </div>
                                                                </td>
                                                                <td class="td__col td__last" style="display: none;">

                                                                    <div class="line_progress">
                                                                        <div class="lp lp__red"  style="width:  <?php print_R($va->sentimentsDeviation->negative);?>%  ;"></div>
                                                                        <div class="lp lp__gray"  style="width:  <?php print_R($va->sentimentsDeviation->neutral);?>% ;"></div>
                                                                        <div class="lp lp__green" style="width:  <?php print_R($va->sentimentsDeviation->positive);?>% ;"></div>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="metrics-card">
                                    <div class="card-header">
                                        <div class="card-caption">
                                            <h3 class="card-title">Most Discussed Topics</h3>
                                        </div>

                                        <a href="https://pro.sentimate.com/"  data-link="/comparison" data-modal="#popUp" class="more-link">
                                            <span class="link-text">Explore More</span>
                                        </a>
                                    </div>

                                    <div class="card-content">
                                        <div class="analysis-table">
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th>Topic Name</th>
                                                    <th style="text-align: center;">Share Of Discussion</th>
                                                    <th style="text-align: center;">SENTIMENT</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i=0;
                                                foreach($ddd as $value) {
                                                    foreach ($value as $va) {
                                                        $i++;
                                                        if($i<7){
                                                            ?>
                                                            <tr class="tr">
                                                                <!--                                                                     <td class="td__col td__prod"><?php  print_R($va->name);?></td> -->
                                                                <td class="td__col td__prod" style="padding-left:50px;">-</td>
                                                                <td class="td__col">
                                                                    <div class="t_flbox" style="justify-content: center;"><div class="numbers_bottom" style="padding: 0.2em; margin-left: 0;">-</div>
                                                                    </div>
                                                                </td>
                                                                <td class="td__col">
                                                                    <div class="t_flbox" style="justify-content: center;"><div class="numbers_bottom" style="padding: 0.2em; margin-left: 0;">-</div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
        </section>
        </div>

    <?php  }else{ ?>
        <div class="single-products-content">
            <?php if(!get_field('hide_fix_navigation_','option')){  get_template_part( 'revuzeapi/partials-demo/product_navigation' ); }  ?>

            <?php get_template_part( 'revuzeapi/partials-demo/share-sidebar' ); ?>

            <div id="singleProduct">
                <div class="container">
                    <div class="breadcrumbs">
                        <ul itemscope itemtype="https://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope
                                itemtype="https://schema.org/ListItem">
                                <a itemprop="item" href="<?php echo get_home_url();?>">
                                    <span itemprop="name"><?php echo get_the_title( get_option('page_on_front') );?></span></a>
                                <meta itemprop="position" content="1" />
                            </li>
                            <!--                        <li itemprop="itemListElement" itemscope-->
                            <!--                            itemtype="https://schema.org/ListItem">-->
                            <!--                            <a itemscope itemtype="https://schema.org/WebPage"-->
                            <!--                               itemprop="item" itemid="--><?php //echo get_permalink('3495'); ?><!--"-->
                            <!--                               href="--><?php //echo get_permalink('3495'); ?><!--">-->
                            <!--                                <span itemprop="name">--><?php //echo get_the_title('3495'); ?><!--</span></a>-->
                            <!--                            <meta itemprop="position" content="2" />-->
                            <!--                        </li>-->
                            <!--                        <li itemprop="itemListElement" itemscope-->
                            <!--                            itemtype="https://schema.org/ListItem">-->
                            <!--                            <a itemscope itemtype="https://schema.org/WebPage"-->
                            <!--                               itemprop="item" itemid="--><?php //echo get_term_link($termindustry->term_id,'product_industry'); ?><!--"-->
                            <!--                               href="--><?php //echo get_term_link($termindustry->term_id,'product_industry'); ?><!--">-->
                            <!--                                <span itemprop="name">--><?php //echo $termindustry->name; ?><!--</span></a>-->
                            <!--                            <meta itemprop="position" content="3" />-->
                            <!--                        </li>-->
                            <!--                        <li itemprop="itemListElement" itemscope-->
                            <!--                            itemtype="https://schema.org/ListItem">-->
                            <!--                            <a itemscope itemtype="https://schema.org/WebPage"-->
                            <!--                               itemprop="item" itemid="--><?php //echo get_term_link($termcategory->term_id,'product_category'); ?><!--"-->
                            <!--                               href="--><?php //echo get_term_link($termcategory->term_id,'product_category'); ?><!--">-->
                            <!--                                <span itemprop="name">--><?php //echo get_name_category($termcategory->name); ?><!--</span></a>-->
                            <!--                            <meta itemprop="position" content="4" />-->
                            <!--                        </li>-->
                            <!--                        --><?php //$rd_terms = wp_get_post_terms( get_the_ID(), 'product_category', array( "fields" => "ids" ) ); // getting the term IDs
                            //                        $term_array = trim( implode( ',', (array) $rd_terms ), ' ,' );
                            //                        $neworderterms = get_terms('product_category', 'orderby=none&include=' . $term_array );
                            //                        if( $neworderterms && $term_array) {
                            //                            $neworderterms2 = array_reverse($neworderterms);
                            //                            foreach( $neworderterms2 as $x => $term ) : $orderterm = get_term($term, 'product_category'); ?>
                            <!--                                <li itemprop="itemListElement" itemscope-->
                            <!--                                    itemtype="https://schema.org/ListItem">-->
                            <!--                                    <a itemscope itemtype="https://schema.org/WebPage"-->
                            <!--                                       itemprop="item" itemid="--><?php //echo get_term_link($orderterm->term_id); ?><!--"-->
                            <!--                                       href="--><?php //echo get_term_link($orderterm->term_id); ?><!--">-->
                            <!--                                        <span itemprop="name">--><?php //echo $term->name; ?><!--</span></a>-->
                            <!--                                    <meta itemprop="position" content="--><?//= $x + 4; ?><!--" />-->
                            <!--                                </li>-->
                            <!--                            --><?php //endforeach;
                            //                        } ?>
                            <?php if ($parents) : foreach ($parents as $u => $parent) : ?>
                                <li itemprop="itemListElement" itemscope
                                    itemtype="https://schema.org/ListItem">
                                    <a itemprop="item" href="<?php echo get_term_link($parent,'product_category'); ?>">
                                        <span itemprop="name"><?php echo $parent->name; ?></span></a>
                                    <meta itemprop="position" content="<?= $u + 2; ?>" />
                                </li>
                            <?php endforeach; endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="section section__overview" id="overview">
                    <div class="container container__product">
                        <div class="section__overview__top_info">
                            <div class="prod_img">
                                <img src="<?php echo get_field('product_image');?>" alt="product_img"></div>
                            <div class="top_info__box">
                                <div class="box__section_top">
                                    <div class="logo-add">
                                    </div>
                                    <?php get_template_part( 'revuzeapi/partials-demo/share-header-button' ); ?>
                                </div>
                                <div class="box__section_mid">
                                    <h1 class="prod_title"><?php the_title();?></h1>
                                    <div class="prod_model">Model</div>
                                </div>
                                <div class="box__section_bottom">
                                    <table>
                                        <thead>
                                        <td>Industry</td>
                                        <td>Brand</td>
                                        <td>Category</td>
                                        </thead>
                                        <tr>
                                            <td class="info-col" data-id="industry"><?php echo $termindustry;?></td>
                                            <td class="info-col" data-id="brand"><?php echo get_field('product_brand_name');?></td>
                                            <td class="info-col" data-id="category"><?php echo $termcategory; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="get_field">
                            <div class="mini_graphics__box">
                                <?php get_template_part( 'revuzeapi/partials-demo/competitive_landscape_rank' ); ?>
                                <?php get_template_part( 'revuzeapi/partials-demo/product_star_rating' ); ?>
                                <?php get_template_part( 'revuzeapi/partials-demo/satisfaction_small' ); ?>
                                <?php get_template_part( 'revuzeapi/partials-demo/product_engagement' ); ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="section__competitive_landscape" id="competitive_landscape" data-id="<?php echo get_field('product_uuid');?>">
                    <div class="container container__product">
                        <div class="section_title hidden">
                            <div class="section_icon"><img src="<?= $baseAssetUrl; ?>img/icons/cil_list.svg" alt="ci_list"></div>
                            <h2>Market</h2>
                        </div>
                        <div class="mg__item mg__item__lg hidden">
                            <div class="mg__title">
                                <div class="block_title">Top 10</div>
                                <a href="https://pro.sentimate.com/" class="v_all"><?php echo get_field('market_btn','option');?> <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
                            </div>
                            <div class="mg__content">
                                <?php
                                $ddd = get_field('category_top_10_products_data');
                                $ddd = json_decode($ddd);
                                ?>
                                <div class="mg__graphic" style="width: 100%;">
                                    <div id="scatteredGraph" class="loading"  style="width: 100%;height: 350px;"></div>
                                </div>
                                <input type="hidden" id="scatteredGraphinput" value='<?php echo json_encode( $ddd );?>'>
                            </div>
                        </div>

                        <div class="mg__item mg__item__lg">
                            <div class="mg__title">
                                <div class="block_title">Competing </div>

                                <a href="https://pro.sentimate.com/" class="v_all"><?php echo get_field('competing_btn','option');?> <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
                            </div>
                            <div class="mg__content">

                                <?php echo get_field('product_competing_table'); ?>
                            </div>
                        </div>

                        <div class="view_list">
                            <a href="https://pro.sentimate.com/"  class="btn"><?php echo get_field('competing_bottom_btn','option');?></a>
                        </div>
                    </div>
                </div>
                <?php
                $ddd = get_field('product_topic_monthly_sentiment');
                $ddd = json_decode($ddd);
                ?>
                <input type="hidden" id="product_topic_monthly_sentiment" name="product_topic_monthly_sentiment" value='<?php echo json_encode( $ddd );?>' />
                <div class="section__product_satisfaction" id="product_satisfaction">
                    <div class="container container__product">
                        <div class="section_title">
                            <div class="section_icon"><img src="<?= $baseAssetUrl; ?>img/icons/satisfaction.svg" alt="ci_list"></div>
                            <h2>Customer Satisfaction</h2>
                        </div>

                        <?php get_template_part( 'revuzeapi/partials-demo/overall_satisfaction_overtime' ); ?>

                        <div class="mg__item mg__item__lg  hidden">
                            <div class="mg__title">
                                <div class="block_title"><?php echo get_field('main_conversation_topics_btn','option');?></div>
                                <a href="https://pro.sentimate.com/" class="v_all">View Entire List <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
                            </div>
                            <div class="mg__content">
                                <table class="block__table2" border="1">
                                    <tr class="tr tr__head">
                                        <td class="td__col td__head td__prod">Topic name</td>
                                        <td class="td__col td__head">volume Share</td>
                                        <td class="td__col td__head">satisfaction</td>
                                        <td class="td__col td__head td__last">Sentiment distribuion</td>
                                    </tr>

                                    <tr class="tr">
                                        <td class="td__col td__prod">Shipping</td>
                                        <td class="td__col">
                                            <div class="t_flbox">14% <div class="numbers_bottom"><span class="mark mark__gr">4%</span>    </div>
                                            </div>
                                        </td>
                                        <td class="td__col">
                                            <div class="t_flbox">12% <div class="numbers_bottom"><span class="mark mark__gr">4%</span>    </div>
                                            </div>
                                        </td>
                                        <td class="td__col td__last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>
                                    </tr>


                                    <tr class="tr">
                                        <td class="td__col td__prod">Is it recomended?</td>
                                        <td class="td__col">
                                            <div class="t_flbox">18% <div class="numbers_bottom"> <span class="mark mark__red">4%</span></div></div>
                                        </td>
                                        <td class="td__col">
                                            <div class="t_flbox">34% <div class="numbers_bottom"><span class="mark mark__red">4%</span></div></div>
                                        </td>
                                        <td class="td__col td__last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>
                                    </tr>


                                    <tr class="tr">
                                        <td class="td__col td__prod">Paclaging</td>
                                        <td class="td__col">
                                            <div class="t_flbox">22% <div class="numbers_bottom"><span class="mark mark__gr">18%</span></div></div>
                                        </td>
                                        <td class="td__col">
                                            <div class="t_flbox">22% <div class="numbers_bottom"> <span class="mark mark__gr">18%</span></div></div>
                                        </td>
                                        <td class="td__col td__last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>
                                    </tr>


                                    <tr class="tr">
                                        <td class="td__col td__prod">Smoother</td>
                                        <td class="td__col">
                                            <div class="t_flbox">12% <div class="numbers_bottom"><span class="mark mark__gr">9%</span></div></div>
                                        </td>
                                        <td class="td__col">
                                            <div class="t_flbox">66% <div class="numbers_bottom"><span class="mark mark__gr">9%</span></div></div>
                                        </td>
                                        <td class="td__col td__last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>
                                    </tr>


                                    <tr class="tr">
                                        <td class="td__col td__prod">Oily</td>
                                        <td class="td__col">
                                            <div class="t_flbox">3% <div class="numbers_bottom"><span class="mark mark__red">2%</span></div></div>
                                        </td>
                                        <td class="td__col">
                                            <div class="t_flbox">42% <div class="numbers_bottom"><span class="mark mark__red">2%</span></div></div>
                                        </td>
                                        <td class="td__col td__last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr></tr>
                                </table>
                            </div>
                        </div>

                        <!-- <div class="view_list">
                        <a href="#" data-modal="#popUp"><?php echo get_field('customer_satisfaction_bottom_btn','option');?> <span class="to_list"><img src="<?= $baseAssetUrl; ?>img/icons/r_list.svg" alt="to_list"></span></a>
                    </div> -->
                    </div>
                    k              </div>


                <div class="section__star_rating hidden" id="star_rating">
                    <div class="container container__product">
                        <div class="section_title">
                            <div class="section_icon"><img src="<?= $baseAssetUrl; ?>img/icons/star.svg" alt="ci_list"></div>
                            <h2>Star Rating</h2>
                        </div>

                        <div class="mg__item mg__item__lg">
                            <div class="mg__title">
                                <div class="block_title">Main  Conversation Topics</div>

                                <a href="https://pro.sentimate.com/" class="v_all">View Full Topics List<img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
                            </div>
                            <div class="mg__content">
                                <div class="mg__numbers">

                                    <div class="numbers_mid"><p>4.6</p> <div class="numbers_bottom"><span class="mark mark__gr">0.4%</span></div></div>

                                    <div class="numbers_top">
                                        <div class="rating_box">
                                            <img src="<?= $baseAssetUrl; ?>img/icons/star_emt.svg" alt="rating_star">
                                            <img src="<?= $baseAssetUrl; ?>img/icons/star_emt.svg" alt="rating_star">
                                            <img src="<?= $baseAssetUrl; ?>img/icons/star_emt.svg" alt="rating_star">
                                            <img src="<?= $baseAssetUrl; ?>img/icons/star_emt.svg" alt="rating_star">
                                            <img src="<?= $baseAssetUrl; ?>img/icons/star_emt.svg" alt="rating_star">

                                        </div>
                                    </div>

                                    <div class="gr__indicator">
                                        <div class="gi_item"><img src="<?= $baseAssetUrl; ?>img/icons/c1.png" alt="color_indicator"> <span>45% Detractors</span></div>
                                        <div class="gi_item"><img src="<?= $baseAssetUrl; ?>img/icons/c2.png" alt="color_indicator"> <span>30% Neutrals</span></div>
                                        <div class="gi_item"><img src="<?= $baseAssetUrl; ?>img/icons/c3.png" alt="color_indicator"> <span>25% Promouters</span></div>
                                    </div>
                                </div>
                                <div class="mg__graphic"></div>
                            </div>
                        </div>


                        <div class="mg__item mg__item__lg">
                            <div class="mg__title">
                                <div class="block_title">The Main Topics that Impact High Star Rating</div>

                                <a href="https://pro.sentimate.com/" class="v_all">View Drivers of Low Rating <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
                            </div>
                            <div class="mg__content">

                                <table class="block__table3" border="1">
                                    <tr class="tr tr__head">
                                        <td class="td__col td__head td__prod">Topic name</td>
                                        <td class="td__col td__head">Share of Discussions</td>
                                        <td class="td__col td__head">impact on star rating</td>
                                        <td class="td__col td__head td__pre_last">1-3 STAR rating</td>
                                        <td class="td__col td__head td__last">4-5 STAR RATING</td>
                                    </tr>

                                    <tr class="tr">
                                        <td class="td__col td__prod">Suction</td>
                                        <td class="td__col">14%</td>
                                        <td class="td__col">
                                            <div class="numbers_bottom"><span class="mark mark__red">-0.03%</span>    </div>
                                        </td>
                                        <td class="td__col td__pre_last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>

                                        <td class="td__col td__last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>
                                    </tr>


                                    <tr class="tr">
                                        <td class="td__col td__prod">Surfaces</td>
                                        <td class="td__col">13%</td>
                                        <td class="td__col">
                                            <div class="numbers_bottom"><span class="mark mark__red">-0.02%</span>    </div>

                                        </td>
                                        <td class="td__col td__pre_last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>

                                        <td class="td__col td__last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>
                                    </tr>


                                    <tr class="tr">
                                        <td class="td__col td__prod">Ease of use</td>
                                        <td class="td__col">12%</td>
                                        <td class="td__col">
                                            <div class="numbers_bottom"> <span class="mark mark__red">-0.04%</span>    </div>

                                        </td>
                                        <td class="td__col td__pre_last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>


                                        <td class="td__col td__last">
                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>
                                    </tr>


                                    <tr class="tr">
                                        <td class="td__col td__prod">Weight</td>
                                        <td class="td__col">12%</td>
                                        <td class="td__col">
                                            <div class="numbers_bottom"><span class="mark mark__red">-0.04%</span>    </div>

                                        </td>
                                        <td class="td__col td__pre_last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>


                                        <td class="td__col td__last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>
                                    </tr>


                                    <tr class="tr">
                                        <td class="td__col td__prod">Performance</td>
                                        <td class="td__col">22%</td>
                                        <td class="td__col">
                                            <div class="numbers_bottom"><span class="mark mark__red">-0.03%</span>    </div>

                                        </td>
                                        <td class="td__col td__pre_last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>


                                        <td class="td__col td__last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>
                                    </tr>


                                    <tr class="tr">
                                        <td class="td__col td__prod">Attachements</td>
                                        <td class="td__col">17%</td>
                                        <td class="td__col">
                                            <div class="numbers_bottom"><span class="mark mark__red">-0.01%</span>    </div>

                                        </td>
                                        <td class="td__col td__pre_last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>


                                        <td class="td__col td__last">

                                            <div class="line_progress">
                                                <div class="lp lp__red"></div>
                                                <div class="lp lp__gray"></div>
                                                <div class="lp lp__green"></div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="section__engagement hidden" id="engagement">
                    <div class="container container__product">
                        <div class="section_title">
                            <div class="section_icon"><img src="<?= $baseAssetUrl; ?>img/icons/engagement.svg" alt="ci_list"></div>
                            <h2>Engagement</h2>
                        </div>

                        <div class="mg__item mg__item__lg">
                            <div class="mg__title">
                                <div class="block_title">Monthly Reviewers </div>

                                <div class="color_indicator_box">
                                    <div class="color_indicator indicator_red"><span></span><p>Negative</p></div>
                                    <div class="color_indicator indicator_gray"><span></span><p>Neutral</p></div>
                                    <div class="color_indicator indicator_green"><span></span><p>Positive</p></div>
                                </div>
                            </div>
                            <div class="mg__content">
                                <div class="mg__graphic">
                                    <div id="monthlyReviewersBars" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>


                        <div class="mg__item mg__item__lg">
                            <div class="mg__title">
                                <div class="block_title">Monthly Reviewers </div>
                            </div>
                            <div class="mg__content">

                                <div class="mg__graphic"></div>
                            </div>
                        </div>
                        <div class="view_list">
                            <a href="https://pro.sentimate.com/" >View Full Report <span class="to_list"><img src="<?= $baseAssetUrl; ?>img/icons/r_list.svg" alt="to_list"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php  } ?>

    <section class="get-access-section">
        <div class="container">
            <div class="get-access-block">
                <div class="section-caption">
                    <h2 class="sc-title small"><?php echo get_field('product_report_title','option');?></h2>
                    <p class="sc-subtitle"><?php echo get_field('product_report_text','option');?></p>
                </div>

                <div class="block-footer">
                    <a href="https://pro.sentimate.com/"  data-link="/comparison" data-modal="#popUp"  class="btn"><?php echo get_field('product_report_button','option');?></a>
                </div>
            </div>
        </div>
    </section>
<?php endwhile; // end of the loop. ?>

    <style>
        .modal{
            overflow: auto !important;
        }

        .modal .modal-content{
            box-shadow: none !important;
            border: 0 !important;
        }
    </style>

<?php get_footer(); ?>