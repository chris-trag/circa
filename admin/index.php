<?php
// ADMIN DESK
require_once("../includes/common.php");
define(PAGE, "admin");
?>
<?php get_header(); ?>
<?php get_sidebar();?>
		 	<div id="content">
				
				<h1>LiveStream Launchpad</h1>
				<p>This is where you can look up the social traffic for a given topic.
				Once processed, the site will display the conversations going on and
				as the editor you will select people from the stream. This will serve as
				the vetting process for a given live stream. <em>Questions can be sent to 
				<a href="mailto:ctraganos@gmail.com">Chris Traganos</a> </em></p>
				<h3>What is the hashtag for the live stream?</h3>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
					<input name="hashtag" type="text"/>
					<input type="submit" value="GO" />
				</form>
				<?php 
			
				$hashtag = $_POST['hashtag'];
				if(isset($_POST['hashtag']) && $hashtag != ''){
					echo "<p>You wrote the word: {$hashtag}</p>\n";
					echo "<div class=\"scroll\"";
					twitterStream(strtolower($hashtag));
					echo "</div>";
					echo "<div class='clearfix'></div>";
				}
				?>
				       
				<ul>
				   <li>Tweets are pulled from vetted users.</li>
				   <li>Questions? Contact Chris Traganos by email: ctraganos at gmail dot com.</li>
				</ul>
		 	</div><!-- exit #content -->
<?php get_footer();?>

