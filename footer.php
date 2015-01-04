<?php
echo '    </div>
    <!-- Container end -->
</div>
<!-- Wrapper end -->
<div class="clear"></div>
<!-- Footer begin -->
<div class="footer">
    <!-- FootPage begin -->
    ';if ( function_exists('wp_nav_menu') ) {;echo '		';wp_nav_menu( array('theme_location'=>'footmenu','container'=>'','depth'=>1,'menu_class'=>'footpage'));;echo '    ';};echo '    <!-- FootPage end -->
    <!-- FriendLink begin -->
	';wp_reset_query();;echo '    ';if (get_option('wpyou_if_friendlink') == '2') {;echo '		
    ';}elseif(get_option('wpyou_if_friendlink') == '1') {;echo '    	';if ( is_home() ) {;echo '            <div class="friendlink">
                <ul>
                	<li><strong>My Links：</strong></li>
                    ';wp_list_bookmarks('title_li=&title_before=&title_after=&categorize=0&orderby=id&order=ASC');;echo '                </ul>
            </div>
        ';};echo '	';}else {;echo '    	<div class="friendlink">
			<ul>
            	<li><strong>My Links：</strong></li>
				';wp_list_bookmarks('title_li=&title_before=&title_after=&categorize=0&orderby=id&order=ASC');;echo '			</ul>
		</div>
    ';};echo '	<!-- FriendLink end -->
    ';if ( get_option('wpyou_footer') ) {;echo '        ';echo stripslashes(get_option('wpyou_footer'));;echo '    ';}else {;echo ' 
        <p>Copyright &copy; ';echo date("Y");;echo ' <a href="';echo get_option('home');;echo '/">';bloginfo('name');;echo '</a> All Rights Reserved.</p>
    ';};echo '    </div>
</div>
<!-- Footer end -->
';wp_footer();;echo '<script type="text/javascript" src="';bloginfo('template_url');;echo '/js/jquery.js"></script>
<script type="text/javascript" src="';bloginfo('template_url');;echo '/js/wpyou.js"></script>
';if (get_option('wpyou_customer')) {;echo '<!-- Customer begin -->
<script type="text/javascript">
	$(document).ready(function(){
			$("#closead").click( function(){$(\'#customer\').css(\'display\',\'none\');})
			var menuYloc = $("#customer").offset().top;
			$(window).scroll(function (){ 
				var offsetTop = menuYloc + $(window).scrollTop() +"px";
				$("#customer").animate({top : offsetTop },{ duration:100 , queue:false });
			});
		});
</script>
<div id="customer" class="png">
	<h3>Customer Service</h3>
	<div class="customcnt">
		';echo get_option('wpyou_customer');;echo '	</div>
	<div class="clear"></div>
	<a href="javascript:void(0)" id="closead">Close</a>
	<div class="clear"></div>
</div>
<!-- Customer end -->
';};echo '<!--[if lte IE 6]>
<script type="text/javascript" src="';bloginfo('template_directory');;echo '/js/DD_belatedPNG.js"></script>
<script type="text/javascript">
	DD_belatedPNG.fix(\'#png, .png, .widget\');
</script>
<![endif]-->
</body>
</html>'
?>