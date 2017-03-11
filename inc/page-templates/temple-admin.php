<h1>Sidebar Settings</h1>

<!-- Notification Message -->
<?php settings_errors(); ?>

<!--options.php is used on action="", is the same page where WordPress saves all the settings.-->
<form class="temple_form_container" action="options.php" method="post">
    <!-- Calling the Option group from the function-admin.php page -->
    <?php settings_fields('temple_general_group'); ?>
    <!-- parent_slug that has been added inside the temple_custom_settings function from the function-admin.php page -->
    <?php do_settings_sections('temple_parent_slug') ?>
    <!-- SUBMIT Button-->
    <?php submit_button( 'Save Changes', 'primary', 'submit_btn' ); ?>
</form>

<!-- calling the functions from the 'temple_sidebar_name' in the function-admin.php page -->
<?php
    // firstname and lastname
    $firstName = esc_attr( get_option('first_name') );
    $lastName = esc_attr( get_option('last_name') );
    // Store $firstName and $lastName in a variable.
    $full_Name = $firstName . ' ' . $lastName;

    // We can use the $description variable as it is.
    $description = esc_attr( get_option('user_description') );

    // profile picture
    $picture = esc_attr( get_option('profile_picture') );
 ?>

    <div class="temple_container_right">
        <!-- FULL NAME (using the variable above) -->
        <h1 class="temple_username">
            <?php print $full_Name; ?>
        </h1>
        <!-- DESCRIPTION (using the variable above) -->
        <h2 class="temple_description">
            <?php print $description ?>
        </h2>
        <!-- PROFLIE PICTURE -->
        <div id="dynamic_profile_picture" class="temple_profile_image">
            <img src="<?php print $picture ?>" alt="">
        </div>
    </div> <!-- temple_container_right -->

    <!-- helper text -->
    <p class="description">These details are came from the left column</p>
