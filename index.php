<?php get_header(); ?>
<!-- header -->

<!-- Loop start -->
<?php
    if ( have_posts() ) :
    while ( have_posts() ) : the_post();


        get_template_part('template-parts/content', get_post_format());

    // Loop end
    endwhile;
    else:
        _e('There is no pages matches your criteria.');
    endif;
    ?>

<!-- footer -->
<?php get_footer(); ?>
