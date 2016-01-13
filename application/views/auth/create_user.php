
<!-- Slider-->
<div data-ride="carousel" class="carousel slide banner" id="myCarousel">
   <div class="container">
      <div class="col-lg-10"><img src="<?php echo base_url(); ?>assets/designs/images/inner-banner.png" width="75%"></div>
   </div>
</div>
<!-- Slider-->
<!-- Middle Content-->
<div class="container-fluid content-bg">
   <div class="spacer"></div>
   <div class="container padding">
      <div class="col-md-8 col-xs-12">
         <div class="bradcome-menu">
            <ul>
               <li><a href="<?php echo base_url(); ?>">Anasayfa</a></li>
               <li><img src="<?php echo base_url(); ?>assets/designs/images/arrow1.png" width="7" height="6"></li>
               <li><a href="#"> Kayıt</a></li>
            </ul>
         </div>
      </div>
   </div>
   <div class="container inner-content padding">
      <div class="col-md-8 col-xs-12">
         <h1 class="inner-hed"><?php echo lang('create_user_subheading'); ?></h1>
         <div class="col-md-12 formgro">
            <!--  <div id="infoMessage"><?php  echo $message;?></div>	-->
            <?php echo $this->session->flashdata('message'); ?>
            <?php echo form_open("auth/create_user",'class="form-signin" id="user_creation_form" enctype="multipart/form-data"');?>
            <div class="form-group paddin-cont">
               <label class="col-lg-3 control-label" for="ftname">Ad <span style="color:red;">*</span></label>
               <div class="col-lg-9 ">
                  <?php echo form_input($first_name);?>
               </div>
            </div>
            <div class="form-group paddin-cont">
               <label class="col-lg-3 control-label" for="ftname">Soyad<span style="color:red;">*</span></label>
               <div class="col-lg-9 ">
                  <?php echo form_input($last_name);?> 
               </div>
            </div>
            <div class="form-group paddin-cont">
               <label class="col-lg-3 control-label" for="ftname">Telefon<span style="color:red;">*</span></label>
               <div class="col-lg-9 ">
                  <?php echo form_input($phone);?>
               </div>
            </div>
            <div class="form-group paddin-cont">
               <label class="col-lg-3 control-label" for="ftname">E-Posta <span style="color:red;">*</span></label>
               <div class="col-lg-9 ">
                  <?php echo form_input($email);?>
               </div>
            </div>
            <div class="form-group paddin-cont">
               <label class="col-lg-3 control-label" for="ftname">Resim <span style="color:red;">*</span></label>
               <div class="col-lg-9 ">
                  <input type="file" name="image" id="image" class=""/>
               </div>
            </div>
            <div class="form-group paddin-cont">
               <label class="col-lg-3 control-label" for="ftname">Şifre <span style="color:red;">*</span></label>
               <div class="col-lg-9 ">
                  <?php echo form_input($password);?>
               </div>
            </div>
            <div class="form-group paddin-cont">
               <label class="col-lg-3 control-label" for="ftname">Şifre Tekrar <span style="color:red;">*</span></label>
               <div class="col-lg-9 ">
                  <?php echo form_input($password_confirm);?>
               </div>
            </div>
            <div style="margin-left:60px;" class="form-group ">
               <div class="col-lg-offset-1 col-lg-10 padd">
                  <?php echo form_submit('submit', $this->lang->line('new_user_submit_btn'),'class="btn btn-danger butt"');?>
               </div>
            </div>
            <?php echo form_close(); ?>
         </div>
         <div class="text-center">
            <ul class="list-inline">
               <li><a class="text-muted" href="<?php echo base_url(); ?>auth/login"><?php echo lang('login_submit_btn'); ?></a></li>
               <li><a class="text-muted" href="<?php echo base_url(); ?>auth/forgot_password"><?php echo lang('login_forgot_password'); ?></a></li>
            </ul>
         </div>
      </div>
      <?php echo $this->load->view('general/quick_links');?>
   </div>
   <div class="spacer"></div>
</div>
</div>
<!-- Middle Content-->
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
   			var pwd=$('#password').val();
   			return (this.optional(element) || repwd==pwd);
   		},"Password and Confirm passwords does not match.");
   		
   		$.validator.addMethod("lettersonly",function(a,b){return this.optional(b)||/^[a-z ]+$/i.test(a)},"Geçerli Bir Ad Girin.");
   		
   		$.validator.addMethod("alphanumericonly",function(a,b){return this.optional(b)||/^[a-z0-9 ]+$/i.test(a)},"Sadece Alfanümerik");
   		
   		$.validator.addMethod("phoneNumber", function(uid, element) {
   			return (this.optional(element) || uid.match(/^([0-9]*)$/));
   		},"Please enter a valid number.");
   		
   		$.validator.addMethod("alphanumerichyphen", function(uid, element) {
   			return (this.optional(element) || uid.match(/^([a-zA-Z0-9 -]*)$/));
   		},"Only Alphanumerics and hyphens are allowed.");
   
   		$.validator.addMethod('check_duplicate_email', function (value, element) {
   			var is_valid=false;
   				$.ajax({
   						url: "<?php echo base_url();?>welcome/check_duplicate_email",
   						type: "post",
   						dataType: "html",
   						data:{ emailid:$('#email').val(), <?php echo $this->security->get_csrf_token_name();?>: "<?php echo $this->security->get_csrf_hash();?>"},
   						async:false,
   						success: function(data) {
   						//alert(data);
   						is_valid = data == 'true';
   				}
   		   });
   		   return is_valid;
   		}, "Girdiğiniz E-Posta zaten var.Başka Bir E-Posta girin.");
   		
   		
   		//form validation rules
              $("#user_creation_form").validate({
                  rules: {
                      first_name: {
                          required: true,
                          lettersonly: true,
   					rangelength: [3, 30]
                      },
   				last_name: {
                          required: true,
                          lettersonly: true,
   					rangelength: [3, 300]
                      },                    
   				phone: {
                          required: true,
   					phoneNumber: true,
   					rangelength: [10, 11]
                      },
   				email: {
                          required: true,
   					email: true,
   					check_duplicate_email: true
                      },
   				image: {
                          required: true,
						  accept: "jpg|jpeg|png"
                      },
   				password:{
   					required:true,
   					rangelength: [8, 300]
   				},
   				password_confirm:{
   					required:true,
   					pwdmatch: true
   				}
                  },
   			
   			messages: {
   				first_name: {
                          required: "Adınız"
                      },
   				last_name: {
                          required: "Soyadınız."
                      },                    
   				phone: {
                          required: "Numaranız."
                      },
   				email: {
                          required: "E-Posta Adresi."
                      },
   				image: {
                          required: "Resim Yükleyin",
						  accept: "Only jpg / jpeg / png uygun resim formatları."
                      },
   				password:{
   					required: "Şifreniz."
   				},
   				password_confirm:{
   					required: "Şifreniz Tekrar."
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
