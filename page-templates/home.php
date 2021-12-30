<?php
/**
 * Template Name: Home
 */
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <main class="page-content">
        <section class="first-screen-section">
            <div class="container">
                <h1 class="page-caption"><?php echo get_field('search_title');?></h1>

                <div class="section-text">
                    <p><?php echo get_field('search_text');?></p>
                </div>

                <div class="component-search-with-autocomplete with-link">
                    <form id="search" class="cmp-field">
                        <svg class="field-icon">
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#search"></use>
                        </svg>
                        <input type="text" name="s" placeholder="<?php echo get_field('placeholder_field','option');?>" id="searchinput">
                        <!-- <a href="https://pro.sentimate.com/product-analysis/search-results?q=" class="btn">Go</a> -->
                        <button class="btn" type="submit">Go</button>
                    </form>
                </div>

                <!-- <div class="component-search-with-autocomplete">
                    <div class="cmp-field">
                        <form action="<?php echo get_home_url();?>">
                            <svg class="field-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#search"></use>
                            </svg>
                            <input type="text" name="s" placeholder="<?php echo get_field('placeholder_field','option');?>" id="searchinput">
                        </form>
                    </div>
                    <div class="cmp-suggestions">
                        <ul id="search_rezult">

                        </ul>
                    </div>
                </div> -->

                <div class="section-stats">
                    <?php if( have_rows('counters','option') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('counters','option') ): the_row(); ?>
                            <div class="item">
                                <svg class="item-icon">
                                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#<?php echo get_sub_field('icon');?>"></use>
                                </svg>
                                <div class="item-text"><strong><?php echo get_sub_field('number');?></strong> <?php echo get_sub_field('text');?></div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

                <div class="top-ranked-products-component">
                    <h3 class="cmp-caption"><?php echo get_field('categoryes_title');?></h3>

                    <div class="top-categories-slider" data-slides-count="6">
                        <?php if( have_rows('categoryes') ): ?>
                            <?php
                            $i=0;
                            while( have_rows('categoryes') ): the_row(); ?>
                                <div class="slide">
                                    <a href="<?php echo get_sub_field('link');?>" class="category-card">
                                        <div class="card-image">
                                            <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                                        </div>
                                        <div class="card-content">
                                            <h3 class="card-name"><?php echo get_sub_field('name');?></h3>
                                            <p class="products-count"><strong><?php echo get_sub_field('count_products');?></strong> Products</p>

                                            <div class="more-link">
                                                <span class="link-text">Explore</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
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

        <section class="dashboard-preview-section">
            <div class="container">
                <div class="section-caption">
                    <h2 class="sc-title"><?php echo get_field('product_dashboard_title');?></h2>
                </div>

                <div class="tabs-nav-wrapper">
                    <div class="tabs-nav">
                        <?php if( have_rows('product_dashboard') ): ?>
                            <?php
                            $i=0;
                            while( have_rows('product_dashboard') ): the_row(); ?>
                                <button class="tab-btn" data-tab="#tab-<?php echo get_sub_field('icon');?>">
                                    <svg class="btn-icon">
                                        <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#<?php echo get_sub_field('icon');?>"></use>
                                    </svg>
                                    <span class="btn-text"><?php echo get_sub_field('tab_title');?></span>
                                </button>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="tabs-container">
                    <?php if( have_rows('product_dashboard') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('product_dashboard') ): the_row(); ?>
                            <div class="tab" id="tab-<?php echo get_sub_field('icon');?>">
                                <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
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
                    <a href="<?php echo get_field('product_button_link','option');?>"  class="btn"><?php echo get_field('product_button','option');?></a>
                </div>
            </div>
        </section>

        <section class="use-cases-section">
            <div class="container">
                <div class="section-caption">
                    <h2 class="sc-title"><?php echo get_field('use_cases_title');?></h2>
                    <p class="sc-subtitle"><?php echo get_field('use_cases_text');?></p>
                </div>

                <div class="tabs-nav-wrapper">
                    <div class="tabs-nav">
                        <?php if( have_rows('use_cases') ): ?>
                            <?php
                            $i=0;
                            while( have_rows('use_cases') ): the_row(); ?>
                                <button class="tab-btn" data-tab="#tab-<?php echo get_sub_field('icon');?>">
                                    <svg class="btn-icon">
                                        <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#<?php echo get_sub_field('icon');?>"></use>
                                    </svg>
                                    <span class="btn-text"><?php echo get_sub_field('title_tab');?></span>
                                </button>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="tabs-container">
                    <?php if( have_rows('use_cases') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('use_cases') ): the_row(); $i++;  ?>
                            <div class="tab" id="tab-<?php echo get_sub_field('icon');?>" <?php if($i!=1){ ?> style="display: none;" <?php  }?>>
                                <div class="use-case-tab-card">
                                    <div class="card-content">
                                        <h3 class="card-caption"><?php echo get_sub_field('title_text');?></h3>
                                        <div class="card-text">
                                            <p><?php echo get_sub_field('text');?></p>
                                        </div>
                                        <div class="card-footer">
                                            <a <?php if(get_sub_field('popup__link')) { ?>data-modal="<?php echo get_sub_field('link');?>" <?php } else { ?> href="<?php echo get_sub_field('link');?>" <?php } ?> class="btn-with-arrow">
                                                <span class="btn-text"><?php echo get_sub_field('text_link');?></span>
                                            </a>
                                        </div>
                                    </div>
                                    <picture class="card-image">
                                        <source srcset="<?php echo get_sub_field('image_mobile')['url'];?>" media="(max-width: 767px)" />
                                        <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                                    </picture>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="testimonials-section">
            <div class="container">
                <div class="testimonials-slider">
                    <?php if( have_rows('reviews') ): ?>
                        <?php
                        $i=0;
                        while( have_rows('reviews') ): the_row(); ?>
                            <div class="slide">
                                <div class="testimonial-card">
                                    <div class="card-text">
                                        <p><?php echo get_sub_field('review');?></p>
                                    </div>

                                    <div class="card-author-block">
                                        <div class="block-avatar">
                                            <img src="<?php echo get_sub_field('author_image')['url'];?>" alt="<?php echo get_sub_field('author_image')['alt'];?>">
                                        </div>
                                        <div class="block-content">
                                            <h4 class="block-name"><?php echo get_sub_field('author_name');?></h4>
                                            <p><?php echo get_sub_field('author_position');?></p>
                                        </div>
                                    </div>
                                </div>
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
                        <h2 class="sc-title small"><?php echo get_field('access_title');?></h2>
                        <p class="sc-subtitle"><?php echo get_field('access_text');?></p>
                    </div>

                    <div class="block-footer">
                        <a href="<?php echo get_field('access_button_link');?>"  class="btn"><?php echo get_field('access_button');?></a>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>