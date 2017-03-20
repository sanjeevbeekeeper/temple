<?php
// Add Metabox details
function my_custom_meta_box(){
    add_meta_box(
        'meta_box_id',
        __('Address', 'textdomain'),
        'metabox_callback_function',
        'post',
        'normal'
        );
    }
add_action('add_meta_boxes', 'my_custom_meta_box');

// Using Metabox function
function metabox_callback_function($post){

    // Address 01
    $address_01 = get_post_meta($post->ID, 'address01', true);
    // Address 02
    $address_02 = get_post_meta($post->ID, 'address02', true);

    // nonce field
    wp_nonce_field('meta_noncefield_action', 'meta_noncefield_name');

    ?>
        <!-- Field 01 - HTML -->
        <p>
            <label for="address01">Address 01</label>
            <input type="text" name="address01" id="address01" value="<?php echo $address_01; ?>">
        </p>

        <!-- Field 02 - HTML -->
        <p>
            <label for="address02">Address 02</label>
            <input type="text" name="address02" id="address02" value="<?php echo $address_02; ?>">
        </p>

        <!-- Field 02 - HTML -->
        <!-- <p>
            <label for="product_description">Product Description</label>
            <textarea class="widefat" name="product_description" id="product_description" rows="8" cols="80"><?php // echo $product_description; ?></textarea>
        </p> -->
<?php
    } ?>

<!-- Saving the content -->
<?php

    function save_our_custom_data($post_id){

        if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
            return;

        // nonce field - action and name
        if(! isset( $_POST['meta_noncefield_name']) || !wp_verify_nonce($_POST['meta_noncefield_name'], 'meta_noncefield_action'))
            return;

        // Field 01 - security
        if(isset($_POST['address01']) && ($_POST['address01'])) {
            update_post_meta($post_id, 'address01', esc_html($_POST['address01']));
            }

        // Field 02 - security
        if(isset($_POST['address02']) && ($_POST['address02'])) {
            update_post_meta($post_id, 'address02', esc_html($_POST['address02']));
            }

        // Field 02 - security
        // if(isset($_POST['product_description']) && ($_POST['product_description'])) {
        //     update_post_meta($post_id, 'product_description', esc_html($_POST['product_description']));
        //     }

        }
    add_action('save_post', 'save_our_custom_data');
 ?>
