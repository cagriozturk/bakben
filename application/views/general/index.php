<!-- include the Placeholders.js file at the bottom of your page -->
<script type="text/javascript">
   $('input[type=text], textarea').placeholder();
</script>
<!-- Slider-->
<div data-ride="carousel" class="carousel slide banner" id="myCarousel">
   <!-- Indicators -->
   <ol class="carousel-indicators">
      <li class="" data-slide-to="0" data-target="#myCarousel"></li>
      <li data-slide-to="1" data-target="#myCarousel" class=""></li>
      <li data-slide-to="2" data-target="#myCarousel" class="active"></li>
   </ol>
   <div class="carousel-inner">
      <div class="item">
         <img alt="Second slide" data-src="/holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" src="<?php echo base_url();?>assets/designs/images/banner2.png">
         <div class="container">
         </div>
      </div>
      <div class="item">
         <img alt="Second slide" data-src="/holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" src="<?php echo base_url();?>assets/designs/images/banner.png">
         <div class="container">
         </div>
      </div>
      <div class="item active">
         <img alt="Second slide" data-src="/holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" src="<?php echo base_url();?>assets/designs/images/banner1.png">
         <div class="container">
         </div>
      </div>
   </div>
   <?php $this->load->library('ion_auth');		
      if( !$this->ion_auth->logged_in() )		
      {
      ?>
   <div class="carousel-caption width-form f-h">
      <div id="infoMessage"><?php  echo $message;?></div>
      <?php echo form_open("auth/login",'class="form-signin"');?>
      <h1 class="form-hed">Oturum <span class="block"> Aç</span></h1>
      <p class="type">
         <?php echo form_input($identity);?>
      </p>
      <p class="type">
         <?php echo form_input($password);?>
      </p>
      <p class="type">
         <?php echo form_submit('submit', $this->lang->line('login_submit_btn'),'class="btn btn-lg btn-primary butt"');?>
      </p>
      <?php echo form_close();?>
      <p class="forget"><a href="<?php echo base_url(); ?>auth/forgot_password"><?php echo lang('login_forgot_password'); ?></a></p>
      <p class="forget"> <a href="<?php echo base_url(); ?>auth/create_user"> <?php echo lang('signup_user_submit_btn'); ?></a></p>
      
   </div>
   <?php } ?>
   <a data-slide="prev" href="#myCarousel" class="left carousel-control"><span class="glyphicon glyphicon-chevron-left"></span></a>
   <a data-slide="next" href="#myCarousel" class="right carousel-control"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<!-- Slider-->
<!-- Middle Content-->
<div class="container-fluid content-bg">
   <div class="spacer"></div>
   <div class="container">
      <div class="col-lg-4 padding test-moni">
         <h2 class="test-hed">Referanslar</h2>
         <div class="carousel slide" id="testimonials-rotate">
            <ol class="carousel-indicators">
               <li class="active" data-slide-to="0" data-target="#testimonials-rotate"></li>
               <li data-slide-to="1" data-target="#testimonials-rotate"></li>
               <li data-slide-to="2" data-target="#testimonials-rotate"></li>
            </ol>
            <div class="carousel-inner">
               <?php if(count($testimonials)>0) { 
                  $i = 1;
                  foreach($testimonials as $tm) {
                  if($tm->author_photo != '')
                  	$author_image = $tm->author_photo;
                  else
                  	$author_image = 'blankuser.jpg';
                ?>
               <div class="item <?php if($i++ == 1) echo 'active';?>">
                  <div class="col-md-4"><img alt="" src="<?php echo base_url();?>assets/uploads/testimony_images/images(98x98)/<?php echo $author_image;?>" class="img-circle img-responsive"  /></div>
                  <div class="testimonials col-md-8">
                     <p class="test-con">
                        <i class="fa fa-quote-left"></i>
                        <?php echo $tm->description;?> <i class="fa fa-quote-right"></i><br>
                        - <small><?php echo $tm->author;?></small>
                     </p>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <?php } 
			   } 
			   else echo "Referans Yazısı Yok.";
			   ?>
            </div>
         </div>
         <div class="pull-right pull">
            <a class="left" href="#testimonials-rotate" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right" href="#testimonials-rotate" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            <div class="clearfix"></div>
         </div>
      </div>
      <div class="col-lg-4 test-moni padding">
         <h2 class="test-hed">Bildirimler</h2>
         <marquee direction="up" scrollamount="2" scrolldelay="2" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 2, 0);" height="218">
            <div class="notif">
               <ul>
                  <?php if(count($notifications)>0) {
                     foreach($notifications as $n) {
                  ?>
                  <li>
                     <a href="<?php echo base_url();?>welcome/notifications/<?php echo $n->nid;?>/<?php echo $n->title;?>">
                     <?php echo $n->title;?>. <br/>
                     Yazılan Tarih: <?php echo date('d-m-Y',strtotime($n->post_date));?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Son Tarih: <?php echo date('d-m-Y',strtotime($n->last_date));?>
                     </a>
                  </li>
                  <?php }
				  } 
				  else echo "Çok Yakında.";
				  ?>
               </ul>
            </div>
         </marquee>
      </div>
      <div class="col-lg-4 padding test-moni">
         <h2 class="test-hed">Son Sınavlar</h2>
         <marquee direction="up" scrollamount="2" scrolldelay="2" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 2, 0);" height="218">
            <div class="notif">
               <ul>
                  <?php if (count($latest_quizzes)>0) {
                     foreach($latest_quizzes as $lq) {
						$style = '';
						if ($this->ion_auth->is_admin()) {
							$style = 'cursor:default;text-decoration:none;';
							$href = "";
						}				
						else {
							$href = 'href="'.base_url().'user/instructions/'.$lq->quizid.'"';
						}
                    ?>
                  <li>
                     <a <?php echo $href;?> style="<?php echo $style;?>">
                     Sınav <b><?php echo $lq->name;?></b> eklendi <?php echo date('d-m-Y',strtotime($lq->startdate));?>. ve kapatılacak <?php echo date('d-m-Y',strtotime($lq->enddate));?>.<br/>
                     Sınav Süresi (Dakika): <?php echo $lq->deauration;?>
                     </a>
                  </li>
                  <?php } 
				  } 
				  else echo "Çok Yakında.";
				  ?>
               </ul>
            </div>
         </marquee>
      </div>
   </div>
   <div class="spacer"></div>
</div>


</div>
 


 
 
