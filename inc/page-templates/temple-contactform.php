<h1>Contact Form</h1>
<!-- Notification Message -->
<?php settings_errors(); ?>

<!--options.php is used on action="", is the same page where WordPress saves all the settings.-->
<form action="options.php" method="post">
    <?php settings_fields('temple_contactform_group'); ?>
    <?php do_settings_sections('temple_contactform_slug'); ?>
    <?php submit_button(); ?>
</form>
