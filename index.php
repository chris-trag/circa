<?php include("includes/functions.php");?>
<!DOCTYPE html>
 <html lang="en">
 <head>
 	<title>#CIRCA</title>

 	<meta charset="utf-8">
 	<meta name="description" content="" />
 	<meta name="keywords" content="" />
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
			 	<h2>Header Level 2</h2>
			 	<a href="#"><img src="images/twitpic_test.gif" alt="twitpic" /></a>
			 	<span class="caption">Lorem ipsum dolor set amit.</span>
				<a href="#"><img src="images/twitpic_test-2.gif" alt="twitpic" /></a>
				<span class="caption">Lorem ipsum dolor set amit.</span>						       
					<ol>
					   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
					   <li>Aliquam tincidunt mauris eu risus.</li>
					</ol>
					
					<blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</p></blockquote>
					
					<h3>Header Level 3</h3>
					
					<ul>
					   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
					   <li>Aliquam tincidunt mauris eu risus.</li>
					</ul>

		 	</div><!-- exit #highlights-->
		 	<div id="content">
				<h1>#dwts</h1>
				<?php tweet_fetch("ctraganos",10); ?>
				<?php tweet_fetch("tristanwalker",10); ?>
					       
				<p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p>
				
				<h2>Header Level 2</h2>
					       
				<ol>
				   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
				   <li>Aliquam tincidunt mauris eu risus.</li>
				</ol>
				
				<blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</p></blockquote>
				
				<h3>Header Level 3</h3>
				
				<ul>
				   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
				   <li>Aliquam tincidunt mauris eu risus.</li>
				</ul>
				
				<pre><code>
				#header h1 a { 
					display: block; 
					width: 300px; 
					height: 80px; 
				}
				</code></pre>
		 	</div><!-- exit #content -->
		 	<div id="footer">
		 	
		 	</div><!-- exit #footer-->
		 </div><!-- exit #wrapper -->
	 </div><!-- exit #summa -->
	 
<!-- Grab Google CDN's jQuery. fall back to local if necessary -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="/js/libs/jquery-1.4.4.min.js"%3E%3C/script%3E'))</script>
	 
	 
 </body>
 </html> 
