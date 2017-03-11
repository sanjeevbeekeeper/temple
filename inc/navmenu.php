<?php
/* =================================================
    Register Default Navmenu
==================================================== */
function temple_register_navmenu(){
    register_nav_menu('primary', 'Primary Menu');
    }
add_action('after_setup_theme', 'temple_register_navmenu');
