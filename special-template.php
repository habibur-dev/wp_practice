<?php

/**
 * Template Name: Special Template
 */

get_header();

if(have_posts()):
    while(have_posts()) : the_post(); ?>
    
    <article class="post page">
        <h2><?php the_title(); ?></a></h2>

        <!-- info box -->
        <div class="info-box">
            <h4>Desclaimer Title</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur ut nihil assumenda culpa aspernatur aut at vel fuga quam eligendi repellendus quidem itaque, debitis nam natus quasi consequuntur sed asperiores.</p>
        </div><!-- info box -->
        <p><?php the_content(); ?></p>
    </article>

    <?php endwhile; ?>
    
    <?php

else:
    echo "No posts found!";

endif;

get_footer();