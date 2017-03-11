<?php

// calling the external function-admin.php
require get_template_directory() . '/inc/cleanup.php'; // remove the wordpress version
require get_template_directory() . '/inc/walker.php'; // custom walker class for navmenu
require get_template_directory() . '/inc/featured-image.php'; // featured image
require get_template_directory() . '/inc/navmenu.php'; // navmenu
require get_template_directory() . '/inc/function-admin.php';
require get_template_directory() . '/inc/enqueue.php'; // enqueue, register, and deregister styles and scripts
require get_template_directory() . '/inc/theme-support.php';
require get_template_directory() . '/inc/post-type/custom-post-type.php';
