<div class="sidebar">
	<ul>
		<?php if ( is_page() ) { ?>
            <!-- SubPageList begin -->
            <?php
            $parent_page = $post->ID;
            while($parent_page) {
                $page_query = $wpdb->get_row("SELECT ID, post_title, post_status, post_parent FROM $wpdb->posts WHERE ID = '$parent_page'");
                $parent_page = $page_query->post_parent;
             }
           $parent_id = $page_query->ID;
           $parent_title = $page_query->post_title;
            if ($wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = '$parent_id' AND post_status != 'attachment'")) { ?>
                <?php $subpage = wp_list_pages('depth=1&echo=0&child_of='.$parent_id); ?><?php //key ?>
                <?php if($subpage) { ?>
                    <li class="widget widget_categories png">
                        <h3><?php echo $parent_title; ?></h3>
                        <ul><?php wp_list_pages('depth=1&sort_column=menu_order&title_li=&child_of='. $parent_id); ?></ul>
                    </li>
                <?php } ?>
            <?php } ?>
            <!-- SubPageList end -->
        <?php } else { ?>
            <!-- ProductCategories begin -->
            <li class="widget widget_categories">
                <h3>Product Categories</h3>
                <ul>
                    <?php if (get_option('wpyou_products_id')) { $productsid = get_option('wpyou_products_id'); } ?>
            		<?php wp_list_categories('title_li=0&orderby=id&hide_empty=0&show_count=0&depth=2&child_of='.$productsid); ?>
                </ul>
            </li>
            <!-- ProductCategories end -->
        <?php } ?>
    	<div class="clear"></div>
    	<!-- RecommendProducts begin -->
        <li>
            <h3><?php _e('Feautured Products'); ?></h3>
            <ul>
            	<?php
					$sticky = get_option('sticky_posts');
					rsort( $sticky );
					$sticky = array_slice( $sticky, 0, 10);
					query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1 ) );
				?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <li><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></li>
                <?php endwhile; endif; ?>
            </ul>
        </li>
        <!-- RecommendProducts end -->
        <div class="clear"></div>
        <!-- Tags begin -->
        <!--<li class="widget widget_tag_cloud">
            <h3><?php _e('Hot search'); ?></h3>
            <div><?php wp_tag_cloud('smallest=12&largest=12&number=40&unit=px&orderby=count&order=RAND'); ?></div>
        </li>-->
        <!-- Tags begin -->
        <div class="clear"></div>
        <?php wp_reset_query(); ?>
        <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>
        <!-- ContactUs begin -->
        <li class="widget widget_text">
            <h3><?php _e('Contact Us'); ?></h3>
            <div class="sb_contactus">
            	<p>
                <?php if ( get_option('wpyou_contactus') ) { ?>
					<?php echo stripslashes(get_option('wpyou_contactus')); ?>
                <?php } else { ?>
                	<strong>Tel</strong>: 086-21-62320707<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 086-21-62321717<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 086-21-62322727<br />
                    <strong>Fax</strong>: 086-21-62323737<br />
                    <strong>E-mail</strong>: linli@cgvalve.com<br />
                    <strong>Address</strong>: Room 2612, 587 Changshou Road, Shanghai China.<br />
                    <strong>ZIP</strong>.: 200060
                <?php } ?>
                </p>
            </div>
        </li>
        <!-- ContactUs end -->
        <!-- OurHonors begin -->
        <li class="widget widget_text">
            <h3><?php _e('Our Certificates'); ?></h3>
            <div>
            	<a href="<?php bloginfo('siteurl');?>/certificates"><img src="<?php bloginfo('template_url'); ?>/images/honors.jpg" title="Our Certificates" width="205" height="270" /></a>
            </div>
        </li>
        <!-- OurHonors end -->
        <?php endif; ?>
    </ul>
</div>
<?php wp_reset_query(); ?>