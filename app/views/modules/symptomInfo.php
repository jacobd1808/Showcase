<? include_once "../../config/conn.php"; 

  $symptom_id = $_POST['id'];
  $tracker = new Tracker($conn); 
  $symptom = $tracker->fetchSymptoms($symptom_id);

?>

<h2> What is '<?= $symptom['name'] ?>'' </h2>
<p> <?= $symptom['info'] ?> </p>
<a href='' class='cir disable closePopup'> <i class="material-icons">close</i> </a>
