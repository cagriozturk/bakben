<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/designs/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/editor.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/designs/js/editor.js"></script>
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url();?>admin">Anasayfa</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="<?php echo base_url();?>admin/group_settings"> Ayarlar</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#"> <?php if(count($data)>0) echo "Update Group"; else echo "Add Group";?></a></li>
      </ul>
   </div>
</div>
<div class="row">
   <div class="col-md-8">
      <div style="color:#FF0000; font-size:12px; padding-left:10px;"><?php 
         echo $this->session->flashdata('message');
         ?>
      </div>
      
	  
	  
	  <form method="POST" action="<?php echo base_url();?>admin/add_group" id="subjects_form">
         <?php if(count($data)>0)
            $data=$data[0];
            ?>   
			
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />	
			
         <div class="form-group">
            <label for="inputEmail">Grup Adı</label>
            <?php 
               $val = '';
               	if ($this->input->post('group_name')) {
					$val = $this->input->post( 'group_name' );
               	}
               	elseif (count($data)) {
               		$val = $data->group_name;
               	}
				 echo form_input('group_name',$val,'class="form-control" placeholder="Enter Group Name"');
			?>
            
         </div>
         <div class="form-group">
            <label for="inputEmail">Durum</label>
            <?php 
               $val = '';
               	if ($this->input->post('status')) {
					$val = $this->input->post('status');
               	}
               	elseif (count($data)) {
               		$val = $data->status;
               	}
               echo form_dropdown('status', $element, $val,'class="form-control"');
               ?>
         </div>
		 
		 
         <input type="hidden" name="id" value="<?php if(isset($id)) echo $id;?>">
         
		 
		 <button type="submit" class="btn btn-primary wnm-user"><?php if(count($data)>0) echo "Update"; else echo 
		 "Add";?></button>
      
	  
	  </form>
   </div>
</div>
<!-- Validations -->
<script src="<?php echo base_url();?>assets/designs/js/jquery.validate.min.js"></script>
<script type="text/javascript"> 
   (function($,W,D)
   {
      var JQUERY4U = {};
   
      JQUERY4U.UTIL =
      {
          setupFormValidation: function()
          {		
   		//form validation rules
              $("#subjects_form").validate({
   			rules: {
   				name: {
   					required: true,
   					rangelength: [2, 30]
   				}
   				
                  },
   			
   			messages: {
   				name: {
                          required: "Please enter subject name."
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

