<?php
get_header(); ?>
    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;?>
    <main class="page-content">
    <section class="first-screen-section">
        <div class="container">
            <h1 class="page-caption"><?php echo get_field('title',3495);?></h1>

            <div class="section-text">
                <p><?php echo get_field('text',3495);?></p>
            </div>

            <?php if (get_field('hide_show_search',3495)) { ?>

                <div class="component-search-with-autocomplete">
                    <div class="cmp-field">
                        <svg class="field-icon">
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/icons-sprite.svg#search"></use>
                        </svg>
                        <input type="text" placeholder="<?php echo get_field('placeholder_field','option');?>" id="searchinput">
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

            <?php } ?>

        </div>
    </section>
    <section class="catalog-section">
        <div class="container">
            <div class="breadcrumbs">
                <?php
                if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();
                ?>
            </div>
            <div class="section-inner">
                <div class="section-content" >

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
                            <div class="products-grid">
                                <?php
                                $tax_query=array('relation'=>"AND");

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
                                    "s" => $_GET['s']
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