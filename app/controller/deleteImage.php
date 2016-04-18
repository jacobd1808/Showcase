<?php
$file = $_POST['name'];
$directory = $_SERVER["DOCUMENT_ROOT"]. "/stud/u1153568/final/showcase/assets/img/gallery_uploads/" . $file;
if (!unlink($directory))
  {
  echo ("Error deleting $file");
  }
else
  {
  echo ("Deleted $file");
  }
?>