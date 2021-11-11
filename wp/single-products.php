<?php
$baseAssetUrl = get_template_directory_uri().'/';
get_header(); ?>

    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<?php while ( have_posts() ) : the_post(); ?>
    <div class="single-products-content">
        <?php if(!get_field('hide_fix_navigation_','option')){  get_template_part( 'revuzeapi/partials-demo/product_navigation' ); }  ?>

        <?php get_template_part( 'revuzeapi/partials-demo/share-sidebar' ); ?>

        <div id="singleProduct">

            <div class="section section__overview" id="overview">
                <div class="container container__product">
                    <div class="breadcrumbs">
                        <?php
                        if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();
                        ?>
                    </div>
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
                                        <td class="info-col" data-id="industry"><?php echo get_field('product_industry');?></td>
                                        <td class="info-col" data-id="brand"><?php echo get_field('product_brand_name');?></td>
                                        <td class="info-col" data-id="category"><?php echo get_field('product_category');?></td>
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
                            <a href="#" data-modal="#contact-sales-modal"  class="v_all"><?php echo get_field('market_btn','option');?> <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
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

                            <a href="#" data-modal="#contact-sales-modal" class="v_all"><?php echo get_field('competing_btn','option');?> <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
                        </div>
                        <div class="mg__content">

                            <?php echo get_field('product_competing_table'); ?>
                        </div>
                    </div>

                    <div class="view_list">
                        <a href="#" data-modal="#contact-sales-modal" class="btn"><?php echo get_field('competing_bottom_btn','option');?></a>
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
                            <a href="#" data-modal="#contact-sales-modal" class="v_all">View Entire List <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
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
                        <a href="#" data-modal="#contact-sales-modal"><?php echo get_field('customer_satisfaction_bottom_btn','option');?> <span class="to_list"><img src="<?= $baseAssetUrl; ?>img/icons/r_list.svg" alt="to_list"></span></a>
                    </div> -->
                </div>
            </div>


            <div class="section__star_rating hidden" id="star_rating">
                <div class="container container__product">
                    <div class="section_title">
                        <div class="section_icon"><img src="<?= $baseAssetUrl; ?>img/icons/star.svg" alt="ci_list"></div>
                        <h2>Star Rating</h2>
                    </div>

                    <div class="mg__item mg__item__lg">
                        <div class="mg__title">
                            <div class="block_title">Main  Conversation Topics</div>

                            <a href="#" class="v_all">View Full Topics List<img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
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

                            <a href="#" class="v_all">View Drivers of Low Rating <img src="<?= $baseAssetUrl; ?>img/icons/arrow_pp.svg" alt="arrow"></a>
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
                        <a href="#" data-modal="#contact-sales-modal">View Full Report <span class="to_list"><img src="<?= $baseAssetUrl; ?>img/icons/r_list.svg" alt="to_list"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="get-access-section">
        <div class="container">
            <div class="get-access-block">
                <div class="section-caption">
                    <h2 class="sc-title small"><?php echo get_field('product_report_title','option');?></h2>
                    <p class="sc-subtitle"><?php echo get_field('product_report_text','option');?></p>
                </div>

                <div class="block-footer">
                    <a href="#" data-modal="#contact-sales-modal" class="btn"><?php echo get_field('product_report_button','option');?></a>
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