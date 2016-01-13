

	 <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
 
 
 <div class="col-md-12 padd">

<div class="bradcome-menu">
 <ul>
<li><a href="<?php echo base_url();?>admin">Anasayfa</a></li>
<li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
<li><a href="#"> Sınav Tarihi <?php echo $username;?> </a></li>
 </ul>
 </div>

 </div>
   <div class="row margin">
 <div class="col-md-12">
 
 <?php if(count($quiz_history)) {
 
		foreach($quiz_history as $h) {
 
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
    En İyi Skor : <?php echo $bestPercentage."%";?> </div> 
 <div class="progress gress">
 
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $bestPercentage."%";?>">
    <span class="sr-only"></span>
  </div>
</div>
  </div>

</div>

<div class="col-md-12">

<small> En İyi Skorun <?php echo $h->score;?>/<?php echo $h->total_questions;?> </small>

<a target="_blank" href="<?php echo base_url();?>admin/userQuizPerformance/<?php echo $h->userid;?>/<?php echo $h->quiz_id;?>"><div style="margin-left:280px;" class="btn bg-primary  exam-histry-btn"> Görünüm</div></a>


</div>

 </div>
 </div>
  </div>
   </div>
   
  <?php } } else echo '<div class="col-md-12">
  <div class="col-md-12 padd">
 <div class="panel panel-default  box-shadow">
 <div class="panel-heading p-hed">Mevcut Veri Yok. <a href="'.base_url().'user">Buraya tıkla</a> sınav olmak için.</div>

 </div>
  </div>
   </div>';?>
   
  </div>
  </div>
    
  