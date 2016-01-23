<? include_once "../../config/conn.php"; 

  $record_id = $_POST['id'];
  $tracker = new Tracker($conn); 
  $record = $tracker->fetchRecord($record_id);

?>

<h2> Add note to this record</h2>
<textarea name='record-note' id='note-area' placeholder='Type your note here' class='theme-border'><? if($record) { echo $record['note']; } ?></textarea>
<a href='' class='cir disable closePopup'> <i class="material-icons">close</i> </a>
<a href='' class='cir disable confirmNote'> <i class="material-icons">check</i> </a>