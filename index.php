<?php include("includes/functions.php");?>
<!DOCTYPE html>
 <html lang="en">
 <head>
 	<title>#CIRCA - Vetted Social Media</title>

 	<meta charset="utf-8">
 	<meta name="description" content="A website for vetted social media live streams" />
 	<meta name="keywords" content="circa, cs50, social-media, traganos" />
 	<meta name="robots" content="" />
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">

 	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/images/apple-touch-icon.png">

 </head>
 <body>
	 <div id="summa">
		 <div id="wrapper">
		 	<div id="header">
		 		<!-- <a href="/" class="logotype"><img src="/images/logotype.png" width="" height="" /></a> -->
		 		<h1 class="logotype">#CIRCA</h1>

		 	</div><!-- exit #header-->
		 	<div id="highlights">
			 	<h2>Photo stream</h2>
			 	<a href="#"><img src="images/twitpic_test.gif" alt="twitpic" /></a>
			 	<span class="caption">A wicked awesome pic.</span>
				<a href="#"><img src="images/twitpic_test-2.gif" alt="twitpic" /></a>
				<span class="caption">Check out that poster art.</span>						       
					
		 	</div><!-- exit #highlights-->
		 	<div id="content">
				
				<h1>Live Stream</h1>
				<div class="scroll">
				<?php				
				/*	This is where I construct an array of twitter users for the app to fetch and sort 
				*	Eventually this will be constructed from the set of approved users via a mySQL call.
				* 	In the meantime, an array of usernames are passed into the function for processing
				* 	as I test the overall site functionality -- CDT
				*/
				$users = array("techcrunch","mashable","msnbc_tech","guardiantech","forbestech","nytimestech");
				?>
				<?php pullCache($users); ?>
				</div>
				<div class="clearfix"></div>       
				<ul>
				   <li>Tweets are pulled from vetted users.</li>
				   <li>Questions? Contact Chris Traganos by email: ctraganos at gmail dot com.</li>
				</ul>


		 	</div><!-- exit #content -->
		 	<div id="footer">
		 	&copy;<?php echo ($cr_start = 2010) != ($cr_end = date("Y")) ? "$cr_start - $cr_end" : $cr_end ?> Chris Traganos for a final project in <a href="https://www.cs50.net/">CS50</a>. Open repository at <a href="https://github.com/ctraganos/circa">GitHub</a>
		 	</div><!-- exit #footer-->
		 </div><!-- exit #wrapper -->
	 </div><!-- exit #summa -->
	 
<!-- Grab Google CDN's jQuery. fall back to local if necessary -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="/js/libs/jquery-1.4.4.min.js"%3E%3C/script%3E'))</script>
	 
	 
 </body>
 </html> 
