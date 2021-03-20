<?php
get_header(); ?>

<!-- site content -->
<div class="site-content clearfix">
    <?php

    if(have_posts()):
        while(have_posts()) : the_post();
        
        the_content();

        endwhile;

    else:
        echo "No posts found!";

    endif;

    ?>
</div>

<?php get_footer();