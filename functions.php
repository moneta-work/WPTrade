<?php

if ( function_exists('register_sidebars') )
{
register_sidebar(array(
'name'=>'侧边栏',
'before_title'=>'<h3>',
'after_title'=>'</h3>'
));
}
if ( function_exists( 'add_theme_support')) {add_theme_support( 'post-thumbnails');}
if ( function_exists('add_custom_background')) {add_custom_background();}
if ( function_exists('register_nav_menus')) {register_nav_menus(array('primary'=>'<b style="font-style:normal; color:#F00;">顶部菜单</b> 设置'));}
if ( function_exists('register_nav_menus')) {register_nav_menus(array('footmenu'=>'<b style="font-style:normal; color:#F00;">底部菜单</b> 设置'));}
function catch_post_image() {
global $post,$posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$post->post_content,$matches);
$first_img = $matches [1] [0];
if(empty($first_img)){
$site_url = bloginfo('template_url');
$first_img = "$site_url/images/no-thumb.jpg";
}
return $first_img;
}
function post_is_in_descendant_category( $cats,$_post = null )
{
foreach ( (array) $cats as $cat ) {
$descendants = get_term_children( (int) $cat,'category');
if ( $descendants &&in_category( $descendants,$_post ) )
return true;
}
return false;
}
function wpyou_strimwidth($str ,$start ,$width ,$trimmarker ){
$output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
return $output.$trimmarker;
}
function wpyou_pagenavi($range = 9){
global $paged,$wp_query;
if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
if($max_page >1){if(!$paged){$paged = 1;}
if($paged != 1){echo "<a href='".get_pagenum_link(1) ."' class='extend' title='First'>First</a>";}
previous_posts_link('Previous');
if($max_page >$range){
if($paged <$range){for($i = 1;$i <= ($range +1);$i++){echo "<a href='".get_pagenum_link($i) ."'";
if($i==$paged)echo " class='current'";echo ">$i</a>";}}
elseif($paged >= ($max_page -ceil(($range/2)))){
for($i = $max_page -$range;$i <= $max_page;$i++){echo "<a href='".get_pagenum_link($i) ."'";
if($i==$paged)echo " class='current'";echo ">$i</a>";}}
elseif($paged >= $range &&$paged <($max_page -ceil(($range/2)))){
for($i = ($paged -ceil($range/2));$i <= ($paged +ceil(($range/2)));$i++){echo "<a href='".get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
else{for($i = 1;$i <= $max_page;$i++){echo "<a href='".get_pagenum_link($i) ."'";
if($i==$paged)echo " class='current'";echo ">$i</a>";}}
next_posts_link('Next');
if($paged != $max_page){echo "<a href='".get_pagenum_link($max_page) ."' class='extend' title='Last'>Last</a>";}
}
}
function custom_comment($comment,$args,$depth) {
$GLOBALS['comment'] = $comment;;echo '   <li ';comment_class();;echo ' id="li-comment-';comment_ID() ;echo '">
     <div id="comment-';comment_ID();;echo '">
         <div class="comment-author vcard">
                ';;echo '                <div class="author_info">
					';printf(__('<cite class="fn">%s</cite>'),get_comment_author_link()) ;echo ' ';edit_comment_link(__('(Edit)'),'  ','') ;echo '<br />
                    <em>';printf(__('%1$s at %2$s'),get_comment_date('Y/m/d '),get_comment_time(' H:i:s')) ;echo '</em>
                </div>
                <div class="reply">
			   		';comment_reply_link(array_merge( $args,array('depth'=>$depth,'max_depth'=>$args['max_depth']))) ;echo '              	</div>
          </div>
		  ';if ($comment->comment_approved == '0') : ;echo '             <em>';_e('Your comment is awaiting moderation.') ;echo '</em>
             <br />
          ';endif;;echo '      		';comment_text() ;echo '     </div>
';};echo '';
$themename = "当前主题";
$theme_dir=get_bloginfo('template_url');
if ( is_admin() ){
wp_enqueue_style("functions",$theme_dir."/options/css/wpyouthemeoption.css",false,"all");
}
function wpyou_add_option() {
global $themename;
add_menu_page($themename.'设置',''.$themename.'设置',10,'theme-setup','wpyou_options',get_bloginfo('template_url').'/options/images/icon_wpyou.png','3');
add_submenu_page('theme-setup','主题设置','主题设置',10,'theme-setup','wpyou_options');
add_action( 'admin_init','register_mysettings');
}
function register_mysettings() {
register_setting( 'wpyou-settings','wpyou_cnsite_url');
register_setting( 'wpyou-settings','wpyou_ensite_url');
register_setting( 'wpyou-settings','wpyou_news_id');
register_setting( 'wpyou-settings','wpyou_products_id');
register_setting( 'wpyou-settings','wpyou_news_perpage');
register_setting( 'wpyou-settings','wpyou_customer');
register_setting( 'wpyou-settings','wpyou_aboutus');
register_setting( 'wpyou-settings','wpyou_contactus');
register_setting( 'wpyou-settings','wpyou_newposts_homepage');
register_setting( 'wpyou-settings','wpyou_hotposts_homepage');
register_setting( 'wpyou-settings','wpyou_if_seo');
register_setting( 'wpyou-settings','wpyou_homepage_title');
register_setting( 'wpyou-settings','wpyou_homepage_description');
register_setting( 'wpyou-settings','wpyou_homepage_keywords');
register_setting( 'wpyou-settings','wpyou_homepage_keywords_separater');
register_setting( 'wpyou-settings','wpyou_if_friendlink');
register_setting( 'wpyou-settings','wpyou_footer');
}
function wpyou_options() {
global $themename;
;echo '<!-- Options Form begin -->
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br/></div>
	<h2>WPTradeD外贸主题设置</h2>
    <ul class="subsubsub wpyounavi">
        <li><a href="#wpyou_bs"><strong>基本设置</strong></a> |</li>
        <li><a href="#wpyou_hp"><strong>首页设置</strong></a> |</li>
    	<li><a href="#wpyou_seo"><strong>SEO设置</strong></a> |</li>
        <li><a href="#wpyou_ft"><strong>底部设置</strong></a></li>
    </ul>
	<form method="post" action="options.php">
		';settings_fields('wpyou-settings');;echo '		<table class="form-table wpyou-form">
            <tr valign="top" class="toptitle">
            	<th><h3 id="wpyou_bs">基本设置</h3></th>
                <td></td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>自定义菜单设置方法<span class="description"></span></label></th>
                <td>
                <span class="description">
                    本主题共有2个自定义菜单,分别为: <strong>顶部菜单、底部菜单</strong>
                    <br />
                    ▪ <strong>请在<a href=\'nav-menus.php\'>【外观 - 菜单(导航菜单)】</a>里设置每个菜单的内容</strong>
                    <br />
                    ▪ <a href=\'http://www.wpyou.com/wordpress-3-0-operation-and-usage-of-navigation-menu.html\' target=\'_blank\'><strong>如何创建使用自定义菜单？</strong></a>
                    <br />
                    ▪ 自定义菜单功能需要在WordPress 3.0以上版本支持 
                 </span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>中文版网址<span class="description">(URL)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" name="wpyou_cnsite_url" value="';echo get_option('wpyou_cnsite_url');;echo '" />
                    <br />
                    <span class="description">设置中文版网站的网址 (带"http://"的完整URL地址)</span>
                </td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>英文版网址<span class="description">(URL)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" name="wpyou_ensite_url" value="';echo get_option('wpyou_ensite_url');;echo '" />
                    <br />
                    <span class="description">设置英文版网站的网址 (带"http://"的完整URL地址)</span>
                </td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>在线客服<span class="description">(HTML)</span></label></th>
                <td class="customset">
                	<textarea class="wpyoutextarea" name="wpyou_customer">';echo get_option('wpyou_customer');;echo '</textarea>
                    <span class="description">
                        设置在线客服的显示内容(<strong>页面右侧滑动显示</strong>), 支持HTML
                        <br />
                        ▪ 内容为空时, 不显示
                     </span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>新闻动态分类ID<span class="description">(数值)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" name="wpyou_news_id" value="';echo get_option('wpyou_news_id');;echo '" />
                    <br />
                    <span class="description">设置首页 新闻动态 分类ID (多个ID间用英文逗号","隔开, 例如: 1,2,3)<br /><br />▪ <a title="如何查看分类ID" href="http://www.wpyou.com/how-to-find-the-category-id.html" target="_blank">如何获取分类ID</a></span>
                </td>
        	</tr>
            <tr valign="top" class="alt">
                <th scope="row"><label><strong>新闻列表页显示文章数</strong><span class="description">(数值)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" value="';echo get_option('wpyou_news_perpage');;echo '" name="wpyou_news_perpage"/>
                    <br />
                    <span class="description">设置 新闻列表页 面显示的文章数目(默认为20)</span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>产品分类ID<span class="description">(数值)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" name="wpyou_products_id" value="';echo get_option('wpyou_products_id');;echo '" />
                    <br />
                    <span class="description">设置产品分类ID (只设置 产品总类ID 即可)<br />▪ <a title="如何查看分类ID" href="http://www.wpyou.com/how-to-find-the-category-id.html" target="_blank">如何获取分类ID</a></span>
                </td>
        	</tr>
            <tr valign="top">
                <th scope="row"></th>
                <td>
                    <input type="submit" name="save" id="button-primary" class="button-primary" value="';_e('Save Changes') ;echo '" />
                </td>
            </tr>
            
			<tr valign="top" class="toptitle">
            	<th><h3 id="wpyou_hp">首页设置</h3></th>
                <td></td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>企业简介<span class="description">(文本)</span></label></th>
                <td>
                	<textarea class="wpyoutextarea" name="wpyou_aboutus"/>';echo get_option('wpyou_aboutus');;echo '</textarea>
                    <div class="clearfix"></div>
                    <span class="description">设置首页右侧显示的企业简介内容 (支持HTML)</span>
                </td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>联系我们<span class="description">(文本)</span></label></th>
                <td>
                	<textarea class="wpyoutextarea" name="wpyou_contactus"/>';echo get_option('wpyou_contactus');;echo '</textarea>
                    <div class="clearfix"></div>
                    <span class="description">设置首页右侧显示的联系我们内容 (支持HTML)</span>
                </td>
        	</tr>
            <tr valign="top" class="alt">
                <th scope="row"><label><strong>最新产品数</strong><span class="description">(数值)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" value="';echo get_option('wpyou_newposts_homepage');;echo '" name="wpyou_newposts_homepage"/>
                    <br />
                    <span class="description">设置 首页显示 最新产品数 (默认为6)<br />▪ 数字最好为 3 的倍数</span>
                </td>
            </tr>
            <tr valign="top" class="alt">
                <th scope="row"><label><strong>最热产品数</strong><span class="description">(数值)</span></label></th>
                <td>
                    <input class="regular-text" style="width:35em;" type="text" value="';echo get_option('wpyou_hotposts_homepage');;echo '" name="wpyou_hotposts_homepage"/>
                    <br />
                    <span class="description">设置 首页显示 最热产品数 (默认为6)<br />▪ 数字最好为 3 的倍数</span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"></th>
                <td>
                    <input type="submit" name="save" id="button-primary" class="button-primary" value="';_e('Save Changes') ;echo '" />
                </td>
            </tr>
			
            <tr valign="top" class="toptitle">
            	<th><h3 id="wpyou_seo">SEO设置</h3></th>
                <td>自定义网站的SEO设置,更加有利于搜索引擎优化收录</td>
        	</tr>
            <tr valign="top">
                <th scope="row"><label>是否开启自定义SEO<span class="description"></span></label></th>
                <td>
                    <input type="checkbox" name="wpyou_if_seo" value="0" ';if (get_option('wpyou_if_seo') == '0') {echo 'checked="checked"';};echo ' /><label class="description"> 选中为开启</label>
                    <br />
                    <span class="description">▪ 默认为开启, 若使用了其他SEO插件，请不要开启此功能<br />▪ 如关闭(不选中)此功能, 则以下所有SEO设置都将失效</span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>首页标题<span class="description">(文本)</span></label></th>
                <td>
                    <input class="regular-text" style="width:45em; height:3em;" type="text" value="';echo get_option('wpyou_homepage_title');;echo '" name="wpyou_homepage_title"/>
                    <br />
                    <span class="description">设置首页标题, 此项内容将和网站名称一起组成首页的Title</span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>首页描述<span class="description">(文本)</span></label></th>
                <td>
                    <textarea class="txtad" style="width:45em; height:6em;" name="wpyou_homepage_description">';echo get_option('wpyou_homepage_description');;echo '</textarea>
                    <br />
                    <span class="description">设置首页描述信息</span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>首页关键字列表<span class="description">(文本)</span></label></th>
                <td>
                    <textarea class="txtad" style="width:45em; height:6em;" name="wpyou_homepage_keywords">';echo get_option('wpyou_homepage_keywords');;echo '</textarea>
                    <br />
                    <span class="description">设置首页关键字列表(多个关键字之间用英文","逗号隔开)</span>
                </td>
            </tr>
            <tr valign="top" class="alt">
                <th scope="row"><label><strong>间隔符</strong><br /><span class="description"></span></label></th>
                <td>
                    <input class="regular-text" style="width:10em;" type="text" value="';echo get_option('wpyou_homepage_keywords_separater');;echo '" name="wpyou_homepage_keywords_separater"/>
                    <br />
                    <span class="description">设置标题间隔符(可使用" - " 或 " _ " 或 " | "等)<br />▪ 例如使用" - "后的格式为: 文章标题 - 网站名称, 分类名称 - 网站名称<br />▪ 默认为" - " </span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"></th>
                <td>
                    <input type="submit" name="save" id="button-primary" class="button-primary" value="';_e('Save Changes') ;echo '" />
                </td>
            </tr>
            
            <tr valign="top" class="toptitle">
            	<th><h3 id="wpyou_ft">底部设置</h3></th>
                <td></td>
        	</tr>
            <tr valign="top">
            	<th scope="row"><label>友情链接显示位置<span class="description"></span></label></th>
                <td>
                	<select name="wpyou_if_friendlink">
                    	<option value="2" ';if (get_option('wpyou_if_friendlink') == '2') {echo 'selected="selected"';};echo '>不显示</option>
                        <option value="1" ';if (get_option('wpyou_if_friendlink') == '1') {echo 'selected="selected"';};echo '>首页显示</option>
                        <option value="0" ';if (get_option('wpyou_if_friendlink') == '0') {echo 'selected="selected"';};echo '>全站显示</option>
                    </select>
                     <span class="description">(默认为 全站显示)</span>
                    <br />
                    <span class="description">设置网站底部 友情链接 模块的显示位置</span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>底部内容设置 <span class="description">(文本)</span></label></th>
                <td>
                    <textarea class="wpyoutextarea" name="wpyou_footer">';echo get_option('wpyou_footer');;echo '</textarea>
                    <br />
                    <span class="description">设置网站底部显示的内容 (支持HTML)</span>
                </td>
        	</tr>
            <tr valign="top">
                <th scope="row"></th>
                <td>
                    <input type="submit" name="save" id="button-primary" class="button-primary" value="';_e('Save Changes') ;echo '" />
                </td>
            </tr>
		</table>
	</form>
</div>
<script type="text/javascript">
var $j = jQuery.noConflict();
	$j(document).ready(function() {
		$j(".wpyoutextarea").markItUp(mySettings);
});
// markItUp! include \'jquery.markitup.js\' file
(function($) {
	$.fn.markItUp = function(settings, extraSettings) {
		var options, ctrlKey, shiftKey, altKey;
		ctrlKey = shiftKey = altKey = false;

		options = {	id:						\'\',
					nameSpace:				\'\',
					root:					\'\',
					previewInWindow:		\'\', // \'width=800, height=600, resizable=yes, scrollbars=yes\'
					previewAutoRefresh:		true,
					previewPosition:		\'after\',
					previewTemplatePath:	\'';bloginfo('template_url');;echo '/options/markitup/templates/preview.html\',
					previewParserPath:		\'\',
					previewParserVar:		\'data\',
					resizeHandle:			true,
					beforeInsert:			\'\',
					afterInsert:			\'\',
					onEnter:				{},
					onShiftEnter:			{},
					onCtrlEnter:			{},
					onTab:					{},
					markupSet:			[	{ /* set */ } ]
				};
		$.extend(options, settings, extraSettings);

		// compute markItUp! path
		if (!options.root) {
			$(\'script\').each(function(a, tag) {
				miuScript = $(tag).get(0).src.match(/(.*)jquery\\.markitup(\\.pack)?\\.js$/);
				if (miuScript !== null) {
					options.root = miuScript[1];
				}
			});
		}

		return this.each(function() {
			var $$, textarea, levels, scrollPosition, caretPosition, caretOffset,
				clicked, hash, header, footer, previewWindow, template, iFrame, abort;
			$$ = $(this);
			textarea = this;
			levels = [];
			abort = false;
			scrollPosition = caretPosition = 0;
			caretOffset = -1;

			options.previewParserPath = localize(options.previewParserPath);
			options.previewTemplatePath = localize(options.previewTemplatePath);

			// apply the computed path to ~/
			function localize(data, inText) {
				if (inText) {
					return 	data.replace(/("|\')~\\//g, "$1"+options.root);
				}
				return 	data.replace(/^~\\//, options.root);
			}

			// init and build editor
			function init() {
				id = \'\'; nameSpace = \'\';
				if (options.id) {
					id = \'id="\'+options.id+\'"\';
				} else if ($$.attr("id")) {
					id = \'id="markItUp\'+($$.attr("id").substr(0, 1).toUpperCase())+($$.attr("id").substr(1))+\'"\';

				}
				if (options.nameSpace) {
					nameSpace = \'class="\'+options.nameSpace+\'"\';
				}
				$$.wrap(\'<div \'+nameSpace+\'></div>\');
				$$.wrap(\'<div \'+id+\' class="markItUp"></div>\');
				$$.wrap(\'<div class="markItUpContainer"></div>\');
				$$.addClass("markItUpEditor");

				// add the header before the textarea
				header = $(\'<div class="markItUpHeader"></div>\').insertBefore($$);
				$(dropMenus(options.markupSet)).appendTo(header);

				// add the footer after the textarea
				footer = $(\'<div class="markItUpFooter"></div>\').insertAfter($$);

				// add the resize handle after textarea
				if (options.resizeHandle === true && $.browser.safari !== true) {
					resizeHandle = $(\'<div class="markItUpResizeHandle"></div>\')
						.insertAfter($$)
						.bind("mousedown", function(e) {
							var h = $$.height(), y = e.clientY, mouseMove, mouseUp;
							mouseMove = function(e) {
								$$.css("height", Math.max(20, e.clientY+h-y)+"px");
								return false;
							};
							mouseUp = function(e) {
								$("html").unbind("mousemove", mouseMove).unbind("mouseup", mouseUp);
								return false;
							};
							$("html").bind("mousemove", mouseMove).bind("mouseup", mouseUp);
					});
					footer.append(resizeHandle);
				}

				// listen key events
				$$.keydown(keyPressed).keyup(keyPressed);
				
				// bind an event to catch external calls
				$$.bind("insertion", function(e, settings) {
					if (settings.target !== false) {
						get();
					}
					if (textarea === $.markItUp.focused) {
						markup(settings);
					}
				});

				// remember the last focus
				$$.focus(function() {
					$.markItUp.focused = this;
				});
			}

			// recursively build header with dropMenus from markupset
			function dropMenus(markupSet) {
				var ul = $(\'<ul></ul>\'), i = 0;
				$(\'li:hover > ul\', ul).css(\'display\', \'block\');
				$.each(markupSet, function() {
					var button = this, t = \'\', title, li, j;
					title = (button.key) ? (button.name||\'\')+\' [Ctrl+\'+button.key+\']\' : (button.name||\'\');
					key   = (button.key) ? \'accesskey="\'+button.key+\'"\' : \'\';
					if (button.separator) {
						li = $(\'<li class="markItUpSeparator">\'+(button.separator||\'\')+\'</li>\').appendTo(ul);
					} else {
						i++;
						for (j = levels.length -1; j >= 0; j--) {
							t += levels[j]+"-";
						}
						li = $(\'<li class="markItUpButton markItUpButton\'+t+(i)+\' \'+(button.className||\'\')+\'"><a href="" \'+key+\' title="\'+title+\'">\'+(button.name||\'\')+\'</a></li>\')
						.bind("contextmenu", function() { // prevent contextmenu on mac and allow ctrl+click
							return false;
						}).click(function() {
							return false;
						}).mousedown(function() {
							if (button.call) {
								eval(button.call)();
							}
							setTimeout(function() { markup(button) },1);
							return false;
						}).hover(function() {
								$(\'> ul\', this).show();
								$(document).one(\'click\', function() { // close dropmenu if click outside
										$(\'ul ul\', header).hide();
									}
								);
							}, function() {
								$(\'> ul\', this).hide();
							}
						).appendTo(ul);
						if (button.dropMenu) {
							levels.push(i);
							$(li).addClass(\'markItUpDropMenu\').append(dropMenus(button.dropMenu));
						}
					}
				}); 
				levels.pop();
				return ul;
			}

			// markItUp! markups
			function magicMarkups(string) {
				if (string) {
					string = string.toString();
					string = string.replace(/\\(\\!\\(([\\s\\S]*?)\\)\\!\\)/g,
						function(x, a) {
							var b = a.split(\'|!|\');
							if (altKey === true) {
								return (b[1] !== undefined) ? b[1] : b[0];
							} else {
								return (b[1] === undefined) ? "" : b[0];
							}
						}
					);
					// [![prompt]!], [![prompt:!:value]!]
					string = string.replace(/\\[\\!\\[([\\s\\S]*?)\\]\\!\\]/g,
						function(x, a) {
							var b = a.split(\':!:\');
							if (abort === true) {
								return false;
							}
							value = prompt(b[0], (b[1]) ? b[1] : \'\');
							if (value === null) {
								abort = true;
							}
							return value;
						}
					);
					return string;
				}
				return "";
			}

			// prepare action
			function prepare(action) {
				if ($.isFunction(action)) {
					action = action(hash);
				}
				return magicMarkups(action);
			}

			// build block to insert
			function build(string) {
				openWith 	= prepare(clicked.openWith);
				placeHolder = prepare(clicked.placeHolder);
				replaceWith = prepare(clicked.replaceWith);
				closeWith 	= prepare(clicked.closeWith);
				if (replaceWith !== "") {
					block = openWith + replaceWith + closeWith;
				} else if (selection === \'\' && placeHolder !== \'\') {
					block = openWith + placeHolder + closeWith;
				} else {
					block = openWith + (string||selection) + closeWith;
				}
				return {	block:block, 
							openWith:openWith, 
							replaceWith:replaceWith, 
							placeHolder:placeHolder,
							closeWith:closeWith
					};
			}

			// define markup to insert
			function markup(button) {
				var len, j, n, i;
				hash = clicked = button;
				get();

				$.extend(hash, {	line:"", 
						 			root:options.root,
									textarea:textarea, 
									selection:(selection||\'\'), 
									caretPosition:caretPosition,
									ctrlKey:ctrlKey, 
									shiftKey:shiftKey, 
									altKey:altKey
								}
							);
				// callbacks before insertion
				prepare(options.beforeInsert);
				prepare(clicked.beforeInsert);
				if (ctrlKey === true && shiftKey === true) {
					prepare(clicked.beforeMultiInsert);
				}			
				$.extend(hash, { line:1 });
				
				if (ctrlKey === true && shiftKey === true) {
					lines = selection.split(/\\r?\\n/);
					for (j = 0, n = lines.length, i = 0; i < n; i++) {
						if ($.trim(lines[i]) !== \'\') {
							$.extend(hash, { line:++j, selection:lines[i] } );
							lines[i] = build(lines[i]).block;
						} else {
							lines[i] = "";
						}
					}
					string = { block:lines.join(\'\\n\')};
					start = caretPosition;
					len = string.block.length + (($.browser.opera) ? n : 0);
				} else if (ctrlKey === true) {
					string = build(selection);
					start = caretPosition + string.openWith.length;
					len = string.block.length - string.openWith.length - string.closeWith.length;
					len -= fixIeBug(string.block);
				} else if (shiftKey === true) {
					string = build(selection);
					start = caretPosition;
					len = string.block.length;
					len -= fixIeBug(string.block);
				} else {
					string = build(selection);
					start = caretPosition + string.block.length ;
					len = 0;
					start -= fixIeBug(string.block);
				}
				if ((selection === \'\' && string.replaceWith === \'\')) {
					caretOffset += fixOperaBug(string.block);
					
					start = caretPosition + string.openWith.length;
					len = string.block.length - string.openWith.length - string.closeWith.length;

					caretOffset = $$.val().substring(caretPosition,  $$.val().length).length;
					caretOffset -= fixOperaBug($$.val().substring(0, caretPosition));
				}
				$.extend(hash, { caretPosition:caretPosition, scrollPosition:scrollPosition } );

				if (string.block !== selection && abort === false) {
					insert(string.block);
					set(start, len);
				} else {
					caretOffset = -1;
				}
				get();

				$.extend(hash, { line:\'\', selection:selection });

				// callbacks after insertion
				if (ctrlKey === true && shiftKey === true) {
					prepare(clicked.afterMultiInsert);
				}
				prepare(clicked.afterInsert);
				prepare(options.afterInsert);

				// refresh preview if opened
				if (previewWindow && options.previewAutoRefresh) {
					refreshPreview(); 
				}
																									
				// reinit keyevent
				shiftKey = altKey = ctrlKey = abort = false;
			}

			// Substract linefeed in Opera
			function fixOperaBug(string) {
				if ($.browser.opera) {
					return string.length - string.replace(/\\n*/g, \'\').length;
				}
				return 0;
			}
			// Substract linefeed in IE
			function fixIeBug(string) {
				if ($.browser.msie) {
					return string.length - string.replace(/\\r*/g, \'\').length;
				}
				return 0;
			}
				
			// add markup
			function insert(block) {	
				if (document.selection) {
					var newSelection = document.selection.createRange();
					newSelection.text = block;
				} else {
					$$.val($$.val().substring(0, caretPosition)	+ block + $$.val().substring(caretPosition + selection.length, $$.val().length));
				}
			}

			// set a selection
			function set(start, len) {
				if (textarea.createTextRange){
					// quick fix to make it work on Opera 9.5
					if ($.browser.opera && $.browser.version >= 9.5 && len == 0) {
						return false;
					}
					range = textarea.createTextRange();
					range.collapse(true);
					range.moveStart(\'character\', start); 
					range.moveEnd(\'character\', len); 
					range.select();
				} else if (textarea.setSelectionRange ){
					textarea.setSelectionRange(start, start + len);
				}
				textarea.scrollTop = scrollPosition;
				textarea.focus();
			}

			// get the selection
			function get() {
				textarea.focus();

				scrollPosition = textarea.scrollTop;
				if (document.selection) {
					selection = document.selection.createRange().text;
					if ($.browser.msie) { // ie
						var range = document.selection.createRange(), rangeCopy = range.duplicate();
						rangeCopy.moveToElementText(textarea);
						caretPosition = -1;
						while(rangeCopy.inRange(range)) { // fix most of the ie bugs with linefeeds...
							rangeCopy.moveStart(\'character\');
							caretPosition ++;
						}
					} else { // opera
						caretPosition = textarea.selectionStart;
					}
				} else { // gecko & webkit
					caretPosition = textarea.selectionStart;
					selection = $$.val().substring(caretPosition, textarea.selectionEnd);
				} 
				return selection;
			}

			// open preview window
			function preview() {
				if (!previewWindow || previewWindow.closed) {
					if (options.previewInWindow) {
						previewWindow = window.open(\'\', \'preview\', options.previewInWindow);
					} else {
						iFrame = $(\'<iframe class="markItUpPreviewFrame"></iframe>\');
						if (options.previewPosition == \'after\') {
							iFrame.insertAfter(footer);
						} else {
							iFrame.insertBefore(header);
						}	
						previewWindow = iFrame[iFrame.length - 1].contentWindow || frame[iFrame.length - 1];
					}
				} else if (altKey === true) {
					// Thx Stephen M. Redd for the IE8 fix
					if (iFrame) {
						iFrame.remove();
					} else {
						previewWindow.close();
					}
					previewWindow = iFrame = false;
				}
				if (!options.previewAutoRefresh) {
					refreshPreview(); 
				}
			}

			// refresh Preview window
			function refreshPreview() {
 				renderPreview();
			}

			function renderPreview() {		
				var phtml;
				if (options.previewParserPath !== \'\') {
					$.ajax( {
						type: \'POST\',
						url: options.previewParserPath,
						data: options.previewParserVar+\'=\'+encodeURIComponent($$.val()),
						success: function(data) {
							writeInPreview( localize(data, 1) ); 
						}
					} );
				} else {
					if (!template) {
						$.ajax( {
							url: options.previewTemplatePath,
							success: function(data) {
								writeInPreview( localize(data, 1).replace(/<!-- content -->/g, $$.val()) );
							}
						} );
					}
				}
				return false;
			}
			
			function writeInPreview(data) {
				if (previewWindow.document) {			
					try {
						sp = previewWindow.document.documentElement.scrollTop
					} catch(e) {
						sp = 0;
					}	
					previewWindow.document.open();
					previewWindow.document.write(data);
					previewWindow.document.close();
					previewWindow.document.documentElement.scrollTop = sp;
				}
				if (options.previewInWindow) {
					previewWindow.focus();
				}
			}
			
			// set keys pressed
			function keyPressed(e) { 
				shiftKey = e.shiftKey;
				altKey = e.altKey;
				ctrlKey = (!(e.altKey && e.ctrlKey)) ? e.ctrlKey : false;

				if (e.type === \'keydown\') {
					if (ctrlKey === true) {
						li = $("a[accesskey="+String.fromCharCode(e.keyCode)+"]", header).parent(\'li\');
						if (li.length !== 0) {
							ctrlKey = false;
							setTimeout(function() {
								li.triggerHandler(\'mousedown\');
							},1);
							return false;
						}
					}
					if (e.keyCode === 13 || e.keyCode === 10) { // Enter key
						if (ctrlKey === true) {  // Enter + Ctrl
							ctrlKey = false;
							markup(options.onCtrlEnter);
							return options.onCtrlEnter.keepDefault;
						} else if (shiftKey === true) { // Enter + Shift
							shiftKey = false;
							markup(options.onShiftEnter);
							return options.onShiftEnter.keepDefault;
						} else { // only Enter
							markup(options.onEnter);
							return options.onEnter.keepDefault;
						}
					}
					if (e.keyCode === 9) { // Tab key
						if (shiftKey == true || ctrlKey == true || altKey == true) { // Thx Dr Floob.
							return false; 
						}
						if (caretOffset !== -1) {
							get();
							caretOffset = $$.val().length - caretOffset;
							set(caretOffset, 0);
							caretOffset = -1;
							return false;
						} else {
							markup(options.onTab);
							return options.onTab.keepDefault;
						}
					}
				}
			}

			init();
		});
	};

	$.fn.markItUpRemove = function() {
		return this.each(function() {
				var $$ = $(this).unbind().removeClass(\'markItUpEditor\');
				$$.parent(\'div\').parent(\'div.markItUp\').parent(\'div\').replaceWith($$);
			}
		);
	};

	$.markItUp = function(settings) {
		var options = { target:false };
		$.extend(options, settings);
		if (options.target) {
			return $(options.target).each(function() {
				$(this).focus();
				$(this).trigger(\'insertion\', [options]);
			});
		} else {
			$(\'textarea\').trigger(\'insertion\', [options]);
		}
	};
})(jQuery);
</script>
<!-- Options Form begin -->
';}
$theme_dir=get_bloginfo('template_url');
if ( is_admin() ){
wp_enqueue_style("style-markitup",$theme_dir."/options/markitup/skins/markitup/style.css",false,"all");
wp_enqueue_style("style-sets",$theme_dir."/options/markitup/sets/html/style.css",false,"all");
wp_enqueue_script("script-markitup",$theme_dir."/options/markitup/jquery.markitup.js",false,"all");
wp_enqueue_script("script-set",$theme_dir."/options/markitup/sets/html/set.js",false,"all");
}
add_action('admin_menu','wpyou_add_option');
?>