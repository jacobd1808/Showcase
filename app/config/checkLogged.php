<?php session_start();

if(isset($_SESSION['ifitness_id'])) { 
	header("Location: index.php");
}

?>