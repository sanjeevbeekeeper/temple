<?php

/* =================================================
    ADMIN PAGE
==================================================== */

    // ===== ADD PAGE
    function temple_adminpage() {

        // PARENT 1/2 ///////////////////////
        add_menu_page('Temple Theme options', 'Temple', 'manage_options', 'temple_parent_slug', 'temple_parent_page_function', 'dashicons-chart-area', 110);
        // PARENT 2/2: /////////////////////// REPETITION
        add_submenu_page('temple_parent_slug', 'Temple Theme options', 'General', 'manage_options', 'temple_parent_slug', 'temple_parent_page_function');
        // Theme Support Page
        add_submenu_page('temple_parent_slug', 'Temple Theme Support Options', 'Temple Options', 'manage_options', 'temple_themesupport_slug', 'temple_themesupport_page_function');
        // Contact form
        add_submenu_page('temple_parent_slug', 'Temple Contact form', 'Contact Form', 'manage_options', 'temple_contactform_slug', 'temple_contactform_page_function');
        // Custom CSS page
        add_submenu_page('temple_parent_slug', 'Temple CSS Options', 'Custom CSS', 'manage_options', 'temple_customcss_slug', 'temple_customcss_page_function');

        // Activate Custom Settings
        add_action( 'admin_init', 'temple_custom_settings' );

        }

    add_action( 'admin_menu', 'temple_adminpage' );


    // ------------------------- //


    // IMPORT 01: temple admin
    function temple_parent_page_function() {
        require_once(get_template_directory() . '/inc/page-templates/temple-admin.php');
        }

    // IMPORT 02: theme-support
    function temple_themesupport_page_function() {
        require_once(get_template_directory() . '/inc/page-templates/temple-theme-support.php');
        }

    // IMPORT 03: Contact form
    function temple_contactform_page_function() {
        require_once(get_template_directory() . '/inc/page-templates/temple-contactform.php');
        }

    // IMPORT 04: Custom CSS
    function temple_customcss_page_function() {
        require_once(get_template_directory() . '/inc/page-templates/temple-customcss.php');
        }


    // ------------------------- //


    function temple_custom_settings() {

        // Section 01: This Section to store all the specific fields that are displayed below
        add_settings_section('temple_general_section', 'Temple Sidebar Options', 'temple_general_section_function', 'temple_parent_slug');

            register_setting('temple_general_group', 'first_name'); // register 01/1: Full Name
            register_setting('temple_general_group', 'last_name'); // register 01/1a: Last name
            register_setting('temple_general_group', 'user_description'); // register 01/2: Description
            register_setting('temple_general_group', 'profile_picture'); // register 01/3: Profile picture
            register_setting('temple_general_group', 'twitter_handler', 'twitter_handler_sanitize'); // register 01/4: Twitter
            register_setting('temple_general_group', 'facebook_handler'); // register 01/5: Facebook

            add_settings_field('temple_fullname_id', 'Full Name', 'temple_fullname_field_function', 'temple_parent_slug', 'temple_general_section');
            add_settings_field('temple_description_id', 'Description', 'temple_description_field_function', 'temple_parent_slug', 'temple_general_section');
            add_settings_field('temple_profilepicture_id', 'Profile Picture', 'temple_profilepicture_field_function', 'temple_parent_slug', 'temple_general_section');
            add_settings_field('temple_twitter_id', 'Twitter', 'temple_twitter_field_function', 'temple_parent_slug', 'temple_general_section');
            add_settings_field('temple_facebook_id', 'Facebook', 'temple_facebook_field_function', 'temple_parent_slug', 'temple_general_section');

        // ----- //

        // Section 02: THEME SUPPORT OPTIONS
        add_settings_section('temple_themesupport_section_id', 'Theme Options', 'temple_themesupport_section_function', 'temple_themesupport_slug');

            register_setting('temple_themesupport_group', 'post_formats'); // register 02/1: Post format
            register_setting('temple_themesupport_group', 'custom_header'); // register 02/2: Custom header
            register_setting('temple_themesupport_group', 'custom_background'); // register 02/3: Custom background

            add_settings_field('temple_themesupport_field_id', 'Post Formats', 'temple_postformat_field_function', 'temple_themesupport_slug', 'temple_themesupport_section_id');
            add_settings_field('temple_customheader_field_id', 'Custom Header', 'temple_customheader_field_function', 'temple_themesupport_slug', 'temple_themesupport_section_id');
            add_settings_field('temple_custombackground_field_id', 'Custom Background', 'temple_custombackground_field_function', 'temple_themesupport_slug', 'temple_themesupport_section_id');

        // ----- //

        // Section 03: CONTACT FORM
        add_settings_section('temple_contactform_section_id', 'Contact Form', 'temple_contactform_section_function', 'temple_contactform_slug');
            register_setting('temple_contactform_group', 'contact_form'); // register 03/1
            add_settings_field('activate_form', 'Activate Contact Form', 'temple_contactform_field_function', 'temple_contactform_slug', 'temple_contactform_section_id');

        // ----- //

        // Section 04: CUSTOM CSS
        add_settings_section('temple_customcss_section_id', 'Custom CSS', 'temple_customcss_section_function', 'temple_customcss_slug');
            register_setting('temple_customcss_group', 'custom_css'); // register 04/1
            add_settings_field('temple_customcss_field_id', 'Temple Custom CSS', 'temple_customcss_field_function', 'temple_customcss_slug', 'temple_customcss_section_id');

        }

    // ------------------------- //

    // Custom CSS
    // subtitle
    function temple_customcss_section_function() {
        echo 'Add your Custom theme here';
        }

    // Custom css
    function temple_customcss_field_function(){
        $css = get_option('custom_css');
        $css = ( empty ($css) ? '/* Theme comment */' : $css );
        echo '<div id="customCSS"> ' .$css.' </div>';
        }


    // GENERAL
    function temple_general_section_function() {
        echo 'Customize your Sidebar Information';
        }

    // Fullname - first-name and last-name
    function temple_fullname_field_function() {
        $firstName = esc_attr( get_option('first_name') );
        $lastName = esc_attr( get_option('last_name') );
        echo
            '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name"/>
             <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name"/>';
        }

    // Description
    function temple_description_field_function() {
        $description = esc_attr( get_option('user_description') );
        echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description"/>';
        }

    // Profile picture
    function temple_profilepicture_field_function(){
        $picture = esc_attr( get_option('profile_picture') );
        if ( empty($picture)) {
            echo
            '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button">
            <input type="hidden" id="hidden_profile_picture" name="profile_picture" value="" />';
            }
        else {
            // $id: upload-button will be used in the temple.admin.js
            echo
            '<input type="button" class="button button-secondary" value="Replace New Image" id="upload-button">
            <input type="hidden" id="hidden_profile_picture" name="profile_picture" value="'.$picture.'" />
            <input type="button" class="button button-secondary" value="Remove Current image" id="remove_picture">';
            }
        }

    // Twitter
    function temple_twitter_field_function() {
        $twitter = esc_attr( get_option('twitter_handler') );
        echo
            '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter handler"/>
            <p class="description"> Input the user name without the @ character</p>';
        }
    // Sanitization settings for twitter
    function twitter_handler_sanitize( $input ){
        // this will strip out any HTML user inputs in the twitter input field
        $output = sanitize_text_field ( $input );
        // search for the '@' and replace with empty value ''
        $output = str_replace ('@', '', $output);
        return $output;
        }

    // Facebook
    function temple_facebook_field_function() {
        $facebook = esc_attr( get_option('facebook_handler') );
        echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook handler"/>';
        }


    // ----- //


    // THEME SUPPORT
    // subtitle
    function temple_themesupport_section_function() {
        echo 'Activate and Deactivate Theme Support Options';
        }

    // Post format function
    function temple_postformat_field_function(){
        $options = get_option('post_formats');
        $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
            $output = '';
            foreach ( $formats as $format ) {
                $checked = ( @$options[$format] == 1 ? 'checked' : '' );
                $output .= '<label>
                                <input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' />
                                    '.$format.'
                            </label>
                            <br />';
                }
            echo $output;
            }

    // Custom Header
    function temple_customheader_field_function(){
        $options = get_option('custom_header');
        $checked = ( @$options == 1 ? 'checked' : '' );
            echo'<label>
                    <input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' />
                    Activate Custom Header
                </label>';
            }

    // Custom Background
    function temple_custombackground_field_function(){
        $options = get_option('custom_background');
        $checked = ( @$options == 1 ? 'checked' : '' );
            echo'<label>
                    <input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' />
                    Activate Custom Background
                </label>';
            }


    // ----- //

    // CONTACT Form
    // subtitle
    function temple_contactform_section_function() {
        echo 'Activate and Deactivate Contact Form';
        }

    // Contact form
    function temple_contactform_field_function(){
        $options = get_option('contact_form');
        $checked = ( @$options == 1 ? 'checked' : '' );
            echo'<label>
                    <input type="checkbox" id="contact_form" name="contact_form" value="1" '.$checked.' />
                </label>';
            }
