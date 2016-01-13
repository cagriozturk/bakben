<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url().$user_type;?>">Anasayfa</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#">  Şifreyi Değiştir </a></li>
      </ul>
   </div>
</div>
<div class="row margin">
   <?php echo $this->session->flashdata('message');?>
   <div class="col-md-12">
      <div class="col-md-2">
         <img src="<?php echo base_url();?>assets/uploads/images(200x200)/<?php if($this->session->userdata('image')!='') echo $this->session->userdata('image');else echo 'dflt-user-icn.png';?>"  class="img-responsive thumbnail">
      </div>
      <div class="col-md-9">
         <div class="col-md-4 padd">
            <div class="sectin-hed">
               Şifreyi Değiştir
            </div>
         </div>
         <div class="col-md-8">
            <div class="hed-line"> </div>
         </div>
         <div class="col-md-12 padd">
            <!--Change Password -->
            <?php echo form_open("auth/change_password",'class="form-signin" id="change_password_form"');?>			
            <?php echo lang('change_password_old_password_label', 'old_password');?>
            <p>
               <?php echo form_input($old_password);?>
            </p>
            <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> 
            <p>
               <?php echo form_input($new_password);?>
            </p>
            <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> 
            <p>
               <?php echo form_input($new_password_confirm);?>
            </p>
            <?php echo form_input($user_id);?>
            <p><?php echo form_submit('submit', lang('change_password_submit_btn'),'class="btn bg-primary  exam-histry-btn"');?></p>
            <?php echo form_close();?>
            <!--Change Password -->
         </div>
      </div>
   </div>
</div>
<!-- Validations -->
<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
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
   		$.validator.addMethod("pwdmatch", function(repwd, element) {
   			var pwd=$('#new').val();
   			return (this.optional(element) || repwd==pwd);
   		},"Şifreler Birbiriyle Eşleşmiyor");		
   		
   		//form validation rules
              $("#change_password_form").validate({
                  rules: {
                      "old": {
                          required: true
                      },
   				"new": {
                          required: true,
   					rangelength: [8, 20]
                      },                    
   				"new_confirm": {
                          required: true,
   					pwdmatch: true
                      }
                  },
   			
   			messages: {
   				"old": {
                          required: "Eski Şifreniz."
                      },
   				"new": {
                          required: "Yeni Şifreniz."
                      },                    
   				"new_confirm": {
                          required: "Yeni Şifreniz Tekrar."
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
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>

