<?php
global $post;
$cats = get_the_terms($post->ID, 'wpwax_docs_category');

$parent_id = $cats[0]->parent;

$all_cats = get_terms( [
    'taxonomy'=> 'wpwax_docs_category',
    'parent'  => $parent_id
] );

if( !empty( $all_cats ) ) {
    foreach ( $all_cats as $child_cat) {

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
        $docs = new WP_Query($options); ?>
        <div class="left-sidebar">
            <h4><?php echo $child_cat->name; ?></h4>
            <?php if($docs->have_posts()) {?>
                <ul>
                    <?php while ($docs->have_posts()) : $docs->the_post(); ?>
                        <li><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            <?php } ?>
        </div>
    <?php
    }
    wp_reset_postdata();
}
?>

<section>
    <?php
    $post_object = get_post($post->ID);
    $post_content = do_shortcode($post_object->post_content);

    ?>
    <div class="title"> <?php echo get_the_title($post->ID); ?> </div>
    <div class="content">
        <?php echo $post_content;?>
    </div>
</section>

