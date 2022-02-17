<?php
get_header();
$queried_object = get_queried_object();
$active = $queried_object->term_id;
$parrent = $queried_object->parent;
$taxonomy = $queried_object->taxonomy;
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
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$page=$taxonomy.'_'.$active;
if ($queried_object->parent !== 0) : ?>
    <main class="page-content page-category">
        <div class="container">
            <div class="breadcrumbs">
                <ul itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="<?php echo get_home_url();?>">
                            <span itemprop="name"><?php echo get_the_title( get_option('page_on_front') );?></span></a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <!--                    <li itemprop="itemListElement" itemscope-->
                    <!--                        itemtype="https://schema.org/ListItem">-->
                    <!--                        <a itemprop="item" href="--><?php //echo get_term_link($active,$taxonomy); ?><!--">-->
                    <!--                            <span itemprop="name">--><?php //echo get_term($active,$taxonomy)->name; ?><!--</span></a>-->
                    <!--                        <meta itemprop="position" content="5" />-->
                    <!--                    </li>-->
                    <?php $parents = get_term_top_most_parent($active, $taxonomy);
                    if ($parents) : foreach ($parents as $u => $parent) : ?>
                        <li itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="<?php echo get_term_link($parent,$taxonomy); ?>">
                                <span itemprop="name"><?php echo $parent->name; ?></span></a>
                            <meta itemprop="position" content="<?= $u + 2; ?>" />
                        </li>
                    <?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
        <section class="first-screen-section first-screen-section-cat">
            <div class="container">
                <h1 class="page-caption">Best<?php echo ' <strong>'.$queried_object->name.'</strong> '; ?>Ratings</h1>

                <div class="section-text category-section-text">
                    <p><?php echo get_field('cat_subtitle', 'option'); ?></p>
                </div>
                <?php if( have_rows('cat_list_items','option') ): ?>
                    <div class="category_wrapper__text">
                        <ul>
                            <?php $i=0; while( have_rows('cat_list_items','option') ): the_row(); ?>
                                <li>
                                    <span>
                                        <svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.65207 2.66428C2.51362 2.8013 2.29082 2.80181 2.15175 2.66542L1.50229 2.02848C1.36165 1.89056 1.1358 1.89286 0.997998 2.03361L0.249375 2.79828C0.111651 2.93895 0.114049 3.16464 0.254732 3.30236L2.15887 5.16636C2.29798 5.30254 2.52062 5.30192 2.65897 5.16498L6.34379 1.5178C6.48366 1.37937 6.48487 1.15378 6.34651 1.01384L5.59482 0.253593C5.45636 0.113557 5.23058 0.112334 5.09061 0.250861L2.65207 2.66428Z" fill="white"/>
                                        </svg>
                                    </span>
                                    <?php echo get_sub_field('title');?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="block-category-button">
<!--                    --><?php //if (get_field('cat_popup')) : ?>
<!--                        <a href="--><?php //echo get_field('cat_sign_link');?><!--"  class="btn">--><?php //echo get_field('cat_button_text');?><!--</a>-->
<!--                    --><?php //else: ?>
<!--                    --><?php //endif; ?>
                    <a href="<?php echo get_field('header_button_link','option');?>" class="btn"><?php echo get_field('header_button_text','option');?></a>
                </div>
                <!--From old design - search and counter-->
<!--                <div class="component-search-with-autocomplete">-->
<!--                    <div class="cmp-field">-->
<!--                        <form action="">-->
<!--                            <svg class="field-icon">-->
<!--                                <use xlink:href="--><?php //echo get_template_directory_uri(); ?><!--/img/icons-sprite.svg#search"></use>-->
<!--                            </svg>-->
<!--                            <input type="text" name="s" placeholder="--><?php //echo get_field('placeholder_field','option');?><!--" id="searchinput">-->
<!--                            <button class="btn" type="submit">Go</button>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                    <div class="cmp-suggestions">-->
<!--                        <ul id="search_rezult">-->
<!---->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="section-stats">-->
<!--                    --><?php //if( have_rows('counters','option') ): ?>
<!--                        --><?php
//                        $i=0;
//                        while( have_rows('counters','option') ): the_row(); ?>
<!--                            <div class="item">-->
<!--                                <svg class="item-icon">-->
<!--                                    <use xlink:href="--><?php //echo get_template_directory_uri(); ?><!--/img/icons-sprite.svg#--><?php //echo get_sub_field('icon');?><!--"></use>-->
<!--                                </svg>-->
<!--                                <div class="item-text"><strong>--><?php //echo get_sub_field('number');?><!--</strong> --><?php //echo get_sub_field('text');?><!--</div>-->
<!--                            </div>-->
<!--                        --><?php //endwhile; ?>
<!--                    --><?php //endif; ?>
<!--                </div>-->
            </div>
        </section>
        <section class="catalog-section <?php if (get_field('product_categories_copy', 'option')) { ?>no-sidebar<?php } ?>">
            <div class="container">
                <div class="section-inner">
                    <aside class="section-sidebar">
                        <div class="sidebar-category-block js-accordion opened-on-load">
                            <input type="hidden" id="link" value="<?php echo get_term_link($active,$taxonomy); ?>">
                            <div class="block-header ac-header">
                                <p class="block-caption">Categories</p>

                                <button class="ac-opener"></button>
                            </div>
                            <div class="block-content ac-content">
                                <div class="checkboxes-list categoryes">
                                    <?php
                                    $brands=array();
                                    if($_GET['categoryes']){
                                        $categoryes=explode(',',$_GET['categoryes']);
                                    }
                                    $args = [
                                        'taxonomy'      => [ 'product_category' ], // название таксономии с WP 4.5
                                        'orderby'       => 'name',
                                        'order'         => 'ASC',
                                        'hide_empty'    => true,
                                    ];

                                    $terms = get_terms( $args );

                                    foreach( $terms as $term ){
                                        ?>
                                        <label class="checkbox">
                                            <input type="checkbox" <?php if(in_array( $term->term_id,$categoryes)){ echo 'checked';}?> <?php if($active== $term->term_id){ echo 'checked';}?> value="<?php echo $term->term_id; ?>" class="visually-hidden">
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
                                <p class="block-caption">Brands</p>

                                <button class="ac-opener"></button>
                            </div>
                            <div class="block-content ac-content">
                                <div class="small-search-block">
                                    <input type="text" placeholder="Search" id="brands_search">
                                </div>
                                <div class="checkboxes-list">

                                    <?php
                                    $brands=array();
                                    if($_GET['brands']){
                                        $brands=explode(',',$_GET['brands']);
                                    }
                                    $args = [
                                        'taxonomy'      => [ 'brands' ], // название таксономии с WP 4.5
                                        'orderby'       => 'name',
                                        'order'         => 'ASC',
                                        'hide_empty'    => true,
                                    ];

                                    $terms = get_terms( $args );
                                    $otp=array();
                                    foreach( $terms as $term ){
                                        $first_letter = mb_strtoupper(substr($term->name, 0, 1));
                                        $otp[$first_letter][] = $term->term_id;
                                    }
                                    $j=0;
                                    foreach( $otp as $key=> $term ){
                                        ?>
                                        <div class="brands_wrap">
                                            <h4 class="list-caption"><?php echo $key; ?></h4>
                                            <?php  foreach( $term as $t ){ ?>
                                                <label class="checkbox">
                                                    <input type="checkbox" <?php if(in_array($t,$brands)){ echo 'checked';}?> value="<?php echo $t; ?>" class="visually-hidden">
                                                    <span class="fake-label"><?php  echo get_term($t,'brands')->name; ?></span>
                                                </label>

                                                <?php
                                            }?>
                                        </div>
                                        <?php
                                    }

                                    ?>

                                </div>
                            </div>
                        </div>
                    </aside>
                    <div class="section-content" >

                        <div class="filters-row">
                            <div class="filter-row-heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="11" viewBox="0 0 19 11" fill="none">
                                    <path d="M18.125 10.0938C18.125 9.90313 18.0493 9.72031 17.9145 9.58552C17.7797 9.45072 17.5969 9.375 17.4062 9.375H13.0938C12.9031 9.375 12.7203 9.45072 12.5855 9.58552C12.4507 9.72031 12.375 9.90313 12.375 10.0938C12.375 10.2844 12.4507 10.4672 12.5855 10.602C12.7203 10.7368 12.9031 10.8125 13.0938 10.8125H17.4062C17.5969 10.8125 17.7797 10.7368 17.9145 10.602C18.0493 10.4672 18.125 10.2844 18.125 10.0938ZM18.125 5.78125C18.125 5.59063 18.0493 5.40781 17.9145 5.27302C17.7797 5.13823 17.5969 5.0625 17.4062 5.0625H7.34375C7.15313 5.0625 6.97031 5.13823 6.83552 5.27302C6.70073 5.40781 6.625 5.59063 6.625 5.78125C6.625 5.97187 6.70073 6.15469 6.83552 6.28948C6.97031 6.42427 7.15313 6.5 7.34375 6.5H17.4062C17.5969 6.5 17.7797 6.42427 17.9145 6.28948C18.0493 6.15469 18.125 5.97187 18.125 5.78125ZM18.125 1.46875C18.125 1.27813 18.0493 1.09531 17.9145 0.960517C17.7797 0.825725 17.5969 0.75 17.4062 0.75H1.59375C1.40313 0.75 1.22031 0.825725 1.08552 0.960517C0.950725 1.09531 0.875 1.27813 0.875 1.46875C0.875 1.65937 0.950725 1.84219 1.08552 1.97698C1.22031 2.11177 1.40313 2.1875 1.59375 2.1875H17.4062C17.5969 2.1875 17.7797 2.11177 17.9145 1.97698C18.0493 1.84219 18.125 1.65937 18.125 1.46875Z" fill="#660091"/>
                                </svg>
                                <p>FILTER & COMPARE</p>
                            </div>
                            <div class="select-field">
                                <select id="sort_select">
                                    <option value="sentiment">Best sentiment</option>
                                    <option <?php if($_GET['sort']=='sentiment-desc'){ echo 'selected'; } ?> value="sentiment-desc">Worst sentiment</option>
                                    <option <?php if($_GET['sort']=='rating'){ echo 'selected'; } ?>  value="rating">Best rating</option>
                                    <option <?php if($_GET['sort']=='rating-desc'){ echo 'selected'; } ?>  value="rating-desc">Worst rating</option>
                                </select>
                            </div>
                        </div>
                        <div id="wrapload">
                            <div  id="wrapinclude">
                                <div class="products-grid category-product-output">
                                    <?php
                                    $tax_query=array('relation'=>"AND");


                                    if($active){
                                        $category=array(
                                            'taxonomy'  => $taxonomy,
                                            'field'     => 'term_id',
                                            'terms'     => $active,
                                        );
                                        $tax_query[]=$category;
                                    }
                                    if($_GET['categoryes']){
                                        $categoryes=explode(',',$_GET['categoryes']);
                                        $category=array(
                                            'taxonomy'  => 'product_category',
                                            'field'     => 'term_id',
                                            'terms'     => $categoryes,
                                        );
                                        $tax_query[]=$category;
                                    }
                                    if($_GET['brands']){
                                        $brands=explode(',',$_GET['brands']);
                                        $category=array(
                                            'taxonomy'  => 'brands',
                                            'field'     => 'term_id',
                                            'terms'     => $brands,
                                        );
                                        $tax_query[]=$category;
                                    }
                                    if(!$_GET['sort'] or $_GET['sort']=='sentiment') {
                                        $metakey = 'sentiment';
                                        $order = 'DESC';
                                    }
                                    if( $_GET['sort']=='sentiment-desc') {
                                        $metakey = 'sentiment';
                                        $order = 'ASC';
                                    }
                                    if( $_GET['sort']=='rating') {
                                        $metakey = 'star_rating';
                                        $order = 'DESC';
                                    }
                                    if( $_GET['sort']=='rating-desc') {
                                        $metakey = 'star_rating';
                                        $order = 'ASC';
                                    }
                                    $args=array(
                                        'post_type' => 'products',
                                        'paged'=>$paged,
                                        'tax_query' =>$tax_query,
                                        "orderby" => 'meta_value_num',
                                        "meta_key" => $metakey,
                                        "order" => $order,
                                        'posts_per_page' => '20'
                                    );

                                    query_posts($args);
                                    if (have_posts()) {
                                        while (have_posts()) : the_post();
                                            get_template_part('content-product');
                                        endwhile;
                                    }else{
                                        ?>
                                        <h2>No search result!</h2>

                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="pagination-wrapper">
                                    <?php  if (function_exists('pagination')) pagination(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php else:
    $glossary = get_field('categories_of_industry', $queried_object);
    $cats_temporary_ids = get_term_children($active, 'product_category');
    if (!$glossary && $cats_temporary_ids) {
        $glossary = get_terms([
            'taxonomy' => 'product_category',
            'hide_empty' => false,
            'number' => 15,
            'include' => $cats_temporary_ids,
        ]);
    }?>
    <main class="industry-tax-content page-category">
        <div class="container">
            <div class="breadcrumbs">
                <ul itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="<?php echo get_home_url();?>">
                            <span itemprop="name"><?php echo get_the_title( get_option('page_on_front') );?></span></a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="<?php echo get_term_link($queried_object); ?>">
                            <span itemprop="name"><?php echo $queried_object->name; ?></span></a>
                        <meta itemprop="position" content="2" />
                    </li>
                </ul>
            </div>
        </div>
        <section class="industry-single-page product-page-section">
            <div class="container relative-position">
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
                    <a class="navigation-item" href="#most-popular-categories">
                        <div class="navigation-item__img">
                            <svg width="26" height="23" viewBox="0 0 26 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M25.041 4.80861C24.6483 3.89935 24.0821 3.07538 23.374 2.38283C22.6654 1.68822 21.83 1.13622 20.9131 0.756857C19.9623 0.361914 18.9426 0.15976 17.9131 0.16213C16.4688 0.16213 15.0596 0.557638 13.835 1.30471C13.542 1.48342 13.2637 1.67971 13 1.89358C12.7363 1.67971 12.458 1.48342 12.165 1.30471C10.9404 0.557638 9.53125 0.16213 8.08691 0.16213C7.04687 0.16213 6.03906 0.361349 5.08691 0.756857C4.16699 1.13772 3.33789 1.68557 2.62598 2.38283C1.91698 3.0746 1.35062 3.89876 0.958984 4.80861C0.551758 5.7549 0.34375 6.75979 0.34375 7.79397C0.34375 8.76955 0.542969 9.78615 0.938477 10.8203C1.26953 11.6846 1.74414 12.5811 2.35059 13.4863C3.31152 14.919 4.63281 16.4131 6.27344 17.9278C8.99219 20.4385 11.6846 22.1729 11.7988 22.2432L12.4932 22.6885C12.8008 22.8848 13.1963 22.8848 13.5039 22.6885L14.1982 22.2432C14.3125 22.1699 17.002 20.4385 19.7236 17.9278C21.3643 16.4131 22.6855 14.919 23.6465 13.4863C24.2529 12.5811 24.7305 11.6846 25.0586 10.8203C25.4541 9.78615 25.6533 8.76955 25.6533 7.79397C25.6562 6.75979 25.4482 5.7549 25.041 4.80861ZM13 20.3711C13 20.3711 2.57031 13.6885 2.57031 7.79397C2.57031 4.80861 5.04004 2.38869 8.08691 2.38869C10.2285 2.38869 12.0859 3.584 13 5.3301C13.9141 3.584 15.7715 2.38869 17.9131 2.38869C20.96 2.38869 23.4297 4.80861 23.4297 7.79397C23.4297 13.6885 13 20.3711 13 20.3711Z" />
                            </svg>

                        </div>
                        <div class="navigation-box__title">
                            Most Popular
                            Categories
                        </div>
                    </a>
                    <?php if ($glossary) : ?>
                        <a class="navigation-item" href="#glossary">
                            <div class="navigation-item__img">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                    <g clip-path="url(#clip0_2113_7267)">
                                        <path d="M17.2176 5.76827L18.3842 4.60171V8.9875C18.3842 9.46394 18.7704 9.85018 19.2468 9.85018C19.7233 9.85018 20.1095 9.46394 20.1095 8.9875V4.60171L21.2761 5.76827C21.6156 6.10256 22.1618 6.09841 22.4961 5.75889C22.8268 5.42309 22.8268 4.88406 22.4961 4.54825L19.8568 1.90891C19.5199 1.57203 18.9737 1.57203 18.6368 1.90891L15.9976 4.54825C15.6592 4.88367 15.6568 5.42987 15.9921 5.76827C16.3275 6.10666 16.8737 6.1091 17.2121 5.77374C17.2139 5.77193 17.2157 5.77012 17.2176 5.76832V5.76827H17.2176Z" />
                                        <path d="M7.64713 19.1896L6.48062 20.3561V15.9701C6.48062 15.4937 6.09438 15.1074 5.61794 15.1074C5.14149 15.1074 4.75526 15.4937 4.75526 15.9701V20.3559L3.5887 19.1896C3.25328 18.8512 2.70708 18.8487 2.36868 19.1841C2.03029 19.5195 2.02785 20.0657 2.36322 20.4041L2.36864 20.4095L5.00793 23.0488C5.34481 23.3858 5.89106 23.3858 6.22799 23.0488L8.86734 20.4093C9.20871 20.0769 9.21598 19.5307 8.88359 19.1894C8.55121 18.848 8.005 18.8407 7.66368 19.1731C7.65802 19.1785 7.65255 19.1841 7.64713 19.1896Z" />
                                        <path d="M24.1338 23.2715H16.4416L24.7438 14.9692C25.0807 14.6323 25.0807 14.0861 24.7437 13.7491C24.582 13.5874 24.3626 13.4965 24.1338 13.4965H14.3588C13.8823 13.4965 13.4961 13.8827 13.4961 14.3591C13.4961 14.8356 13.8823 15.2218 14.3588 15.2218H22.051L13.7488 23.5242C13.4119 23.8611 13.4119 24.4073 13.7488 24.7443C13.9106 24.906 14.13 24.9969 14.3588 24.9969H24.1338C24.6102 24.9969 24.9965 24.6107 24.9965 24.1342C24.9965 23.6578 24.6103 23.2715 24.1338 23.2715Z" />
                                        <path d="M6.52805 0.480017C6.31482 0.0539495 5.79659 -0.118665 5.37047 0.0945645C5.20372 0.177991 5.0685 0.313261 4.98502 0.480017L0.0973454 10.2549C-0.122328 10.6777 0.0423295 11.1985 0.465078 11.4182C0.887875 11.6379 1.4087 11.4732 1.62837 11.0505C1.63247 11.0426 1.63647 11.0346 1.64033 11.0266L3.26464 7.77794H8.24799L9.87226 11.0266C10.0919 11.4494 10.6127 11.6141 11.0355 11.3944C11.4491 11.1795 11.6172 10.675 11.4152 10.255L6.52805 0.480017ZM4.12751 6.05258L5.75641 2.79488L7.38531 6.05258H4.12751Z" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2113_7267">
                                            <rect width="25" height="25" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="navigation-box__title">
                                All Categories
                                (A-Z)
                            </div>
                        </a>
                    <?php endif; ?>
                    <a class="navigation-item" href="#top-ranked-products">
                        <div class="navigation-item__img">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                <path d="M26.7094 14.0625H20.3156V9.85313C20.3131 9.22818 20.0631 8.62967 19.6204 8.18864C19.1776 7.74761 18.5781 7.5 17.9531 7.5H12.0469C11.4219 7.5 10.8224 7.74761 10.3796 8.18864C9.93686 8.62967 9.68686 9.22818 9.68437 9.85313V17.8125H3.29063C2.6673 17.815 2.0702 18.0637 1.62944 18.5044C1.18868 18.9452 0.939969 19.5423 0.9375 20.1656V24.0938C0.9375 24.6656 1.16468 25.2141 1.56905 25.6184C1.97343 26.0228 2.52188 26.25 3.09375 26.25H26.9062C27.4781 26.25 28.0266 26.0228 28.4309 25.6184C28.8353 25.2141 29.0625 24.6656 29.0625 24.0938V16.4156C29.06 15.7923 28.8113 15.1952 28.3706 14.7544C27.9298 14.3137 27.3327 14.065 26.7094 14.0625ZM9.68437 24.375H3.12187C3.04803 24.3727 2.97785 24.3423 2.9256 24.29C2.87336 24.2378 2.84297 24.1676 2.84062 24.0938V20.1656C2.84041 20.0435 2.88691 19.926 2.97058 19.8371C3.05425 19.7482 3.16876 19.6947 3.29063 19.6875H9.68437V24.375ZM18.4406 24.375H11.5594V9.85313C11.5594 9.78954 11.572 9.72659 11.5966 9.66796C11.6213 9.60933 11.6573 9.5562 11.7027 9.51168C11.7481 9.46716 11.8019 9.43214 11.861 9.40867C11.9201 9.3852 11.9833 9.37375 12.0469 9.375H17.9531C18.0167 9.37375 18.0799 9.3852 18.139 9.40867C18.1981 9.43214 18.2519 9.46716 18.2973 9.51168C18.3427 9.5562 18.3787 9.60933 18.4034 9.66796C18.428 9.72659 18.4406 9.78954 18.4406 9.85313V24.375ZM27.1875 24.0938C27.1852 24.1676 27.1548 24.2378 27.1025 24.29C27.0503 24.3423 26.9801 24.3727 26.9062 24.375H20.3438V15.9375H26.7375C26.8003 15.9375 26.8625 15.9499 26.9205 15.9739C26.9785 15.9979 27.0312 16.0331 27.0756 16.0775C27.12 16.1219 27.1552 16.1746 27.1792 16.2327C27.2033 16.2907 27.2156 16.3528 27.2156 16.4156L27.1875 24.0938Z" />
                            </svg>
                        </div>
                        <div class="navigation-box__title">
                            Top Ranked
                            Products
                        </div>
                    </a>
                </div>
                <div class="industry-body">
                    <div id="overview" class="top-ranked-products-component">
                        <div class="industry-overview-grid bottom-border">
                            <div class="order-mobile-div">
                                <div class="subsection-caption">
                                    <h1 class="sc-title"><?= $queried_object->name; ?></h1>
                                </div>
                                <?php if ($img_mob = get_field('main_image_of_industry_mob', $queried_object)) : ?>
                                    <div class="mobile-img-industry">
                                        <picture class="industry-image">
                                            <source srcset="<?php echo $img_mob['url'];?>" media="(max-width:768px)">
                                            <img src="<?= $img_mob['url']; ?>" alt="<?= $img_mob['alt']; ?>">
                                        </picture>
                                    </div>
                                <?php endif; ?>
                                <div class="industry-description">
                                    <?php echo term_description($active, $taxonomy); ?>
                                </div>
                            </div>
                            <?php if ($img = get_field('main_image_of_industry', $queried_object)) : ?>
                                <picture class="industry-image industry-image-desktop">
                                    <img src="<?= $img['url']; ?>" alt="<?= $img['alt']; ?>">
                                </picture>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="most-popular-categories" id="most-popular-categories">
                        <div class="subsection-caption">
                            <div class="sc-image">
                                <img src="<?= get_template_directory_uri() ?>/img/content-images/product-page/customer-satisfaction.svg" alt="">
                            </div>
                            <h2 class="sc-title">Most Popular Categories</h2>
                        </div>

                        <div class="subsection-inner categories-grid_tax">
                            <?php if( have_rows('categories', $queried_object) ): ?>
                                <?php
                                $i=0;
                                while( have_rows('categories', $queried_object) ): the_row();
                                    $cat_term = get_sub_field('cat_link'); ?>
                                    <div class="category-card_industry">
                                        <a href="<?php echo $cat_term ? get_term_link($cat_term, 'product_category') : get_sub_field('cat_link');?>"
                                           class="category-card">
                                            <div class="card-image">
                                                <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>">
                                            </div>
                                            <div class="card-content">
                                                <div class="content__card-wrap">
                                                    <h3 class="card-name"><?php echo $cat_term ? $cat_term->name : get_sub_field('name');?></h3>
                                                    <p class="products-count"><strong>
                                                            <?php echo get_sub_field('quantity'); ?>
                                                        </strong> Products
                                                    </p>
                                                </div>
                                                <div class="more-link">
                                                    <span class="link-text">Go to Overview</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endwhile; ?>
                            <?php else :
                                if ($cats_temporary_ids) {
                                    $cats_temporary = get_terms([
                                        'taxonomy' => 'product_category',
                                        'hide_empty' => true,
                                        'number' => 6,
                                        'include' => $cats_temporary_ids,
                                    ]);
                                }
                                if($cats_temporary) : foreach ($cats_temporary as $cat_temp) :
                                    $curr_prod = get_posts([
                                        'post_type' => 'products',
                                        'numberposts' => 1,
                                        'order' => 'rand',
                                        'tax_query' => [
                                            [
                                                'taxonomy' => 'product_category',
                                                'field'    => 'term_id',
                                                'terms'    => $cat_temp->term_id,
                                            ],
                                        ],
                                    ]);?>
                                    <div class="category-card_industry">
                                        <a href="<?php echo get_term_link($cat_temp, 'product_category'); ?>"
                                           class="category-card">
                                            <?php if ($curr_prod && isset($curr_prod[0])) : ?>
                                                <div class="card-image">
                                                    <img src="<?php echo get_field('product_image', $curr_prod[0]->ID); ?>" alt="">
                                                </div>
                                            <?php endif; ?>
                                            <div class="card-content">
                                                <div class="content__card-wrap">
                                                    <h3 class="card-name"><?php echo $cat_temp->name; ?></h3>
<!--                                                    <p class="products-count"><strong>-->
<!--                                                            --><?php //echo $cat_temp->count; ?>
<!--                                                        </strong> Products-->
<!--                                                    </p>-->
                                                </div>
                                                <div class="more-link">
                                                    <span class="link-text">Go to Overview</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; endif; endif; ?>
                        </div>
                    </div>
                    <?php if ($glossary) : ?>
                        <div id="glossary" class="glossary-subsection">
                            <div class="top-ranked-products-component">
                                <div class="subsection-caption">
                                    <div class="sc-image">
                                        <img src="<?= get_template_directory_uri() ?>/img/content-images/single-industry/glossary.svg" alt="">
                                    </div>
                                    <h2 class="sc-title">All Categories (A-Z)</h2>
                                </div>
                                <div class="subsection-inner glossary-subsection_inner">
                                    <?php $sort_terms = [];
                                    foreach($glossary as $term) {
                                        $sort_terms[$term->name] = $term;
                                    }
                                    uksort( $sort_terms, 'strnatcmp');
                                    $new_glossary = [];
                                    foreach ($sort_terms as $key => $value) {
                                        $first_char = substr($value->name, 0, 1);
                                        $new_glossary[$first_char][] = $value->name;
                                    }
                                    foreach ($new_glossary as $x => $item) : ?>
                                        <div class="glossary-item">
                                            <div class="glossary-letter glossary-text_style">
                                                <?= $x; ?>
                                            </div>
                                            <div class="glossary-item_links">
                                                <?php if ($item) : foreach ($item as $name) :
                                                    $term = get_term_by('name', $name, 'product_category'); ?>
                                                    <a href="<?= get_term_link($term, 'product_category'); ?>"
                                                       class="glossary_cat-item glossary-text_style">
                                                        <?= $name; ?>
                                                    </a>
                                                <?php endforeach; endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div id="top-ranked-products" class="top-ranked-industry">
                        <div class="top-ranked-products-component">
                            <div class="subsection-caption">
                                <div class="sc-image">
                                    <img src="<?= get_template_directory_uri() ?>/img/content-images/single-industry/ranking.svg" alt="">
                                </div>
                                <h2 class="sc-title">Popular Products in Industry</h2>
                            </div>
                            <div class="top-ranked-slider" data-modal="#popUp">
                                <?php
                                $termindustry=str_replace('&','%26',$queried_object->name);
                                $termindustry=str_replace('amp;','',$queried_object->name);
                                ?>
                                <button type="button"  data-link="/category-analysis/overview?q=&industry=<?php echo trim($termindustry); ?>" class="slick-arrow slick-prev auth-btn" aria-label="Previous"><svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 26"><path d="M.62 14.15l10.6 10.59c.4.41.88.61 1.47.61.6 0 1.08-.2 1.48-.61l1.23-1.22a2.13 2.13 0 000-2.96l-7.9-7.9 7.88-7.88a2.13 2.13 0 000-2.96L14.15.6a2 2 0 00-1.47-.6 2 2 0 00-1.47.6L.6 11.19a2.09 2.09 0 00.02 2.96z"/></svg></button>
                                <?php
                                $posts = get_field('ind_top_ranked_products', $queried_object);
                                if (!$posts) {
                                    $posts = get_posts([
                                        'numberposts' => 5,
                                        'post_type'   => 'products',
                                        'tax_query' => [
                                            [
                                                'taxonomy' => 'product_category',
                                                'field'    => 'id',
                                                'terms'    => $cats_temporary_ids,
                                            ]
                                        ],
                                        'meta_query' => [
                                            'relation' => 'OR',
                                        array(
                                            'key' => 'star_rating',
                                            'value' => [4, 5],
                                            'compare' => 'BETWEEN',
                                        ),
                                            [
                                                'key' => 'sentiment',
                                                'value' => '80',
                                                'compare' => '>',
                                            ]
                                        ]
                                    ]);
                                }
                                $h = 0;
                                foreach( $posts as $post ){$h++;

                                    if ($h == 5) {
                                        break;
                                    }

                                    setup_postdata($post);
                                    ?>
                                    <div class="slide">
                                        <a href="<?php echo get_permalink(); ?>" class="product-card">
                                            <div class="card-number"><?php if($h<10){ ?>0<?php } ?><?php echo $h;?></div>
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
                                                        <span class="link-text">Go to Overview</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>



                                    <?php

                                }

                                wp_reset_postdata(); // сброс

                                ?>

                                <button type="button" data-link="/category-analysis/overview?q=&industry=<?php echo $termindustry; ?>" class="slick-arrow slick-next auth-btn" aria-label="Next"><svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 26"><path d="M15.38 11.2L4.78.63C4.38.2 3.9 0 3.3 0c-.6 0-1.08.2-1.48.62L.6 1.83a2.13 2.13 0 000 2.96l7.9 7.9-7.88 7.89a2.13 2.13 0 000 2.96l1.23 1.21c.4.4.9.6 1.47.6a2 2 0 001.47-.6L15.4 14.17c.4-.42.6-.91.6-1.5a2.09 2.09 0 00-.62-1.46z"/></svg></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--    --><?php //if( have_rows('reviews_industry', 'option') ): ?>
        <!--        <section class="testimonials-section">-->
        <!--            <div class="container">-->
        <!--                <div class="testimonials-slider">-->
        <!--                    --><?php //$i=0;
        //                    while( have_rows('reviews_industry', 'option') ): the_row(); ?>
        <!--                        <div class="slide">-->
        <!--                            <div class="testimonial-card">-->
        <!--                                <div class="card-text">-->
        <!--                                    <p>--><?php //echo get_sub_field('review');?><!--</p>-->
        <!--                                </div>-->
        <!---->
        <!--                                <div class="card-author-block">-->
        <!--                                    <div class="block-avatar">-->
        <!--                                        <img src="--><?php //echo get_sub_field('author_image')['url'];?><!--" alt="--><?php //echo get_sub_field('author_image')['alt'];?><!--">-->
        <!--                                    </div>-->
        <!--                                    <div class="block-content">-->
        <!--                                        <h4 class="block-name">--><?php //echo get_sub_field('author_name');?><!--</h4>-->
        <!--                                        <p>--><?php //echo get_sub_field('author_position');?><!--</p>-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    --><?php //endwhile; ?>
        <!--                </div>-->
        <!--            </div>-->
        <!--        </section>-->
        <!--    --><?php //endif; ?>
        <section class="get-access-section">
            <div class="container">
                <div class="get-access-block">
                    <div class="section-caption">
                        <h2 class="sc-title small"><?php echo get_field('industry_access_title','option');?></h2>
                        <p class="sc-subtitle"><?php echo get_field('industry_access_text','option');?></p>
                    </div>
                    <div class="block-footer">
                        <button data-modal="#popUp" class="btn"><?php echo get_field('get_started_button','option');?></button>

                        <!--                    <a href="https://pro.sentimate.com/"  data-link="/comparison" class="btn auth-btn">--><?php //echo get_field('get_started_button','option');?><!--</a>-->
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php endif;
get_footer(); ?>