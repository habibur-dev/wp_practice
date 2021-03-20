<?php
get_header(); ?>

<!-- site content -->
<div class="site-content clearfix">
    <div class="main-column">
        <?php

        if(have_posts()):
            while(have_posts()) : the_post();
            
            get_template_part('templates/content', get_post_format());

            endwhile;

        else:
            echo "No posts found!";

        endif;

        ?>
    </div>

    <?php get_sidebar(); ?>
</div>

<?php get_footer();