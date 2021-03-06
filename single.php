<?php
get_header();
?>
<div class="site-content clearfix">
    <div class="main-column">
        <?php
        if(have_posts()):
            while(have_posts()) : the_post(); ?>
            
            <article class="post">
                <h2><?php the_title(); ?></h2>
                <p class="post-info"><?php the_time('F j, Y g:i a'); ?> | by- <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a> | Posted in 
                <?php
                
                $categories = get_the_category();
                $separator = ", ";
                $output = "";

                if($categories){
                    foreach($categories as $category){
                        $output .= '<a href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>' . $separator;
                    }

                    echo trim($output, $separator);
                }
                
                ?>
                </p>
                <?php the_post_thumbnail('banner-thumbnail'); ?>
                <p><?php the_content(); ?></p>

                <div class="about-author clearfix">
                    <div class="about-author-image">
                        <?php echo get_avatar( get_the_author_meta('ID'), 512 ); ?>
                        <p><?php echo get_the_author_meta( 'nickname' ); ?></p>
                    </div>

                    <?php 
                    
                    $args = array(
                        'author' => get_the_author_meta('ID'),
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                    );
                    $otherAuthorPosts = new WP_Query($args);
                    
                    ?>

                    <div class="about-author-text">
                        <h3>About Author</h3>
                        <?php echo wpautop( get_the_author_meta( 'description' ) ); ?>

                        <?php if($otherAuthorPosts->have_posts()): ?>
                        <div class="other-posts-by">
                            <h4>Other posts by <?php echo get_the_author_meta( 'nickname' ); ?></h4>
                            <ul>
                                <?php while ($otherAuthorPosts->have_posts()): ?>
                                <?php  $otherAuthorPosts->the_post(); ?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                <?php
                                endwhile;
                                ?>
                            </ul>
                        </div>
                        <?php
                        endif;
                        wp_reset_postdata(); 
                        ?>
                        <?php if( count_user_posts( get_the_author_meta('ID')) > 3): ?>
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="cat-btn">View all posts by <?php echo get_the_author_meta( 'nickname' ); ?></a>
                        <?php endif; ?>

                    </div>
                </div>

            </article>

            <?php endwhile; 
        else:
            echo "No posts found!";

        endif;
        ?>
</div>

<?php get_sidebar(); ?>
</div>
<?php 

get_footer();