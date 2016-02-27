<?php 

  //include_once "app/config/checkSession.php";
  //include_once "app/config/conn.php";
  //include "app/controller/indexController.php";
	
	$pageOpt = array(
		"title"			    =>	"FitConnect . Search ", 
		'navName' 		  	=> 	"search", 
		'cssIncludes'	  	=>	" ", 
		"jsIncludes"	 	=>	" ",
	);

?>
<!DOCTYPE html>
    <head>
		<?php include_once "app/views/meta.php";?>
    </head>
    <body>
      <?php include_once "app/views/header.php"; ?>
      <div class='view'> 
          <div class='search-filters'> 
          Some Filters
          </div>
          <table> 
            <tr> 
              <th> Avatar </th>
              <th> Name </th>
              <th> Add </th>
            </tr>
          </table>
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>