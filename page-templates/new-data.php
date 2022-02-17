<?php
/**
 * Template Name: Data Page
 */
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <main class="page-content">
        <section class="first-screen-section first-data-background"
                 style="background-image: url('<?= get_field('data_background_image')['url'];?>')">
            <div class="container">
                <div class="data-main-block">
                    <div class="text-data__block">
                        <h1 class="page-caption"><?php echo get_field('main_data_title');?></h1>
                        <div class="section-text">
                            <p><?php echo get_field('main_data_text');?></p>
                        </div>
                    </div>
                    <div class="data-img__block">
                        <?php if ($img = get_field('data_guy_img')) : ?>
                            <picture class="card-image">
                                <img src="<?php echo $img['url'];?>" alt="<?php echo $img['alt'];?>">
                            </picture>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="big-stats-section data-big-stats big-stats-section-data">
            <div class="container">
                <div class="stats-grid small-stats-grid">

                    <?php if( have_rows('data_counter') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('data_counter') ): the_row(); ?>
                            <div class="stats-card">
                                <p class="card-caption"><?php echo get_sub_field('number');?></p>
                                <?php if( get_sub_field('title') ): ?>
                                    <div class="card-tag_title"><?= get_sub_field('title'); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <section class="data-new-section">
            <div class="first-screen-section description-screen_section">
                <div class="container">
                    <h2 class="page-caption"><?php echo get_field('data_blocks_title');?></h2>
                    <div class="section-text">
                        <p><?php echo get_field('data_blocks_text');?></p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="data-page_cards">
                    <?php if( have_rows('blocks') ): ?>
                        <?php $i=0;
                        while( have_rows('blocks') ): the_row(); ?>
                            <div class="about-card">
                                <div class="card-content">
                                    <p class="step-number">
                                        Step <?= $i + 1; ?>
                                    </p>
                                    <h3 class="card-caption"><?php echo get_sub_field('title');?></h3>
                                    <div class="card-text">
                                        <?php echo get_sub_field('text');?>
                                    </div>
                                </div>
                                <div class="card-image">
                                    <?php if (get_sub_field('image')) { ?>
                                        <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                                    <?php } else { ?>
                                        <video width="100%" height="100%" src="<?php echo get_sub_field('animate'); ?>" loop muted playsinline autoplay poster="<?php echo get_sub_field('animate'); ?>"></video>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php $i++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <section class="data-insights-section">
            <div class="first-screen-section description-screen_section">
                <div class="container">
                    <h2 class="page-caption"><?php echo get_field('title_kind_of_insights');?></h2>
                    <div class="section-text">
                        <p><?php echo get_field('text_kind_of_insights');?></p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="industries-grid insights-grid">
                    <?php if( have_rows('kind_of_insights') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('kind_of_insights') ): the_row(); ?>
                            <div class="industry-card insight-card">
                                <div class="card-content">
                                    <h3 class="card-caption"><?php echo get_sub_field('title');?></h3>
                                    <p class="card-text">
                                        <?php echo get_sub_field('description');?>
                                    </p>
                                </div>
                                <picture class="card-image">
                                    <source srcset="<?php echo get_sub_field('image_mobile')['url'];?>" media="(max-width:576px)">
                                    <?php if (get_sub_field('image')) : ?>
                                        <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                                    <?php endif; ?>
                                </picture>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="get-access-section">
            <div class="container">
                <div class="get-access-block">
                    <div class="section-caption">
                        <h2 class="sc-title small"><?php echo get_field('data_footer_title');?></h2>
                    </div>

                    <div class="block-footer">
                        <a href="<?php echo get_field('header_button_link','option');?>" data-link="/product-analysis/6fb6b0e7417b4b924101d4d34e3da6ee8dcd0acc7b921762961732edda0266d9/swot?q=" class="btn"><?php echo get_field('data_button_text');?></a>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>