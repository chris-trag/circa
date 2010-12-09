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
				$hashtag = mysql_real_escape_string($_POST['hashtag']);
				if(isset($_POST['hashtag']) && $hashtag != ''){?>
					<div class="scroll">
						<form method="post" action="/admin/vouch.php">
						<h3>Describe the livestream reference / backstory</h3>
						<textarea cols="50" rows="4" name="description"></textarea>
						<h3>Please provide a URL to reference the </h3>
						<input type="text" name="source_link" />
						<br><br><br>
						<h3>Select users to be apart of the LiveStream for <?php echo strtoupper($hastag); ?></h3>
						<p>Current chatter about: <?php echo $hashtag;?></p>
						<?php twitterStream(strtolower($hashtag));?>
						<input type="hidden" name="hashtag" value="<?php echo $hashtag;?>"/>
						<input type="submit" value="Launch Stream!" />
						</form>
					</div>
					<div class='clearfix'></div>
				<?php
				} // end hashtag processing
				?>
				       
				<ul>
				   <li>Tweets are pulled from vetted users.</li>
				   <li>Questions? Contact Chris Traganos by email: ctraganos at gmail dot com.</li>
				</ul>
		 	</div><!-- exit #content -->
<?php get_footer();?>

