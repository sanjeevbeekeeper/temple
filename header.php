<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <title><?php bloginfo('name'); wp_title(); ?></title>
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11"> <!-- html5 profile -->
        <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>

    <!-- Container fluid -->
    <div class="container-fluid">

        <!-- header -->
        <header>
            <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
            <?php bloginfo('description'); ?>
        </header>

        <nav class="navbar navbar-default">
            <?php wp_nav_menu(array(
                'theme_location'    => 'primary',
                'container'         => false,
                'menu_class'        => 'nav navbar-nav'
            )); ?>
        </nav>
