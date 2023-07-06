<!doctype html>
<?php if (!isset($lang))
	$lang = 'english';
 ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php echo $lang ?>"> <!--<![endif]-->
<html lang="en">
	<head>
		<title><?php echo $base_title; ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<?php echo (!empty($meta_tag))?$meta_tag:""; ?>
		<link rel="shortcut icon" href="<?php echo base_url('assets/images/fav/favicon.ico'); ?>">
		<link rel="apple-touch-icon" href="<?php echo base_url('assets/images/fav/apple-touch-icon.png'); ?>">
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('assets/images/fav/apple-touch-icon-57x57-precomposed.png'); ?>">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('assets/images/fav/apple-touch-icon-72x72-precomposed.png'); ?>">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('assets/images/fav/apple-touch-icon-114x114-precomposed.png'); ?>">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('assets/images/fav/apple-touch-icon-144x144-precomposed.png'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

		<!-- styles -->
		<?php echo (!empty($styles))?$styles:""; ?>
		<?php /*
		<link href='https://fonts.googleapis.com/css?family=Russo+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Jockey+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Rochester' rel='stylesheet' type='text/css'>
		*/ ?>
		<link href='https://fonts.googleapis.com/css?family=Orbitron|Pacifico' rel='stylesheet' type='text/css'>
		<!-- JS -->
		<?php  echo (!empty($scripts_header))?$scripts_header:""; ?>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		 <style type="text/css">
    /* For devices smaller than 400px: */
  /*  body {
  background: url('<?php echo base_url('assets/images/bg/bg_public.jpg') ?>') center center cover no-repeat fixed;
}*/
    body {
        background-image: url(<?php echo base_url('assets/images/bg/bg_public.jpg') ?>);
    	background-size: 100% auto;
    	background-position: center top;
        background-repeat: no-repeat;

    }
    .container-body {
      padding-top : 85px;
    }
    header{
    font-family: 'Pacifico', cursive;
      /*font-family: 'Russo One', sans-serif;*/
      padding-top: 10px ;
      color: #fff;
    }
    header h1{
    	font-family: 'Orbitron', sans-serif;
     	/*font-family: 'Russo One', sans-serif;*/
     	font-size: 48px;
    }
    header p{
      font-size: 24px;
    }
    /* For devices 400px and larger: */
    @media only screen and (min-device-width: 400px) {
       header{
        padding: 10px 70px;
        color: #fff;
      }
    }
    </style>
  </head>
  <body>
    <header> 
      <div class="container">
        <?php           
          $lang = $this->config->item('language','application');
          $application = $this->config->item('application','application');
         ?>
        <h1><?php echo $application['name'][$lang]; ?></h1> 
        <p><?php echo $application['about'][$lang]; ?></p> 
      </div>
    </header>

    <div class="container container-body">
           <?
          if(!empty($content) && isset($content)){       
              echo $content;
          }
          ?> 
    </div>
<!--BEGIN FOOTER-->
<div id="footer">
	<div class="copyright">
		<div class="copyright">
			<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span> Universiti Kebangsaan Malaysia <?php echo date('Y'); ?>&nbsp;&nbsp;
			<a href="https://smp.ukm.my/webservices/general/disclaimer.cfm"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;Penafian</a>
		</div>
</div>
<!--END FOOTER-->
						
	</body>
</html>
