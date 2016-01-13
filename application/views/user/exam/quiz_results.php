<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url();?>user">Anasayfa</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#">  Sınav Sonuçları </a></li>
      </ul>
   </div>
</div>
<div class="row margin">
   <div class="col-md-12">
      <div class="col-md-8 padd">
         <div class="col-md-12 padd">
            <div class="panel panel-default">
               <div class="panel-heading p-hed">
                  <?php echo $quiz_info->name; ?> 
                  <div>
                     <?php foreach($quizRecords as $subj) { ?>
                     <a href="#<?php echo $subj->subjectid."_1";?>"><?php echo $subj->subjectname;?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <?php } ?>
                  </div>
               </div>
               <!-- /.panel-heading -->
               <div class="panel-body  pre-scrollable scroll-height">
                  <div id="morris-area-chart">
                     <?php $sno=1;foreach($questions as $row) { 
                        $i=1;
                        foreach($row as $q) {
                        
                        
                        ?>
                     <div class="col-md-12 padd border" id="<?php echo $q->subjectid."_".$i++;?>">
                        <h4 class="quction"><?php echo $sno++.". ".$q->question;?></h4>
                        <table width="100%" border="0" class="answeers">
                           <input type="radio" name="<?php echo $q->questionid;?>" value="0" id="" style="display:none;" <?php if(isset($user_options[$q->questionid])) if($user_options[$q->questionid]==0) echo "checked";?> >
                           <?php 
                              if (isset($q->answer1)) {  
                               ?>
                           <tr>
                              <td>
                                 <input type="radio" name="<?php echo $q->questionid;?>" value="1" id="" <?php if(isset($user_options[$q->questionid])) if($user_options[$q->questionid]==1) echo "checked";?> >
                                 <?php echo $q->answer1;?>
                              </td>
                           </tr>
                           <?php } ?>
                           <?php 
                              if (isset($q->answer2)) {  
                               ?>
                           <tr>
                              <td>
                                 <input type="radio" name="<?php echo $q->questionid;?>" value="2" id="" <?php if(isset($user_options[$q->questionid])) if($user_options[$q->questionid]==2) echo "checked";?> >
                                 <?php echo $q->answer2;?>
                              </td>
                           </tr>
                           <?php } ?>
                           <?php 
                              if (isset($q->answer3)) {  
                               ?>
                           <tr>
                              <td>
                                 <input type="radio" name="<?php echo $q->questionid;?>" value="3" id="" <?php if(isset($user_options[$q->questionid])) if($user_options[$q->questionid]==3) echo "checked";?> >
                                 <?php echo $q->answer3;?>
                              </td>
                           </tr>
                           <?php } ?>
                           <?php 
                              if (isset($q->answer4)) {  
                               ?>
                           <tr>
                              <td>
                                 <input type="radio" name="<?php echo $q->questionid;?>" value="4" id="" <?php if(isset($user_options[$q->questionid])) if($user_options[$q->questionid]==4) echo "checked";?> >
                                 <?php echo $q->answer4;?>
                              </td>
                           </tr>
                           <?php } ?>
                           <?php 
                              if (isset($q->answer5)) {  
                               ?>
                           <tr>
                              <td>
                                 <input type="radio" name="<?php echo $q->questionid;?>" value="5" id="" <?php if(isset($user_options[$q->questionid])) if($user_options[$q->questionid]==5) echo "checked";?> >
                                 <?php echo $q->answer5;?>
                              </td>
                           </tr>
                           <?php } ?>
                           <tr>
                              <td> </td>
                           </tr>
                           <tr>
                              <td>
                                 <div class="btn bg-primary   <?php if(isset($user_options[$q->questionid])){ if($user_options[$q->questionid]==$answers[$q->questionid])  echo "correct-answ"; else echo "wrong-answ"; } else echo "wrong-answ";?>">Doğru Cevap: <?php echo $answers[$q->questionid]; ?></div>
                              </td>
                           </tr>
                        </table>
                     </div>
                     <?php } } ?>
                  </div>
               </div>
               <!-- /.panel-body -->
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="lates-users">
            <div class="recent-msg-hed quiz-bhed">Sınav Bilgileri <i class="fa fa-exclamation-circle"></i></div>
            <div class="recent-msg-total">
               <div class="lates-users-img-hed quiz-hed">
                  Toplam Sorular:<br>
               </div>
               <div class="btn bg-primary wnm-user"><?php echo $totalQuestions; ?></div>
            </div>
            <div class="recent-msg-total">
               <div class="lates-users-img-hed quiz-hed">
                  Zaman (dakika):<br>
               </div>
               <div class="btn bg-primary wnm-user"><?php echo $quiz_info->deauration; ?></div>
            </div>
            <?php if(isset($negativeMark)) { ?>
            <div class="recent-msg-total">
               <div class="lates-users-img-hed quiz-hed">
                  Negatif İşaretle:<br>
               </div>
               <div class="btn bg-primary wnm-user"><?php echo $negativeMark; ?></div>
            </div>
            <?php } ?>   
         </div>
         <div class="lates-users top">
            <div class="recent-msg-hed quiz-bhed">Genel Bilgi <i class="fa fa-clock-o"></i></div>
            <div class="recent-msg-total">
               <div class="lates-users-img-hed quiz-hed">
                 Puanınız 
                  :
               </div>
               <div class="btn bg-primary wnm-user"><?php echo $score; ?> / <?php echo $totalQuestions; ?></div>
            </div>
         </div>
         <div class="lates-users top">
            <div class="recent-msg-hed quiz-bhed">Sonuç Özeti <i class="fa fa-tasks"></i></div>
            <div class="recent-msg-total mar-resu-summ">
               <div class="lates-users-img-hed quiz-hed result-sum-hed">
                  Denenmiş Sorular : <?php echo $attempted_percentage.'%';?> 
               </div>
               <div class="progress gress">
                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $attempted_percentage.'%';?>">
                     <span class="sr-only"><?php echo $attempted_percentage.'%';?> Tam</span>
                  </div>
               </div>
            </div>
            <div class="recent-msg-total mar-resu-summ">
               <div class="lates-users-img-hed quiz-hed result-sum-hed">
                  Doğru Yanıtlar : <?php echo $score_percentage.'%';?> 
               </div>
               <div class="progress gress">
                  <div class="progress-bar  progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php if($score_percentage < 0) echo '0%'; else echo $score_percentage.'%';?>">
                     <span class="sr-only"><?php echo $score_percentage.'%';?> Tam</span>
                  </div>
               </div
                  >
            </div>
            <div class="recent-msg-total mar-resu-summ">
               <div class="lates-users-img-hed quiz-hed result-sum-hed">
                  Yanlış Cevaplar : <?php echo $wrong_percentage.'%';?> 
               </div>
               <div class="progress gress">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $wrong_percentage.'%';?>">
                     <span class="sr-only"><?php echo $wrong_percentage.'%';?> Komple (uyarı)</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="lates-users top">
            <div class="recent-msg-hed quiz-bhed">Bu Sınavda Yüksek Skorlar <i class="fa fa-flag"></i></div>
            <?php if(count($previous_score)) { 
               foreach($previous_score as $s) {
               
               ?>
            <div class="recent-msg-total">
               <div class="lates-users-img">
                  <img src="<?php echo base_url();?>assets/uploads/images(200x200)/<?php if(isset($s->image)&&$s->image!='')echo $s->image; else echo "dflt-user-icn.png";?>" width="50" height="50">
               </div>
               <div class="lates-users-img-hed quiz-hed">
                  <?php echo $s->username;?> <br>
                  <small><?php echo $s->dateoftest."  ".$s->timeoftest;?></small><br>
               </div>
               <div class="btn bg-primary wnm-user"><?php echo $s->score; ?> / <?php echo $totalQuestions; ?></div>
            </div>
            <?php } } else echo '<div class="recent-msg-total">Mrvcut Kayıt Yok.</div>';?>
         </div>
      </div>
   </div>
</div>
<link href="<?php echo base_url();?>assets/designs/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/designs/js/TableBarChart.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/designs/css/TableBarChart.css" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script type="text/javascript">
   $(function() {
   	$('#source').tableBarChart('#target', '', false);
   	});
   
</script>
<style>
   .progress-bar {
   border-radius: 2px;
   box-shadow: 0 2px 3px rgba(0, 0, 0, 0.25) inset;
   width: 250px;
   height: 20px;
   position: relative;
   display: block;
   }
   .progress-bar > span {
   background-color: blue;
   border-radius: 2px;
   display: block;
   text-indent: -9999px;
   }
</style>

