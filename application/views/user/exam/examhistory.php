<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url();?>assets/general/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>assets/general/js/bootstrap.min.js"></script>
<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url();?>user">Anasayfa</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#"> Sınav/Sınav Tarihi </a></li>
      </ul>
   </div>
</div>
<div class="row margin">
   <div class="col-md-12">
      <?php if (count($quiz_history)) {
         foreach ($quiz_history as $h) {
      ?>
      <div class="col-md-6">
         <div class="col-md-12 padd">
            <div class="panel panel-default  box-shadow">
               <div class="panel-heading p-hed"> <?php echo $h->name;?> </div>
               <div class="panel-body">
                  <div class="col-md-12"> <i class="fa fa-check"></i> <small> Toplam Denemeler : <?php echo $h->total_attempts;?>   Sınav Tarihi: <?php echo $h->dateoftest;?> </small> </div>
                  <?php
                     //Calculate Best Score Percentage
                     $bestPercentage = ($h->score/$h->total_questions)*100;
                     
                  ?>
                  <div class="col-md-12">
                     <div class="exam-histroy  mar-resu-summ">
                        <div class="lates-users-img-hed quiz-hed result-sum-hed">
                           Yüksek Skor : <?php echo number_format($bestPercentage,2)."%";?> 
                        </div>
                        <div class="progress gress">
                           <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $bestPercentage."%";?>">
                              <span class="sr-only"></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="col-md-3 padd"> <small> En Yüksek Skor <?php echo $h->score;?>/<?php echo $h->total_questions;?> </small></div>
                     <div class="col-md-2">
                        <a href="<?php echo base_url();?>user/performance/<?php echo $h->quiz_id;?>" target="_blank">
                           <div class="btn bg-primary  exam-histry-btn"> Görünüm</div>
                        </a>
                     </div>
                     <div class="col-md-4">
                        <a href="<?php echo base_url();?>user/certificate/<?php echo $h->quiz_id;?>" target="_blank">
                           <div class="btn bg-primary  exam-histry-btn">Sertifika İndir </div>
                        </a>
                     </div>
                     <div class="col-md-2 rank-exam">
                        <a href="<?php echo base_url();?>user/instructions/<?php echo $h->quiz_id;?>/<?php echo $h->name;?>" style="text-decoration:none;">
                           <div class="btn bg-primary  exam-histry-btn"> Sınavı Geri Al </div>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php } 
	  } 
	  else echo '<div class="col-md-12">
         <div class="col-md-12 padd">
         <div class="panel panel-default  box-shadow">
         <div class="panel-heading p-hed">Mevcut Veri YOk. <a href="'.base_url().'user">Buraya Tıkla</a> sınav olmak için.</div>
         
         </div>
         </div>
          </div>';
		  ?>
   </div>
</div>

