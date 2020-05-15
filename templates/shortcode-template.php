<?php

if (!empty($child_cats)) { ?>
    <div class="docs-search">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="http://directorist.local/search-result-2/">
                        <input type="text" placeholder="Search anything" name="search_docs"/>
                        <input type="hidden" name="type" value="<?php echo !empty( $search_type ) ? $search_type : 'directorist'; ?>">
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!--ends: .docs-search-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="docs-wrapper">
                    <div class="docs-sidebar">
                        <div id="sticky-anchor"></div>
                        <ul>
                            <?php
                            foreach ($child_cats as $child_cat) { ?>
                                <li class="sidbar-category"><a href="#<?php echo $child_cat->term_id; ?>"><?php echo $child_cat->name; ?></a></li>
                                <?php
                            } ?>
                        </ul>
                    </div>
                    <div class="docs-contents">
                        <?php
                      //  var_dump($taxonomy);
                        foreach ($child_cats as $child_cat) {
                            $options = array(
                                'post_type' => $type,
                                'posts_per_page' => -1,
                                'post_parent' => 0,
                                'orderby'=>'id',
                                'order'=>'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field' => 'slug',
                                        'terms' => $child_cat->slug
                                    )
                                )
                            );
                            $docs = new WP_Query($options);
                            ?>
                            <div class="atbd-docs-name" id="<?php echo $child_cat->term_id; ?>">
                                <h4><?php echo $child_cat->name; ?></h4>
                                <?php if ($docs->have_posts()) { ?>
                                    <ul>
                                        <?php while ($docs->have_posts()) : $docs->the_post();
                                            $parent_id = wp_get_post_parent_id(get_the_ID());
                                        ?>
                                            <li class="parent_docs">
                                                <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                                <?php
                                                $child_docs = get_children( array('post_parent' => get_the_ID() , 'post_type'=> $type) );
                                                if( !empty($child_docs) ) {
                                                ?>
                                                <ul>
                                                    <?php foreach ( $child_docs as $child_doc ) { ?>
                                                    <li class="child_docs">
                                                        <a href="<?php echo get_the_permalink($child_doc->ID); ?>"><?php echo get_the_title($child_doc->ID); ?></a>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                                <?php } ?>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php } ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="doc-cta">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Still no luck? We can help!</h2>
                    <p>Contact us and we’ll get back to you as soon as possible.</p>
                    <a href="" class="btn btn-primary">Submit a Request</a>
                </div>
            </div>
        </div>
    </div>-->
    <?php
}
