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
	<div style="padding-top:60px">
          <p><h3>What is BubbleDo?</h3></p>
          
         <p>
           Linear based task lists do not work for everyone. The mind of the creative or artistic type of person doesn’t work well around regimented, standardized and prioritized lists. The list itself is treated as a daunting and unpleasant source of headaches and over time becomes loathed if it is used, but often simply ignored. While there are a lot of good productivity and task oriented tools out there, they are all basically the same in that they are all linear in design (i.e. based on Lists).</p> 
          
          <p>BubbleDo does the same thing, but in a fundamentally different way.  BubbleDo provides a platform to allow users to organize their tasks in a visual context, and arrange objects (tasks) in a manner that makes sense to them. Users define keywords, size, color, opacity and other dynamics of the objects which all let the user build references around the tasks to quickly and easily see which tasks are of greater importance or are more time sensitive. In one view a user can see the culmination of all of their tasks without feeling overwhelmed by regimented lists.</p>
          
          <p>This allows the user, at any point in time, to see a bird’s eye view (snapshot) of all the things they need to do. Artistic types can remember this image as a reference and gives them a format that they can wrap their minds around. If this concept makes sense to you, BubbleDo is for YOU! Research shows that people who have high aptitude for the visual arts, are more responsive to visual stimuli. </p>
          
          <p>BubbleDo finally gives people a useful and engaging platform to organize their life.</p>
          
          <p><h3>BubbleDo Team</h3></p>
          <ul>
            <li style="float:left;margin-right: 60px; width: 200px">Kaisa Taipale</li>
            <li style="float:left;margin-right: 60px; width: 200px">Choapet Oravivattanakul</li>
            <li style="float:left;margin-right: 60px; width: 200px">Daniel Hussey</li>
            <li style="float:left;margin-right: 60px; width: 200px">David Guell</li>
            <li style="float:left;margin-right: 60px; width: 200px">Eric Caron</li>
            <li style="float:left;margin-right: 60px; width: 200px">Hunter Dunbar</li>
            <li style="float:left;margin-right: 60px; width: 200px">Miezan Echimane</li>
            <li style="float:left;margin-right: 60px; width: 200px">Ross Thompson</li>
            <li style="float:left;margin-right: 60px; width: 200px">Shruti Gupta</li>
            <li style="float:left;margin-right: 60px; width: 200px">Stephen Nixon</li>
          </ul>
	</div>
<?php
include 'templates/loggedin-footer.php';	
