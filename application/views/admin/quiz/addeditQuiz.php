<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/designs/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/editor.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready( function() {
          $("#txtEditor").Editor();
  
  //Get Sub Categories on change of Categories
    $('#catid').change(function() {
   	var catid=$(this).val();
   	if(catid=="") {
   		$('#subcatid').empty();
   		$('#subcatid').append("<option value=''>İlk Kategori Seçin.</option>");
   	}
   
   	$.ajax({
   	
   		type:'POST',
   		url:'<?php echo base_url();?>admin/getSubCategories',
   		data:'catid='+catid+'&<?php echo $this->security->get_csrf_token_name();?>=<?php echo $this->security->get_csrf_hash();?>',
   		cache:false,
   		success: function(data) {
   		
   			var dta = $.parseJSON(data);
   			if (dta.length>0) {
   				$('#subcatid').empty();
   				$('#subcatid').append("<option value=''>Alt Kategori Seçin</option>");
   				for(i=0; i<dta.length; i++)
   				$('#subcatid').append("<option value='"+dta[i].subcatid+"'>"+dta[i].name+"</option>");
   			}
   			else {
   				$('#subcatid').empty();
   				alert("Alt kategori mevcut değil.");	
   			}		
   		}
   	});
    });
    
    //If the Negative marks status is Inactive, hide the form field 'Negative marks'.
    $('#negativemarkstatus').change(function() {
    
   	if($(this).val()=="Aktif") {
   		$('#NegativeMarkDiv').fadeIn();
   	}
   	else {
   		$('#NegativeMarkDiv').fadeOut();
   		$('#negativemark').val('');
   	}
    
    });
	
	//QUIZ TYPE SETTINGS
	$('#quiztype').change(function() {
    
   	if($(this).val()=="Paralı") {
   		$('#quiztypediv').fadeIn();
   	}
   	else {
   		$('#quiztypediv').fadeOut();
   		$('#quizcost').val('0');
		$('#validity').val('0');
   	}
    
    });
	
	
    
    
   //Append data to the table, on click of add subjects and no. of questions
   if($('#qq_table >tbody >tr').length==0)
   	$('#qq_table').hide();
   $('#quiz_questions').click(function() {
   	var minQuestions=1;
   	var maxQuestions=20;
   	var noOfAvailableQuestions = parseInt($('#no_of_available_questions').val());
   	var noOfQuestions=$('#totalquestion').val();
   	//var tdata="";	
   	if($('#subjectid').val()!='' && noOfQuestions!='' && 
   		noOfQuestions>=minQuestions) {
   		if(noOfAvailableQuestions!=0 && noOfQuestions<=noOfAvailableQuestions) {
   			$('#qq_table').show();
   			var bit=1;
   			var tdata="";
   			var subjectid=$('#subjectid').val();
   			var subjectname=$('#subjectid option:selected').text();
   			var totalquestion=noOfQuestions;
   			
   			$('#qq_table >tbody >tr').each(function() {
   							
   			var subject_id=$(this).attr('id').split("_")[1];
   			if(subjectid==subject_id) {
   				$('#totalquestion_'+subject_id).val(totalquestion);
   				
   				//Styles for focusing the total questions update operation.
   				$('html, body').animate({scrollTop: $('#totalquestion_'+subject_id).offset().top}, 2000);
   				$('#totalquestion_'+subject_id).attr('style','border:4px solid #93edf7;cursor: default;text-align: center;width:65px;');
   				setTimeout(function(){$('#totalquestion_'+subject_id).attr('style','border:1px solid #bfbfbf;cursor: default;text-align: center;width:65px;');},3000);
   				$('html, body').animate({scrollTop: $('#hfour').offset().top}, 2000);
   				
   				bit=0;
   			}
   			
   			});
   			
   			if(bit==1) {
   				tdata = '<tr id="tr_'+subjectid+'"><td></td><td>'+subjectname+'</td><td><input type="text" id="totalquestion_'+subjectid+'" class="form-control" style="width:65px;text-align:center;cursor:default;" value="'+totalquestion+'" readonly></td><td><a onclick="deleteRow('+subjectid+')" class="btn bg-primary wnm-user"><i class="fa fa-times-circle"></i> </a></td></tr>';
   
   				$('#qq_table').append(tdata);
   					$('#subjectid').val('');
   					$('#totalquestion').val('');
   					$('#no_of_available_questions_p').empty();
   					$('#no_of_available_questions').val(0);
   					$('#no_of_available_questions_p').fadeOut();
   					
   				//Styles for focusing the adding total questions operation.
   				$('html, body').animate({scrollTop: $('#totalquestion_'+subjectid).offset().top}, 2000);
   				$('#totalquestion_'+subjectid).attr('style','border:4px solid #93edf7;cursor: default;text-align: center;width:65px;');
   				setTimeout(function(){$('#totalquestion_'+subjectid).attr('style','border:1px solid #bfbfbf;cursor: default;text-align: center;width:65px;');},3000);
   				$('html, body').animate({scrollTop: $('#hfour').offset().top}, 2000);
   				
   					
   			}
   			reset_sno();
   		}
   		else if (noOfAvailableQuestions==0) {
   			alert('Bu konu ile ilgili mevcut soru yok.');
   		}
   		else {
   			alert('Mevcut aralıkta sorular yok ekleyin lütfen.');
   		}
   	}
   	else if ($('#subjectid').val()=='') {
   		alert("Konu Seçin.");
   	}
   	else {
   		alert("Her dersten en az 1 soru ekleyin.");
   	}		
   });
   
   
   //Append row to the table on pressing 'enter key' at the form field No. of Questions
   $('#totalquestion').bind('keypress',function(e){
   	
   	var code = e.keyCode || e.which;
   
   	if ($('#subjectid').val()!='' && $(this).val()!='' && code == 13) {
   		e.preventDefault();
   		$('#quiz_questions').click();
   		$('#subjectid').focus();
   	}
   });
   
   
   //On clicking submit button, get the appended Table data first by preventing the submission and then submit the form.
   $('#submitbtn').click(function(e) {
   	e.preventDefault();
   	var quizQuestions=" ";
   	$('#qq_table >tbody >tr').each(function() {
   		var subject_id=$(this).attr('id').split("_")[1];					
   		var total_questions = $('#totalquestion_'+subject_id).val();
   		quizQuestions +=subject_id+","+total_questions+"^";
   	});
   	
   	$('#qq').val(quizQuestions);
   	$('#quizform').submit();
   	
   });
     });
   
   //For Deleting Table Row based on subjectid
   function deleteRow(subjectid)
   {
   $('#tr_'+parseInt(subjectid)).remove();
   reset_sno();
   if($('#qq_table >tbody >tr').length==0)
   	$('#qq_table').hide();
   	
   }
   
   //Get no. of available questions in the selected subject based on the selected difficulty level.
   function get_available_questions()
   {
   var difficulty_level = "Orta";
   if($('#difficultylevel').val()!="")
   	difficulty_level = $('#difficultylevel').val();
   var subjectId = $('#subjectid').val();
   var no_of_available_questions = 0;
   $('#no_of_available_questions_p').empty();
   $('#no_of_available_questions').val(no_of_available_questions);
   
   if (subjectId!="") {			
   	$.ajax({
   		type:'POST',
   		url:'<?php echo base_url();?>admin/get_available_questions',
   		data:'subjectid='+subjectId+'&difficultylevel='+difficulty_level+'&<?php echo $this->security->get_csrf_token_name();?>=<?php echo $this->security->get_csrf_hash();?>',
   		cache:false,
   		success: function(data) {
   			if(data != 0) {						
   				$('#no_of_available_questions_p').append("<i class='fa fa-info-circle'></i> Bu konuda mevcut soru: "+data);						
   			}
   			else {
   				$('#no_of_available_questions_p').append("<i class='fa fa-info-circle'></i> Bu Konuda mevcut soru yok.");
   			}
   		  $('#no_of_available_questions_p').fadeIn();
   		  $('#no_of_available_questions').val(data);
   		}
   	});
   }
   else {
   	$('#no_of_available_questions_p').fadeOut();
   }
   }
   
   //Onchange of Difficulty Level Reset the Subjects table and available questions.
   function reset_subjects_table()
   {
   $('#qq_table tbody tr').remove();
   $('#subjectid').val('');
   $('#no_of_available_questions_p').empty();
   $('#no_of_available_questions').val(0);
   $('#no_of_available_questions_p').fadeOut();
   //alert($('#qq_table tbody tr').length);
   if($('#qq_table tbody tr').length==0)
   	$('#qq_table').hide();
   }
   
   //For setting the question value to the text Editor.
   function set(val)
   {
   //alert(val);
   $('#contentarea').text(val);
   }
   
   function reset_sno()
   {
   $('#qq_table tr').each(function(index) {
   	$(this).find('td:nth-child(1)').html(index);
   });
   }
   
</script>
<script src="<?php echo base_url();?>assets/designs/js/editor.js"></script>
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script>
   $(function() {
   $( "#startdate" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   numberOfMonths: 3,
   onClose: function( selectedDate ) {
   $( "#enddate" ).datepicker( "option", "minDate", selectedDate );
   }
   });
   $( "#enddate" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   numberOfMonths: 3,
   onClose: function( selectedDate ) {
   $( "#startdate" ).datepicker( "option", "maxDate", selectedDate );
   }
   });
   });
</script>
    
<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url();?>admin">Anasayfa</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="<?php echo base_url();?>admin/quiz">Sınav</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#"> <?php if(count($data)>0) echo "Güncel Sınav"; else echo "Sınav Ekle";?></a></li>
      </ul>
   </div>
</div>

<div class="row">
   <div class="col-md-8">
      <div style="color:#FF0000; font-size:12px; padding-left:10px;"><?php echo validation_errors();
         echo $this->session->flashdata('message');
         ?>
      </div>
      <form method="POST" name="quizform" id="quizform" action="<?php echo base_url();?>admin/addeditQuiz">
         <?php if(count($data)>0)
            $data=$data[0];
            ?>  
            
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />  
            
         <div class="form-group">
            <label for="inputEmail">Sınav Adı</label>
            <?php 
               $val = '';
               	if ($this->input->post( 'name' )) {
               	$val = $this->input->post( 'name' );
               	}
               	elseif (count($data)) {
               		$val = $data->name;
               	}
               ?>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $val;?>" placeholder="Enter Quiz name" >    
         </div>
         <div class="form-group">
            <label for="inputEmail">Kategori</label>
            <?php 
               $val = '';
               	if ($this->input->post( 'catid' )) {
					$val = $this->input->post( 'catid' );
               	}
               	elseif (count($data)) {
               		$val = $data->catid;
               	}
               echo form_dropdown('catid', $categories, $val,'class="form-control" id="catid"');
               ?>
         </div>
         <div class="form-group">
            <label for="inputEmail">Alt Kategori</label>
            <?php 
               $val = '';
               $name = 'Select Category First.';
               	if ($this->input->post( 'subcatid' )) {
					$val = $this->input->post('subcatid');
					$name = '';
               	}
               	elseif (count($data)) {
               		$val = $data->subcatid;
               		$name = $data->subcatname;
               	}
               ?>
            <select name="subcatid" id="subcatid" class="form-control">
               <option value="<?php echo $val;?>"><?php echo $name;?></option>
            </select>
         </div>
         <div class="form-group">
            <label for="inputEmail">Olumsuz Not Durumu</label>
            <?php 
               $val = 'Inactive';
               	if ($this->input->post('negativemarkstatus')) {
               	$val = $this->input->post('negativemarkstatus');
               	}
               	elseif (count($data)) {
               		$val = $data->negativemarkstatus;
               	}
               
               echo form_dropdown('negativemarkstatus', $negativemarksstatus, $val,'class="form-control" id="negativemarkstatus"');
               ?>
         </div>
         <div class="form-group" id="NegativeMarkDiv" <?php if(count($data)) { if($data->negativemarkstatus=="Inactive") echo "style='display:none;'"; } else echo "style='display:none;'"; ?>>
            <label for="inputEmail">Negatif İşaretle</label>
            <?php 
               $val = '';
               	if ($this->input->post( 'negativemark' )) {
					$val = $this->input->post( 'negativemark' );
               	}
               	elseif (count($data)) {
               		$val = $data->negativemark;
               	}
               ?>
            <input type="text" class="form-control" id="negativemark" name="negativemark" value="<?php echo $val;?>" placeholder="Enter Negative Mark" >
         </div>
         <div class="form-group">
            <label for="inputEmail">Zorluk Seviyesi</label>
            <?php 
               $val = 'Orta';
               	if ($this->input->post( 'difficultylevel' ) ) {
					$val = $this->input->post( 'difficultylevel' );
               	}
               	elseif (count($data)) {
               		$val = $data->difficultylevel;
               	}
               
               echo form_dropdown('difficultylevel', $difficultylevels, $val,'class="form-control" id="difficultylevel" onchange="reset_subjects_table()"');
               ?>
         </div>
         <!--	<div class="form-group">
            <label for="inputEmail">Hint Status</label>
            <?php 
               $val = 'Pasif';
               	if ($this->input->post( 'hint' )) {
					$val = $this->input->post( 'hint' );
               	}
               	elseif (count($data)) {
               		$val = $data->hint;
               	}
               echo form_dropdown('hint', $element, $val,'class="form-control"');
               ?>
            
            </div>	-->
			
         <div class="form-group">
            <label for="inputEmail">Başlangıç Tarihi</label>
            <?php 
               $val = '';
               	if ($this->input->post('startdate')) {
					$val = $this->input->post('startdate');
               	}
               	elseif (count($data)) {
               		$val = date('m/d/Y',strtotime($data->startdate));
               	}
               
               ?>
            <input type="text" class="form-control" id="startdate" name="startdate" value="<?php echo $val;?>" placeholder="Enter Start Date (mm/dd/yyyy)" >
         </div>
         <div class="form-group">
            <label for="inputEmail">Bitiş Tarihi</label>
            <?php 
               $val = '';
               	if ($this->input->post('enddate')) {
					$val = $this->input->post( 'enddate' );
               	}
               	elseif (count($data)) {
               		$val = date('m/d/Y',strtotime($data->enddate));
               	}
               ?>
            <input type="text" class="form-control" id="enddate" name="enddate" value="<?php echo $val;?>" placeholder="Enter End Date (mm/dd/yyyy)" >
         </div>
         <div class="form-group">
            <label for="inputEmail">Süre</label>
            <?php 
               $val = '';
               	if ($this->input->post('deauration')) {
					$val = $this->input->post('deauration');
               	}
               	elseif (count($data)) {
               		$val = $data->deauration;
               	}
               ?>
            <input type="number" class="form-control" id="deauration" name="deauration" value="<?php echo $val;?>" placeholder="Enter Duration for Quiz (in minutes; if quiz duration is one hour, type as 60.)" >
         </div>
		 
		 
		 	<!--QUIZ TYPE PART START-->
			 <div class="form-group">
            <label for="inputEmail">Sınav Türü</label>
            <?php 
               $val = 'Parasız';
               	if ($this->input->post('quiztype')) {
               	$val = $this->input->post('quiztype');
               	}
               	elseif (count($data)) {
               		$val = $data->quiztype;
               	}
               
               echo form_dropdown('quiztype', array('Free'=>'Free','Paid'=>'Paid'), $val,'class="form-control" id="quiztype"');
               ?>
         </div>
		 
		 <?php if(count($quizfor)>0) { ?>
		 
		   <div class="form-group">
		    <label for="inputEmail">Sınav için</label>&nbsp;&nbsp;&nbsp;
  		 <label>
          <input type="checkbox" id="for_all" name="for_all" <?php if(count($data)) { if($data->quiz_for == "0") echo "checked";}?>> Bütün Üyeler
        </label>
        <br>
        <label>
		
			<?php 
            	
               /* $val = array();
               if(count($data))
               $val = explode(',',$data->quiz_for); */
             
			  $str = 'class="form-control" id="quizfor" required';
			 
			   if(count($data)) if($data->quiz_for == "0")  $str = $str." disabled";
			 
				echo form_multiselect('quizfor[]', $quizfor ,$groups,$str);
				//'class="form-control" id="quizfor" required'
             ?>
			 
		    
        </label>
  </div>
		 
		 <?php } else { ?>
		 
		 <input type="checkbox" id="for_all" name="for_all" checked style='display:none;'>
		 
		 <?php } ?>
		 
         <div class="form-group" id="quiztypediv" <?php if(count($data)) { if($data->quiztype=="Free") echo "style='display:none;'"; } else echo "style='display:none;'"; ?>>
		 
		  <label for="inputEmail">Geçerlilik Tipi</label>
		    <?php 
               $val = 'Days';
               	if ($this->input->post('validitytype')) {
               	$val = $this->input->post('validitytype');
               	}
               	elseif (count($data)) {
               		$val = $data->validitytype;
               	}
               
               echo form_dropdown('validitytype', array('Days'=>'Days','Attempts'=>'Attempts'), $val,'class="form-control" id="validitytype"');
               ?>
			   
		 
            <label for="inputEmail">Geçerlilik Değeri</label>
            <?php 
               $val = '0';
               	if ($this->input->post( 'validityvalue' )) {
					$val = $this->input->post( 'validityvalue' );
               	}
               	elseif (count($data)) {
               		$val = $data->validityvalue;
               	}
               ?>
            <input type="text" class="form-control" id="validityvalue" name="validityvalue" value="<?php echo $val;?>" placeholder="Enter Validity Type (No. of Days/No. of Attempts)" >
			
			<label for="inputEmail">Fiyat</label>
            <?php 
               $val = '0';
               	if ($this->input->post( 'quizcost' )) {
					$val = $this->input->post( 'quizcost' );
               	}
               	elseif (count($data)) {
               		$val = $data->quizcost;
               	}
               ?>
            <input type="text" class="form-control" id="quizcost" name="quizcost" value="<?php echo $val;?>" placeholder="Enter the cost in numbers" >
			
         </div>
			
			<!--QUIZ TYPE PART END-->
		 
		 
		 
		 
		 
         <div class="form-group">
            <label for="inputEmail">Durum</label>
            <?php 
               $val = '';
               	if ($this->input->post( 'status' )) {
					$val = $this->input->post('status');
               	}
               	elseif (count($data)) {
               		$val = $data->status;
               	}
               echo form_dropdown('status', $element, $val,'class="form-control"');
               ?>
         </div>
         <h4 id="hfour">Seçnme Sınav Soruları Seti</h4>
         <div class="col-md-12">
            <div class="col-md-6">
               <div class="form-group">
                  <label for="inputEmail">Konu</label>
                  <?php 
                     echo form_dropdown('subjectid', $subjects, '','class="form-control" id="subjectid" onchange="get_available_questions()"');
                     ?>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label for="inputEmail">Hayır Sorular</label>
                  <input type="number" min="1" class="form-control" id="totalquestion" name="totalquestion" value="" placeholder="Enter no. of Questions you want to give." >
                  <p style="dispaly:none;background-color: #d9edf7;border-color: #bce8f1;border-radius: 3px;color: #31708f;padding-left: 5px;" id="no_of_available_questions_p"></p>
                  <input type="hidden" id="no_of_available_questions">
               </div>
            </div>
         </div>
         <input type="hidden" name="qq" id="qq" >
         <button type="button" style="float:right;" class="btn btn-primary wnm-user" id="quiz_questions">Ekle</button>
         <table id="qq_table" class="serial" width="100%">
            <thead>
               <tr>
                  <th>S.No.</th>
                  <th>Konu</th>
                  <th>Hayır Sorular</th>
                  <th>Eylem</th>
               </tr>
            </thead>
            <tbody>
               <?php if (count($qqdata)) { $i=1; 
						foreach ($qqdata as $qq) {
							$subjid=$qq->subjectid;
                ?>
               <tr id="tr_<?php echo $subjid;?>">
                  <td><?php echo $i++;?></td>
                  <td><?php echo $qq->subjectname;?></td>
                  <td><input type="text" id="totalquestion_<?php echo $subjid;?>" class="form-control" style="width:65px;text-align:center;cursor:default;" value="<?php echo $qq->totalquestion;?>" readonly></td>
                  <td><a onclick="deleteRow(<?php echo $subjid;?>)" class="btn bg-primary wnm-user"><i class="fa fa-times-circle"></i> </a>
                  </td>
               </tr>
               <?php 
						} 
					} 
			   ?>
            </tbody>
         </table>
         <input type="hidden" name="id" value="<?php if(isset($id)) echo $id;?>">
         <button type="submit" id="submitbtn" class="btn btn-primary wnm-user"><?php if(count($data)>0) echo "Güncelle"; else echo "Kaydet";?></button>
      </form>
   </div>
</div>
<!-- Validations -->
<script src="<?php echo base_url();?>assets/designs/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/designs/js/additional-methods.min.js"></script>
<script type="text/javascript"> 
   (function($,W,D)
   {
      var JQUERY4U = {};
   
      JQUERY4U.UTIL =
      {
          setupFormValidation: function()
          {				
   		//Additional Methods
   		$.validator.addMethod("dateFormat",function(value, element) { return value.match(/^(0[1-9]|1[012])[\/](0[1-9]|[12][0-9]|3[01])[\/](20)\d\d$/); }, "Please enter a date in the format mm/dd/yyyy (e.g., 06/31/2014).");			
   		
   		//form validation rules
              $("#quizform").validate({
                  
   			ignore: "", //To validate hidden fields
   			rules: {
                      name: {
   					required: true,
   					rangelength: [2, 90]
   				},
   				catid: {
   					required: true
   				},
   				subcatid: {
   					required: true
   				},
   				startdate: {
   					required: true,
   					dateFormat: true
   				},
   				enddate: {
   					required: true,
   					dateFormat: true
   				},
   				deauration: {
   					required: true,
   					digits: true,
   					rangelength: [1, 90]
   				},
   				qq: {
   					required: true
   				}
   				
                  },
   			
   			messages: {
   				name: {
                          required: "Sınav için başlık girin."
                      },
   				catid: {
   					required: "Kategori Seçin."
   				},
   				subcatid: {
   					required: "Alt Kategori Seçin."
   				},
   				startdate: {
   					required: "Sınav Başlama Tarihi girin."
   				},
   				enddate: {
   					required: "Sınav bitiş tarihi girin."
   				},
   				deauration: {
   					required: "Sınav süresi girin dakika cinsinden."
   				},
   				qq: {
   					required: "Please select subjects and no. of questions. (Ignore this message if subjects & no. of questions are added. And this message will be removed when clicks on save button.)"
   				}
   			},
                  
                  submitHandler: function(form) {
                      form.submit();
                  }
              });
          }
      }
   
      //when the dom has loaded setup form validation rules
      $(D).ready(function($) {
          JQUERY4U.UTIL.setupFormValidation();
      });
   
   })(jQuery, window, document);
</script>


 <script>
// Disable or Enable quiz for all
document.getElementById("for_all").onclick=function(){
	if(this.checked)
	{	
		$('#quizfor').attr('disabled','disabled');
		
		
		
	}
	else
	{
		$('#quizfor').removeAttr('disabled');
	}
}
</script>
