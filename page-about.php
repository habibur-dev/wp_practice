<?php
get_header();

?>

<div class="site-content clearfix">
    
        <?php

        if(have_posts()):
            while(have_posts()) : the_post(); ?>
            
            <article class="post page">
        
            <?php if(has_children() OR $post->post_parent >0 ){?>
        
                <nav class="site-nav children-links clearfix">
                    <span class="parent-link">
                        <a href="<?php get_the_permalink(get_top_ancestor_id()); ?>"><?php echo get_the_title(get_top_ancestor_id()); ?></a>
                    </span>
        
                    <ul>
                    <?php 
                    
                    $args = array(
                        'child_of' => get_top_ancestor_id(),
                        'title_li' => ''
                    );
                    wp_list_pages($args); 
                    
                    ?>
                    </ul>
                </nav>
                <?php } ?>
                <h2><?php the_title(); ?></a></h2>
                <p><?php the_content(); ?></p>
            </article>
        
            <?php endwhile; ?>
            
            <?php
        
        else:
            echo "No posts found!";
        
        endif;

        ?>

        <div>
        <h2>Blog Posts About Us</h2>
        <?php 
        
        $get_current_page = get_query_var( 'paged' );
        $about_posts = new WP_Query(array(
            'category_name'  => 'about',
            'posts_per_page' => 3,
            'paged'          => $get_current_page,
        ));

        if($about_posts->have_posts()): ?>
            <ul>
            <?php 
            while($about_posts->have_posts()):
                $about_posts->the_post();
                ?><li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php
            endwhile;
            
            echo paginate_links( array(
                'total' => $about_posts->max_num_pages,

            ) );
            ?>
            </ul>
        <?php endif;?>
        </div>
    
</div>


<?php
get_footer();

