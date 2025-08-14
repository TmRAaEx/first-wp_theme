<?php

get_header(); ?>

<?php
while (have_posts()):
    the_post();

    the_content();

endwhile;
do_action("message");
?>
<?php
get_footer();