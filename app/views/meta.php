        <meta charset="utf-8">
        <!-- Meta Tags --> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
        <link rel="icon" href="favicon.ico">
        <!-- Title --> 
        <title><?php echo $pageOpt['title']; ?></title>
        <!-- Fonts  --> 
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900,100,200,600' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
        <!-- Font Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Grid --> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pure/0.6.0/grids-min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pure/0.6.0/grids-responsive-min.css">
        <!-- Plugin Style Sheets -->
        <link rel='stylesheet' href='lib/tooltipster-master/css/tooltipster.css' /> 
        <link rel="stylesheet" href="lib/gallery/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <link rel="stylesheet" href="lib/gallery/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
        <link rel="stylesheet" href="lib/gallery/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
        <!-- Page Specfic Files-->
        <?php if($pageOpt['cssIncludes']) { echo $pageOpt['cssIncludes']; } ?> 
        <!-- -->
        <link rel="stylesheet" href="assets/css/main.css?<?php echo time(); ?>">
        <!-- --> 