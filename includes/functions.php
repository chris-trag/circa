<?php
/*
CIRCA - A web app that live streams relevant, vetted topics & users.
Author: Chris Traganos <ctraganos@gmail.com>
Built as the Final Project for CS50 - http://cs50.net
 */
 
/*  
Function tweetCompress()
creates the main site API feed of live stream of vetted users
along with printing out a sucess note if it worked.
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

/*  
Function pullCache()
Accepts an Array of usernames and in turn
retrieve their local caches THEN
compiles them into one stream on the page.
*/

function pullCache($users){
	for($a = 0; $a < count($users); $a++){
		tweetFetch($users[$a]);
		$tweets[$a] = json_decode(@file_get_contents(dirname(__FILE__)."/cache/{$users[$a]}-twitter.json"))->results;
	}
	// Following line needs to be cleaned up and more flexible via a loop
	$combined_tweets = array_merge($tweets[0],$tweets[1],$tweets[2],$tweets[3],$tweets[4],$tweets[5]);
	
	usort($combined_tweets, 'cmp_date'); // Sort tweets in the stream by the latest date.
	outputFeed($combined_tweets); // Crank out the wall		
}

/*  
Function tweetFetch()
calls out to the Twitter Search API for the
recent twitter results of a specific user and 
locally caches the individual stream.
*/
function tweetFetch($username){
	$feed = "http://search.twitter.com/search.json?q=from:" . $username . "&amp;rpp=100";
	 
	$newfile = dirname(__FILE__)."/cache/{$username}-twitternew.json";
	$file = dirname(__FILE__)."/cache/{$username}-twitter.json";
	 
	copy($feed, $newfile);
	 
	$oldcontent = @file_get_contents($file);
	$newcontent = @file_get_contents($newfile);
	 
	if($oldcontent != $newcontent) copy($newfile, $file);
}

/*  
Function cmp_date()
compares array item field "created_at" and compares.
Needed for uSort() to work.
*/
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
	// This version of the feed has a few more parameters such as GEO & Language.
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
	
/*  
Function outputFeed()
Takes a compiled set of JSON tweets and outputs HTML
for each item in the multi-dimensional array.
*/
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
The Following functions are mostly asthetic in nature
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