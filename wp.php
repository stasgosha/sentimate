// Директория темы
<? echo get_template_directory_uri(); ?>

//  Подключение файлов
<?php get_template_part( 'breadcrumbs', 'footer' ); ?>

// get_posts
<?php 
// параметры по умолчанию
$posts = get_posts( array(
	'numberposts' => 5,
	'category'    => 0,
	'orderby'     => 'date',
	'order'       => 'DESC',
	'include'     => array(),
	'exclude'     => array(),
	'meta_key'    => '',
	'meta_value'  =>'',
	'post_type'   => 'post',
		'tax_query' => array(
		array(
			'taxonomy' => 'country',
			'field'    => 'id',
			'terms'    => array( 62 )
		)
	),
) );

foreach( $posts as $post ){
	setup_postdata($post);
    // формат вывода the_title() ...
}

wp_reset_postdata(); // сброс
?>


// меню
<?php
$args = array(
    'theme_location'  => '',
    'menu'            => 'Menu',
    'container'       => '',
    'container_class' => '',
    'container_id'    => '',
    'menu_class'      => 'menu',
    'menu_id'         => '',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<ul  class="">%3$s</ul>',
    'depth'           => 0
);

wp_nav_menu(  $args  );
?>

// вывод телефонов
<?php
$phone1 = get_field('phone_number1', 'options');
$phone1_arr = array(" ", "(", ")");
?>
<a href="tel:<?php echo str_replace($phone1_arr, "", $phone1); ?>">
    <?php echo $phone1; ?>
</a>


// вывод картинки поста url
<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'smi', true);
$image_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
?>
<img src="<?php echo $thumb_url[0]; ?>" alt="<?php echo $image_alt; ?>">


// Переключатель языков
<?php $lounges = str_replace("en/", "", $_SERVER[REQUEST_URI]); ?>
<div class="rus <?php if(get_locale() == 'ru_RU') { echo'active'; }?>"><a href="/ru<?php echo $lounges ;?>"><РУС</a></div>
<div class="eng <?php if(get_locale() == 'en_US') { echo'active'; }?>"><a href="/en<?php echo $lounges ;?>">ENG</a></div>


// переводы
<?php _e( 'Показать еще', 'twentytwelve' );?>


// текущая страница в пагинации
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;?>


// обрезка текста
<?php
$f= strip_tags (get_the_content());
if(strlen ( $f )>270){
    echo mb_substr($f,0,270);
    echo"...";
}
else{
    echo mb_substr($f,0,270);
}
?>


// форма поиска
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
    <div class="search-text"><input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" /></div>
    <div class="search-button"><input type="submit"  id="searchsubmit" value=""></div>
</form>


// дата acf
<?php
$date = get_field('дата_окончания', false, false);
$date = new DateTime($date);
$date_post=$date->format('Y-m-d');
?>



// reapit acf
<?php if( have_rows('uslugi') ): ?>
    <?php
    $i=0;
    while( have_rows('uslugi') ): the_row(); ?>
    <?php endwhile; ?>
<?php endif; ?>

//  acf галерея
<?php $slider=get_field('слайдер');
if($slider){
    foreach ($slider as  $value){?>
        <div class="item" style="background-image: url(<?php print_R($value['sizes']['slider']);?> );"></div>
    <?php } } ?>


// reapit reapit reapit acf
<?php if( have_rows('контакти') ): ?>
    <?php while( has_sub_field('контакти') ): ?>
        <div class="item">
            <h4><?php echo get_sub_field('місто');?></h4>
            <div class="address"><?php echo get_sub_field('адреса');?></div>
            <?php if( get_sub_field('менеджера') ): ?>
                <?php while( has_sub_field('менеджера') ): ?>
                    <div class="item-contacts">
                        <div class="name-block"><?php the_sub_field('менеджер'); ?></div>
                        <?php if( get_sub_field('tags') ): ?>
                            <?php while( has_sub_field('tags') ): ?>

                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

// карта acf
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTojkNOgePZS3uIOWkD8viKhYQVfRwyjY"></script>
<?php
$location = get_field('location');
if( !empty($location) ):
    ?>
    <div class="acf-map">
        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
    </div>
<?php endif; ?>


// вывод связаных записей
<?php $special=get_field('каталог');?>
<?php if($special){?>
    <?php $i = 0;?>
    <?php foreach($special as $value){ ?>
        <a href='<?php the_permalink($value);?>'>
            <?php echo get_the_post_thumbnail($value, 'thumbnail'); ?>
        </a>
        <a href='<?php the_permalink($value);?>'> <?php echo get_the_title($value)?></a>
    <?php  } ?>
<?php  } ?>


//вывод подрубрик


//вывод тегов записи
<?php the_tags('<span>Теги:</span>', ' ', '<br />'); ?>


// пример запроса wp_query с meta
<?php
if($_POST['manufacturer']){
    $meta[relation]='OR';
    foreach ($_POST['manufacturer'] as $key => $value) {
        $meta[]= array(
            'key' => 'производитель',
            'value' => $value,
            'compare' => '=',
        );
    }

}

if($_POST['material']){
    $meta2[relation]='OR';
    foreach ($_POST['material'] as $key => $value) {
        $meta2[]= array(
            'key' => 'материал',
            'value' => $value,
            'compare' => '=',
        );
    }
}
$meta_m[relation]='AND';
$meta_m=array(
    $meta2,
    $meta
);
query_posts(array(
    'meta_query' => $meta_m,
    'post_type' => 'product',
    'posts_per_page' => '3',
    'paged'=>$paged
));
while ( have_posts() ) : the_post(); ?>

<?php   endwhile;  ?>




// показать еще
<?php
if($paged == 1 && $wp_query->max_num_pages > 1): ?>
    <script>
        var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
        var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
        var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
        var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
        var type = 'smi';
    </script>
    <div class="wrap-button-more">
        <div class="button-more more-item"><a id="true_loadmore" href=""><?php _e( 'Показать еще', 'twentytwelve' );?></a></div>
    </div>
<?php endif; ?>
<script>
    $('body').find('#true_loadmore').on('click',function(e){
        e.preventDefault();
        var data = {
            'action': 'loadmore',
            'query': true_posts,
            'page' : current_page,
        };
        var btn_hml_tmp = $(button).html();
        $(button).html('Загрука ...').attr('disabled', 'disabled');
        $('.pagination').fadeOut('slow', function () {
            $('.pagination').remove();
        });
        $.ajax({
            url:ajaxurl, // обработчик
            data:data, // данные
            type:'POST', // тип запроса
            success:function(data){
                if( data ) {
                    $(button).html(btn_hml_tmp).removeAttr('disabled');
                    $(button).html('Показать еще');
                    $(block).append(data)
                    // вставляем новые посты
                    current_page++;
                    $('#true_loadmore').attr('data-current_page',current_page);

                    // увеличиваем номер страницы на единицу
                    if (current_page == max_pages) $("#true_loadmore").remove(); // если последняя страница, удаляем кнопку
                } else {
                    $(button).fadeOut('slow', function () {
                        $(button).removeAttr('disabled').remove();
                    });
                    $('#true_loadmore').remove(); // если мы дошли до последней страницы постов, скроем кнопку
                }
                myEqual (block+' .equipment-block .text');

            }
        });
    });
</script>



