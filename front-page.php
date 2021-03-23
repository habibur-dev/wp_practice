<?php
get_header(); ?>

<!-- site content -->
<div class="site-content-front-page clearfix">
    <?php if(have_posts()):
        while(have_posts()) : the_post();
        
        the_content();

        endwhile;

    else:
        echo "No posts found!";

    endif;
    ?>

    <div class="home-columns clearfix">
        <div class="one-half">

            <h2>Latest Education </h2>
            <?php // education posts query
            $args = array(
                'cat'            => 11,
                'posts_per_page' => 2,
                'orderby'        => 'title',
                'order'          => 'DESC'
            );

            $edu_posts = new WP_Query($args);

            if($edu_posts->have_posts()):
                while($edu_posts->have_posts()) : $edu_posts->the_post(); ?>
                    <div class="post-item clearfix">

                        <div class="square-thumbnail">

                            <a href="<?php the_permalink(); ?>">
                            <?php
                            if(has_post_thumbnail()):
                                the_post_thumbnail('square-thumbnail');
                            else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="">
                            <?php endif; ?>
                            </a>
                            
                        </div>
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span class="subtle-date"><?php the_time('d/m/Y'); ?></span></h4>
                        <?php the_excerpt(); ?>
                    </div>


                <?php endwhile;

            else:
                echo "No posts found!";

            endif;
            wp_reset_postdata(); ?>
            <span class="cat-post"><a href="<?php echo get_category_link(11); ?>" class="cat-btn">View all technology posts</a></span>
        </div>

        <div class="one-half">
            <h2>Latest Technology</h2>
            <?php // technology posts query
            $tech_args = array(
                'cat'            => 12,
                'posts_per_page' => 2,
                'orderby'        => 'title',
                'order'          => 'DESC'
            );

            $tech_posts = new WP_Query($tech_args);

            if($tech_posts->have_posts()):
                while($tech_posts->have_posts()) : $tech_posts->the_post();?>

                    <div class="post-item clearfix">

                        <div class="square-thumbnail">

                            <a href="<?php the_permalink(); ?>">
                            <?php
                            if(has_post_thumbnail()):
                                the_post_thumbnail('square-thumbnail');
                            else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="">
                            <?php endif; ?>
                            </a>
                            
                        </div>
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span class="subtle-date"><?php the_time('d/m/Y'); ?></span> </h4>
                    <?php the_excerpt(); ?>
                    </div>

                <?php endwhile;

            else:
                echo "No posts found!";

            endif;
            wp_reset_postdata(); ?>
            <span class="cat-post"><a href="<?php echo get_category_link(12); ?>" class="cat-btn">View all technology posts</a></span>
        </div>
    </div>
</div>

<?php get_footer();