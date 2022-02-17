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
if(get_field('title',$page)) {
    $title = get_field('title', $page);
}else{
    $title = get_field('title', 3495);
}
if(get_field('text',$page)) {
    $text = get_field('text', $page);
}else{
    $text = get_field('text', 3495);
}
//if ($queried_object->parent !== 0) : ?>
    <main class="page-content">
        <section class="first-screen-section">
            <div class="container">
                <h1 class="page-caption">Best<?php echo ' <strong>'.$queried_object->name.'</strong> '; ?>Ratings</h1>

                <div class="section-text">
                    <p><?php echo $title; ?></p>
                </div>

                <div class="component-search-with-autocomplete">
                    <div class="cmp-field">
                        <form action="">
                            <svg class="field-icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#search"></use>
                            </svg>
                            <input type="text" name="s" placeholder="<?php echo get_field('placeholder_field','option');?>" id="searchinput">
                            <button class="btn" type="submit">Go</button>
                        </form>
                    </div>
                    <div class="cmp-suggestions">
                        <ul id="search_rezult">

                        </ul>
                    </div>
                </div>

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
            </div>
        </section>
        <section class="catalog-section no-sidebar brand-section">
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
                <div class="section-inner no-sidebar">
<!--                    <aside class="section-sidebar">-->
<!--                        <div class="sidebar-category-block js-accordion opened-on-load">-->
<!--                            <input type="hidden" id="link" value="--><?php //echo get_term_link($active,$taxonomy); ?><!--">-->
<!--                            <div class="block-header ac-header">-->
<!--                                <p class="block-caption">Categories</p>-->
<!---->
<!--                                <button class="ac-opener"></button>-->
<!--                            </div>-->
<!--                            <div class="block-content ac-content">-->
<!--                                <div class="checkboxes-list categoryes">-->
<!--                                    --><?php
//                                    $brands=array();
//                                    if($_GET['categoryes']){
//                                        $categoryes=explode(',',$_GET['categoryes']);
//                                    }
//                                    $args = [
//                                        'taxonomy'      => [ 'product_category' ], // название таксономии с WP 4.5
//                                        'orderby'       => 'name',
//                                        'order'         => 'ASC',
//                                        'hide_empty'    => true,
//                                    ];
//
//                                    $terms = get_terms( $args );
//
//                                    foreach( $terms as $term ){
//                                        ?>
<!--                                        <label class="checkbox">-->
<!--                                            <input type="checkbox" --><?php //if(in_array( $term->term_id,$categoryes)){ echo 'checked';}?><!-- --><?php //if($active== $term->term_id){ echo 'checked';}?><!-- value="--><?php //echo $term->term_id; ?><!--" class="visually-hidden">-->
<!--                                            <span class="fake-label">--><?php //echo $term->name; ?><!--</span>-->
<!--                                        </label>-->
<!--                                        --><?php
//                                    }
//                                    ?>
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="sidebar-category-block js-accordion opened-on-load">-->
<!--                            <div class="block-header ac-header">-->
<!--                                <p class="block-caption">Brands</p>-->
<!---->
<!--                                <button class="ac-opener"></button>-->
<!--                            </div>-->
<!--                            <div class="block-content ac-content">-->
<!--                                <div class="small-search-block">-->
<!--                                    <input type="text" placeholder="Search" id="brands_search">-->
<!--                                </div>-->
<!--                                <div class="checkboxes-list">-->
<!---->
<!--                                    --><?php
//                                    $brands=array();
//                                    if($_GET['brands']){
//                                        $brands=explode(',',$_GET['brands']);
//                                    }
//                                    $args = [
//                                        'taxonomy'      => [ 'brands' ], // название таксономии с WP 4.5
//                                        'orderby'       => 'name',
//                                        'order'         => 'ASC',
//                                        'hide_empty'    => true,
//                                    ];
//
//                                    $terms = get_terms( $args );
//                                    $otp=array();
//                                    foreach( $terms as $term ){
//                                        $first_letter = mb_strtoupper(substr($term->name, 0, 1));
//                                        $otp[$first_letter][] = $term->term_id;
//                                    }
//                                    $j=0;
//                                    foreach( $otp as $key=> $term ){
//                                        ?>
<!--                                        <div class="brands_wrap">-->
<!--                                            <h4 class="list-caption">--><?php //echo $key; ?><!--</h4>-->
<!--                                            --><?php // foreach( $term as $t ){ ?>
<!--                                                <label class="checkbox">-->
<!--                                                    <input type="checkbox" --><?php //if(in_array($t,$brands)){ echo 'checked';}?><!-- value="--><?php //echo $t; ?><!--" class="visually-hidden">-->
<!--                                                    <span class="fake-label">--><?php // echo get_term($t,'brands')->name; ?><!--</span>-->
<!--                                                </label>-->
<!---->
<!--                                                --><?php
//                                            }?>
<!--                                        </div>-->
<!--                                        --><?php
//                                    }
//
//                                    ?>
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </aside>-->
                    <div class="section-content">
                        <div class="filters-row">
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
                                <div class="products-grid brand-products-grid">
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
<?php get_footer(); ?>