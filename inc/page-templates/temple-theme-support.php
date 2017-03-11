<h1>Temple Theme Support</h1>
<!-- Notification Message -->
<?php settings_errors(); ?>

<!--options.php is used on action="", is the same page where WordPress saves all the settings.-->
<form action="options.php" method="post">
    <?php settings_fields('temple_themesupport_group'); ?>
    <?php do_settings_sections('temple_themesupport_slug'); ?>
    <?php submit_button(); ?>
</form>
