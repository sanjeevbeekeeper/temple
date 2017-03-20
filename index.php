<?php get_header(); ?>
<!-- header -->

    <?php
        $address_01 = get_post_meta($post->ID, 'address01', true);
        $address_02 = get_post_meta($post->ID, 'address02', true);
     ?>
    <p>
        <?php echo $address_01; ?>
        <?php echo $address_02; ?>
    </p>





<!-- Loop start -->
<?php
    if ( have_posts() ) :
    while ( have_posts() ) : the_post();
    ?>

<?php
        get_template_part('temple-parts/content', get_post_format());

    // Loop end
    endwhile;
    else:
        _e('There is no pages matches your criteria.');
    endif;
    ?>

<!-- footer -->
<?php get_footer(); ?>
