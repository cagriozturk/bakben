 <!-- Bootstrap -->    
 <link href="<?php echo base_url();?>assets/designs/css/bootstrap.css" rel="stylesheet">   <link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" 
 rel="stylesheet">    
 <link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">    
 <link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">    
 <link href="<?php echo base_url();?>assets/designs/css/morris-0.4.3.min.css" 
 rel="stylesheet">

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->    
 <script src="<?php echo base_url();?>assets/designs/js/jquery.js"></script>    
 <!-- Include all compiled plugins (below), or include individual files as needed -->	<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>       <script src="<?php echo base_url();?>assets/designs/js/jquery-1.10.2.js"></script>    
 <script src="<?php echo base_url();?>assets/designs/js/plugins/morris/raphael-2.1.0.min.js"></script>    
 <script src="<?php echo base_url();?>assets/designs/js/plugins/morris/morris.js"></script>    
 <script src="<?php echo base_url();?>assets/designs/js/demo/dashboard-demo.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/designs/js/chart.js"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
       
	   var usersdata = google.visualization.arrayToDataTable([
          ['Users', 'No. of Users'],
          ['Active',      <?php echo $activeUsersCount;?>],
          ['Inactive',  <?php echo $inactiveUsersCount;?>]
        ]);
		
		 var examdata = google.visualization.arrayToDataTable([
          ['Exam name', 'Attempts'],
		  <?php foreach ($exam_data as $exam) {?>
          <?php echo "['".$exam->name."',      ".$exam->cnt."],";
           } ?>
        ]);
		
		 var paymentsdata = google.visualization.arrayToDataTable([
          ['Exam', 'Payments'],
          <?php foreach ($payments_data as $payment) {?>
		  <?php echo "['".$payment->name."', ".$payment->cnt."],";
		   } ?>
          
        ]);

        var options = {
          title: 'Kullanıcılar & Durum',
          is3D: true,
		  'width':340,
		  'height':275
        };
		
		var examoptions = {
          title: 'Sınavlar Ve Girişimler',
          is3D: true,
		  'width':310,
		  'height':275,
		  'legend':'none'
        };
		
		 var paymentoptions = {
          title: 'Sınavlar Ve Ödemeler',
          is3D: true,
		  'width':340,
		  'height':275,
		};

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(usersdata, options);
		
		var examschart = new google.visualization.BarChart(document.getElementById('examchart'));
        examschart.draw(examdata, examoptions);
		
		var paychart = new google.visualization.PieChart(document.getElementById('paychart_3d'));
        paychart.draw(paymentsdata, paymentoptions);
      }
    </script>




 
 <div class="col-md-12 padd">

<div class="bradcome-menu">
 <ul>
<li><a href="<?php echo base_url();?>">Anasayfa</a></li>
<li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
<li><a href="#">   Moderator Paneli </a></li>
 </ul>
 </div>

 </div>
 
 <div class="row">
 
 <?php echo $this->session->flashdata('message'); ?>
 
 <div class="col-md-12">

<a href="<?php echo base_url();?>admin/questionsindex"><div class="module">
<div class="module-img"><img src="<?php echo base_url();?>assets/designs/images/quations.png" width="49" height="48"></div>
<div class="module-hed">Sorular</div>
</div></a>

<a href="<?php echo base_url();?>admin/quiz"><div class="module">
<div class="module-img"><img src="<?php echo base_url();?>assets/designs/images/exam.png" width="49" height="48"></div>
<div class="module-hed">Quiz/Sınav</div>
</div></a>

 </div> 
 
 </div>
 
 
 <div class="row margin">
 <div class="col-md-12">
 
  <div class="col-md-4 padd">
  <div class="recent-msg">
  <div class="recent-msg-hed">En Yüksek</div>
  <div class="recent-msg-con">
  
  <?php if(count($topRankers)) { 
		
			foreach($topRankers as $t) {
	
	?>  
  
  <div class="recent-msg-total">
  <div class="recent-msg-img">
  <img src="<?php echo base_url();?>assets/uploads/images(200x200)/<?php if(isset($t->image)&&$t->image!='')echo $t->image; else echo "dflt-user-icn.png";?>" width="50" height="50"></div>
    <div class="recent-msg-img-hed">
    <?php echo $t->username;?><br>
<small><?php echo $t->dateoftest." ".$t->timeoftest;?></small><br>
 <small><?php echo $t->name.":  ".$t->score."/".$t->total_questions;?></small>
     </div>
   </div>
   
  <?php } }?>
    
  </div>
   </div>
   </div>
  
     <div class="col-md-4"><div class="lates-users">
    <div class="recent-msg-hed">Son Kullanıcı Sınavları</div>

	<?php if(count($recentUserQuizzes)) { 
	
			foreach($recentUserQuizzes as $l) {
	
	?>
	
  <div class="recent-msg-total">
  <div class="lates-users-img">
  <img src="<?php echo base_url();?>assets/uploads/images(200x200)/<?php  if(isset($l->image)&&$l->image!='')echo $l->image; else echo "dflt-user-icn.png";?>" width="50" height="50"></div>
    <div class="lates-users-img-hed">
    <?php echo $l->username;?><br>
<small><?php echo $l->dateoftest." (".$l->name.": ".$l->score."/".$l->total_questions.")";?></small><br>
  
     </div>
  <!--   <div class="btn bg-primary wnm-user">Approve</div>	
     <a href="<?php echo base_url();?>admin/userQuizHistory/<?php echo $l->userid?>"><div class="btn bg-primary wnm-user">View</div></a> -->
   </div>
   
   <?php } }?>
   
  </div></div> 

  

  </div>
  </div>
  
  <div class="row">
  
  <div class="col-md-12 padd">  
  
   
  
  
  </div>
    </div>
  
