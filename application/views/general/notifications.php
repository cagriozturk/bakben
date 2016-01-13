<!-- Slider-->
<div data-ride="carousel" class="carousel slide banner" id="myCarousel">
   <div class="container-fluid padding">
      <img src="<?php echo base_url(); ?>assets/designs/images/inner-banner.png" width="100%">
   </div>
</div>
<!-- Slider-->
<!-- Middle Content-->
<div class="container-fluid content-bg">
   <div class="spacer"></div>
  <div class="container padding">
      <div class="col-md-2 col-xs-12">
         <div class="bradcome-menu">
            <ul>
               <li><a href="<?php echo base_url(); ?>">Anasayfa</a></li>
               <li><img src="<?php echo base_url(); ?>assets/designs/images/arrow1.png" width="7" height="6"></li>
               <li><a href="#"> Hakkımızda </a></li>
            </ul>
         </div>
      </div>
	 
   </div>
   <div class="container inner-content padding">
      <div class="col-md-8 col-xs-12">
         <h1 class="inner-hed"><?php if(isset($notificationTitle)) echo $notificationTitle; else echo "Notifications";?></h1>
         <div class="col-md-12 formgro">
            <?php if (count($notifications)>0) {
               foreach ($notifications as $n) {
               ?>	
            <?php if (!isset($notificationTitle)) echo "<h4>".$n->title."</h4>"; ?>
            <p><?php echo $n->description;?></p>
            <br/>
            <div <?php if(!isset($notificationTitle)) { ?> style="border-bottom:1px dashed #ccc;margin-bottom:15px;margin-top: -10px;" <?php } ?>>
               Yazılan Tarih: <?php echo date('d-m-Y',strtotime($n->post_date));?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
               <p style="float:right;">Son Tarih: <?php echo date('d-m-Y',strtotime($n->last_date));?></p>
            </div>
            <?php if(isset($notificationTitle)) echo "<br/><a style='float:right;margin-top: 20px;' href='".base_url()."welcome/notifications'>Tüm Bildirimleri Görüntüle</a>"; ?>
            <?php } } ?>
         </div>
      </div>
      <?php echo $this->load->view('general/quick_links');?>
   </div>
   <div class="spacer"></div>
</div>
</div>
<!-- Middle Content-->

