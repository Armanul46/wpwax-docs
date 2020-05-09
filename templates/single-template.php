<?php
global $post;
$post_type = $post->post_type;
if( 'wpwax_directorist' == $post_type ) {
    $taxonomy = 'wpwax_directorist_category';
    $main_doc = __('Directorist', 'wpwax-docs');
} elseif ( 'wpwax_extensions' == $post_type) {
    $taxonomy = 'wpwax_extensions_category';
    $main_doc = __('Extensions', 'wpwax-docs');
} elseif ( 'wpwax_dlist' == $post_type) {
    $taxonomy = 'wpwax_dlist_category';
    $main_doc = __('Dlist', 'wpwax-docs');
} elseif ( 'wpwax_direo' == $post_type) {
    $taxonomy = 'wpwax_direo_category';
    $main_doc = __('Direo', 'wpwax-docs');
} elseif ( 'wpwax_directoria' == $post_type) {
    $taxonomy = 'wpwax_directoria_category';
    $main_doc = __('Directoria', 'wpwax-docs');
} elseif ( 'wpwax_findbiz' == $post_type) {
    $taxonomy = 'wpwax_findbiz_category';
    $main_doc = __('Findbiz', 'wpwax-docs');
} elseif ( 'wpwax_dservice' == $post_type) {
    $taxonomy = 'wpwax_dservice_category';
    $main_doc = __('Dservice', 'wpwax-docs');
} elseif ( 'wpwax_drestaurant' == $post_type) {
    $taxonomy = 'wpwax_drestaurant_category';
    $main_doc = __('Drestaurant', 'wpwax-docs');
}

$single_doc_id = $post->ID;

$cats = get_the_terms($post->ID, $taxonomy);

$parent_id = $cats[0]->parent;
$parent_cat = get_term_by('id', $parent_id, 'wpwax_docs_category');

$all_cats = get_terms( [
    'taxonomy'=> $taxonomy,
    //'parent'  => $parent_id,
    'orderby'   => 'id',
    'order'   => 'ASC',
] ); ?>
<div class="wpwax-single-docs">
    <div class="wpwax-left-sidebar">
        <div class="wpwax-left-sidebar-contents">
            <h2><?php echo !empty( $main_doc ) ? $main_doc : ''; ?></h2>
        <?php

        if( !empty( $all_cats ) ) {
            foreach ( $all_cats as $child_cat) {
                $options = array(
                    'post_type' => $post_type,
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxonomy,
                            'field' => 'slug',
                            'terms' => $child_cat->slug
                        )
                    )
                );
                $docs = new WP_Query($options); ?>
                <div class="left-sidebar">
                    <h4 class="<?php echo ($cats[0]->term_id == $child_cat->term_id ) ? 'active' : ''; ?>"><?php echo $child_cat->name; ?></h4>
                    <?php if($docs->have_posts()) {?>
                        <ul>
                            <?php while ( $docs->have_posts() ) : $docs->the_post(); ?>
                                <li class="<?php echo ( $single_doc_id === get_the_ID() ) ? 'active' : ''; ?>"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    <?php } ?>
                </div>
            <?php
            }
            wp_reset_postdata();
        }
        ?>
        </div>
    </div>
    <section class="wpwax-doc-details">
        <?php
        $post_object = get_post($post->ID);
        $post_content = do_shortcode($post_object->post_content);

        ?>
        <div class="title"> <?php echo get_the_title($post->ID); ?> </div>
        <div class="content">
        <?php echo do_shortcode(wpautop($post_content)); ?>
        </div>
        <div class="doc-details-excerpt">
            <p class="doc-last-update">
                <?php _e('Last Updated:', 'wpwax-docs');?>
                <span>
                    <?php
                    echo get_the_modified_time('F jS, Y');
                    ?>
                </span>
            </p>

           <!-- <div class="doc-feedback">
                Was this article helpful?
                <a href="" class="doc-upvote"><span class="la la-smile-o"></span> Yes</a>
                <a href="" class="doc-downvote"><span class="la la-frown-o"></span> No</a>
            </div>

            <div class="doc-request-share">
                <p>Still need help? <a href="">Submit a Request</a></p>
                <p>
                    Share Article:
                    <a href=""><span class="la la-facebook"></span></a>
                    <a href=""><span class="la la-twitter"></span></a>
                    <a href=""><span class="la la-youtube"></span></a>
                    <a href=""><span class="la la-instagram"></span></a>
                </p>
            </div>-->

            <!--<div class="doc-pagination">
                <a href="" class="doc-prev">
                    <span><i class="la la-angle-left"></i> Previous Article</span>
                    Stop getting emails from lorem
                </a>
                <a href="" class="doc-next">
                    <span>Next Article <i class="la la-angle-right"></i></span>
                    Use threads to organize disdcussions
                </a>
            </div>-->
            <?php
            $wpwax_cats = get_the_terms($post, $taxonomy);
            $wpwax_cats_ids = array();

            if (!empty($wpwax_cats)) {
                foreach ($wpwax_cats as $wpwax_cat) {
                    $wpwax_cats_ids[] = $wpwax_cat->term_id;
                }
            }
            $args = array(
                'post_type' => $post_type,
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'term_id',
                        'terms' => $wpwax_cats_ids,
                    ),
                ),
                'posts_per_page' => 3,
                'post__not_in' => array($post->ID),
            );
            $related_docs = new WP_Query($args);

            ?>
            <?php if($related_docs->have_posts()) { ?>
            <div class="doc-related-article">
                <h3><?php _e('Related Article', 'wpwax-docs');?></h3>
                <ul>
                    <?php while($related_docs->have_posts()) : $related_docs->the_post();?>
                    <li><a href="<?php echo get_the_permalink(); ?>"><span class="la la-file-text"></span> <?php echo get_the_title(); ?></a></li>
                   <?php endwhile;
                   wp_reset_postdata();
                   ?>
                </ul>
            </div>
            <?php } ?>
            <!--<div class="doc-comments">
                <h3>Leave Comment</h3>
                <form action="/">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea></textarea>
                    </div>
                </form>
            </div>-->
        </div>
    </section>
</div>
