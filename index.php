<?php
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php endwhile; // end of the loop. ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>