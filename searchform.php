<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
    <!-- <label for="search">Search in:</label> -->
    <input type="text" name="s" id="search-txt"  placeholder="<?php the_search_query(); ?>" />
    <input type="submit" alt="Search" value="Search" id="search-btn" />
</form>