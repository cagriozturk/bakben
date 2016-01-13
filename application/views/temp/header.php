<!DOCTYPE html>
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
      <link href="<?php echo base_url();?>assets/designs/css/front-style.css" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url();?>assets/designs/css/jquery.dataTables.css" rel="stylesheet">
      <?php if(isset($site_data->google_analytics)) echo $site_data->google_analytics; ?>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
	  <script type="text/javascript" charset="utf-8">
  (function(G,o,O,g,L,e){G[g]=G[g]||function(){(G[g]['q']=G[g]['q']||[]).push(
   arguments)},G[g]['t']=1*new Date;L=o.createElement(O),e=o.getElementsByTagName(
   O)[0];L.async=1;L.src='//www.google.com/adsense/search/async-ads.js';
  e.parentNode.insertBefore(L,e)})(window,document,'script','_googCsa');
</script>


   </head>
   <body>
      <!---Hedder--->
      <div class="container-fluid fluid-hedder navbar-fixed-top padding">
         <div class="col-md-4 col-xs-12 logo"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/designs/images/<?php echo $site_data->site_logo; ?>" align="center" width="80%"></a></div>
         <div class="total-hed">
            <div class="col-md-4 rs-cha menu-wi">
               <nav class="navbar navbar-default menu" role="navigation">
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
                        <ul class="nav navbar-nav menu-list">
                           <li class="<?php if(isset($active_menu) && $active_menu=="home") echo "active";?>"><a href="<?php echo base_url();?>">Anasayfa</a></li>
                           <li class="<?php if(isset($active_menu) && $active_menu=="aboutus") echo "active";?>"><a href="<?php echo base_url(); ?>welcome/aboutus">  Hakkımızda  </a></li>
                           <li class="<?php if(isset($active_menu) && $active_menu=="contactus") echo "active";?>"><a href="<?php echo base_url(); ?>welcome/contact">İletişim</a></li>
                           <?php $this->load->library('ion_auth');		
                              if ($this->ion_auth->logged_in() && !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))
                              {
                              ?>
                           <li class="dropdown <?php if(isset($active_menu) && $active_menu=="dashboard") echo "active";?>">
                              <a href="<?php echo base_url();?>user" class="dropdown-toggle menu-drop" data-toggle="dropdown">Paneli<b class="caret"></b></a>
                              <ul class="dropdown-menu menu-drop">
                                 <li><a href="<?php echo base_url();?>user">Panelim</a></li>
                                 <li><a href="<?php echo base_url();?>user/profile">Profil</a></li>
                                 <li><a href="<?php echo base_url();?>user/quiz_history">Sınav Tarihi</a></li>
                                 <li><a href="<?php echo base_url();?>auth/logout">Çıkış</a></li>
                              </ul>
                           </li>
                            <?php } else if ($this->ion_auth->logged_in() && ($this->ion_auth->is_admin() || $this->ion_auth->is_moderator())) { ?>
                           <li class="dropdown">
                              <a href="<?php echo base_url();?>user" class="dropdown-toggle menu-drop" data-toggle="dropdown">Panel<b class="caret"></b></a>
                              <ul class="dropdown-menu menu-drop">
                                 <li><a href="<?php echo base_url();?>admin">Panelim</a></li>
                                 <li><a href="<?php echo base_url();?>auth/logout">Çıkış</a></li>
                              </ul>
                           </li>
                           <?php } ?>
                        </ul>
                     </div>
                     <!-- /.navbar-collapse -->
                  </div>
                  <!-- /.container-fluid -->
               </nav>
            </div>
			 
         </div>
      </div>
      <!---Hedder--->
	