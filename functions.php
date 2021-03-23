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
    add_image_size( 'square-thumbnail', 150, 150, true );

    // add post formates
    add_theme_support('post-formats', array('aside','gallery','link'));
}
add_action('after_setup_theme', 'wp_practice_setup');

//widget location
function wp_practice_widget_init(){

    //main sidebar
    register_sidebar(array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar1',
        'before_widget' => '<div class="widget-item">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="wp-widget-title">',
        'after_title'   => '</h4>'
    ));

    // footer one 
    register_sidebar(array(
        'name'          => 'Footer One',
        'id'            => 'footer1',
        'before_widget' => '<div class="widget-item">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="wp-widget-title">',
        'after_title'   => '</h4>'
    ));

    // footer two 
    register_sidebar(array(
        'name'          => 'Footer Two',
        'id'            => 'footer2',
        'before_widget' => '<div class="widget-item">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="wp-widget-title">',
        'after_title'   => '</h4>'
    ));

    // footer three 
    register_sidebar(array(
        'name'          => 'Footer three',
        'id'            => 'footer3',
        'before_widget' => '<div class="widget-item">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="wp-widget-title">',
        'after_title'   => '</h4>'
    ));

    // footer four 
    register_sidebar(array(
        'name'          => 'Footer Four',
        'id'            => 'footer4',
        'before_widget' => '<div class="widget-item">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="wp-widget-title">',
        'after_title'   => '</h4>'
    ));

}
add_action('widgets_init', 'wp_practice_widget_init');


//customizer options
function wp_practice_customize_register($wp_customize){

    $wp_customize->add_setting('wp_practice_link_color', array(
        'default'   => '#006ec3',
        'transport' => 'refresh'
    ));

    $wp_customize->add_setting('wp_practice_button_color', array(
        'default'   => '#006ec3',
        'transport' => 'refresh'
    ));

    $wp_customize->add_setting('wp_practice_button_hover_color', array(
        'default'   => '#004C87',
        'transport' => 'refresh'
    ));

    $wp_customize->add_section('wp_practice_standard_colors', array(
        'title'    => __('Standard Colors', 'wppractice'),
        'priority' => 30
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wp_practice_color_control', array(
        'label'       => __('Link Color'),
        'description' => 'All links color.',
        'section'     => 'wp_practice_standard_colors',
        'settings'    => 'wp_practice_link_color'
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wp_practice_button_control', array(
        'label'       => __('Button Color'),
        'description' => 'All buttons color.',
        'section'     => 'wp_practice_standard_colors',
        'settings'    => 'wp_practice_button_color'
    )));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'wp_practice_button_hover_control', array(
        'label'       => __('Button Hover Color'),
        'description' => 'All buttons hover color.',
        'section'     => 'wp_practice_standard_colors',
        'settings'    => 'wp_practice_button_hover_color'
    )));

}
add_action('customize_register', 'wp_practice_customize_register');

//output customize css
function wp_practice_customize_css(){?>
    <style type="text/css">
        a:link,
        a:visited{
            color: <?php echo get_theme_mod('wp_practice_link_color'); ?>;
        }
        .site-header nav ul li.current-menu-item a:link,
        .site-header nav ul li.current-menu-item a:visited {
            background-color: <?php echo get_theme_mod('wp_practice_link_color'); ?>;
        }

        #search-btn, 
        .cat-btn, 
        .cat-btn:link, 
        .cat-btn:visited{
            background-color: <?php echo get_theme_mod('wp_practice_button_color'); ?>;
        }
        #search-btn:hover, 
        .cat-btn:hover{
            background-color: <?php echo get_theme_mod('wp_practice_button_hover_color'); ?>;
        }
    </style>
<?php }
add_action('wp_head', 'wp_practice_customize_css');

//add footer callout option in customizer
function wp_practice_footer_callout($wp_customize){

    $wp_customize->add_section('wp_practice_footer_callout_section', array(
        'title'       => 'Footer Callout'
    ));

    $wp_customize->add_setting('wp_practice_footer_callout_display', array(
        'default'     => 'No',
    ));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'wp_practice_footer_callout_display_control', array(
        'label'       => 'Show/Hide',
        'description' => 'Show or hide footer callout section.',
        'section'     => 'wp_practice_footer_callout_section',
        'settings'    => 'wp_practice_footer_callout_display',
        'type'        => 'select',
        'choices'     => array('No' => 'No', 'Yes' => 'Yes'),
    )));

    $wp_customize->add_setting('wp_practice_footer_callout_headline', array(
        'default'     => 'Example Header text'
    ));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'wp_practice_footer_callout_headline_control', array(
        'label'       => 'Headline',
        'description' => 'Add footer callout header.',
        'section'     => 'wp_practice_footer_callout_section',
        'settings'    => 'wp_practice_footer_callout_headline',
    )));

    $wp_customize->add_setting('wp_practice_footer_callout_text', array(
        'default'     => 'Example texts',
        'capability'  => 'edit_theme_options',
    ));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'wp_practice_footer_callout_text_control', array(
        'label'       => 'Description',
        'description' => 'Add footer callout texts.',
        'section'     => 'wp_practice_footer_callout_section',
        'settings'    => 'wp_practice_footer_callout_text',
        'type'        => 'textarea',
    )));

    $wp_customize->add_setting('wp_practice_footer_callout_image');

    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'wp_practice_footer_callout_image_control', array(
        'label'       => 'Callout Image',
        'description' => 'Add footer callout image.',
        'section'     => 'wp_practice_footer_callout_section',
        'settings'    => 'wp_practice_footer_callout_image',
        'width'       => 700,
        'height'      => 500,
    )));
 

}
add_action('customize_register', 'wp_practice_footer_callout');