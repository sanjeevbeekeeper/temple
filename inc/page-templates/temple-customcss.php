<h1>Temple Custom CSS</h1>
<!-- Notification Message -->
<?php settings_errors(); ?>

<form action="options.php" method="post">
    <?php settings_fields('temple_customcss_group'); ?>
    <?php do_settings_sections('temple_customcss_slug'); ?>
    <?php submit_button(); ?>
</form>
