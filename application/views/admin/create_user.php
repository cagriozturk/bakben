<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/designs/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url();?>admin">Anasayfa</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
		 <?php if(isset($user_type) && $user_type == "admin") {
		 
					$link = "admins";
					$text = "Admin";
					
				} else {
				
					$link = "moderators";
					$text = "Moderator";
				
				}	 
		 ?>
		 
         <li><a href="<?php echo base_url();?>admin/<?php echo $link;?>"> <?php echo $text."s";?></a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#"> <?php echo "Create ".$text;?></a></li>
      </ul>
   </div>
</div>
<div class="row">
   <div class="col-md-8">
      <div style="color:#FF0000; font-size:12px; padding-left:10px;"><?php 
         echo $this->session->flashdata('message');
         ?>
      </div>

            <?php echo form_open("admin/create_user",'class="form-signin" id="user_creation_form" enctype="multipart/form-data"');?>
            <div class="form-group">
               <label for="ftname">Ad <span style="color:red;">*</span></label>
                  <?php echo form_input($first_name);?>
            </div>
            <div class="form-group">
               <label for="ftname">Soyad <span style="color:red;">*</span></label>
                  <?php echo form_input($last_name);?> 
            </div>
            <div class="form-group">
               <label for="ftname">Telefon<span style="color:red;">*</span></label>
                  <?php echo form_input($phone);?>
            </div>
            <div class="form-group">
               <label for="ftname">E-Posta <span style="color:red;">*</span></label>
                  <?php echo form_input($email);?>
            </div>
            <div class="form-group">
               <label for="ftname">Telefon <span style="color:red;">*</span></label>
                  <input type="file" name="image" id="image" class=""/>
            </div>
            <div class="form-group">
               <label for="ftname">Şifre <span style="color:red;">*</span></label>
                  <?php echo form_input($password);?>
            </div>
            <div class="form-group">
               <label for="ftname">Şifre Tekrar Gir <span style="color:red;">*</span></label>
                  <?php echo form_input($password_confirm);?>
            </div>
          
			<?php echo form_hidden('user_type', $user_type) ;?>
             
               <?php echo form_submit('submit', $this->lang->line('new_user_submit_btn'),'class="btn btn-primary wnm-user"');?>

            <?php echo form_close(); ?>
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
   			var pwd=$('#password').val();
   			return (this.optional(element) || repwd==pwd);
   		},"Şifreler Eşleşmedi.");
   		
   		$.validator.addMethod("lettersonly",function(a,b){return this.optional(b)||/^[a-z ]+$/i.test(a)},"Geçerli bir ad girin.");
   		
   		$.validator.addMethod("alphanumericonly",function(a,b){return this.optional(b)||/^[a-z0-9 ]+$/i.test(a)},"Sadece Alfanümerik");
   		
   		$.validator.addMethod("phoneNumber", function(uid, element) {
   			return (this.optional(element) || uid.match(/^([0-9]*)$/));
   		},"Geçerli bir numara girin.");
   		
   		$.validator.addMethod("alphanumerichyphen", function(uid, element) {
   			return (this.optional(element) || uid.match(/^([a-zA-Z0-9 -]*)$/));
   		},"Sadece Altfanümerik ve - izin verilir.");
   
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
   		}, " Girdiğiniz E-Posta zaten var.Lütfen başka E-Posta giriniz.");
   		
   		
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
   					rangelength: [3, 30]
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
   					rangelength: [8, 30]
   				},
   				password_confirm:{
   					required:true,
   					pwdmatch: true
   				}
                  },
   			
   			messages: {
   				first_name: {
                          required: "Adınız."
                      },
   				last_name: {
                          required: "Soyadınız."
                      },                    
   				phone: {
                          required: "Numaranız."
                      },
   				email: {
                          required: "E-Posta ."
                      },
   				image: {
                          required: "Resim Yükleyin.",
						  accept: "Uygun jpg / jpeg / png resim formatları."
                      },
   				password:{
   					required: "Şifre girin."
   				},
   				password_confirm:{
   					required: "Şifreyi tekrar girin."
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
