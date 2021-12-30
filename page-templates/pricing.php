<?php
/**
 * Template Name: Pricing
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

        <section class="plans-section">
            <div class="container">
                <div class="breadcrumbs">
                    <?php
                        if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();
                    ?>
                </div>
                <div class="switch-tabs-block tabs-nav">
                    <div class="switch-wrapper">
                        <button class="left-btn monthly" data-tab="#tab-monthly1"><?php echo get_field('plan_1_name');?></button>
                        <button class="block-middle"></button>
                    </div>
                    <button class="left-btn annual" data-tab="#tab-monthly2"><?php echo get_field('plan_2_name');?> <span class="save-up"><?php echo get_field('plan_2_sale');?></span></button>
                </div>

                <?php $is_blured =  get_field('coming_soon'); ?>
                <div class="section-inner <?php echo $is_blured ? 'blured' : ''; ?>">
                    <div class="tabs-container">
                        <?php if( have_rows('plans') ): ?>
                            <?php
                            $i=0;
                            while( have_rows('plans') ): the_row(); $i++; ?>
                                <div class="tab" id="tab-monthly<?php echo $i;?>">
                                    <div class="plans-grid">
                                        <?php if( get_sub_field('tarif') ): ?>
                                            <?php while( has_sub_field('tarif') ): ?>
                                                <div class="plan-card <?php if(get_sub_field('popular')){ ?> popular <?php } ?>">
                                                    <?php if(get_sub_field('popular')){ ?>
                                                        <p class="card-label">Most popular</p>
                                                    <?php } ?>
                                                    <h3 class="card-name"><?php echo get_sub_field('name_tarif');?></h3>
                                                    <p class="card-price"><?php echo get_sub_field('price');?></p>
                                                    <p class="card-description"><?php echo get_sub_field('text');?></p>
                    
                                                    <ul class="card-features">
                                                        <?php if( get_sub_field('params') ): ?>
                                                            <?php while( has_sub_field('params') ): ?>
                                                                <li><?php echo get_sub_field('text');?></li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    
                    <div class="section-footer">
                        <button class="btn" data-modal="#contact-sales-modal"><?php echo get_field('text_contacts_button');?></button>
                    </div>

                    <div class="blured-block">
                        <p><?php echo get_field('coming_soon_title');?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="big-stats-section">
            <div class="container">
                <div class="stats-grid">

                    <?php if( have_rows('product_counters','option') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('product_counters','option') ): the_row(); ?>
                            <div class="stats-card">
                                <h3 class="card-caption"><strong style="color: <?php echo get_sub_field('color_counter');?>;"><?php echo get_sub_field('counter');?></strong> <?php echo get_sub_field('title');?></h3>

                                <div class="card-text">
                                    <p><?php echo get_sub_field('text');?></p>
                                </div>

                                <ul class="card-tags">
                                    <?php if( get_sub_field('tags') ): ?>
                                        <?php while( has_sub_field('tags') ): ?>
                                            <li>
                                                <?php if(get_sub_field('image')['url']){ ?>
                                                    <img src="<?php echo get_sub_field('image')['url']; ?>" alt="<?php echo get_sub_field('image')['alt']; ?>">
                                                <?php }else{ ?>
                                                    <?php if(get_sub_field('link')){ ?>
                                                        <a href="<?php echo get_sub_field('link');?>">
                                                    <?php } ?>
                                                    <?php echo get_sub_field('text');?>
                                                    <?php if(get_sub_field('link')){ ?>
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </li>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                    <?php if(get_sub_field('text_tags')){ ?>
                                        <li class="pale"><?php echo get_sub_field('text_tags');?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

                <div class="section-footer">
                    <a href="<?php echo get_field('header_button_link','option');?>"  class="btn"><?php echo get_field('product_button','option');?></a>
                </div>
            </div>
        </section>
    </main>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>