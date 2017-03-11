<?php
/* =================================================
    ADMIN ENQUEUE FUNCTIONS
==================================================== */

    function temple_load_admin_scripts( $templehook ){
        // if the hook variable is not equal to the 'toplevel_page_temple_theme' then stop the styles below.
        // 'toplevel_page_temple_theme' is a class from the <body> element (inspect the page).
        if ('toplevel_page_temple_parent_slug' == $templehook ){
            // styles
            wp_register_style('temple_style_css_id', get_template_directory_uri() . '/lib/styles/css/temple.admin.css', array(), '1.0.0', 'all');
            wp_enqueue_style('temple_style_css_id');
            // for Profile picture
            wp_enqueue_media();
            // script
            wp_register_script('temple_script_js_id', get_template_directory_uri() . '/lib/scripts/js/temple.admin.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script ('temple_script_js_id');
            }

        else if ('temple_page_temple_customcss_slug' == $templehook ){
            wp_enqueue_style('ace_css', get_template_directory_uri() . '/lib/styles/css/temple.ace.css', array(), '1.0.0', 'all');
            // 'ace' syntax highlighter
            wp_enqueue_script('ace-js', get_template_directory_uri(). '/lib/vendor/ace/ace.js', array('jquery'), '1.2.1', true);
            wp_enqueue_script('temple-customcss-script', get_template_directory_uri() . '/lib/vendor/temple.ace.js', array('jquery'), '1.0.0', true);
            }

        else {
            return;
            }
        }

    // this will enqueue only if it is admin
    add_action ('admin_enqueue_scripts', 'temple_load_admin_scripts');

    // ----- //

    /* =================================================
            BOOTSTRAP styels
    ==================================================== */
    function temple_load_script(){
        // Bootstrap css
        wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7', 'all');

        // Bootstrap css
        wp_enqueue_style('customcss', get_template_directory_uri() . '/lib/styles/css/temple.ace.css', array(), '1.0.0', 'all');

        // Deregister jquery
        wp_deregister_script('jquery');
        // Register jquery
        wp_register_script('jquery','https://code.jquery.com/jquery-3.1.1.min.js', false, '3.1.1', true );
        // Enqueue jquery
        wp_enqueue_script('jquery');

        // Bootstrap js
        wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), '3.3.7', true);
        }
    add_action ('wp_enqueue_scripts', 'temple_load_script');
