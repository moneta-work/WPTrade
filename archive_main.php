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
    <div class="plist nlist">
		<?php if (have_posts()) : ?>
        		<?php if ( get_option('wpyou_news_perpage') ) { ?>
					<?php $news_perpage = stripslashes(get_option('wpyou_news_perpage')); ?>
                <?php } else { ?>
                    <?php $news_perpage = 20; ?>
                <?php } ?>
                <?php $wp_query = new WP_Query('cat='.$cat.'&orderby=date&caller_get_posts=1&order=DESC&posts_per_page='.$news_perpage.'&paged='.$paged); ?>
                <ul>
                <?php while (have_posts()) : the_post(); ?>
                    <li><span><?php the_time('Y-m-d'); ?></span><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile;?>
                </ul>
        <?php else : ?>
            <div class="error">
                <p>
                    <strong>No product matched</strong><br />
                    Sorry, no product matched your criteria! <a href="<?php echo get_settings('home'); ?>">You can back home</a>
                </p>
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
