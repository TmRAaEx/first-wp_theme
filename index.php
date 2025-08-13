<?php

get_header(); ?>
 
<?php
while (have_posts()):
    the_post();

    the_content();
    hello_world();

endwhile;
?>
<?php
get_footer();