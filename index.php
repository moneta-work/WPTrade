<?php get_header(); ?>
<!-- Sidebar begin -->
<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
<!-- Sidebar end -->
<!-- Content begin -->
<div class="content">
	<!-- Introduce begin -->
    <div class="introduce">
        <h2>About us<span><a href="<?php bloginfo('url'); ?>/about-us" title="More">More</a></span></h2>
		<div class="section png">
       		<?php if ( get_option('wpyou_aboutus') ) { ?>
            	<?php
					$getdata = get_option('wpyou_aboutus');
					$getdata = str_replace(" "," ",$getdata);
					$getdata = stripslashes($getdata); 
					echo $getdata;
				?>
            <?php } else { ?>
                  请在后台的【 外观 - 当前主题设置 】中添加企业简介
            <?php } ?>
        </div>
        <div class="clear"></div>
	</div>
    <!-- Introduce end -->
	<!-- News begin -->
    <div class="news">
    	<h2>
			<?php if (get_option('wpyou_news_id')) { $newsid = get_option('wpyou_news_id'); ?>
                <a href="<?php echo get_category_link( $newsid );?>" title="<?php echo get_cat_name( $newsid ); ?>"><?php echo get_cat_name( $newsid ); ?></a>
            <?php } else { ?>
                 <a href="<?php bloginfo('siteurl');?>/category/news">News</a>
            <?php } ?>
            <span><?php if (get_option('wpyou_news_id')) { $newsid = get_option('wpyou_news_id'); ?>
                <a href="<?php echo get_category_link( $newsid );?>" title="<?php echo get_cat_name( $newsid ); ?>">More>></a>
            <?php } else { ?>
                 <a href="<?php bloginfo('siteurl');?>/category/news">More>></a>
            <?php } ?>
            </span>
        </h2>
		<?php if (get_option('wpyou_news_id')) { $newsid = get_option('wpyou_news_id'); ?>
            <?php query_posts('caller_get_posts=1&showposts=10&cat='.$newsid); ?>
        <?php } else { ?>
            <?php query_posts('caller_get_posts=1&showposts=10&cat=news'); ?>
        <?php } ?>
        <ul>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
             <li><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a><span><?php the_time('Y-m-d') ?></span></li>
            <?php endwhile; endif; ?>
        </ul>
    </div>
    <!-- Contact US end -->
	<div class="clear"></div>
    <!-- Featured begin -->
    <div class="featured">
    	<!-- Latest products begin -->
        <div class="latest_products">
            <h2><span>Latest Products</span></h2>
            <div class="plist">
            	<?php if ( get_option('wpyou_newposts_homepage') ) { ?>
					<?php $newposts = stripslashes(get_option('wpyou_newposts_homepage')); ?>
                <?php } else { ?>
                      <?php $newposts = 6; ?>
                <?php } ?>
                <?php if (get_option('wpyou_exclude_catid')) { $exclude_catid = get_option('wpyou_exclude_catid'); } ?>
                <?php query_posts('caller_get_posts=1&showposts='.$newposts.'&cat=-'.$exclude_catid) ?>
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
                <?php wp_reset_query(); ?>
            </div>
            <div class="plistbtm"></div>
        </div>
        <!-- Latest products end -->
        <!-- Hot products begin -->
        <div class="hot_products">
            <h2><span>Hot Products</span></h2>
            <div class="plist">
            	<?php if ( get_option('wpyou_hotposts_homepage') ) { ?>
					<?php $hotposts = stripslashes(get_option('wpyou_hotposts_homepage')); ?>
                <?php } else { ?>
                    <?php $hotposts = 6; ?>
                <?php } ?>
                <?php if (get_option('wpyou_exclude_catid')) { $exclude_catid = get_option('wpyou_exclude_catid'); } ?>
                <?php query_posts('caller_get_posts=1&v_sortby=views&v_orderby=desc&showposts='.$hotposts.'&cat=-'.$exclude_catid) ?>
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
                <?php wp_reset_query(); ?>
            </div>
            <div class="plistbtm"></div>
        </div>
        <!-- Hot products end -->
    </div>
    <!-- Featured end -->
</div>
<!-- Content end -->
<?php get_footer(); ?>
