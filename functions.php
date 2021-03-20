<?php


//style & scripts enqueue
function wp_practice_add_css_js(){
    wp_enqueue_style('stylesheet', get_stylesheet_uri());
    
}

add_action('wp_enqueue_scripts', 'wp_practice_add_css_js');



//get top ancestor
function get_top_ancestor_id(){

    global $post;

    if($post->post_parent){
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }

    return $post->ID;
}

/** has children page */
function has_children(){
    global $post;
    $pages = get_pages('child_of='.$post->ID);
    return count($pages);
}

//customize excerpt word count length

function custom_excerpt_length(){
    return 25;
}
add_filter('excerpt_length', 'custom_excerpt_length');

// remove excerpt last 3 dots
function remove_excerpt_dots(){
    return '';
}
add_filter('excerpt_more', 'remove_excerpt_dots');

// adding theme supports

function wp_practice_setup(){
    //menu register
    register_nav_menus( array(
        'primary' => 'Primay Menu',
        'footer' => 'Footer Menu'
    ) );

    // add featured photo
    add_theme_support('post-thumbnails');

    //add image size
    add_image_size( 'small-thumbnail', 180, 120, true );
    add_image_size( 'banner-thumbnail', 1500, 450, true );

    // add post formates
    add_theme_support('post-formats', array('aside','gallery','link'));
}
add_action('after_setup_theme', 'wp_practice_setup');

//widget location
function wp_practice_widget_init(){

    //main sidebar
    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar1',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="wp-widget-title">',
        'after_title' => '</h4>'
    ));

    // footer one 
    register_sidebar(array(
        'name' => 'Footer One',
        'id' => 'footer1',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="wp-widget-title">',
        'after_title' => '</h4>'
    ));

    // footer two 
    register_sidebar(array(
        'name' => 'Footer Two',
        'id' => 'footer2',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="wp-widget-title">',
        'after_title' => '</h4>'
    ));

    // footer three 
    register_sidebar(array(
        'name' => 'Footer three',
        'id' => 'footer3',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="wp-widget-title">',
        'after_title' => '</h4>'
    ));

    // footer four 
    register_sidebar(array(
        'name' => 'Footer Four',
        'id' => 'footer4',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="wp-widget-title">',
        'after_title' => '</h4>'
    ));

}

add_action('widgets_init', 'wp_practice_widget_init');