<?php

/**
 * Template Name: Resources
 */
get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
    <main class="page-content">
        <section class="first-screen-section">
            <div class="container">
                <h1 class="page-caption"><?php echo get_field('title'); ?></h1>

                <div class="section-text">
                    <p><?php echo get_field('text'); ?></p>
                </div>

                <?php if (get_field('hide_show_search')) { ?>

                    <div class="component-search-with-autocomplete">
                        <div class="cmp-field">
                            <svg class="field-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#search"></use>
                            </svg>
                            <input type="text" placeholder="<?php echo get_field('placeholder_field', 'option'); ?>" id="searchinput">
                        </div>
                        <div class="cmp-suggestions">
                            <ul id="search_rezult">

                            </ul>
                        </div>
                    </div>

                    <div class="section-stats">
                        <?php if (have_rows('counters', 'option')) : ?>
                            <?php
                            $i = 0;
                            while (have_rows('counters', 'option')) : the_row(); ?>
                                <div class="item">
                                    <svg class="item-icon">
                                        <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#<?php echo get_sub_field('icon'); ?>"></use>
                                    </svg>
                                    <div class="item-text"><strong><?php echo get_sub_field('number'); ?></strong> <?php echo get_sub_field('text'); ?></div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                <?php } ?>

            </div>
        </section>
    <?php endwhile; // end of the loop. 
    ?>
    <section class="catalog-section  <?php if (get_field('product_page_copy', 'option')) { ?>no-sidebar<?php } ?>">
        <div class="container">
            <div class="breadcrumbs">
                <?php
                if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();
                ?>
            </div>
            <div class="section-inner">
                <aside class="section-sidebar">
                    <div class="sidebar-category-block js-accordion opened-on-load">
                        <input type="hidden" id="link" value="<?php echo get_permalink(); ?>">
                        <div class="block-header ac-header">
                            <h3 class="block-caption">Categories</h3>

                            <button class="ac-opener"></button>
                        </div>
                        <div class="block-content ac-content">
                            <div class="checkboxes-list categoryes">
                                <?php
                                $brands = array();
                                if ($_GET['categoryes']) {
                                    $categoryes = explode(',', $_GET['categoryes']);
                                }
                                $args = [
                                    'taxonomy'      => ['product_category'], // название таксономии с WP 4.5
                                    'orderby'       => 'name',
                                    'order'         => 'ASC',
                                    'hide_empty'    => true,
                                ];

                                $terms = get_terms($args);

                                foreach ($terms as $term) {
                                ?>
                                    <label class="checkbox">
                                        <input type="checkbox" <?php if (in_array($term->term_id, $categoryes)) {
                                                                    echo 'checked';
                                                                } ?> value="<?php echo $term->term_id; ?>" class="visually-hidden">
                                        <span class="fake-label"><?php echo $term->name; ?></span>
                                    </label>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-category-block js-accordion opened-on-load">
                        <div class="block-header ac-header">
                            <h3 class="block-caption">Brands</h3>

                            <button class="ac-opener"></button>
                        </div>
                        <div class="block-content ac-content">
                            <div class="small-search-block">
                                <input type="text" placeholder="Search" id="brands_search">
                            </div>
                            <div class="checkboxes-list">

                                <?php
                                $brands = array();
                                if ($_GET['brands']) {
                                    $brands = explode(',', $_GET['brands']);
                                }
                                $args = [
                                    'taxonomy'      => ['brands'], // название таксономии с WP 4.5
                                    'orderby'       => 'name',
                                    'order'         => 'ASC',
                                    'hide_empty'    => true,
                                ];

                                $terms = get_terms($args);
                                $otp = array();
                                foreach ($terms as $term) {
                                    $first_letter = mb_strtoupper(substr($term->name, 0, 1));
                                    $otp[$first_letter][] = $term->term_id;
                                }
                                $j = 0;
                                foreach ($otp as $key => $term) {
                                ?>
                                    <div class="brands_wrap">
                                        <h4 class="list-caption"><?php echo $key; ?></h4>
                                        <?php foreach ($term as $t) { ?>
                                            <label class="checkbox">
                                                <input type="checkbox" <?php if (in_array($t, $brands)) {
                                                                            echo 'checked';
                                                                        } ?> value="<?php echo $t; ?>" class="visually-hidden">
                                                <span class="fake-label"><?php echo get_term($t, 'brands')->name; ?></span>
                                            </label>

                                        <?php
                                        } ?>
                                    </div>
                                <?php
                                }

                                ?>

                            </div>
                        </div>
                    </div>
                </aside>
                <div class="section-content">

                    <div class="filters-row">
                        <div class="select-field">
                            <select id="sort_select">
                                <option value="sentiment">Best sentiment</option>
                                <option <?php if ($_GET['sort'] == 'sentiment-desc') {
                                            echo 'selected';
                                        } ?> value="sentiment-desc">Worst sentiment</option>
                                <option <?php if ($_GET['sort'] == 'rating') {
                                            echo 'selected';
                                        } ?> value="rating">Best rating</option>
                                <option <?php if ($_GET['sort'] == 'rating-desc') {
                                            echo 'selected';
                                        } ?> value="rating-desc">Worst rating</option>
                            </select>
                        </div>
                    </div>
                    <div id="wrapload">
                        <div id="wrapinclude">
                            <div class="products-grid">
                                <?php
                                $tax_query = array('relation' => "AND");

                                if ($_GET['categoryes']) {
                                    $categoryes = explode(',', $_GET['categoryes']);
                                    $category = array(
                                        'taxonomy'  => 'product_category',
                                        'field'     => 'term_id',
                                        'terms'     => $categoryes,
                                    );
                                    $tax_query[] = $category;
                                }
                                if ($_GET['brands']) {
                                    $brands = explode(',', $_GET['brands']);
                                    $category = array(
                                        'taxonomy'  => 'brands',
                                        'field'     => 'term_id',
                                        'terms'     => $brands,
                                    );
                                    $tax_query[] = $category;
                                }
                                if (!$_GET['sort'] or $_GET['sort'] == 'sentiment') {
                                    $metakey = 'sentiment';
                                    $order = 'DESC';
                                }
                                if ($_GET['sort'] == 'sentiment-desc') {
                                    $metakey = 'sentiment';
                                    $order = 'ASC';
                                }
                                if ($_GET['sort'] == 'rating') {
                                    $metakey = 'star_rating';
                                    $order = 'DESC';
                                }
                                if ($_GET['sort'] == 'rating-desc') {
                                    $metakey = 'star_rating';
                                    $order = 'ASC';
                                }
                                $args = array(
                                    'post_type' => 'products',
                                    'paged' => $paged,
                                    'tax_query' => $tax_query,
                                    "orderby" => 'meta_value_num',
                                    "meta_key" => $metakey,
                                    "order" => $order
                                );

                                query_posts($args);
                                if (have_posts()) {
                                    while (have_posts()) : the_post();
                                        get_template_part('content-product');
                                    endwhile;
                                } else {
                                ?>
                                    <h2>No search result!</h2>

                                <?php
                                }
                                ?>
                            </div>
                            <div class="pagination-wrapper">
                                <?php if (function_exists('pagination')) pagination(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </main>

    <?php get_footer(); ?>