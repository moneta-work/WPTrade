<?php
/*
Template Name: Hot Products - Template
*/
?>
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
    <!-- ProductList begin -->
    <div class="plist">
    	<?php wp_reset_query(); ?>
        <?php if (get_option('wpyou_products_id')) { $productsid = get_option('wpyou_products_id'); } ?>
        <?php $wp_query = new WP_Query('v_sortby=views&cat='.$productsid.'&orderby=date&caller_get_posts=1&order=DESC&posts_per_page='.$products_perpage.'&paged='.$paged); ?>
		<?php if (have_posts()) : ?>
                <ul>
                <?php while (have_posts()) : the_post(); ?>
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
                <?php endwhile;?>
                </ul>
        <?php else : ?>
            <div class="product_detail">
                <strong>No page matched</strong>
                <p>Sorry, no page matched your criteria! <a href="<?php echo get_settings('home'); ?>">You can back home</a></p>
            </div>
        <?php endif; ?>
        <div class="clear"></div>
        <!-- Navigation begin -->
        <div class="wpagenavi">
            <?php if(function_exists('wpyou_pagenavi')) { wpyou_pagenavi(9); } ?>
        </div>
        <!-- Navigation end -->
    </div>
    <!-- ProductList end -->
</div>
<!-- Content end -->
<?php get_footer(); ?>