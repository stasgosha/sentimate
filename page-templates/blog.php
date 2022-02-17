<?php
/**
 * Template Name: Blog
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

    </main>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>