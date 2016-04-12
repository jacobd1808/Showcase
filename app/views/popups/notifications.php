<?php 
	include_once "../../controller/notificationsController.php";
?>

<div class='modulated-box vert-center-popup' id='popup-content' style='width: 60%'> 
	<ul class='basic-list vert-list notification-list'> 
<?php 
	foreach ( $notifications as $x){
		if ( $x['viewed'] == 0){
			$notification_class = "new_notification";
		} else {
			$notification_class = "notification";
		}

		echo "<li class='". $notification_class ."'>". $Relation->printNotification($x);
		echo "<span class='notification-date' id > xx - xx - xx</span></li>";
	}

	/* if new notification, class new_notification added */
?>
	</ul>
</div>


