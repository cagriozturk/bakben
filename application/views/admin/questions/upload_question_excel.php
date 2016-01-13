<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url();?>admin">Anasayfa</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="<?php echo base_url();?>admin/questionsindex">Sorular</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#">  Excel ile Soru Yükle </a></li>
      </ul>
   </div>
</div>
<div class="row margin">
   <?php echo $this->session->flashdata('message');?>
   <div class="col-md-12">
      <div class="col-md-9">
         <div class="col-md-4 padd">
            <div class="details"><strong> <a href="<?php echo base_url();?>excel/QuestionsSample.xls" target="_blank">Buraya tıkla</a>  sample xls dosyası indirmek için</strong>  </div>
         </div>
         <div class="col-md-8">
            <div class="hed-line"> </div>
         </div>
         <div class="col-md-12 padd">
            <div class="details">
               <form method="post" action="<?php echo base_url();?>admin/readquestionexcel" id="excel_questions_form" enctype="multipart/form-data">
			   
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			   
                  <strong>Seç </strong>: <input type='file' name='questionsfile' />
            </div>
            <input type="submit" name="submit" value="Upload" class="btn bg-primary  exam-histry-btn" />
            </form>
         </div>
      </div>
   </div>
</div>
<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
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
              $("#excel_questions_form").validate({
   			rules: {
   				questionsfile: {
   					required: true,
					accept: "xls"
   				}
   				
                  },
   			
   			messages: {
   				questionsfile: {
                          required: "Please upload the questions file as given in the sample xls file format.",
                          accept: "Please upload the questions file as given in the sample xls file format."
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

