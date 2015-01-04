<?php
 if (get_option('wpyou_news_id')){
$newsCats = get_option('wpyou_news_id');
$newsArrays = explode(",",$newsCats);}
if(in_category($newsArrays) ||post_is_in_descendant_category( $newsArrays )){include('archive_main.php');}
else{include('archive_products.php');}
?>