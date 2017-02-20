<h1>General</h1>

<!-- Notification Message -->
<?php settings_errors(); ?>

<!-- options.php is the same page where WordPress saves all the settings. See the Detaulf 'Settings' pages slug in the address bar-->
<form class="" action="options.php" method="post">
    <!-- Calling the Option group from the function-admin.php page -->
    <!-- TITLE -->
    <?php settings_fields('temple-settings-group'); ?>
    <!-- parent_slug that has been added inside the temple_custom_settings function from the function-admin.php page -->
    <!-- DESCRIPTION -->
    <?php do_settings_sections('temple_theme') ?>
    <!-- SUBMIT Button-->
    <?php submit_button(/*text*/ /*type*/ /*name*/ /*wrap*/ /*other_attributes*/ ); ?>
</form>
