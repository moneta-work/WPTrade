<?php get_header(); ?>
<!-- Sidebar begin -->
<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
<!-- Sidebar end -->
<!-- Content begin -->
<div class="content">
	<!-- Breadcrumb begin -->
    <h2 class="breadcrumb">
		<?php include (TEMPLATEPATH . '/breadcrumb.php'); ?>
    </h2>
    <!-- Breadcrumb end -->
    <div class="clear"></div>
    <!-- Single begin -->
    <div class="single">
        <h2><?php the_title(); ?></h2> 
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content(' '); ?>
                <br />
                <?php the_tags('Tags: ', ',', ''); ?><br />
            <?php endwhile; ?>
        <?php else : ?>
            <div class="error">
                <h2>404 Error</h2>
                <p>
                    <strong>Nothing Found</strong><br />
                    Sorry, no posts matched your criteria! <a href="<?php echo get_settings('home'); ?>">You can back home</a>
                </p>
            </div>
        <?php endif; ?>
        <div class="clear"></div>
        <?php if (get_option('wpyou_news_id')){
			$newsCats = get_option('wpyou_news_id');
			$newsArrays = explode(",",$newsCats); }
			if(in_category($newsArrays) || post_is_in_descendant_category( $newsArrays )){
		?>
        <div class="pagelr">
        	<div class="pageleft"><?php previous_post_link('%link', '&laquo; Previous', TRUE); ?></div>
			<div class="pageright"><?php next_post_link('%link', 'Next &raquo;', TRUE); ?></div>
        </div>
        <!-- Relative News begin -->
        <div class="related_products related_news nlist">
            <h2>Related News</h2>
            <ul>
            <?php if (get_option('wpyou_news_id')) { $newsid = get_option('wpyou_news_id'); }?>
            <?php
                $tags = wp_get_post_tags($post->ID);
                if ($tags) {
                    $tag_ids = array();
                    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                
                    $args=array(
                        'tag__in' => $tag_ids,
                        'post__not_in' => array($post->ID),
						'cat' => $news_id,
                        'showposts'=>10, // Number of related posts that will be shown.
                        'caller_get_posts'=>1
                    );
                    $my_query = new wp_query($args);
                    if( $my_query->have_posts() ) {
                        while ($my_query->have_posts()) {
                            $my_query->the_post();
                        ?>
                            <li><span><?php the_time('Y-m-d'); ?></span><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></li>
                        <?php
                        }
                    }
                } else {
                    echo"No related news";
                }
                ?>
            </ul>
            <?php wp_reset_query(); ?>
        </div>
        <!-- Relative News end -->
        <?php } else { ?>
        <!-- Relative Products begin -->
        <div class="related_products">
            <h2>Related Products</h2>
            <ul>
            <?php if (get_option('wpyou_products_id')) { $productid = get_option('wpyou_products_id'); }?>
            <?php
                $tags = wp_get_post_tags($post->ID);
                if ($tags) {
                    $tag_ids = array();
                    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                
                    $args=array(
                        'tag__in' => $tag_ids,
                        'post__not_in' => array($post->ID),
						'cat' => $productid,
                        'showposts'=>8, // Number of related posts that will be shown.
                        'caller_get_posts'=>1
                    );
                    $my_query = new wp_query($args);
                    if( $my_query->have_posts() ) {
                        while ($my_query->have_posts()) {
                            $my_query->the_post();
                        ?>
                            <li>
                                <?php
                                    if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
                                ?>
                                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" ><?php the_post_thumbnail( 'thumbnail' ); ?></a>
                                <?php } else { ?>
                                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" ><img src="<?php echo catch_post_image() ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" /></a>
                                <?php } ?>
                                    <h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                            </li>
                        <?php
                        }
                    }
                } else {
                    echo"No related products";
                }
                ?>
            </ul>
            <?php wp_reset_query(); ?>
        </div>
        <!-- Relative Products end -->
        <?php } ?>
    </div>
    <!-- Single end -->
</div>
<!-- Content end -->
<?php get_footer(); ?>