<div class="book-single">
    <?php
    if (have_posts()):
        while (have_posts()):
            the_post(); ?>

            <h1><?php the_title(); ?></h1>
            <div class="book-content">
                <?php the_content(); ?>
            </div>

            <div class="book-meta">
                <p><strong>Genres:</strong> <?php the_terms(get_the_ID(), 'genre'); ?></p>
                <p><strong>Author(s):</strong> <?php the_terms(get_the_ID(), 'author'); ?></p>
                <p><strong>Age Recommendation:</strong> <?php the_terms(get_the_ID(), 'age_recommendation'); ?></p>
            </div>

        <?php endwhile;
    endif;
    ?>
</div>