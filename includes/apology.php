<?php
// Apology
require_once("includes/common.php");
?>
<?php get_header(); ?>
<?php get_sidebar();?>
		 	<div id="content">
				
				<h1>Whoops!</h1>
  				<p><?php echo $message; ?></p>
				<ul>
				   <li>Tweets are pulled from vetted users.</li>
				   <li>Questions? Contact Chris Traganos by email: ctraganos at gmail dot com.</li>
				</ul>
		 	</div><!-- exit #content -->
<?php get_footer();?>

