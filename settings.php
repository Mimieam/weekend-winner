<?php
include 'common.inc.php';
if ($user->isLoggedIn() === false) {
  include 'templates/not-logged-in.php';
  exit;
}
$pageTitle = 'BubbleDo Features &amp; Settings';
$topics = $user->getTopics();
$topicAction = false;
include 'templates/loggedin-header.php';
?>
	<div style="padding-top:100px">
	    <h2>User Settings</h2>
	    <form class="form-horizontal">
	      <div class="control-group">      
	         <label class="control-label" for="email">Email :</label>   
	         <div class="controls">  
	         	<label class="radio inline">
	           		<input type="radio" name="emailRadio" id="emailRadio1" value="" checked>On
	           	</label>
	           	<label class="radio inline">
		           <input type="radio" name="emailRadio" id="emailRadio2" value="">Off
		          </label>
	         </div>
	      </div>
	       
	      <div class="control-group">        
	         <label class="control-label" for="reminder">Reminder :</label>
	        <div class="controls">  
        	<label class="radio inline">
	          	<input type="radio" name="reminderRadio" id="reminderRadio1" value="" checked>On
		      </label>
		      <label class="radio inline">
		          <input type="radio" name="reminderRadio" id="reminderRadio2" value="">Off 
		       </label>
	        </div>
	      </div>
	  
	      <div class="control-group">     
	          <label class="control-label" for="geoLocation">Geo Location :</label>
	         <div class="controls">  
				<label class="radio inline">
	          		<input type="radio" name="geoLocationRadio" id="geoLocationRadio1" value="" checked>On
	          </label>
				<label class="radio inline">
	          		<input type="radio" name="geoLocationRadio" id="geoLocationRadio2" value="">Off  
	          </label>
	      </div>
	    </div> 
    </form>
   </div>
<?php
include 'templates/loggedin-footer.php';