<?php
/* =================================================
    WALKER CUSTOM CLASS: FINALLY!!
==================================================== */
/*
    ----- BASE CODE EXPLAINED -----
    // When you write this function - 1/2
        <?php wp_nav_menu(); ?>

    // wordpress creates this structure automatically - 2/2
    // The 'start' and 'end' functions for html elements are created by wordpress.
    // we can use these functions to customize to our need.
    <div class="menu-container">
        <ul>            // start_lvl() (function name) (parent)
            <li> <a>    // start_el() (function name) (child and subchild elements)
                Link    // html (your code)
            </a> </li>  // end_el() (function name)
        </ul>           // end_lvl() (function)
    </div>
*/

/*
    ----- NOTES 01 -----
    // 00:
        extents the Primary walker class.
        from 'Walker_Nav_menu' to 'Walker_Nav_Primary'.
    // 01:
        Three variables inside the 'start_lvl( &$output, $depth, $argument)' function
    // 02:
        this will repeat the argument.
        "\t" : is for the indent space
    // 03:
        if the depth is greater than 0, add the 'sub-menu' class.
    // 04:
        .= : concatenate with above.
*/

// see NOTES 01
class Walker_Nav_Primary extends Walker_Nav_menu { // 00
    // for '<ul>'
    function start_lvl(&$output, $depth) { // 01
        $indent = str_repeat("\t", $depth); // 02
        $submenu = ($depth > 0) ? ' sub-menu' : ''; // 03
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n"; // 04
        }

    // for '<li>, <a>, <span>'
    // this will handles the child elements
    // $item: is for the html attributes
    // $depth = 0: is to avoid 'undefined error'. If there is no depth, it will count as 0
    // $args = array(): this is to avoid any error, if the before and after is not mentioned.
    // $id = 0: same as the notes from '$depth'
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        // ($depth) ?: if depth is defined use the 'str_repeat(...)'
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        // if you want to add data-attribute inside li, do this $li_attributes = ' data-attribute="something"';
        $li_attributes = '';
        $class_names = $value = '';

        // split the class for array.
        // empty($item->classes) ?: if the array is empty use the 'array()', else use '(array) $item->classes'
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        // []: will merge with the array
        // ($args->walker_has_children): if the argument has children? add the class 'dropdown' (Bootstrap default class)
        //
        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        // if the item has child and is current or 'current_item_ancestor' add 'active' (Bootstrap default class)
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
        // WordPress default class - 'menu-item-ID'
        $classes[] = 'menu-item-' . $item->ID;
            // if the 'li' is children of another children
            if($depth && $args->walker->has_children){
                // add the 'dropdown-submenu' (Bootstrap default class)
                $classes[] = 'dropdown-submenu';
                }

        // merging
        // ' ' : space between the quote to join all the output
        // array_filter: loops through all the elements
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        // output
        $class_names = ' class=" ' .esc_attr($class_names). ' "';
        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
        // if the id string length
        $id = strlen($id) ? ' id=" ' .esc_attr($id). ' "' : '';
        $output .= $ident . '<li' . $id . $value . $class_names . $li_attributes . '>';
        // if the attribute is not empty
        $attributes = ! empty($item->attr_title) ? ' title=" ' .esc_attr($item->attr_title). ' "' : '';
        $attributes .= ! empty($item->target) ? ' target=" ' .esc_attr($item->target). ' "' : '';
        // xfn: is for 'rel attribute'
        $attributes .= ! empty($item->xfn) ? ' rel=" ' .esc_attr($item->xfn). ' "' : '';
        $attributes .= ! empty($item->url) ? ' href=" ' .esc_attr($item->url). ' "' : '';
        // if the link is container of sub-menu (Bootstrap class)
        $attributes .= ($args->walker->has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

        // wrap the elements
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        // if the item has children
        $item_output .= ($depth == 0 && $args->walker_has_children) ? ' <b class="caret"></b></a>' : '</a>';
        $item_output .= $args->before;

        // merge everything
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
/*
    ----- CURRENTLY WE DO NOT WANT TO DO ANYTHING -----
    // '</li>' html element
    function end_el() {

        }
    // '</ul>' html element
    function end_lvl(){

        }
*/
    }
