
    <!-- Page Heading -->
    <h1>Page Heading</h1>

    <!-- Notification Message -->
    <?php settings_errors(); ?>

    <!-- Form field and Output -->
    <form class="classname" action="options.php" method="post">
        <!-- Register 01 group (function-admin.php)-->
        <?php settings_fields('setting_general_group'); ?>
        <!-- PARENT 1/2 (function-admin.php) -->
        <?php do_settings_sections('setting_parent_slug') ?>
        <!-- Submit button -->
        <?php submit_button( 'Save Changes', 'primary', 'submit_btn' ); ?>
    </form>
