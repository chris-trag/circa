<?php
// HOME PAGE
require_once("includes/common.php");
?>
<?php get_header(); ?>
<?php get_sidebar();?>
		 	<div id="content">
				
				<h1>Live Stream</h1>
				<div class="scroll">
				<?php				
				/*	This is where I construct an array of twitter users for the app to fetch and sort 
				*	Eventually this will be constructed from the set of approved users via a mySQL call.
				* 	In the meantime, an array of usernames are passed into the function for processing
				* 	as I test the overall site functionality -- CDT
				*/
				$users = array("techcrunch","mashable","msnbc_tech","guardiantech","forbestech","nytimestech","cnn","time","reuters","bbc","wsj","harvard" );
				?>
				<?php pullCache($users); ?>
				</div>    
				<ul>
				   <li>Tweets are pulled from vetted users.</li>
				   <li>Questions? Contact Chris Traganos by email: ctraganos at gmail dot com.</li>
				</ul>
		 	</div><!-- exit #content -->
<?php get_footer();?>

