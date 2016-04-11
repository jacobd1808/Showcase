<?php 
	include_once "../../controller/notificationsController.php";
?>

<div class='modulated-box vert-center-popup' id='popup-content' style='width: 60%'> 
	<ul class='basic-list vert-list notification-list'> 
<?php 
	foreach ( $notifications as $x){
		echo "<li>". $Relation->printNotification($x);
		echo "<span class='notification-date'> xx - xx - xx</span></li>";
	}
?>
	</ul>
</div>