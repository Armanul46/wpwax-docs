<?php
if (!empty($child_cats)) { ?>
    <div class="docs-search">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="http://directoristp.com/doc-search-result/">
                        <input type="text" placeholder="Search anything" name="search_docs"/>
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
                        <ul>
                            <?php
                            foreach ($child_cats as $child_cat) { ?>
                                <li class="sidbar-category"><?php echo $child_cat->name; ?></li>
                                <?php
                            } ?>
                        </ul>
                    </div>
                    <div class="docs-contents">
                        <?php
                        foreach ($child_cats as $child_cat) {
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
                                <?php if ($docs->have_posts()) { ?>
                                    <ul>
                                        <?php while ($docs->have_posts()) : $docs->the_post(); ?>
                                            <li>
                                                <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
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
    <?php
}
