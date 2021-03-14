<?php


//style & scripts enqueue
function wp_practice_add_css_js(){
    wp_enqueue_style('stylesheet', get_stylesheet_uri());
    
}

add_action('wp_enqueue_scripts', 'wp_practice_add_css_js');

//menu register
register_nav_menus( array(
    'primary' => 'Primay Menu',
    'footer' => 'Footer Menu'
) );