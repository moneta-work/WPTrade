<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
  <?php /* If this is a category archive */ if (is_home()) { ?>
		You are here:<a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name');?></a>
  <?php /* If this is a tag archive */ } elseif(is_category()) { ?>
		You are here:<a href="<?php echo get_settings('home'); ?>">home</a> > <?php single_cat_title(); ?>
  <?php /* If this is a search result */ } elseif (is_search()) { ?>
		You are here:<a href="<?php echo get_settings('home'); ?>">home</a> > <?php echo $s; ?>
  <?php /* If this is a tag archive */ } elseif(is_tag()) { ?>
		You are here:<a href="<?php echo get_settings('home'); ?>">home</a> > <?php single_tag_title(); ?>
  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		You are here:<a href="<?php echo get_settings('home'); ?>">home</a> ><?php the_time('Y, F jS'); ?>
  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		You are here:<a href="<?php echo get_settings('home'); ?>">home</a> ><?php the_time('Y, F'); ?>
  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		You are here:<a href="<?php echo get_settings('home'); ?>">home</a> ><?php the_time('Y'); ?>
  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		You are here:<a href="<?php echo get_settings('home'); ?>">home</a> > Author's Article List
  <?php /* If this is a single page */ } elseif (is_single()) { ?>
		You are here:<a href="<?php echo get_settings('home'); ?>">home</a> > <?php the_category(', ') ?> > Pruduct's Detail
  <?php /* If this is a page */ } elseif (is_page()) { ?>
		You are here:<a href="<?php echo get_settings('home'); ?>">home</a> > <?php the_title(); ?>
  <?php /* If this is a 404 error page */ } elseif (is_404()) { ?>
		You are here:<a href="<?php echo get_settings('home'); ?>">home</a> > 404 error page
  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		You are here:<a href="<?php echo get_settings('home'); ?>">home</a> > Archive
  <?php } ?>
<?php wp_reset_query(); ?>