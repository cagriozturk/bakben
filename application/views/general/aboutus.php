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
         <h1 class="inner-hed">Hakkımızda</h1>
         <p>
            <?php if (isset($aboutus_content) && count($aboutus_content) > 0) { 
               foreach ($aboutus_content as $c) {
				echo $c->content;
            ?> 
            <?php } 
			} 
			else echo "Çok Yakında.";
			?>
         </p>
      </div>
      <?php echo $this->load->view('general/quick_links');?>
   </div>
   <div class="spacer"></div>
</div>
</div>
<!-- Middle Content-->

