<?php get_header(); ?>
<!-- Sidebar begin -->
<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
<!-- Sidebar end -->
<!-- Content begin -->
<div class="content error">
	<!-- Breadcrumb begin -->
    <div class="breadcrumb">
		<?php include (TEMPLATEPATH . '/breadcrumb.php'); ?>
    </div>
    <!-- Breadcrumb end -->
    <div class="clear"></div>
	<div class="error">
        <h2>404 Error</h2>
        <p>
            <strong>Nothing Found</strong><br />
            Sorry, no posts matched your criteria! <a href="<?php echo get_settings('home'); ?>">You can back home</a>
        </p>
    </div>
</div>
<!-- Content end -->
<?php get_footer(); ?>