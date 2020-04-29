<div class="wpwax-search-result">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="doc-search-summery">
                    <p><span>76</span> results for <span>"How to"</span></p>
                    <span>Show 1-10 of 76 results</span>
                </div>
                <?php
                if (isset($_GET['search_docs'])) {
                    $options = array(
                        'post_type' => 'wpwax_docs',
                        'posts_per_page' => -1,
                        's' => $_GET['search_docs']
                    );
                    $docs = new WP_Query($options);


                    if ($docs->have_posts()) { ?>
                        <div class="doc-result-wrapper">
                            <?php while ($docs->have_posts()) : $docs->the_post(); ?>
                                <div class="search-result-docs">
                                    <span class="la la-file-o"></span>
                                    <div>
                                        <h4>
                                            <a href="<?php echo get_the_permalink(); ?>"> <?php echo get_the_title(); ?> </a>
                                        </h4>
                                        <p>
                                            <?php echo wp_trim_words(get_the_content(), 20); ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>
