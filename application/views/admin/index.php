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
          ['Kullanıcılar', 'No. of Users'],
          ['Aktif',      <?php echo $activeUsersCount;?>],
          ['Pasif',  <?php echo $inactiveUsersCount;?>]
        ]);
		
		 var examdata = google.visualization.arrayToDataTable([
          ['Sınav Adı', 'Çalışma'],
		  <?php foreach ($exam_data as $exam) {?>
          <?php echo "['".$exam->name."',      ".$exam->cnt."],";
           } ?>
        ]);
		
		 var paymentsdata = google.visualization.arrayToDataTable([
          ['Sınav', 'Ödemeler'],
          <?php foreach ($payments_data as $payment) {?>
		  <?php echo "['".$payment->name."', ".$payment->cnt."],";
		   } ?>
          
        ]);

        var options = {
          title: 'Kullanıcı & Durumları',
          is3D: true,
		  'width':340,
		  'height':275
        };
		
		var examoptions = {
          title: 'Sınavlar & Çalışma',
          is3D: true,
		  'width':310,
		  'height':275,
		  'legend':'none'
        };
		
		 var paymentoptions = {
          title: 'Sınavlar & Ödemeler',
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
<li><a href="#">   Yönetici</a></li>
 </ul>
 </div>

 </div>
 
 <div class="row">
 
 <?php echo $this->session->flashdata('message'); ?>
 
 <div class="col-md-12">
 
 
 <a href="<?php echo base_url();?>admin/categories"><div class="module">
<div class="module-img"><img src="<?php echo base_url();?>assets/designs/images/categories.png" width="49" height="48"></div>
<div class="module-hed">Kategoriler</div>
</div></a>

 <a href="<?php echo base_url();?>admin/subcategories"><div class="module">
<div class="module-img"><img src="<?php echo base_url();?>assets/designs/images/sub-categories.png" width="49" height="48"></div>
<div class="module-hed">Alt Kategoriler</div>
</div></a>
 
<a  href="<?php echo base_url();?>admin/subjects"><div class="module">
<div class="module-img"><img src="<?php echo base_url();?>assets/designs/images/subject.png" width="49" height="48"></div>
<div class="module-hed">Konular</div>
</div></a>

<a href="<?php echo base_url();?>admin/questionsindex"><div class="module">
<div class="module-img"><img src="<?php echo base_url();?>assets/designs/images/quations.png" width="49" height="48"></div>
<div class="module-hed">Sorular</div>
</div></a>

<a href="<?php echo base_url();?>admin/quiz"><div class="module">
<div class="module-img"><img src="<?php echo base_url();?>assets/designs/images/exam.png" width="49" height="48"></div>
<div class="module-hed">Bilgi/Sınav</div>
</div></a>

<a href="<?php echo base_url();?>admin/notifications"><div class="module">
<div class="module-img"><img src="<?php echo base_url();?>assets/designs/images/notification.png" width="49" height="48"></div>
<div class="module-hed">Bildirimler</div>
</div></a>

<a href="<?php echo base_url();?>admin/settings"><div class="module">
<div class="module-img"><img src="<?php echo base_url();?>assets/designs/images/setting.png" width="49" height="48"></div>
<div class="module-hed">Ayarlar</div>
</div></a>

 </div>
 
 
 </div>
 
 
 <div class="row margin">
 <div class="col-md-12">
 
 <div class="col-md-4 padd">
 <div class="panel panel-default">
                        <div class="panel-heading p-hed">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Kullanıcı Grafiği
                          
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="piechart_3d" class="threed" style="width:340px"></div>
                        </div>
						
                        <!-- /.panel-body -->
                    </div>
  </div>
  
  <div class="col-md-4">
  <div class="panel panel-default">
                        <div class="panel-heading p-hed">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Sınav Grafiği
                          
                        </div>
                        <!-- /.panel-heading -->
                         
						 <div class="panel-body">
                            <div id="examchart" class="threed" style="width:310px"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
  
  </div>
  
    <div class="col-md-4">
  <div class="panel panel-default">
                        <div class="panel-heading p-hed">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Ödeme Grafiği
                          
                        </div>
                        <!-- /.panel-heading -->
                         
						 <div class="panel-body">
                            <div id="paychart_3d" class="threed" style="width:340px"></div>
                        </div>
                        <!-- /.panel-body -->
     </div>
  
  </div>
  

  </div>
  </div>
  
  <div class="row">
  
  <div class="col-md-12 padd">
  <div class="col-md-4">
  <div class="lates-users">
    <div class="recent-msg-hed">Son Kullanıcılar</div>

	<?php if(count($latestUsers)) { 
	
			foreach($latestUsers as $l) {
	
	?>
	
  <div class="recent-msg-total">
  <div class="lates-users-img">
  <img src="<?php echo base_url();?>assets/uploads/images(200x200)/<?php if(isset($l->image)&&$l->image!='')echo $l->image; else echo "dflt-user-icn.png";?>" width="50" height="50"></div>
    <div class="lates-users-img-hed">
    <?php echo $l->username;?><br>
<small><?php echo $l->date_of_registration;?></small><br>
  
     </div>
     
     <a href="<?php echo base_url();?>admin/viewUserProfile/<?php echo $l->id;?>"><div class="btn bg-primary wnm-user">Görünüm</div></a>
	 
	 <?php if($l->active==1) { ?>
	 
		<a href="<?php echo base_url();?>admin/blockUser/<?php echo $l->id;?>" onclick="return confirm('Kullanıcıyı engellemek istiyor musunuz?')"><div class="btn bg-primary wnm-user">Engelle</div></a>
	 
	 <?php } else {?>
	 
		<a href="<?php echo base_url();?>admin/activateUser/<?php echo $l->id;?>" onclick="return confirm('Kullanıcıyı aktif etmek istiyor musunuz?')"><div class="btn bg-primary wnm-user">Etkinleştir</div></a>
	 
	 <?php } ?>
	 
   </div>
   
  <?php } 
  
  echo '<a href="'.base_url().'admin/viewAllUsers" style="float:right;margin:10px;">Görünüm</a>';
  
  }?>
   
  </div>
  </div>

  
  
    <div class="col-md-4">
  <div class="recent-msg">
  <div class="recent-msg-hed">En Skorer</div>
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
  <!--   <div class="btn bg-primary wnm-user">Approve</div>	-->
     <a href="<?php echo base_url();?>admin/userQuizHistory/<?php echo $l->userid?>"><div class="btn bg-primary wnm-user">Görünüm</div></a>
   </div>
   
   <?php } }?>
   
  </div></div> 
  
  
  </div>
    </div>
  
