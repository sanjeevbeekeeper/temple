<?php

    // contact form
    $contact = get_option('contact_form');
    if (@$contact == 1) {

        // 1st function hook
        add_action('init', 'temple_custom_post_type' );

        // 2nd function
        // filter format: 'manage_<yourcustomposttype>_posts_columns'
        add_filter('manage_temple_contact_posts_columns', 'temple_contactform_filter_function');

        // 3rd function
        // filter format: 'manage_<yourcustomposttype>_posts_custom_column'
        add_action('manage_temple_contact_posts_custom_column', 'temple_contactform_action_function', 10, 2);
        // 10: prioriety of loading the action.
        // 2: two arguments, see 3rd function below

        add_action('add_meta_boxes', 'temple_contactform_metabox' );

        // action for security
        add_action( 'save_post', 'temple_email_nonce_action');
        }

    // 1st functions
    function temple_custom_post_type(){
        $labels = array(
            'name'              => 'Messages',  // page title
            'singular_name'     => 'Message',
            'menu_name'         => 'Messages', // sidebar name
            'name_admin_bar'    => 'Message'
            );
        $args = array(
            'labels'            => $labels, // this variable is from above
            'show_ui'           => true,
            'show_in_menu'      => true,
            'capability_type'   => 'post',
            'hierarchical'      => false,
            'menu_position'     => 26,  // sidebar position
            'menu_icon'         => 'dashicons-id', // sidebar icon
            'supports'          => array( 'title', 'editor', 'author' ) // table new columns
            );

        // hook
        register_post_type( 'temple_contact', $args );
        }

    // 2nd function (new columns for table)
    function temple_contactform_filter_function( $columns ){
        $newColumns = array();
        $newColumns['title']    = 'Full name';
        $newColumns['message']  = 'Message';
        $newColumns['email']    = 'Email';
        $newColumns['date']     = 'Date';
        return $newColumns;
        }

    // 3rd function ('list of columns' and 'post id')
    function temple_contactform_action_function( $column, $post_id ){
        switch($column){
            // show the message
            case 'message' :
            echo get_the_excerpt();
            break;

            // show the email
            case 'email' :
            $email = get_post_meta( $post_id, '_temple_contactform_email_valuekey', true );
            echo '<a href="mailto: '. $email .' "> ' .$email. '</a>';
            break;
            }
        }

    // Contact meta box
    function temple_contactform_metabox(){
        add_meta_box('temple_contactform_metabox_id', 'User Email', 'temple_contactform_metabox_function', 'temple_contact', 'side', 'default');
        // Position of the metabox
        // normal: below the mail Content
        // side: the metabox will be on the side.
        // high: on top of the sidebar.
        // defalut: end of the sidebar.
        }

        // callback from above
        function temple_contactform_metabox_function( $post ){
            wp_nonce_field(temple_email_nonce_action, 'temple_email_nonce_name');

            $value = get_post_meta( $post->ID, '_temple_contactform_email_valuekey', true );
            // echo the label and input
            echo '<label for="temple_contactform_email_id"> User Email Address: </label>';
            echo '<input type="email" id="temple_contactform_email_id" name="temple_contactform_email_id" Placeholder="Enter your Email" value=" '. esc_attr( $value ) .' " size="25" />';
            }

            // SECURITY
            function temple_email_nonce_action ( $post_id ){
                // if the 'nonce' is not set
                if(! isset( $_POST['temple_email_nonce_name'] )) {
                    // stop
                    return;
                    }
                // verify the nonce
                if( ! wp_verify_nonce( $_POST['temple_email_nonce_name'], 'temple_email_nonce_action') ){
                    // stop
                    return;
                    }
                // if WordPress is doing the autosave, stop the execution
                if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
                    // stop
                    return;
                    }
                // if the user is cannot edit the post
                if( ! current_user_can('edit_post', $post_id ) ){
                    // stop
                    return;
                    }
                // if the 'input' id field is NOT set, stop
                if( ! isset( $_POST['temple_contactform_email_id'])){
                    // stop
                    return;
                    }
                // Print
                $my_data = sanitize_text_field( $_POST['temple_contactform_email_id'] );
                // update the function
                update_post_meta( $post_id, '_temple_contactform_email_valuekey', $my_data);
                }
