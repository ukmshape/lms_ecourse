<!doctype html>
<html class="no-js" lang="<?php echo $lang; ?>"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo (!empty($base_title))?$base_title:""; ?></title>
        <meta name="keywords" content="<?php echo (!empty($site_keywords))?$site_keywords:""; ?>" />
        <meta name="description" content="<?php echo (!empty($site_description))?$site_description:""; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo (!empty($meta_tag))?$meta_tag:""; ?>
        <?php echo (!empty($styles))?$styles:""; ?>
        <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/img/fav/favicon.ico'); ?>">
        <link rel="apple-touch-icon" href="<?php echo base_url('assets/img/fav/apple-touch-icon.png'); ?>">
        <!-- styles -->
        <?php echo (!empty($styles))?$styles:""; ?>
        <!-- JS -->
        <?php  echo (!empty($scripts_header))?$scripts_header:""; ?>
      </head>

      <body id="bg">
      <div class="page-wraper">

            <?php
              if(!empty($content)){
                  echo $content;
              }
            ?>


              <button class="back-to-top fa fa-chevron-up" ></button>
            </div>

    <?php echo (!empty($scripts_footer))?$scripts_footer:""; ?>
    <?php if(!empty($script_content)): $this->load->view($script_content); endif; ?>


    </body>
</html>
