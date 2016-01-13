<!--	DON'T DELETE ANY DIV	--><!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="keywords" content="<?php if(isset($site_data->site_keywords)) echo $site_data->site_keywords; else echo ""; ?>">
      <meta name="description" content="<?php if(isset($site_data->site_description)) echo $site_data->site_description; else echo ""; ?>">
      <title><?php if(isset($title)) echo $title." - DOES"; else echo $site_data->site_title; ?></title>
      <!-- Bootstrap -->
      <link href="<?php echo base_url();?>assets/designs/css/bootstrap.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/designs/css/morris-0.4.3.min.css" rel="stylesheet">
      <?php if(isset($site_data->google_analytics)) echo $site_data->google_analytics; ?>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <div class="container-fluid top-header padd">
         <div class="col-md-2 padd">
            <div class="logo">
               <a href="<?php echo base_url();?>user"><img src="<?php echo base_url();?>assets/designs/images/logo.png" width="100%" height="50" ></a> 
            </div>
         </div>
         <div class="col-md-10">
            <div class="menu">
               <div class="profile">
                  <div class="profile-im"><img src="<?php echo base_url();?>assets/uploads/images(200x200)/<?php if($this->session->userdata('image')!='') echo $this->session->userdata('image');else echo 'dflt-user-icn.png';?>" width="35" height="35"></div>
                  <div class="profile-name"><?php echo $this->session->userdata('username');?></div>
               </div>
               <div class="small-menu">
                  <nav class="navbar navbar-default menu-nav" role="navigation">
                     <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                           <span class="sr-only">Geçiş Navigasyonu</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           </button>
                           <a class="navbar-brand" href="#">Marka</a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                           <ul class="nav navbar-nav">
                              <li><a href="<?php echo base_url();?>user/profile"><i class="fa fa-user"></i> Hesap</a></li>
                              <li class="dropdown">
                                 <a href="<?php echo base_url();?>user/logout" class="dropdown-toggle" > <i class="fa fa-lock"></i> Çıkış </a>        
                              </li>
                           </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                     </div>
                     <!-- /.container-fluid -->
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid padd">
      <!--	DON'T DELETE ANY DIV	-->
