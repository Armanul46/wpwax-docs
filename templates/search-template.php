<div class="wpwax-search-result">
    <?php
    if( isset( $_GET['search_docs'] ) ) {
        $options = array(
            'post_type' => 'wpwax_docs',
            'posts_per_page' => -1,
            's' => $_GET['search_docs']
        );
        $docs = new WP_Query($options);


        if ($docs->have_posts()) { ?>
            <div class="search-result-docs">
            <?php while ($docs->have_posts()) : $docs->the_post(); ?>
                <h4><a href="<?php echo get_the_permalink(); ?>"> <?php echo get_the_title(); ?> </a></h4>
            <?php endwhile; ?>
            </div>
        <?php
        }
    }
    ?>
</div>
