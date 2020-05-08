<?php
$type = isset( $_GET['type'] ) ?  $_GET['type'] : 'directorist';
    if(  'directorist' == $type ) {
        $post_type = 'wpwax_directorist';
    } elseif ( 'dlist' == $type ) {
        $post_type = 'wpwax_dlist';
    } elseif ( 'direo' == $type ) {
        $post_type = 'wpwax_direo';
    } elseif ( 'directoria' == $type ) {
        $post_type = 'wpwax_directoria';
    } elseif ( 'findbiz' == $type ) {
        $post_type = 'wpwax_findbiz';
    } elseif ( 'dservice' == $type ) {
        $post_type = 'wpwax_dservice';
    } elseif ( 'drestaurant' == $type ) {
        $post_type = 'wpwax_drestaurant';
    }
?>
<div class="wpwax-search-result">
    <div class="docs-search">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="http://directorist.local/search-result-2/">
                        <input type="text" placeholder="Search anything" name="search_docs" value="<?php echo !empty( $_GET['search_docs'] ) ? $_GET['search_docs'] : ''; ?>" />
                        <input type="hidden" name="type" value="<?php echo !empty( $type ) ? $type : 'directorist'; ?>">
                        <span class="la la-search"></span>
                    </form>
                </div>
            </div>
        </div>
    </div><!--ends: .docs-search-->
    <div class="container">
        <div class="row">
            <?php
            $options = array(
                'post_type' => $post_type,
                'posts_per_page' => -1,
            );
            if (isset($_GET['search_docs'])) {
                $options['s'] = $_GET['search_docs'];
            }
            $docs = new WP_Query($options);
            ?>
            <div class="col-md-10 offset-md-1">
                <?php if( !empty( $_GET['search_docs'] ) ) {
                    $results = (1 < $docs->post_count) ? ' results for' : ' result for';
                    ?>
                <div class="doc-search-summery">
                    <p><span><?php echo $docs->post_count; ?></span> <?php echo $results; ?> <span><?php echo $_GET['search_docs'];?></span></p>
                    <!--<span>Show 1-10 of 76 results</span>-->
                </div>
                <?php } ?>
                <?php
                if ($docs->have_posts()) { ?>
                    <div class="doc-result-wrapper">
                        <?php while ($docs->have_posts()) : $docs->the_post(); ?>
                            <div class="search-result-docs">
                                <span class="la la-file-text-o"></span>
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

                ?>

            </div>
        </div>
    </div>
</div>
