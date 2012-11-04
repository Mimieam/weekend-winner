<?php
include 'common.inc.php';
if ($user->isLoggedIn() === false) {
  include 'templates/not-logged-in.php';
  exit;
}
$pageTitle = 'About BubbleDo';
$topics = $user->getTopics();
$topicAction = false;
include 'templates/loggedin-header.php';
?>
	<div style="padding-top:100px">
		Linear based task lists do not work for everyone. The mind of the creative or artistic type of person doesn’t work well around regimented, standardized and prioritized lists. <br>
		The list itself is treated as a daunting and unpleasant source of headaches and over time becomes loathed if it is used, but often simply ignored.<br>
		While there are a lot of good productivity and task oriented tools out there, they are all basically the same in that they are all linear in design (i.e. based on Lists).<br> 
		BubbleDo does the same thing, but in a fundamentally different way.  BubbleDo provides a platform to allow users to organize their tasks in a visual context, and arrange objects (tasks) in a manner that makes sense to them.<br> 
		Users define keywords, size, color, opacity and other dynamics of the objects which all let the user build references around the tasks to quickly and easily see which tasks are of greater importance or are more time sensitive.<br>
		In one view a user can see the culmination of all of their tasks without feeling overwhelmed by regimented lists. 
		<br><br>
		This allows the user, at any point in time, to see a bird’s eye view (snapshot) of all the things they need to do. <br> 
		Artistic types can remember this image as a reference and gives them a format that they can wrap their minds around. <br>
		If this concept makes sense to you, BubbleDo is for YOU!<br>
		Research shows that people who have high aptitude for the visual arts, are more responsive to visual stimuli. <br> 
		BubbleDo finally gives people a useful and engaging platform to organize their life. <br>
	</div>
<?php
include 'templates/loggedin-footer.php';	
