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
                        while( have_rows('industry') ): the_row();
                            $sub_field_link = get_sub_field('link');
                            $main_link = $sub_field_link ? get_term_link($sub_field_link) : '';
                            ?>
                            <div class="industry-card">
                                <picture class="card-image">
                                    <source srcset="<?php echo get_sub_field('image_mob')['url'];?>" media="(max-width:479px)">
                                    <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                                </picture>
                                <div class="card-content">
                                    <h3 class="card-caption"><?php echo get_sub_field('name');?></h3>

                                    <ul class="card-list">
                                        <?php if( get_sub_field('subcategory') ): ?>
                                            <?php while( has_sub_field('subcategory') ) : ?>
                                                <?php if($cat_term_id = get_sub_field('category_link')) : $cat_term = get_term($cat_term_id); $link = $cat_term ? get_term_link($cat_term) : ''; ?>
                                                    <li><a <?php if(get_sub_field('target_balnk')){ echo "target='_blank'"; } ?> href="<?php echo $link; ?>">
                                                            <?php echo $cat_term->name;?></a>
                                                    </li>
                                                <?php endif;
                                            endwhile; ?>
                                        <?php endif; ?>
                                    </ul>
                                    <?php if($main_link);{ ?>
                                        <a href="<?php echo $main_link; ?>" class="more-link">
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