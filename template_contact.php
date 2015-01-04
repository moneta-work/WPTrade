<?php
/*
Template Name: Feedback - Template
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
    <!-- Single begin -->
    <div class="single">
        <h2><?php the_title(); ?></h2> 
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                    <?php the_content(' '); ?>
                <!-- Post Comment begin -->
                <div class="post_comment">
                    <?php comments_template(''); ?>
                </div>
                <!-- Post Comment end -->
            <?php endwhile; ?>
       	<?php else : ?>
       		<div class="error">
                <h2>404 Error</h2>
                <p>
                    <strong>No product matched</strong><br />
                    Sorry, no product matched your criteria! <a href="<?php echo get_settings('home'); ?>">You can back home</a>
                </p>
            </div>
        <?php endif; ?>
    </div>
    <!-- Single end -->
</div>
<!-- Content end -->
<?php get_footer(); ?>