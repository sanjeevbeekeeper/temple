<?php

    // Post Format
    $options = get_option('post_formats');
    $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
    $output = '';
    foreach ( $formats as $format ) {
        $output[] = ( @$options[$format] == 1 ? $format : '' );
        }
    if( !empty( $options ) ) {
        add_theme_support('post-formats', $output );
        }

    // Custom header
    $header = get_option('custom_header');
    if (@$header == 1) {
        add_theme_support('custom-header', $output );
        }

    // Custom background
    $background = get_option('custom_background');
    if (@$background == 1) {
        add_theme_support('custom-background', $output );
        }

    // Post format
    function temple_posted_meta(){
        // posted on time difference
        $posted_on = human_time_diff( get_the_time('U'), current_time('timestamp') );
        // Category breakdown
        $categories = get_the_category();
        $separator = ', ';
        $output = '';

        if(!empty($categories)):
            foreach($categories as $category):
                $output = '<a href=" '. esc_url( get_the_category_link($category->term_id) ) .' " alt=" '. esc_attr('View all posts in %s', $category->name) .' "> '. esc_html($category->name) .' </a>';
            endforeach;
        endif;

        return
            '<span class="posted-on">Posted <a href="'.esc_url(get_permalink()).'">' . $posted_on . '</a> ago</span> /
            <span class="posted-in">'.the_category(', ').'</span>';
        }
