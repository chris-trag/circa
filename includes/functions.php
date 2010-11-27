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

function makeRich($text)
{
	/* 
	 * Replacing '@user' and 'http' with hypertext
	 */
	$pattern = "/(http:\/\/\S+)/"; // hyperlink pattern
	
	if(preg_match($pattern, $text)){
		$text = preg_replace($pattern, "<a href='$1'>$1</a>", $text);
	}
	
	// find hash tags
	if(preg_match("/(^|\s)#(\w+)/", $text)){
		$text = preg_replace('/(^|\s)#(\w+)/','\1<a href="http://twitter.com/search/%23\2">#\2</a>',$text);
	}
	
	// find and link users
	if(preg_match("/@([^()#@\s\,]+)/", $text)){
		$text = preg_replace("/@([^()#@\s\,]+)/", "<a href='http://twitter.com/$1'>@$1</a>", $text);
	}
	
	return $text;
}


function twitter_stream($keyword){
	$feed = "http://search.twitter.com/search.json?geocode=42.380054%2C-71.132952%2C50.0mi&lang=en&q=+{$keyword}+since%3A2010-11-26+until%3A2010-11-26+near%3A02138+within%3A50mi&rpp=100";
	$newfile = dirname(__FILE__)."/cache/terms/{$keyword}-twitternew.json";
	$file = dirname(__FILE__)."/cache/terms/{$keyword}-twitter.json";
	
	copy($feed, $newfile);
	$oldcontent = @file_get_contents($file);
	$newcontent = @file_get_contents($newfile);

	if($oldcontent != $newcontent) {
	copy($newfile, $file);
	}
	$tweets = json_decode(@file_get_contents($file));
	 echo count($tweets->results);
	for($x =0; $x < count($tweets->results); $x++){
		$thumb = $tweets->results[$x]->profile_image_url;
		$created = ago(strtotime($tweets->results[$x]->created_at));
		$user = $tweets->results[$x]->from_user;
		$tweet_id = $tweets->results[$x]->id_str;
		$tweet = makeRich($tweets->results[$x]->text);
		?>
		<div class="chunk">
			<a href="http://twitter.com/<?php echo $user;?>" class="avatar"><img src="<?php echo $thumb;?>" width="48" height="48" title="<?php echo $user;?>" /></a>
			<span class="tweet">
				<span class="user"><a href="http://twitter.com/<?php echo $user;?>"><?php echo $user;?></a></span>
				<br /><?php echo $tweet; ?>
			</span>
			<span class="date">
				<a href="http://twitter.com/<?php echo $user;?>/status/<?php echo $tweet_id;?>/"><?php echo $created; ?></a>
			</span>
		</div><!-- exit div.chunk -->
		<?php // continue php
	}
}
?>