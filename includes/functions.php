<?php
/*  
Function tweetFetch()
calls out to the Twitter API and collect specific user
tweets up to the number specified.
*/

function tweetCompress($username){
	$fileHandle = fopen(dirname(__FILE__).'/cache/circa.json', 'w+')
		or die("Can't open file\n");

	$tweets = json_decode(@file_get_contents(dirname(__FILE__)."/cache/{$username}-twitter.json"));
	$user_cache = json_encode($tweets);	
	$result = fwrite ($fileHandle, $user_cache);

	echo ($result) ? "Data written successfully.<br>" : "Data write failed.<br>";

	fclose($fileHandle);

}

function pullCache($users){
	for($a = 0; $a < count($users); $a++){
		tweetFetch($users[$a]);
		$tweets[$a] = json_decode(@file_get_contents(dirname(__FILE__)."/cache/{$users[$a]}-twitter.json"))->results;
		//$combined_tweets = array_push($combined_tweets,$tweets[$a]);
	}
	$combined_tweets = array_merge($tweets[0],$tweets[1],$tweets[2],$tweets[3],$tweets[4],$tweets[5]);

	//$combined_tweets = array_merge($tweets[0]->results, $tweets[1]->results,$tweets[2]->results,$tweets[3]->results);
	usort($combined_tweets, 'cmp_date');
	outputFeed($combined_tweets);		
}
function tweetFetch($username){
	$feed = "http://search.twitter.com/search.json?q=from:" . $username . "&amp;rpp=100";
	 
	$newfile = dirname(__FILE__)."/cache/{$username}-twitternew.json";
	$file = dirname(__FILE__)."/cache/{$username}-twitter.json";
	 
	copy($feed, $newfile);
	 
	$oldcontent = @file_get_contents($file);
	$newcontent = @file_get_contents($newfile);
	 
	if($oldcontent != $newcontent) copy($newfile, $file);
}


function cmp_date($a, $b){
    if (strtotime($a->created_at) == strtotime($b->created_at)) {
        return 0;
    }
    return (strtotime($a->created_at) > strtotime($b->created_at)) ? -1 : 1;
}

/*  
Function twitterStream()
Pulls in tweets for specific topic requested.
*/
function twitterStream($keyword){
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
	outputFeed($tweets->results);
	}

function outputFeed($combined_tweets){
	for($x =0; $x < count($combined_tweets); $x++){	
		$thumb = $combined_tweets[$x]->profile_image_url;
		$created = ago(strtotime($combined_tweets[$x]->created_at));
		$user = $combined_tweets[$x]->from_user;
		$tweet_id = $combined_tweets[$x]->id_str;
		$tweet = makeRich($combined_tweets[$x]->text);
		?>
		<div class="chunk">
			<a href="http://twitter.com/<?php echo $user;?>" class="avatar">
				<img src="<?php echo $thumb;?>" width="48" height="48" title="<?php echo $user;?>" /></a>
			<span class="tweet">
				<span class="user"><a href="http://twitter.com/<?php echo $user;?>"><?php echo $user;?></a></span>
				<br /><?php echo $tweet; ?>
			</span>
			<span class="date">
				<a href="http://twitter.com/<?php echo $user;?>/status/<?php echo $tweet_id;?>/"><?php echo $created; ?></a>
			</span>
		</div><!-- exit div.chunk -->

	<?php // continue structure
	}

}
/* 
Asthetic Formatting for the Streams
*/

/*  
Function ago()
Based on script from snipt.net that compares
a time stamp to how much time has passed.
*/
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
/*  
Function makeRich()
Process that uses REGEX to detect for links, usernames, and 
Hash tags inside the tweets.
*/
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


?>