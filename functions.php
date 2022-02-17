<?php


add_theme_support( 'menus' );

if( function_exists('acf_add_options_page') ) {

    $option_page = acf_add_options_page(array(
        'page_title' 	=> 'General settings',
        'menu_title' 	=> 'General settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability' 	=> 'edit_posts',
        'redirect' 	=> false
    ));
}

// if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();

function dimox_breadcrumbs() {

    /* === ОПЦИИ === */
    $text['home']     = get_the_title( get_option('page_on_front') ); // текст ссылки "Главная"
    $text['category'] = '%s'; // текст для страницы рубрики
    $text['search']   = 'Search result "%s"'; // текст для страницы с результатами поиска
    $text['tag']      = 'Записи с тегом "%s"'; // текст для страницы тега
    $text['author']   = 'Статьи автора %s'; // текст для страницы автора
    $text['404']      = 'Ошибка 404'; // текст для страницы 404
    $text['page']     = 'Страница %s'; // текст 'Страница N'
    $text['cpage']    = 'Страница комментариев %s'; // текст 'Страница комментариев N'

    $wrap_before    = '<ul class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
    $wrap_after     = '</ul><!-- .breadcrumbs -->'; // закрывающий тег обертки
    $sep            = ''; // разделитель между "крошками"
    $before         = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'; // тег перед текущей "крошкой"
    $after          = '</span><meta itemprop="position" content="2" /></li>'; // тег после текущей "крошки"

    $show_on_home   = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
    $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
    $show_current   = 1; // 1 - показывать название текущей страницы, 0 - не показывать
    $show_last_sep  = 1; // 1 - показывать последний разделитель, когда название текущей страницы не отображается, 0 - не показывать
    /* === КОНЕЦ ОПЦИЙ === */

    global $post;
    $home_url       = home_url('/');
    $link           = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $link          .= '<a class="breadcrumbs__link" href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
    $link          .= '<meta itemprop="position" content="%3$s" />';
    $link          .= '</li>';
    $parent_id      = ( $post ) ? $post->post_parent : '';
    $home_link      = sprintf( $link, $home_url, $text['home'], 1 );

    if ( is_home() || is_front_page() ) {

        if ( $show_on_home ) echo $wrap_before . $home_link . $wrap_after;

    } else {

        $position = 0;

        echo $wrap_before;

        if ( $show_home_link ) {
            $position += 1;
            echo $home_link;
        }

        if ( is_category() ) {
            $parents = get_ancestors( get_query_var('cat'), 'category' );
            foreach ( array_reverse( $parents ) as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $cat = get_query_var('cat');
                echo $sep . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }

        } elseif ( is_search() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $show_home_link ) echo $sep;
                echo sprintf( $link, $home_url . '?s=' . get_search_query(), sprintf( $text['search'], get_search_query() ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['search'], get_search_query() ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }

        } elseif ( is_year() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_time('Y') . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_month() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('F') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_day() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position ) . $sep;
            $position += 1;
            echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('d') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_single() && ! is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $position += 1;
                $post_type = get_post_type_object( get_post_type() );
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
                if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                elseif ( $show_last_sep ) echo $sep;
            } else {
                $cat = get_the_category(); $catID = $cat[0]->cat_ID;
                $parents = get_ancestors( $catID, 'category' );
                $parents = array_reverse( $parents );
                $parents[] = $catID;
                foreach ( $parents as $cat ) {
                    $position += 1;
                    if ( $position > 1 ) echo $sep;
                    echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                }
                if ( get_query_var( 'cpage' ) ) {
                    $position += 1;
                    echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
                    echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
                } else {
                    if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                    elseif ( $show_last_sep ) echo $sep;
                }
            }

        } elseif ( is_post_type_archive() ) {
            $post_type = get_post_type_object( get_post_type() );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . $post_type->label . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_attachment() ) {
            $parent = get_post( $parent_id );
            $cat = get_the_category( $parent->ID ); $catID = $cat[0]->cat_ID;
            $parents = get_ancestors( $catID, 'category' );
            $parents = array_reverse( $parents );
            $parents[] = $catID;
            foreach ( $parents as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            $position += 1;
            echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_page() && ! $parent_id ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_title() . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_page() && $parent_id ) {
            $parents = get_post_ancestors( get_the_ID() );
            foreach ( array_reverse( $parents ) as $pageID ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
            }
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_tag() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $tagID = get_query_var( 'tag_id' );
                echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_author() ) {
            $author = get_userdata( get_query_var( 'author' ) );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['author'], $author->display_name ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_404() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . $text['404'] . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( has_post_format() && ! is_singular() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            echo get_post_format_string( get_post_format() );
        }

        echo $wrap_after;

    }
} // end of dimox_breadcrumbs()




function revuze_setup() {
    load_theme_textdomain( 'revuze', get_template_directory() . '/languages' );
    add_editor_style();
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
    register_nav_menu( 'primary', __( 'Primary Menu', 'revuze' ) );
    add_theme_support( 'custom-background', array(
        'default-color' => 'e6e6e6',
    ) );
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'revuze_setup' );




//  добавление нового разширение изорбражений
 add_image_size( 'press_pelis', '502', '371', true);



function corporate_plus_customize_preview_js() {

    if(is_singular('products')) {
        wp_enqueue_script('corporate-plus-customizer', get_template_directory_uri() . '/acmethemes/core/js/customizer.js', array('customize-preview'), '1.1.0', true);
        wp_enqueue_script('at-theme-info-js', get_template_directory_uri() . '/acmethemes/at-theme-info/js/at-theme-info.js', array('jquery'));
        wp_enqueue_script('corporate-plus-skip-link-focus-fix', get_template_directory_uri() . '/acmethemes/core/js/skip-link-focus-fix.js', array(), '20130115', true);

        wp_enqueue_script('corporate-plus-customize-controls', trailingslashit(get_template_directory_uri()) . 'acmethemes/customizer/customizer-pro/customize-controls.js', array('customize-controls'));
        wp_enqueue_style('corporate-plus-customize-controls', trailingslashit(get_template_directory_uri()) . 'acmethemes/customizer/customizer-pro/customize-controls.css');
        if (get_page_template_slug() == 'new-hp.php') {
            wp_enqueue_style('revuze-api', get_template_directory_uri() . '/assets/css/revuze-new-5.css', array(), '1.0.14');
        }
        wp_enqueue_style('corporate-plus-googleapis', '//fonts.googleapis.com/css?family=Lato:400,700,300', array(), null);
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/css/bootstrap.min.css', array(), '3.3.6');
        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/library/Font-Awesome/css/font-awesome.min.css', array(), '4.5.0');

        wp_enqueue_style('jquery-bxslider', get_template_directory_uri() . '/assets/library/bxslider/css/jquery.bxslider.min.css', array(), '4.2.5');
        wp_enqueue_style('corporate-plus-style', get_stylesheet_uri(), array(), '1.0.1');
        wp_enqueue_script('corporate-plus-skip-link-focus-fix', get_template_directory_uri() . '/acmethemes/core/js/skip-link-focus-fix.js', array(), '20130115', true);
        wp_enqueue_script('html5', get_template_directory_uri() . '/assets/library/html5shiv/html5shiv.min.js', array('jquery'), '3.7.3', false);
        wp_script_add_data('html5', 'conditional', 'lt IE 9');
        wp_enqueue_script('respond', get_template_directory_uri() . '/assets/library/respond/respond.min.js', array('jquery'), '1.1.2', false);
        wp_script_add_data('respond', 'conditional', 'lt IE 9');
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.6', 1);
        wp_enqueue_script('jquery-bxslider', get_template_directory_uri() . '/assets/library/bxslider/js/jquery.bxslider.min.js', array('jquery'), '4.2.51', 1);
        wp_enqueue_script('parallax', get_template_directory_uri() . '/assets/library/jquery-parallax/jquery.parallax.js', array('jquery'), '1.1.3', 1);

        wp_enqueue_script('corporate-plus-custom', get_template_directory_uri() . '/assets/js/corporate-plus-custom.js', array('jquery'), '1.0.3', 1);
    }
}
add_action( 'wp_enqueue_scripts', 'corporate_plus_customize_preview_js' );


// Пагинация
// if (function_exists('pagination')) pagination();


function pagination($pages = '', $range = 4){

    $prev_arrow = is_rtl() ? 'prev;' : '«prev';
    $next_arrow = is_rtl() ? 'next;' : 'next»';

    global $wp_query;
    $total = $wp_query->max_num_pages;
    $big = 999999999; // need an unlikely integer
    if( $total > 1 )  {
        if( !$current_page = get_query_var('paged') )
            $current_page = 1;
        if( get_option('permalink_structure') ) {
            $format = 'page/%#%/';
        } else {
            $format = '&paged=%#%';
        }
        echo paginate_links(array(
            'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'		=> $format,
            'current'		=> max( 1, get_query_var('paged') ),
            'total' 		=> $total,
            'mid_size'		=> 3,
            'type' 			=> 'list',
            'prev_text'		=> $prev_arrow,
            'next_text'		=> $next_arrow,
        ) );
    }
}






add_action('admin_menu', function(){
    add_menu_page( 'Import', 'Import', 'manage_options', 'site-options', 'add_my_setting', '', 88);
} );


function add_my_setting(){
    ?>
    <div class="wrap">
        <h2>  Api import</h2>

        <?php
        // settings_errors() не срабатывает автоматом на страницах отличных от опций
        if( get_current_screen()->parent_base !== 'options-general' )
            settings_errors('название_опции');
        ?>
        <br>
        <div class="file_name" style="font-size: 18px;">Import<?php if(get_field('import','option')){  $file=get_field('import','option'); echo $file['url'];}else{ 'Upload file in general settings!';}?></div>
        <br>
        <br>
        <div style ="width: 750px">

            <a id="submit" style=" display: inline-block;"  class="button button-primary start_import">Start update products by API</a>
            <a id="submit_import" style=" display: inline-block;" class="button button-primary">Start import product from exel</a>

            <span class="spinner" style=" display: inline-block;"></span>
            <div>
                <br>
                <label for="">Delete products that are not in the file
                  <input type="checkbox" id="removeold">
                </label>
            </div>

        </div>
        <br>
        <br>
    </div>
    <div class="rezult"></div>
    <?php
    $maxpaged=ceil(wp_count_posts('products')->publish/get_field('product_per_page','option'));



    $file=get_field('file_products','option');
    $url=get_attached_file( $file['id']);

    require_once __DIR__ . '/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

// Файл xlsx
    $xls = PHPExcel_IOFactory::load($url);

// Первый лист
    $xls->setActiveSheetIndex(0);
    $sheet = $xls->getActiveSheet();
    $sheetcount = $xls->setActiveSheetIndex(0)->getHighestRow();

    ?>
    <script>
        jQuery( document ).ready(function() {
            jQuery('.start_import').click(function(){
                jQuery('.spinner').css('visibility','visible');
                exp(1);

            });
            jQuery('#submit_import').click(function(){
                jQuery('.spinner').css('visibility','visible');
                importproducts(1);
            });


            function importproducts(i){
                var removeold=0;
                if (jQuery('#removeold').is(':checked')) {
                    removeold=1;
                }
                var data = {
                    'action': 'importproduct',
                    'removeold' : removeold,
                    'pagefrom' : i,
                    'pageto' : i+3,
                };
                jQuery.ajax({
                    url:'<?php echo site_url() ?>/wp-admin/admin-ajax.php',
                    data:data, // данные
                    type:'POST', // тип запроса
                    success:function(data){

                        if( data ) {
                            jQuery('.rezult').append('<span>'+data+'</span></br>');
                        }
                        if(i==<?php echo $sheetcount;?>){
                            jQuery('.spinner').css('visibility','hidden');
                            jQuery('.rezult').append('<h2>End import api!</h2></br>');
                            return;
                        }

                        if(i<=<?php echo $sheetcount; ?>){
                            i=i+3;
                            importproducts(i);
                        }
                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        $('#post').html(msg);
                    },
                });
            }

            function exp(i){

                var data = {
                    'action': 'do_every_thirty_min',
                    'page' : i,
                };
                jQuery.ajax({
                    url:'<?php echo site_url() ?>/wp-admin/admin-ajax.php',
                    data:data, // данные
                    type:'POST', // тип запроса
                    success:function(data){

                        if( data ) {
                            jQuery('.rezult').append('<span>'+data+'</span></br>');
                        }
                        if(i>=<?php echo $maxpaged;?>){
                            jQuery('.spinner').css('visibility','hidden');
                            jQuery('.rezult').append('<h2>End import product!</h2></br>');
                            return;
                        }


                        if(i<=<?php echo $maxpaged; ?>){
                            i++;
                            exp(i);
                        }
                    }
                });
            }



        });
    </script>
    <?php

}





add_action('wp_ajax_importproduct', 'importproduct');
add_action('wp_ajax_nopriv_importproduct', 'importproduct');

function importproduct(){
    $file=get_field('file_products','option');
    $homepage = file_get_contents($file['url']);
    $url=get_attached_file( $file['id']);
    require_once __DIR__ . '/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

    $xls = PHPExcel_IOFactory::load($url);

    $xls->setActiveSheetIndex(0);
    $sheet = $xls->getActiveSheet();

    $i=0;
    foreach ($sheet->toArray() as $row) {

        $i++;
        if($i>$_POST['pagefrom'] and $i<=$_POST['pageto'] and strlen($row[1])>30) {
           echo add_update_product($row);
        }

    }
    die();
}




function add_update_product($row){
    $post_id = 0;
    $cc_args = array(
        'posts_per_page' => -1,
        'post_type' => 'products',
        'meta_key' => 'product_uuid',
        'meta_value' => $row[1]
    );

    $cc_query = new WP_Query($cc_args);
    while ($cc_query->have_posts()) {
        $cc_query->the_post();
        $post_id = get_the_ID();
    }
    if (!$post_id) {
        $post = array(
            'post_content' => '',
            'post_status' => "publish",
            'post_title' => $row[2],
            'post_parent' => '',
            'post_type' => "products",
        );
        $post_id = wp_insert_post($post);
        update_field('product_uuid', $row[1], $post_id);
        apiupdate($post_id);
        $return= $row[1] . ' add!</br>';
    } else {
        // apiupdate($post_id);
        $return= $row[1] . ' update!</br>';
    }
}
//Change the permalink if it's id
//$posts = get_posts([
//    'numberposts' => -1,
//    'post_type' => 'products',
//]);
//foreach ( $posts as $post ) {
//    $new_slug = sanitize_title( $post->post_title );
//    if ( $post->post_name != $new_slug )
//    {
//        wp_update_post(
//            array (
//                'ID'        => $post->ID,
//                'post_name' => $new_slug
//            )
//        );
//    }
//}











add_filter( 'cron_schedules', 'cron_add_thirty_min' );
function cron_add_thirty_min( $schedules ) {
    $schedules['thirty_min'] = array(
        'interval' => 60 * get_field('updates_in_minutes','option'),
        'display' => 'Раз в 30 минут'
    );
    return $schedules;
}
add_action( 'wp', 'my_activation' );
function my_activation() {
    if ( ! wp_next_scheduled( 'my_thirty_min_event' ) )
        wp_schedule_event( time(), 'thirty_min', 'my_thirty_min_event' );
}

// функция крон-задачи


add_action( 'my_thirty_min_event', 'do_every_thirty_min' );
add_action('wp_ajax_do_every_thirty_min', 'do_every_thirty_min');
add_action('wp_ajax_nopriv_do_every_thirty_min', 'do_every_thirty_min');

function add_upload_mimes( $types ) {
    $types['json'] = 'text/plain';
    return $types;
}
add_filter( 'upload_mimes', 'add_upload_mimes' );

function do_every_thirty_min(){



//    $maxpaged=ceil(wp_count_posts('products')->publish/get_field('product_per_page','option'));
    $maxpaged=ceil(10000/get_field('product_per_page','option'));


    $curent_page=get_field('paged','option');
    if($_POST['page']){
        $curent_page=$_POST['page'];
    }


    $args= array(
        'numberposts' => get_field('product_per_page','option'),
        'paged'    => $curent_page,
        'orderby'     => 'date',
        'order'       => 'DESC',
        'post_type'   => 'products',
    );

    $posts = get_posts( $args);

    foreach( $posts as $post ){
        setup_postdata($post);
        echo $post->ID;
        echo'</br>';
        $id=$post->ID;
        update_field('product_competing_table', '', $id);
        update_field('product_competitive_products', '', $id);
        update_field('product_monthly_verified_buyers', '', $id);
        update_field('category_top_10_brands', '', $id);
        update_field('star_rating_drivers', '', $id);
        update_field('monthly_number_of_verified_buyers', '', $id);
        update_field('product_monthly_star_rating', '', $id);

        apiupdate($post->ID);
    }

    wp_reset_postdata(); // сброс

    $paged=$curent_page+1;
    if($paged>$maxpaged){
        $paged=1;
    }
    update_field('paged', $paged, 'option');
    die();
}

require_once trailingslashit( get_template_directory() ).'revuzeapi/revuzeapi.php';



add_action( 'init', 'process_post' );

function process_post() {
    if(!empty($_GET['id'])){
        apiupdate($_GET['id']);
    }
}


if($_GET['currentpage']){
    $args = [
        'post_type'     => 'products',
        'posts_per_page' => 50000,
        'paged'=>$_GET['currentpage']

    ];
    $my_query = new WP_Query( $args );
    $posts = $my_query->posts;
    $num_of_posts = count($posts);

    for($j = 0; $j < $num_of_posts; $j++)
    {
        $post = $posts[$j]; // this post will be the post that doesnt get deleted, if any duplicates exist down the line //
        $current_title = $post->post_title;

        for($k = $j+1; $k < $num_of_posts; $k++)
        {
            $next_post = $posts[$k];
            $next_title = $next_post->post_title;
            $next_id = $next_post->ID;


            if( strcmp($current_title, $next_title) == 0 and get_field('product_uuid',$post->ID)==get_field('product_uuid',$next_post->ID)) {
                echo '</br>';
                echo get_field('product_uuid',$post->ID);
                echo '</br>';
                echo $post->ID;
                echo '</br>';
                echo get_field('product_uuid',$next_post->ID);
                echo '</br>';
                echo $next_post->ID;
                echo '</br>';
                echo "Duplicate for {$current_title} with ID {$next_id} will be deleted <br/>";
                wp_delete_post($next_id, false); // move to trash first
            }
        }
    }
    die('/////');
}


//Old function


//function apiupdate($id)
//{
//
//    $uid = get_field('product_uuid',$id);
//    update_field('date_update', date('Y-m-d H:i:s'), $id);
//
//    $response = get_product_data($uid);
//    $json = json_decode($response);
//
//    if($json) {
////        $rank = json_encode($json->ranking);
//        $rank = json_encode($json->rank);
//
//        update_field('product_image', $json->image, $id);
//        update_field('product_brand_name', $json->brand_name, $id);
//        update_field('product_brand_logo', $json->brand_logo, $id);
//        update_field('product_category', $json->last_category, $id);
//        update_field('product_industry', $json->industry_name, $id);
//        update_field('rank', $json->rank, $id);
//        update_field('rank_trend', $json->rank_trend, $id);
//
//
//        $termpost=array();
//        $term_long = get_term_by('name', esc_sql($json->category), 'product_category');
//        $arr_of_chars = str_split(esc_sql($json->category));
//        if ($term_long && in_array('|', $arr_of_chars)) {
//            wp_delete_term($term_long->term_id, 'product_category');
//        }
//        $arr_names = explode("|", $json->category);
//
//        foreach ($arr_names as $num => $name_category) {
//            $term = get_term_by('name', $name_category, 'product_category');
//            if (empty($term->term_id)) {
//                $termparent = get_term_by('name', $arr_names[$num-1], 'product_category');
//                $arrgs=array(
//                    'parent' => $termparent->term_id,
//                );
//                $insert_data = wp_insert_term(($name_category), 'product_category', $arrgs);
//                $term_id = $insert_data['term_id'];
//            } else {
//                $term_id = $term->term_id;
//                if ((!isset($term->parent) || $term->parent === 0) && $num > 0 ) {
//                    wp_update_term($term_id, 'product_category', [
//                        'parent' => $termpost[$num - 1],
//                    ]);
//                }
//            }
//            update_field('parent_industry', $json->industry_name, 'product_category' . '_' . $term_id);
//            $termpost[] = $term_id;
//        }
//        wp_set_object_terms($id, $termpost, 'product_category');
//        $termpost = array();
//
//
//
//        $term = get_term_by('name', $json->industry_name, 'product_industry');
//        if (empty($term->term_id)) {
//            $insert_data = wp_insert_term($json->industry_name, 'product_industry', array(
//                'parent' => 0,
//            ));
//            $term_id = $insert_data['term_id'];
//        } else {
//            $term_id = $term->term_id;
//        }
//        $termpost[] = $term_id;
//        wp_set_object_terms($id, $termpost, 'product_industry');
//        $termpost = array();
//        $term = get_term_by('name', $json->brand_name, 'brands');
//        if (empty($term->term_id)) {
//            $insert_data = wp_insert_term($json->brand_name, 'brands', array(
//                'parent' => 0,
//            ));
//            $term_id = $insert_data['term_id'];
//        } else {
//            $term_id = $term->term_id;
//        }
//        $termpost[] = $term_id;
//        wp_set_object_terms($id, $termpost, 'brands');
//
//        update_field('product_ranking', $rank, $id);
//        echo $uid.' update!';
//        echo '</br>';
//    }
//
//
//    if(!$json->name){
//        wp_delete_post($id);
//        /// //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//        return;
//    }
//
//
//
//    //Market Rank
//    $monthly_rank = get_monthly_rank($uid);
//    update_field('product_monthly_rank', $monthly_rank, $id);
//
//
//    $category_top_10_products_data = category_top_10_products_data($uid);
//    update_field('category_top_10_products_data', $category_top_10_products_data, $id);
//
//
////    $category_top_10_brands = category_top_10_brands($uid);
////    update_field('category_top_10_brands', $category_top_10_brands, $id);
//
//
//    $topicsadvdisadv = get_topicsAdvDisadv($uid);
//
//    update_field('topicsadvdisadv', $topicsadvdisadv, $id);
//
//
//    $date1=date("m/Y", mktime(0, 0, 0, date('m')-0, date('d') , date('Y')));
//    $date2=date("m/Y", mktime(0, 0, 0, date('m')-6, date('d') , date('Y')));
//    $mostdiscussedtopics = get_most_discussed_topics_of_product('779152d0-c3cf-11e9-b164-c3925ec7a797',$date1,$date2,$uid);
//    update_field('re-purchase', $mostdiscussedtopics, $id);
//
//
//    $date1=date("m/Y", mktime(0, 0, 0, date('m')-0, date('d') , date('Y')));
//    $date2=date("m/Y", mktime(0, 0, 0, date('m')-6, date('d') , date('Y')));
//    $mostdiscussedtopics = get_most_discussed_topics_of_product('77e05d32-c3cf-11e9-b164-c3925ec7a797',$date1,$date2,$uid);
//    update_field('recommenders', $mostdiscussedtopics, $id);
//
//
//
//
//
//
//    $all_topics_data = all_topics_data($uid);
//    update_field('all_topics_data', $all_topics_data, $id);
//
//
//
////    $product_monthly_star_rating = product_monthly_star_rating($uid);
////    update_field('product_monthly_star_rating', $product_monthly_star_rating, $id);
//
////    $star_rating_drivers = star_rating_drivers($uid);
////    update_field('star_rating_drivers', $star_rating_drivers, $id);
//
//
////    $monthly_number_of_verified_buyers = monthly_number_of_verified_buyers($uid);
////    update_field('monthly_number_of_verified_buyers', $monthly_number_of_verified_buyers, $id);
//
//
//
//    //Customer Satisfaction
//    $monthly_reviews = get_monthly_reviews($uid);
//    update_field('product_monthly_reviews', $monthly_reviews, $id);
//    $jsonsant=json_decode($monthly_reviews);
//    $satisfactionSum=0;
//    $count=0;
//    foreach($jsonsant as $val){
//        if($val->sentiments->positive){
//            $count++;
//            $satisfactionSum=$satisfactionSum+$val->sentiments->positive* 100;
//        }
//    }
//    $avarageSatisfaction=$satisfactionSum/$count;
//    update_field('sentiment', $avarageSatisfaction, $id);
//
//
//    //Verified buyers
//    $verified_buyers = get_monthly_verified_buyers($uid);
//   // update_field('product_monthly_verified_buyers', $verified_buyers, $id);
//
//    //User Rating
//    $star_rating = get_star_rating($uid);
//    update_field('product_star_rating', $star_rating, $id);
//
//
//    $product_star_rating = json_decode($star_rating);
//    $avarageSum = 0;
//    $averageCount = 0;
//    foreach($product_star_rating as $rating){
//        if($rating->average > 0){
//            $avarageSum += $rating->average;
//            $averageCount++;
//        }
//    }
//    $average = $avarageSum/$averageCount;
//    update_field('star_rating', $average, $id);
//
//
//    //User Rating
//    $monthly_sentiment = get_topic_monthly_sentiment($uid);
//    update_field('product_topic_monthly_sentiment', $monthly_sentiment, $id);
//
//
////    print_R($monthly_reviews);
////    die('////');
//    /// product Info
//
//    $post_data = array(
//        'ID' => $id,
//        'post_title' => $json->name
//    );
//    wp_update_post($post_data);
////    echo 'Product name: '.$json->name.', Product uid: '.$uid;
////    echo '</br>';
//
//    //////Competing
//    $competitive = get_competitive_products($uid);
//    $json = json_decode($competitive);
//    $count = 0;
//    $competing = array();
//    foreach ($json[0]->uuids as $value) {
//        $count++;
//        if ($count <= 10) {
//            $competing[] = $value;
//        }
//    }
//    $table = '<table class="block__table" border="1"><tbody data-id="competitiveProducts"><tr class="tr tr__head"><td class="td__col td__head td__prod">Product name</td><td class="td__col td__head">category</td><td class="td__col td__head">reviews</td><td class="td__col td__head">satisfaction</td> <td class="td__col td__head td__last">Sentiment distribuion</td></tr>';
//    foreach ($competing as $value) {
//        $response = get_product_data($value);
//        $json = json_decode($response);
//
//        $responsemonthly = get_monthly_reviews($value);
//        $jsonmonthly = json_decode($responsemonthly);
//        $totalReviews = 0;
//        $negative = 0;
//        $neutral = 0;
//        $positive = 0;
//        $satisfaction = 0;
//        $count = count($jsonmonthly);
//        foreach ($jsonmonthly as $month) {
//            $totalReviews = $totalReviews + $month->volume;
//            if (!empty($month->sentiments->negative))
//                $negative = $negative + $month->sentiments->negative * 100;
//            if (!empty($month->sentiments->neutral))
//                $neutral = $neutral + $month->sentiments->neutral * 100;
//            if (!empty($month->sentiments->positive))
//                $positive = $positive + $month->sentiments->positive * 100;
//        }
//        $satisfaction = round($positive / $count, 2);
//
//        $table .= '<tr class="tr"><td class="td__col td__prod"><div class="t_flbox">
//                <img src="' . $json->image . '"  alt="product">
//                <span>' . $json->name . '</span>
//            </div></td>
//         <td class="td__col">' . $json->category . '</td>
//        <td class="td__col">' . $totalReviews . '</td>
//        <td class="td__col">' . $satisfaction . '</td>
//        <td class="td__col td__last">
//            <div class="line_progress">
//                <div class="lp lp__red" style="width:' . $negative / $count . '%"></div>
//                <div class="lp lp__gray" style="width:' . $neutral / $count . '%"></div>
//                <div class="lp lp__green" style="width:' . $positive / $count . '%"></div>
//            </div>
//        </td>
//    </tr>';
//    }
//    $table .= '</tbody></table>';
//  //  update_field('product_competing_table', $table, $id);
//  //  update_field('product_competitive_products', $competitive, $id);
//
//
//
//
//}



//NEW FUNCTION FOR UPDATE BY API

function apiupdate($id)
{

    $uid = get_field('product_uuid',$id);
    update_field('date_update', date('Y-m-d H:i:s'), $id);

    $response = get_product_data($uid);
    $json = json_decode($response);
    $monthly_reviews = get_monthly_reviews($uid);
    $jsonsant=json_decode($monthly_reviews);
//    $total_revs = 0;
//    foreach ($jsonsant as $month) {
//        $total_revs += $month->volume;
//    }

    if($json) {
//        $rank = json_encode($json->ranking);
        $rank = json_encode($json->rank);

        update_field('product_image', $json->image, $id);
        update_field('product_brand_name', $json->brand_name, $id);
        update_field('product_brand_logo', $json->brand_logo, $id);
        update_field('product_industry', $json->industry_name, $id);
        update_field('rank', $json->rank, $id);
        update_field('rank_trend', $json->rank_trend, $id);

//        $termpost = array();
//        $term = get_term_by('name', esc_sql($json->category), 'product_category');
//
//        if (empty($term->term_id)) {
//            $insert_data = wp_insert_term(esc_sql($json->category), 'product_category', array(
//                'parent' => 0,
//            ));
//            $term_id = $insert_data['term_id'];
//        } else {
//            $term_id = $term->term_id;
//        }
//        $termpost[] = $term_id;
//        wp_set_object_terms($id, $termpost, 'product_category');
//        $termpost = array();

        $termpost=array();
        $term_long = get_term_by('name', esc_sql($json->category), 'product_category');
        $arr_of_chars = str_split(esc_sql($json->category));
        if ($term_long && in_array('|', $arr_of_chars)) {
            wp_delete_term($term_long->term_id, 'product_category');
        }
        $arr_names = explode("|", $json->category);
        array_unshift($arr_names, $json->industry_name);
        foreach ($arr_names as $num => $name_category) {
            $term = get_term_by('name', $name_category, 'product_category');
            if (empty($term->term_id)) {
                $termparent = get_term_by('name', $arr_names[$num-1], 'product_category');
                $arrgs=array(
                    'parent' => $termparent->term_id,
                );
                $insert_data = wp_insert_term(($name_category), 'product_category', $arrgs);
                $term_id = $insert_data['term_id'];
            } else {
                $term_id = $term->term_id;
                if ((!isset($term->parent) || $term->parent === 0) && $num > 0 ) {
                    wp_update_term($term_id, 'product_category', [
                        'parent' => $termpost[$num - 1],
                    ]);
                }
            }
            $termpost[] = $term_id;
        }
        update_field('product_category', end($arr_names), $id);
        wp_set_object_terms($id, $termpost, 'product_category');
        $termpost = array();



//        $term = get_term_by('name', $json->industry_name, 'product_industry');
//        if (empty($term->term_id)) {
//            $insert_data = wp_insert_term($json->industry_name, 'product_industry', array(
//                'parent' => 0,
//            ));
//            $term_id = $insert_data['term_id'];
//        } else {
//            $term_id = $term->term_id;
//        }
//        $termpost[] = $term_id;
//        wp_set_object_terms($id, $termpost, 'product_industry');
//        $termpost = array();


        $term = get_term_by('name', $json->brand_name, 'brands');
        if (empty($term->term_id)) {
            $insert_data = wp_insert_term($json->brand_name, 'brands', array(
                'parent' => 0,
            ));
            $term_id = $insert_data['term_id'];
        } else {
            $term_id = $term->term_id;
        }
        $termpost[] = $term_id;
        wp_set_object_terms($id, $termpost, 'brands');

        update_field('product_ranking', $rank, $id);
        echo $uid.' update!';
        echo '</br>';
    }


    if(!$json->name){
        wp_delete_post($id);
        /// //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        return;
    }
//    if ($total_revs < 40) {
//        wp_update_post(
//            array (
//                'ID'        => $id,
//                'post_status' => 'draft'
//            )
//        );
//        return;
//    }



    //Market Rank
    $monthly_rank = get_monthly_rank($uid);
    update_field('product_monthly_rank', $monthly_rank, $id);


    $category_top_10_products_data = category_top_10_products_data($uid);
    update_field('category_top_10_products_data', $category_top_10_products_data, $id);


//    $category_top_10_brands = category_top_10_brands($uid);
//    update_field('category_top_10_brands', $category_top_10_brands, $id);


    $topicsadvdisadv = get_topicsAdvDisadv($uid);

    update_field('topicsadvdisadv', $topicsadvdisadv, $id);


    $date1=date("m/Y", mktime(0, 0, 0, date('m')-0, date('d') , date('Y')));
    $date2=date("m/Y", mktime(0, 0, 0, date('m')-6, date('d') , date('Y')));
    $mostdiscussedtopics = get_most_discussed_topics_of_product('779152d0-c3cf-11e9-b164-c3925ec7a797',$date1,$date2,$uid);
    update_field('re-purchase', $mostdiscussedtopics, $id);


    $date1=date("m/Y", mktime(0, 0, 0, date('m')-0, date('d') , date('Y')));
    $date2=date("m/Y", mktime(0, 0, 0, date('m')-6, date('d') , date('Y')));
    $mostdiscussedtopics = get_most_discussed_topics_of_product('77e05d32-c3cf-11e9-b164-c3925ec7a797',$date1,$date2,$uid);
    update_field('recommenders', $mostdiscussedtopics, $id);






    $all_topics_data = all_topics_data($uid);
    update_field('all_topics_data', $all_topics_data, $id);



//    $product_monthly_star_rating = product_monthly_star_rating($uid);
//    update_field('product_monthly_star_rating', $product_monthly_star_rating, $id);

//    $star_rating_drivers = star_rating_drivers($uid);
//    update_field('star_rating_drivers', $star_rating_drivers, $id);


//    $monthly_number_of_verified_buyers = monthly_number_of_verified_buyers($uid);
//    update_field('monthly_number_of_verified_buyers', $monthly_number_of_verified_buyers, $id);



    //Customer Satisfaction
    $monthly_reviews = get_monthly_reviews($uid);
    update_field('product_monthly_reviews', $monthly_reviews, $id);
    $jsonsant=json_decode($monthly_reviews);
    $satisfactionSum=0;
    $count=0;
    foreach($jsonsant as $val){
        if($val->sentiments->positive){
            $count++;
            $satisfactionSum=$satisfactionSum+$val->sentiments->positive* 100;
        }
    }
    $avarageSatisfaction=$satisfactionSum/$count;
    update_field('sentiment', $avarageSatisfaction, $id);


    //Verified buyers
    $verified_buyers = get_monthly_verified_buyers($uid);
    // update_field('product_monthly_verified_buyers', $verified_buyers, $id);

    //User Rating
    $star_rating = get_star_rating($uid);
    update_field('product_star_rating', $star_rating, $id);


    $product_star_rating = json_decode($star_rating);
    $avarageSum = 0;
    $averageCount = 0;
    foreach($product_star_rating as $rating){
        if($rating->average > 0){
            $avarageSum += $rating->average;
            $averageCount++;
        }
    }
    $average = $avarageSum/$averageCount;
    update_field('star_rating', $average, $id);


    //User Rating
    $monthly_sentiment = get_topic_monthly_sentiment($uid);
    update_field('product_topic_monthly_sentiment', $monthly_sentiment, $id);


//    print_R($monthly_reviews);
//    die('////');
    /// product Info

    $post_data = array(
        'ID' => $id,
        'post_title' => $json->name
    );
    wp_update_post($post_data);
//    echo 'Product name: '.$json->name.', Product uid: '.$uid;
//    echo '</br>';

    //////Competing
    $competitive = get_competitive_products($uid);
    $json = json_decode($competitive);
    $count = 0;
    $competing = array();
    foreach ($json[0]->uuids as $value) {
        $count++;
        if ($count <= 10) {
            $competing[] = $value;
        }
    }
    $table = '<table class="block__table" border="1"><tbody data-id="competitiveProducts"><tr class="tr tr__head"><td class="td__col td__head td__prod">Product name</td><td class="td__col td__head">category</td><td class="td__col td__head">reviews</td><td class="td__col td__head">satisfaction</td> <td class="td__col td__head td__last">Sentiment distribuion</td></tr>';
    foreach ($competing as $value) {
        $response = get_product_data($value);
        $json = json_decode($response);

        $responsemonthly = get_monthly_reviews($value);
        $jsonmonthly = json_decode($responsemonthly);
        $totalReviews = 0;
        $negative = 0;
        $neutral = 0;
        $positive = 0;
        $satisfaction = 0;
        $count = count($jsonmonthly);
        foreach ($jsonmonthly as $month) {
            $totalReviews = $totalReviews + $month->volume;
            if (!empty($month->sentiments->negative))
                $negative = $negative + $month->sentiments->negative * 100;
            if (!empty($month->sentiments->neutral))
                $neutral = $neutral + $month->sentiments->neutral * 100;
            if (!empty($month->sentiments->positive))
                $positive = $positive + $month->sentiments->positive * 100;
        }
        $satisfaction = round($positive / $count, 2);

        $table .= '<tr class="tr"><td class="td__col td__prod"><div class="t_flbox">
                <img src="' . $json->image . '"  alt="product"> 
                <span>' . $json->name . '</span>
            </div></td>
         <td class="td__col">' . $json->category . '</td>
        <td class="td__col">' . $totalReviews . '</td>
        <td class="td__col">' . $satisfaction . '</td>
        <td class="td__col td__last">
            <div class="line_progress">
                <div class="lp lp__red" style="width:' . $negative / $count . '%"></div>
                <div class="lp lp__gray" style="width:' . $neutral / $count . '%"></div>
                <div class="lp lp__green" style="width:' . $positive / $count . '%"></div>
            </div>
        </td>
    </tr>';

    }
    $table .= '</tbody></table>';
    //  update_field('product_competing_table', $table, $id);
    //  update_field('product_competitive_products', $competitive, $id);




}




add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
    if(is_front_page()) {
        $classes[] = 'home';
    }
    return $classes;

}




add_action('wp_ajax_loadsearch', 'loadsearch');
add_action('wp_ajax_nopriv_loadsearch', 'loadsearch');
function loadsearch(){
    $posts = get_posts( array(
        'numberposts' => -1,
        's'    => $_POST['val'],
        'post_type'   => 'products',
    ) );
    if($posts){
    foreach( $posts as $post ){
        setup_postdata($post);
        ?>
        <li>
            <a href="<?php echo get_permalink($post); ?>">
                <span class="item-image">
                    <img src="<?php echo get_field('product_image',$post); ?>" alt="">
                </span>
                <span class="item-text"><?php echo get_the_title($post); ?></span>
            </a>
        </li>
        <?php
    }
    }else{
      ?>
        <li>
            <div>
                <span class="item-text">No search result!</span>
            </div>
        </li>
      <?php
    }

    wp_reset_postdata(); // сброс
    die();
}






if($_GET['api1']){
    function myscript() {
        ?>
        <script>
            jQuery( document ).ready(function() {
                jQuery('body').html('');
                var i=1;
                importproductsapi(i);

            });


            function importproductsapi(i){

                var data = {
                    'action': 'importproductsapi',
                    'page' : i,
                };
                jQuery.ajax({
                    url:'<?php echo site_url() ?>/wp-admin/admin-ajax.php',
                    data:data, // данные
                    type:'POST', // тип запроса
                    success:function(data){

                        if( data ) {
                            jQuery('body').append('<span>'+data+'</span></br>');
                        }
                        i++;
                        // if(i<=102){
                        //     importproductsapi(i);
                        // }
                    }
                });
            }
        </script>
        <?php
    }
    add_action('wp_head', 'myscript');
}
//add_action('wp_ajax_importproductsapi', 'importproductsapi');
//add_action('wp_ajax_nopriv_importproductsapi', 'importproductsapi');
//function importproductsapi(){
//    $categoryrequest=get_categoriesapi();
//    $json = json_decode($categoryrequest);
//
//    $productsrequest=get_products($_POST['page']);
//    $json = json_decode($productsrequest);
//    $products=$json->data;
////    print_R($products);
//    foreach($products as $value){
//        $c=$value->category;
//        if($c=='Personal size blenders' or $c=='Hand blenders' or $c=='Coffee grinders' or $c=='Coffee machines' or $c=='Cold brew' or $c=='Coffee Percolators' or $c=='Electric kettle' or $c=='French press' or $c=='Milk frother' or $c=='Single serve brewers'){
//            $args=array(
//                'posts_per_page' => -1,
//                'post_type' => 'products',
//                'meta_key' => 'product_uuid',
//                'meta_value' => $value->uuid
//            );
//            $post_id=0;
//            $posts = get_posts($args );
//            $post_id=$posts[0]->ID;
//            if (!$post_id) {
//                $post = array(
//                    'post_content' => '',
//                    'post_status' => "publish",
//                    'post_title' => $value->name,
//                    'post_parent' => '',
//                    'post_type' => "products",
//                );
//                $post_id = wp_insert_post($post);
//                echo $value->name . ' add!</br>';
//            } else {
//
//                echo $value->name . ' update!</br>';
//            }
//            update_post_meta($post_id, 'product_uuid', $value->uuid);
//            update_post_meta($post_id, 'product_category', $value->category);
//            update_post_meta($post_id, 'product_industry', $value->Electronics);
//
//
//            $termpost=array();
//            $term = get_term_by('name', $json->category, 'product_category');
//            if (empty($term->term_id)) {
//                $insert_data = wp_insert_term($json->category, 'product_category', array(
//                    'parent' => 0,
//                ));
//                $term_id = $insert_data['term_id'];
//            } else {
//                $term_id = $term->term_id;
//            }
//            $termpost[] = $term_id;
//            wp_set_object_terms($id, $termpost, 'product_category');
//            $termpost=array();
//            $term = get_term_by('name', $json->industry_name, 'product_industry');
//            if (empty($term->term_id)) {
//                $insert_data = wp_insert_term($json->industry_name, 'product_industry', array(
//                    'parent' => 0,
//                ));
//                $term_id = $insert_data['term_id'];
//            } else {
//                $term_id = $term->term_id;
//            }
//            $termpost[] = $term_id;
//            wp_set_object_terms($id, $termpost, 'product_industry');
//
//        }
//    }
//
//    die();
//}



function your_wpcf7_mail_sent_function($contact_form){
    $title = $contact_form->title;
	$submission = WPCF7_Submission::get_instance();
    $posted_data = $submission->get_posted_data();
	$id = $contact_form->id;




    if ( $submission ) {
    	$posted_data = $submission->get_posted_data();
		$pUrl        = $submission->get_meta('url');
	    $ipAddr      = $submission->get_meta('remote_ip');
		$hubspotutk  = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
		$ip_addr     = $_SERVER['REMOTE_ADDR']; //IP address too.

		$hs_context = array(
			'hutk'      => $hubspotutk,
			'ipAddress' => $ip_addr,
			'pageUrl'   =>   $pUrl,
			'pageName'  => 'Example Title'
		);
		$hs_context_json = json_encode($hs_context);
    }




    	$firstName = $posted_data['your-name'];
    	$email = $posted_data['your-email'];
		$lastname = $posted_data['your-lastname'];
	    $message = $posted_data['your-message'];
	    $company = $posted_data['your-company'];

	    $str_post = "firstname=" . urlencode($firstName)
					. "&email=" . urlencode($email)
					. "&lastname=" . urlencode($lastname)
			        . "&message=" . urlencode($message)
			        . "&company=" . urlencode($company)
					. "&hs_context=" . urlencode($hs_context_json); //Leave this one be

		$endpoint = 'https://forms.hubspot.com/uploads/form/v2/5244251/4661a89b-7422-4d18-bb2b-a53ea14b8ade';

	   	$ch = @curl_init();
		@curl_setopt($ch, CURLOPT_POST, true);
		@curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
		@curl_setopt($ch, CURLOPT_URL, $endpoint);
		@curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/x-www-form-urlencoded'
		));
		@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response    = @curl_exec($ch); //Log the response from HubSpot as needed.
		$status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
		@curl_close($ch);



}
add_action('wpcf7_mail_sent', 'your_wpcf7_mail_sent_function');



function get_name_category($cat){
    $cat=explode('|',$cat);
    $cat=end($cat);
    $namecat=ucwords($cat);
    return $namecat;
}
require_once 'inc/helper.php';




























