<?php

/* =================================================
    ADMIN PAGE
==================================================== */

    // ===== Initial setup
    function temple_adminpage() {
        // PARENT 1/2 - Main page
        add_menu_page(/*title*/'Temple Theme options', /*menu_title*/'Temple', /*capability*/'manage_options', /*menu_slug*/'temple_theme', /*callback function*/'temple_parentpage', /*dashboard_icon*/'dashicons-chart-area', /*position*/110);

        // PARENT 2/2 + CHILD (sub-page)
        add_submenu_page(/*parent_slug*/'temple_theme', /*page_title*/'Temple Theme options', /*menu_title*/'General', /*capability*/'manage_options', /*menu_slug*/ 'temple_theme', /*callback function*/'temple_parentpage');

        // CHILD sub-page
        add_submenu_page(/*parent_slug*/'temple_theme', /*page_title*/'Temple CSS Options', /*menu_title*/'Custom CSS', /*capability*/'manage_options', /*menu_slug*/'temple_theme_css', /*callback function*/'temple_childpage');

        // Activate Custom Settings
        add_action( 'admin_init', /*callback function (see below)*/'temple_custom_settings' );
        }
    add_action( 'admin_menu', 'temple_adminpage' );

    // ===== //

    // Register settings will give us the access the store custom datas in the WordPress database
    function temple_custom_settings() {

        //
        register_setting(/*option_group*/'temple-settings-group', /*option_name*/'first_name' /*callback sanitize_callback (not required for now)*/);
        //

        add_settings_section(/*id*/'temple-sidebar-options', /*title*/'Temple Sidebar Options', /*callback*/'temple_sidebar_options', /*page (parent_slug from the temple_adminpage)*/'temple_theme');

        // This will generate custom fields and store in the database
        add_settings_field(/*id*/'temple-name', /*title*/'First Name', /*callback*/'temple_sidebar_name', /*page (parent slug inside the  'add_settings_section')*/'temple_theme', /*section (section id from above 'add_settings_section')*/'temple-sidebar-options' /*array args (Note required for now)*/);
        }

    // callback function from the 'add_settings_section'
    function temple_sidebar_options() {
        echo 'Customize your sidebar Information';
        }

    // callback function from the 'add_settings_fields'
    function temple_sidebar_name() {
        // id is same the option_name inside the 'register_setting'
        $firstName = esc_attr( get_option(/*id*/first_name) );
        // name is same as the option_name inside the 'register_setting'
        echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name"/>';
        }

    // callback function from the 'temple_adminpage'
    function temple_parentpage() {
        // calling the admin inside the inc folder
        require_once(get_template_directory() . '/inc/templates/temple-admin.php');
        }

    function temple_childpage() {
        // empty
        }
