<!-- Bootstrap -->    
<link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/morris-0.4.3.min.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->    
<script src="<?php echo base_url();?>assets/designs/js/jquery.js"></script>    
<!-- Include all compiled plugins (below), or include individual files as needed -->	
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>       
<script src="<?php echo base_url();?>assets/designs/js/jquery-1.10.2.js"></script>    
<script src="<?php echo base_url();?>assets/designs/js/plugins/morris/raphael-2.1.0.min.js"></script>    
<script src="<?php echo base_url();?>assets/designs/js/plugins/morris/morris.js"></script>    
<script src="<?php echo base_url();?>assets/designs/js/demo/dashboard-demo.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/designs/js/bar-chart.js"></script>
 
<script type="text/javascript">
<?php if($result!="") { ?>
   google.load("visualization", "1", {packages:["corechart"]});
   google.setOnLoadCallback(drawChart);
   function drawChart() {
     var data = google.visualization.arrayToDataTable([
       <?php echo $result;?>
     ]);
   
     var options = {
       title: 'Performans Sınavları',
       vAxis: {title: 'Sınav',  titleTextStyle: {color: 'Kırmızı'}}
     };
   
     var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
     chart.draw(data, options);
   }
   <?php } ?>
   
</script>

<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url();?>">Anasayfa</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#">   Üye Paneli </a></li>
      </ul>
   </div>
</div>
<?php 
   $message = $this->session->flashdata('message');
   if(isset($message)) echo $message;?>
<div class="row">
   <div class="col-md-12">
      <a href="<?php echo base_url();?>">
         <div class="module">
            <div class="module-img"><img src="<?php echo base_url();?>assets/designs/images/home.png" width="49" height="48"></div>
            <div class="module-hed">Anasayfa</div>
         </div>
      </a>
      <a href="#latest_quizzes">
         <div class="module">
            <div class="module-img"><img src="<?php echo base_url();?>assets/designs/images/exam.png" width="49" height="48"></div>
            <div class="module-hed">Son Sınavlar</div>
         </div>
      </a>
      <a href="<?php echo base_url();?>user">
         <div class="module">
            <div class="module-img"><i class="fa fa-dashboard" style="font-size:46px;color:#3c3c3c;"></i></div>
            <div class="module-hed">Panel</div>
         </div>
      </a>
      <a href="<?php echo base_url();?>user/profile">
         <div class="module">
            <div class="module-img"> <img src="<?php echo base_url();?>assets/designs/images/profile.png" width="49" height="48"></div>
            <div class="module-hed">Profil</div>
         </div>
      </a>
      <a href="<?php echo base_url();?>user/quiz_history">
         <div class="module">
            <div class="module-img"><img src="<?php echo base_url();?>assets/designs/images/histroy.png" width="49" height="48"></div>
            <div class="module-hed">Sınav Tarihi</div>
         </div>
      </a>
   </div>
</div>
<div class="row margin">
   <div class="col-md-12">
      <div class="col-md-9 padd">
         <div class="panel panel-default">
            <div class="panel-heading p-hed">
               <i class="fa fa-bar-chart-o fa-fw"></i> Sınav Performans Grafiği 
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
            <?php if($result!=""){ ?>
               <div id="chart_div" ></div>
               <?php } 
               else { ?>
               Veri Mevcut Değil
               <?php } ?>
            </div>
            <!-- /.panel-body -->
         </div>
      </div>
      <div class="col-md-3">
         <div class="recent-msg">
            <div class="recent-msg-hed">Son Kullanıcı Sınavları</div>
            <div class="recent-msg-con">
               <?php if(count($recentUserQuizzes)) { 
                  foreach($recentUserQuizzes as $l) {
                  
                  ?>
               <div class="recent-msg-total">
                  <div class="recent-msg-img">
                     <img src="<?php echo base_url();?>assets/uploads/images(200x200)/<?php if(isset($l->image)&&$l->image!='')echo $l->image; else echo "dflt-user-icn.png";?>" width="50" height="50">
                  </div>
                  <div class="recent-msg-img-hed">
                     <?php echo $l->username;?><br>
                     <small><?php echo $l->dateoftest;?></small><br>
                     <small><?php echo $l->name.": ".$l->score."/".$l->total_questions;?></small><br>
                  </div>
               </div>
               <?php } }?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12 padd">
      <div class="col-md-6">
         <div class="lates-users">
            <div class="recent-msg-hed" id="latest_quizzes">Son Sınavları</div>
            <?php if (count($exams) > 0) { 
               foreach ($exams as $exam ) {
               ?>
            <div class="recent-msg-total">
               <div class="lates-users-img-hed">
                  <?php echo $exam->name; ?><br>
                  <small>Sınav Türü: <?php echo $exam->quiztype; ?>&nbsp; Süresi:<?php echo $exam->deauration;?></small><br>
               </div>
               <a href="<?php echo base_url();?>user/instructions/<?php echo $exam->quizid;?>/<?php echo $exam->name;?>" >
                  <div class="btn bg-primary wnm-user">Görünüm</div>
               </a>
               <a href="<?php echo base_url();?>user/instructions/<?php echo $exam->quizid;?>/<?php echo $exam->name;?>" >
                  <div class="btn bg-primary wnm-user" >Sınav Al</div>
               </a>
            </div>
            <?php } 
               }
               else {
               ?>
            <div class="recent-msg-total">
               <div class="lates-users-img-hed">
                  Sınavlar Mevcut Değil<br>
               </div>
            </div>
            <?php } ?>
         </div>
      </div>
      <div class="col-md-6">
         <div class="lates-users">
            <div class="recent-msg-hed">En Yüksek</div>
            <?php if (count($topRankers)) { 
               foreach ($topRankers as $t) {
            ?>
            <div class="recent-msg-total">
               <div class="lates-users-img">
                  <img src="<?php echo base_url();?>assets/uploads/images(200x200)/<?php if(isset($t->image)&&$t->image!='')echo $t->image; else echo "dflt-user-icn.png";?>" width="50" height="50">
               </div>
               <div class="lates-users-img-hed">
                  <?php echo $t->username;?><br>
                  <small><?php echo $t->dateoftest." ".$t->timeoftest;?></small><br>
               </div>
               <div class="btn bg-primary wnm-user not-hover" style="cursor:default;"><?php echo $t->name.": ".$t->score."/".$t->total_questions;?></div>
            </div>
            <?php } 
			} 
			?>
         </div>
      </div>
   </div>
</div>

