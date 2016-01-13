<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/jquery.dataTables.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/designs/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
   $(document).ready(function() {
   	$('#example').dataTable();
   	   
   //Get Sub Categories on change of Categories
    $('#catid').change(function() {
   	var catid=$(this).val();
   	$('#subcatid').empty();
   	if (catid=="") {
   		$('#subcatid').empty();
   		$('#subcatid').append("<option value=''>İlk Kategori Seçiniz.</option>");
   	}
   
   	$.ajax({
   	
   		type:'POST',
   		url:'<?php echo base_url();?>user/get_subcategories',
   		data:'catid='+catid+'&<?php echo $this->security->get_csrf_token_name();?>=<?php echo $this->security->get_csrf_hash();?>',
   		cache:false,
   		success: function(data) {
   		
   			var dta = $.parseJSON(data);
   			if(dta.length>0)
   			{
   				$('#subcatid').empty();
   				$('#subcatid').append("<option value=''>Alt Kategori Seçiniz</option>");
   				for(i=0; i<dta.length; i++)
   				$('#subcatid').append("<option value='"+dta[i].subcatid+"'>"+dta[i].name+"</option>");
   			}
   			else
   			{
   				$('#subcatid').empty();
   				alert("Alt Kategori Bulunmuyor");	
   			}		
   		}
   	});
    }); 
    
    });
   
   
   //Get Quizzes by user selected Options like Category, Sub Category, Quiz Type and Difficulty Level.
   function get_quizzes(selected_id)
   {
   var selectedId = selected_id;
   var catid = $('#catid').val();
   var subcatid = $('#subcatid').val();
   var quiztype = $('#quiztype').val();
   var difficultylevel = $('#difficultylevel').val();

   
   $.ajax({
   	
   		type:'POST',
   		url:'<?php echo base_url();?>user/get_quizzes',
   		data:'catid='+catid+'&subcatid='+subcatid+'&quiztype='+quiztype+'&difficultylevel='+difficultylevel+'&<?php echo $this->security->get_csrf_token_name();?>=<?php echo $this->security->get_csrf_hash();?>',
   		cache:false,
   		success: function(data) {
   		//alert(data);
   			var dta = $.parseJSON(data);
   			if(dta.length>0)
   			{
   				var data_to_append = '';
   				
   				var thead = '<thead><tr><th>S.No.</th><th>Sınav Adı</th><th>Kategori</th><th>Alt Kategori</th><th>Zorluk Seviyesi</th><th>Sınav Türü</th><th>Fiyat</th><th>Validity</th><th>Süre</th><th>Eylem</th></tr></thead> ';
   				
   				var tfoot = '<thead><tr><th>S.No.</th><th>Sınav Adı</th><th>Kategori</th><th>Alt Kategori</th><th>Zorluk Seviyesi</th><th>Sınav Türü</th><th>Fiyat</th><th>Validity</th><th>Süre</th><th>Eylem</th></tr></thead>';
   				
   				var tbody_open = '<tbody>';
   				var tbody_content = '';
   				var tbody_close = '</tbody>';						
   				
   				var j=1;
   				for(i=0; i<dta.length; i++)
   				{
   					//var start_date = get_date_format(dta[i].startdate);
   					//var end_date = get_date_format(dta[i].enddate);
   					var quiz = dta[i].quizid;
   					
   					//Get Subjects according to the Quiz
   					//var subjectsTd = get_subjects(quiz);
   					
   					tbody_content = tbody_content + '<tr><td>'+j+'</td><td>'+dta[i].name+'</td><td>'+dta[i].catname+'</td><td>'+dta[i].subcatname+'</td><td>'+dta[i].difficultylevel+'</td><td>'+dta[i].quiztype+'</td><td>'+dta[i].quizcost+'</td><td>'+dta[i].validityvalue+'</td><td>'+dta[i].deauration+'</td><td><a href="<?php echo base_url()?>user/instructions/'+dta[i].quizid+'/'+dta[i].name+'" class="btn bg-primary wnm-user"> <i class="fa fa-puzzle-piece"></i> Sınava Başla</a></td></tr>';
   					j++;
   				}
   				
   				data_to_append = data_to_append + tbody_open + tbody_content + tbody_close;
   				//alert(data_to_append);						
   				
   				$('#example').empty();						
   				$('#example').dataTable().fnDestroy();
   				$('#example').append(data_to_append);
   				$('#example').dataTable();
   				
   				//Highlight Styles(select field) For Selected Filter Options if available.
   				if($('#'+selectedId).val()!='')
   				{
   					$('#'+selectedId).removeAttr('style');
   					$('#'+selectedId).attr('style','border: 2px solid green !important;border-radius: 2px !important;font-weight: 700;padding: 2px !important;width: 100%;');
   				}
   				else
   				{
   					$('#'+selectedId).removeAttr('style');
   					$('#'+selectedId).attr('style','border-radius: 1px !important;font-weight: 600;padding: 2px !important;width: 100%;');
   				}
   				
   			}
   			else
   			{
   				$('#example').empty();						
   				$('#example').dataTable().fnDestroy();
   				$('#example').dataTable({"oLanguage": {"sEmptyTable": "Eşleşen Kayıt Bulunamadı."}});
   				
   				//Highlight Styles(select field) For Selected Filter Options if NOT available.
   				if($('#'+selectedId).val()!='')
   				{
   					$('#'+selectedId).removeAttr('style');
   					$('#'+selectedId).attr('style','border: 2px solid red !important;border-radius: 2px !important;font-weight: 700;padding: 2px !important;width: 100%;');
   				}						
   				
   			}		
   		}
   	});		
   
   }
   
   
   function get_date_format(date)
   {
   var formattedDate = new Date(date);
   var d = formattedDate.getDate();
   var m =  formattedDate.getMonth();
   m += 1;  // JavaScript months are 0-11
   var y = formattedDate.getFullYear();
   var formatted_date = d + "-" + m + "-" + y;
   
   return formatted_date;
   
   }
   
   //Get Subjects according to the Quiz
   function get_subjects(quiz)
   {
   
   var subjectsArr = [];
   var subjectsTd = "";
   var subjectz = "";								
   $.ajax({
   
   type:'POST',
   url:'<?php echo base_url();?>user/get_subjects',
   data:'quizid='+quiz+'&<?php echo $this->security->get_csrf_token_name();?>=<?php echo $this->security->get_csrf_hash();?>',
   cache:false,
   success: function(data) {
   
   	var subjs = $.parseJSON(data);
   										
   	if(subjs.length>0)
   	{										
   		for(k=0; k<subjs.length; k++)
   		{
   			subjectsArr.push(subjs[k].subjectname);																			
   		}
   		
   		for(l=0; l<subjectsArr.length; l++)
   		{
   			subjectz = subjectz + subjectsArr[l];
   			if(l!=(subjectsArr.length-1))
   				subjectz = subjectz + ', ';
   			else if(l==(subjectsArr.length-1))
   				subjectz = subjectz + '.';
   			
   			subjectsTd = '<td>'+subjectsTd + subjectz+'</td>';
   			
   		}
   	}
   	else
   	{
   		subjectsArr.push("Henüz Eklenen Konu yok.");	
   	}			
   } 
   });	
   
   }
   
</script>
<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url();?>user">Anasayfa</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#">   Sınavlar </a></li>
      </ul>
   </div>
</div>
<div class="row">
   <?php echo validation_errors();
      					
      				if($this->session->flashdata('message'))	 echo $this->session->flashdata('message'); 
      ?>
   <div class="col-md-12">
      <p><b>Sınavları Alın</b></p>
      <?php if(isset($data) && count($data)>0)
         $data=$data[0];
         ?> 
      <div class="col-md-5" style="">
         Kategori
         <div class="form-group">
            <?php 
               $val = '';
               	if($this->input->post('catid')) {
               	$val = $this->input->post( 'catid' );
               	}
               	elseif (count($data)) {
               		$val = $data->catid;
               	}
               echo form_dropdown('catid', $categories, $val,'onchange="get_quizzes(this.id);" id="catid"');
               ?>
         </div>
         <div class="form-group">
            Alt Kategori
            <?php 
               $val = '';
               $name = 'İlk Kategori Seçin.';
               	if ($this->input->post('subcatid')) {
					$val = $this->input->post( 'subcatid' );
					$name = '';
               	}
               	elseif (count($data)) {
               		$val = $data->subcatid;
               		$name = $data->subcatname;
               	}
               ?>
            <select name="subcatid" id="subcatid" class="" onchange="get_quizzes(this.id);">
               <option value="<?php echo $val;?>"><?php echo $name;?></option>
            </select>
         </div>
      </div>
      <div class="col-md-5" style="">
         Sınav Türü
         <div class="form-group">
            <?php 
               $val = '';
               	if ($this->input->post('quiztype')) {
					$val = $this->input->post('quiztype');
               	}
               	elseif (count($data)) {
               		$val = $data->quiztype;
               	}
               echo form_dropdown('quiztype', $quiztypes, $val,'id="quiztype" onchange="get_quizzes(this.id);"');
               ?>
         </div>
         <div class="form-group">
            Zorluk Seviyesi
            <?php 
               $val = '';
               	if ($this->input->post('difficultylevel')) {
					$val = $this->input->post( 'difficultylevel' );
               	}
               	elseif (count($data)) {
               		$val = $data->difficultylevel;
               	}
               echo form_dropdown('difficultylevel', $difficultylevels, $val,'id="difficultylevel" onchange="get_quizzes(this.id);"');
               ?>
         </div>
      </div>
   </div>
</div>
<br/>


<div class="row">
   <div class="col-md-12">
      <table id="example" class="cell-border" cellspacing="0" width="100%">
         <thead>
            <tr>
               <th>S.No.</th>
               <th>Sınav Adı</th>
               <th>Kategori</th>
               <th>Alt Kategori</th>
               <th>Zorluk Seviyesi</th>
               <th>Sınav Türü</th>
               <th>Fiyat</th>
			   <th>Geçerlilik</th>
               <th>Süre</th>
               <th>Eylem</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
              <th>S.No.</th>
               <th>Sınav Adı</th>
               <th>Kategori</th>
               <th>Alt Kategori</th>
               <th>Zorluk Seviyesi</th>
               <th>Sınav Türü</th>
               <th>Fiyat</th>
			   <th>Geçerlilik</th>
               <th>Süre</th>
               <th>Eylem</th>
            </tr>
         </tfoot>
         <tbody>
            <?php if (count($records)>0) {  
               $i=1;
               foreach ($records as $r) {
            ?>
            <tr>
               <td><?php echo $i++;?></td>
               <td><?php echo $r->name;?></td>
               <td><?php echo $r->catname;?></td>
               <td><?php echo $r->subcatname;?></td>
               <td><?php echo $r->difficultylevel;?></td>
               <td><?php echo $r->quiztype; ?></td>
               <td><?php if($r->quiztype=="Free")echo "Ücretsiz"; else echo $r->quizcost;?></td>
			   <td><?php if($r->quiztype=="Free")echo "Ücretsiz"; else echo $r->validityvalue. "  ".$r->validitytype;?></td>
               <td><?php echo $r->deauration;?></td>
               <td>
                  <a href="<?php echo base_url();?>user/instructions/<?php echo $r->quizid;?>/<?php echo $r->name;?>" class="btn bg-primary wnm-user"> <i class="fa fa-puzzle-piece"></i> Sınava Başla</a>
               </td>
            </tr>
            <?php } 
			} 
			else "<tr><td colspan='4'>Mevcut Veri Yok.</td></tr>"; 
			?>
			 <?php if (count($records_for_all)>0) {  
               $i=1;
               foreach ($records_for_all as $r) {
            ?>
            <tr>
               <td><?php echo $i++;?></td>
               <td><?php echo $r->name;?></td>
               <td><?php echo $r->catname;?></td>
               <td><?php echo $r->subcatname;?></td>
               <td><?php echo $r->difficultylevel;?></td>
               <td><?php echo $r->quiztype; ?></td>
               <td><?php if($r->quiztype=="Free")echo "Ücretsiz"; else echo $r->quizcost;?></td>
			   <td><?php if($r->quiztype=="Free")echo "Ücretsiz"; else echo $r->validityvalue. "  ".$r->validitytype;?></td>
               <td><?php echo $r->deauration;?></td>
               <td>
                  <a href="<?php echo base_url();?>user/instructions/<?php echo $r->quizid;?>/<?php echo $r->name;?>" class="btn bg-primary wnm-user"> <i class="fa fa-puzzle-piece"></i> Sınava Başla</a>
               </td>
            </tr>
            <?php } 
			} 
			else "<tr><td colspan='4'>Mevcut Veri Yok.</td></tr>"; 
			?>
         </tbody>
      </table>
   </div>
</div>




<style>
   .form-group > select {
   border-radius: 2px !important;
   font-weight: 600;
   padding: 2px !important;
   width: 100%;
   }
</style>