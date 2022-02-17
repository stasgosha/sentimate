<?php
/**
 * Template Name: Test categories
 */
get_header();
$terms = get_terms( [
    'taxonomy' => 'product_category',
    'hide_empty' => true,
    'parent' => 0,
] ); ?>
<main class="page-content">
    <div class="container">
        <ol style="list-style: decimal">
            <?php
            function true_filter_by_date($where = '') {
                $from = '2022-02-10'; // промежуток времени
                $to = '2022-02-11';
                $where .= " AND post_date >= '$from' AND post_date <= '$to'";
                return $where;
            }
            add_filter('posts_where', 'true_filter_by_date'); // включаем фильтр

            $params = array(
                'post_type' => 'products',
                'posts_per_page' => -1 // можно добавить и других параметров для WP_Query
            );
            $q = new WP_Query($params);
            while($q->have_posts()) {
                $q->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_permalink() . '</a></li>';
            }
            wp_reset_postdata();

            remove_filter('posts_where', 'true_filter_by_date'); // отключаем фильтр под конец
            ?>
        </ol>
    </div>





    <?php if ($terms) : ?>
    <div class="container">
        <ol style="list-style: decimal">
            <?php foreach ($terms as $term) : ?>
                <li>
                    <a href="<?= get_term_link($term->term_id); ?>" style="font-weight: bold">
                        <?= $term->name.'('.$term->count.')'; ?>
                    </a>
                    <?php if ($cats_temporary_ids = get_term_children($term->term_id, 'product_category')) : ?>
                        <ul>
                            <?php foreach ($cats_temporary_ids as $child_id) : $child = get_term_by('id', $child_id,'product_category');?>
                                <li>
                                    <a href="<?= get_term_link($child); ?>">
                                        <?= $child->name.'('.$child->count.')'; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
<?php endif;
get_terms();?>

<!--    <section class="subsection-inner">-->
<!--        --><?php //$products = get_posts([
//            'numberposts' => -1,
//            'post_type' => 'products',
//        ]); foreach ($products as $product) : ?>
<!--            <div class="card-content">-->
<!--                --><?//= $product->post_title; ?>
<!--            </div>-->
<!--        --><?php //endforeach;
//        ?>
<!--    </section>-->



</main>

<!--<script>-->
<!--    hbspt.forms.create({-->
<!--        region: "na1",-->
<!--        portalId: "5244251",-->
<!--        formId: "febc8be7-2a2f-498e-a729-b91db308a19c"-->
<!--    });-->
<!--</script>-->
<?php get_footer(); ?>
