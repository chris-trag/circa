<?php
function tweet_fetch($username, $num){
	$feed = "http://search.twitter.com/search.json?q=from:" . $username . "&amp;rpp=" . $num;
	 
	$newfile = dirname(__FILE__)."/cache/{$username}-twitternew.json";
	$file = dirname(__FILE__)."/cache/{$username}-twitter.json";
	 
	copy($feed, $newfile);
	 
	$oldcontent = @file_get_contents($file);
	$newcontent = @file_get_contents($newfile);
	 
	if($oldcontent != $newcontent) {
	copy($newfile, $file);
	}
	$tweets = @file_get_contents($file);
	 
	$tweets = json_decode($tweets);
	 
	echo "<ul class=\"scroll\">";
	for($x=0;$x<$num;$x++) {
	$str = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\">\\0</a>", $tweets->results[$x]->text);
	$pattern = '/[#|@][^\s]*/';
	preg_match_all($pattern, $str, $matches);	
	 
	foreach($matches[0] as $keyword) {
	$keyword = str_replace(")","",$keyword);
	$link = str_replace("#","%23",$keyword);
	$link = str_replace("@","",$keyword);
	if(strstr($keyword,"@")) {
	$search = "<a href=\"http://twitter.com/$link\">$keyword</a>";
	} else {
	$link = urlencode($link);
	$search = "<a href=\"http://twitter.com/#search?q=$link\" class=\"grey\">$keyword</a>";
	}
	$str = str_replace($keyword, $search, $str);
	}
	$avatar = $tweets->results[$x]->profile_image_url;
	$time = ago(strtotime($tweets->results[$x]->created_at));
	$tweet_id = $tweets->results[$x]->id_str;
	//http://twitter.com/marcamos/status/8009729116733440
	echo "<li><a href=\"http://twitter.com/{$username}\" class=\"avatar\"><img src=\"{$avatar}\"/></a>".$str."<span class=\"date\"><a href=\"http://twitter.com/{$username}/status/{$tweet_id}\">{$time}</a></span></li>\n";
	}
	echo "</ul>";
}

function ago($timestamp){
   $difference = time() - $timestamp;
   $periods = array("second", "minute", "hour", "day", "week", "month", "years", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");
   for($j = 0; $difference >= $lengths[$j]; $j++)
   $difference /= $lengths[$j];
   $difference = round($difference);
   if($difference != 1) $periods[$j].= "s";
   $text = "$difference $periods[$j] ago";
   return $text;
  }


?>