<?php
// HOME PAGE
require_once("includes/common.php");
?>
<?php get_header(); ?>
<?php get_sidebar();?>
		 	<div id="content">
				<?php				
				/*	This is where I construct an array of twitter users for the app to fetch and sort 
				*	Eventually this will be constructed from the set of approved users via a mySQL call.
				* 	In the meantime, an array of usernames are passed into the function for processing
				* 	as I test the overall site functionality -- CDT
				*/
				//$slug = 'harvardyale'; // This is for the variable of the live stream
				/* $users = array("techcrunch","mashable","msnbc_tech","guardiantech","forbestech","nytimestech","cnn","time","reuters","bbc","wsj","harvard" ); */
				
				$result_sum = mysql_query("SELECT id, hashtag, description, source_link, users FROM streams ORDER BY id DESC LIMIT 0,1");
				// if we found a row, remember user and redirect to portfolio

				if (mysql_num_rows($result_sum) == 1)
				{
					// grab row
					$row_sum = mysql_fetch_array($result_sum);
					
					$hashtag = $row_sum["hashtag"];
					$description = $row_sum["description"];
					$source_link = $row_sum["source_link"];
/*
					print_r($row_sum["users"]);
					$str = substr($str,'',-1);
					echo "<br>";
*/					
					$users = substr($row_sum["users"],0,-1);
					$users = explode(",", $users);
					
					echo "<br>".$users;
/*
					echo $users."<br>";
					print_r($users);
*/
					
				}else{
				// Going to set these as a default to show people the example
				$users = array("techcrunch","mashable","msnbc_tech","guardiantech","forbestech","nytimestech","cnn","time","reuters","bbc","wsj","harvard" );
				$hashtag = "Tech News";
				$description = "There are thousands of technology Web sites out there, but Weblogs are your e-ticket to becoming an industry insider. Want to find that impossibly thin cell phone or high-resolution digital camera? Or perhaps you need to get briefed on the digital privacy and copyright debates or learn how to fortify your inbox against spam? Bloggers are talking about it. In fact, the posts on veteran blog Slashdot often break technology news. Earlier this year, the site was first to flag America Online's controversial privacy clause for its AIM service that read, in part, \"You waive any right to privacy. You waive any right to inspect or approve uses of the content or to be compensated for any such uses.\" Besides breaking news, you'll find information on tech trends you can't pick up elsewhere and well-articulated arguments about all things tech. These sites all share limitless curiosity and passion for covering all that is next.";
				$source_link = "http://www.cs50.net";
				}

				?>	
				<h1>Live Stream for (<?php echo $hashtag; ?>)</h1>
				<p><strong>Description:</strong><br/><?php echo  makeRich($description); ?></p>
				<p><strong>Reference: </strong> <a href="<?php echo $source_link; ?>"><?php echo $source_link; ?></a></p>			
				<div class="scroll">
				
				<?php pullCache($users); ?>
				</div>    
				<ul>
				   <li>Tweets are pulled from vetted users.</li>
				   <li>Questions? Contact Chris Traganos by email: ctraganos at gmail dot com.</li>
				</ul>
		 	</div><!-- exit #content -->
<?php get_footer();?>

