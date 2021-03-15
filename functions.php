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