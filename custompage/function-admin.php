<?php

/* =================================================
    ADMIN PAGE
==================================================== */

    // ===== ADD PAGE
    function setting_adminpage() {
        // PARENT 1/2
        add_menu_page('settings Theme options', 'Custom Page', 'manage_options', 'setting_parent_slug', 'setting_parent_page_function', 'dashicons-media-archive', 110);

        // PARENT 2/2:REPETITION
        // PAGE 01
        add_submenu_page('setting_parent_slug', 'settings Theme options', 'Page name 01', 'manage_options', 'setting_parent_slug', 'setting_parent_page_function');

        // PAGE 02
        add_submenu_page('setting_parent_slug', 'settings Theme Support Options', 'Page name 02', 'manage_options', 'setting_themesupport_slug', 'setting_themesupport_page_function');

        // Page action 01
        add_action( 'admin_init', 'setting_custom_settings' );
        }
    add_action( 'admin_menu', 'setting_adminpage' );
    // ===== ADD PAGE END

    // page 01 - function
    function setting_parent_page_function() {
        require_once(get_template_directory() . '/custompage/pagecontent/page01.php');
        }

    // page 02 - function
    function setting_themesupport_page_function() {
        //
        }


// ------------------------- //


    // Page action 01 - function
    function setting_custom_settings() {

        // Section 01
        add_settings_section('setting_general_section', 'Sub Heading', 'setting_general_section_function', 'setting_parent_slug');

            // Register 01
            register_setting('setting_general_group', 'email_id');

            // Settings field 01
            add_settings_field('setting_emailid_id', 'Email Id', 'setting_emailid_field_function', 'setting_parent_slug', 'setting_general_section');

        }

    // Section 01 - function
    function setting_general_section_function() {
        echo 'Some Description here';
        }

    // Settings field 01 - function
    function setting_emailid_field_function() {
        // Register 01 - group
        $emailidhere = esc_attr( get_option('email_id') );
        // HTML - Input field
        echo '<input type="email" name="email_id" value="'.$emailidhere.'" placeholder="Email id"/>
        <p class="description"> Enter your Email id here </p>';
        }

// ------------------------- //
