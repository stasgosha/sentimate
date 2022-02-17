<?php
/**
 * Template Name: Overview
 */
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <main class="page-content">
        <section class="first-screen-section">
            <div class="container">
                <h1 class="page-caption"><?php echo get_field('title');?></h1>

                <div class="section-text">
                    <p><?php echo get_field('text');?></p>
                </div>
            </div>
        </section>

        <section class="overview-section">
            <!-- У первых двух карточек отличается структура. Думаю, лучше выводить их не в цикле, а отдельно -->


            <?php if( have_rows('blocks') ): ?>
                <?php
                $i=0;
                while( have_rows('blocks') ): the_row(); ?>
                    <div class="overview-card <?php if (get_sub_field('tabs')) { ?>with-tabs<?php } ?>">
                        <div class="container">
                            <?php if (get_sub_field('title')) : ?>
                            <h2 class="card-caption centered-caption"><?php echo get_sub_field('title');?></h2>
                            <?php endif; ?>
                            <div class="card-inner">
                                <div class="card-content">
                                    <?php if( get_sub_field('tabs') ): $g=0; $j=0; ?>
                                    <div class="tabs-nav-wrapper">
                                        <div class="tabs-nav">
                                            <?php while( has_sub_field('tabs') ): $g++; ?>
                                                <button class="tab-btn" data-tab="#tab-metrics<?php echo $g;?>">
                                                    <span class="btn-text"><?php echo get_sub_field('title');?></span>
                                                </button>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                    <div class="tabs-container">
                                        <?php while( has_sub_field('tabs') ): $j++; ?>
                                            <div class="tab" id="tab-metrics<?php echo $j;?>">
                                                <div class="card-text">
                                                    <?php echo get_sub_field('text');?>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>

                                    </div>
                                    <?php endif; ?>

                                    <?php if(get_sub_field('text')){ ?>
                                        <div class="card-text">
                                            <p><?php echo get_sub_field('text');?></p>
                                        </div>
                                    <?php } ?>
									<?php if(get_sub_field('show_link')){ ?>
										<?php if(get_sub_field('link')){ ?>
										<a href="<?php echo get_sub_field('link');?>" class="btn-with-arrow">
											<span class="btn-text">Learn More</span>
										</a>
										<?php } ?>
									<?php } ?>
                                </div>
                                <div class="card-image">
                                    <?php if(get_sub_field('image_big')){ ?>
                                        <a href="<?php echo get_sub_field('image_big')['url'];?>" class="fancybox" data-fancybox>
                                    <?php } ?>
                                         <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                                    <?php if(get_sub_field('image_big')){ ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php endwhile; ?>
            <?php endif; ?>
        </section>

        <section class="get-access-section">
            <div class="container">
                <div class="get-access-block">
                    <div class="section-caption">
                        <h2 class="sc-title small"><?php echo get_field('footer_title');?></h2>
                    </div>

                    <div class="block-footer">
                        <a href="<?php echo get_field('header_button_link','option');?>" data-link="/product-analysis/6fb6b0e7417b4b924101d4d34e3da6ee8dcd0acc7b921762961732edda0266d9/swot?q=" class="btn"><?php echo get_field('footer_text_button');?></a>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>