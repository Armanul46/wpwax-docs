<?php
if($child_cats) {

    foreach ( $child_cats as $child_cat) {
        $options = array(
            'post_type' => 'wpwax_docs',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'wpwax_docs_category',
                    'field' => 'slug',
                    'terms' => $child_cat->slug
                )
            )
        );
        $docs = new WP_Query($options);
        ?>
        <div class="atbd-docs-name">
            <h4><?php echo $child_cat->name; ?></h4>
            <?php if($docs->have_posts()) {?>
            <ul>
                <?php while ($docs->have_posts()) : $docs->the_post();?>
                <li><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
                <?php endwhile; ?>
            </ul>
            <?php } ?>
        </div>

        <?php
    }



}
