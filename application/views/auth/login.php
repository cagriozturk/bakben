<!-- Slider-->
<div data-ride="carousel" class="carousel slide banner" id="myCarousel">
   <div class="container-fluid padding">
      <img src="<?php echo base_url(); ?>assets/designs/images/inner-banner.png" width="100%">
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
               <li><a href="#"> Giriş Yap </a></li>
            </ul>
         </div>
      </div>
   </div>
   <div class="container inner-content padding">
      <div class="col-md-8 col-xs-12">
         <h1 class="form-hed">Giriş<span class="block">Yap</span></h1>
         <div class="col-md-12 formgro">
            <!--  <div id="infoMessage"><?php  echo $message;?></div>	-->
            <?php echo $this->session->flashdata('message'); ?>
            <?php echo form_open("auth/login",'class="form-signin" id="login_form"');?>
            <div class="form-group paddin-cont">
               <label class="col-lg-3 control-label" for="ftname">Kullanıcı E-Posta<span style="color:red;">*</span></label>
               <div class="col-lg-9 ">
                  <?php echo form_input($identity);?>
               </div>
            </div>
            <div class="form-group paddin-cont">
               <label class="col-lg-3 control-label" for="ftname">Şifre<span style="color:red;">*</span></label>
               <div class="col-lg-9 ">
                  <?php echo form_input($password);?>
               </div>
            </div>
            <div style="margin-left:60px;" class="form-group ">
               <div class="col-lg-offset-1 col-lg-10 padd">
                  <?php echo form_submit('submit', $this->lang->line('login_submit_btn'),'class="btn btn-lg btn-primary butt"');?>
               </div>
            </div>
            <?php echo form_close();?>
            <div class="text-center">
               <ul class="list-inline">
                  <li><a href="<?php echo base_url(); ?>auth/forgot_password"><?php echo lang('login_forgot_password'); ?></a></li>
                  <li> <a href="<?php echo base_url(); ?>auth/create_user"> <?php echo lang('signup_user_submit_btn'); ?></a></li>
               </ul>
            </div>
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
<script type="text/javascript"> 
   (function($,W,D)
   {
      var JQUERY4U = {};
   
      JQUERY4U.UTIL =
      {
          setupFormValidation: function()
          {
              //form validation rules
              $("#login_form").validate({
                  rules: {
   				identity: {
                          required: true,
   					email: true
                      },
   				password:{
   					required:true
   				}
                  },
   			
   			messages: {
   				identity: {
                          required: "E-Posta Giriniz."
                      },
   				password:{
   					required: "Şifre Giriniz."
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

