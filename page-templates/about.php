<?php
/**
 * Template Name: About
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

        <section class="clients-section">
            <div class="container">
                <h2 class="small-caption"><?php echo get_field('companies_title','option');?></h2>
            </div>

            <div class="clients-slider">
                <div class="slider-inner">
                    <?php if( have_rows('companies','option') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('companies','option') ): the_row(); ?>
                            <div class="slide">
                                <div class="client-logo">
                                    <img src="<?php echo get_sub_field('logo')['url'];?>" alt="<?php echo get_sub_field('logo')['alt'];?>">
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="slider-inner">

                    <?php if( have_rows('companies','option') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('companies','option') ): the_row(); ?>
                            <div class="slide">
                                <div class="client-logo">
                                    <img src="<?php echo get_sub_field('logo')['url'];?>" alt="<?php echo get_sub_field('logo')['alt'];?>">
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="container">

                <?php if( have_rows('blocks') ): ?>
                    <?php
                    $i=0;
                    while( have_rows('blocks') ): the_row(); ?>
                        <div class="about-card">
                            <div class="card-content">
                                <h3 class="card-caption"><?php echo get_sub_field('title');?></h3>
                                <div class="card-text">
                                    <?php echo get_sub_field('text');?>
                                </div>
                                <?php if (get_sub_field('link_button')) { ?>
                                    <a <?php if(get_sub_field('popup__link')) { ?>data-modal="<?php echo get_sub_field('link_button');?>" <?php } else { ?> href="<?php echo get_sub_field('link_button');?>" <?php } ?> class="btn-with-arrow" >
                                        <span class="btn-text"><?php echo get_sub_field('text_button');?></span>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="card-image">
                                <?php if (get_sub_field('image')) { ?>
                                    <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                                <?php } else { ?>
                                    <video width="100%" height="100%" src="<?php echo get_sub_field('animate'); ?>" loop muted playsinline autoplay poster="<?php echo get_sub_field('animate'); ?>"></video>
                                <?php } ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
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
                    <a href="<?php echo get_field('product_button_link','option');?>" class="btn"><?php echo get_field('product_button','option');?></a>
                </div>
            </div>
        </section>
    </main>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>