<?php get_header();

$post_type = get_post_type();

switch ($post_type) {
    case 'book':
        get_template_part('templates/books/single-book');
        break;

    default:
        // Fallback for other posts
        get_template_part('templates/single-default');
        break;
}



get_footer();