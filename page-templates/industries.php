<?php
/**
 * Template Name: Industries
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

        <section class="industries-section">
            <div class="container">
                <div class="industries-grid">
                    <?php if( have_rows('industry') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('industry') ): the_row(); ?>
                            <div class="industry-card">
                                <div class="card-image">
                                    <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                                </div>
                                <div class="card-content">
                                    <h3 class="card-caption"><?php echo get_sub_field('name');?></h3>

                                    <ul class="card-list">
                                        <?php if( get_sub_field('subcategory') ): ?>
                                            <?php while( has_sub_field('subcategory') ): ?>
                                                <?php if(get_sub_field('category_link')){ $link=get_term_link(get_sub_field('category_link'),'product_industry'); }else{ $link=get_sub_field('link')['url']; } ?>
                                                <li><a <?php if(get_sub_field('target_balnk')){ echo "target='_blank'"; } ?> href="<?php echo $link; ?>"><?php echo get_sub_field('name');?></a></li>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </ul>
                                    <?php if(get_sub_field('link')){ ?>
                                        <a href="<?php echo get_sub_field('link');?>" class="more-link">
                                            <span class="link-text"><?php echo get_sub_field('text_button'); ?></span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            </div>
        </section>
    </main>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>