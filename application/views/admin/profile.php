
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
	
	<script>
	
	function do_user_photo_div(action)
	{
		if(action == "show")
		{
			$('#user_photo_div').fadeIn();
			$('html, body').animate({scrollTop: $('#user_photo_div').offset().top}, 2000);
			$('#user_photo').focus();
		}
		else if(action == "hide")
		{
			$('#user_photo_div').fadeOut();
			$('#user_photo').val('');
		}
		
	}
	
	</script>
	

<?php if(count($details)) {

		foreach($details as $d) {

?>
	
	
 <div class="col-md-12 padd">

<div class="bradcome-menu">
 <ul>
<li><a href="<?php echo base_url();?>admin">Anasayfa</a></li>
<li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
<li><a href="#">  Profilim </a></li>
 </ul>
 </div>

 </div>
   <div class="row margin">
   
   <?php echo $this->session->flashdata('message');?>
   
 <div class="col-md-12">
 <div class="col-md-2">
 <img src="<?php echo base_url();?>assets/uploads/images(200x200)/<?php if($d->image!='') echo $d->image;else echo 'dflt-user-icn.png';?>"  class="img-responsive thumbnail">
 <a id="user_change_photo" onclick="do_user_photo_div('show')" style="cursor:pointer;">Resim Değiştir</a>
 </div>
 <div class="col-md-9">
  <div class="col-md-4 padd">
 <div class="sectin-hed">
 Kişisel Bilgiler
 </div>
 </div>
 <div class="col-md-8">
 <div class="hed-line"> </div>
 </div>
 
 <div class="col-md-12 padd">
 
	<form method="post" id="user_profile_form" action="<?php echo base_url();?>admin/updateProfile" enctype="multipart/form-data">

	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	
 <div class="details"> 
	<strong>Ad </strong>: 
		<input type="text" name="first_name" value="<?php echo $d->first_name;?>" placeholder="Adınız" style="border:none;background:#fafafa !important;padding: 1px 0 !important;"/>
 </div>
 
 <div class="details"> 	
	<strong>Soyadı </strong>: 
		<input type="text" name="last_name" value="<?php echo $d->last_name;?>" placeholder="Soyadınız" style="border:none;background:#fafafa !important;padding: 1px 0 !important;"/>
 </div>
   
  <div class="details"> 
	<strong>E-Posta</strong> : <input type="text" name="email" value="<?php echo $d->email;?>" placeholder="E-Posta" style="border:none;background:#fafafa !important;padding: 1px 0 !important;"/>
  </div>
  
  <div class="details">
 <strong> Telefon </strong>: <input type="text" name="phone" maxlength="11" value="<?php echo $d->phone;?>" style="border:none;background:#fafafa !important;padding: 1px 0 !important;"/>
 <input type="hidden" name="user" value="<?php echo $d->id;?>">
 </div>
 
	<div class="details col-md-12" id="user_photo_div" style="display:none;margin-top:0;padding-left:0;">

		<div class="col-md-3">
		  <strong> Resim Yükle </strong>: 
		</div>
		<div class="col-md-8">
		  <input type="file" name="image" id="user_photo" style="border: medium none; background: none repeat scroll 0% 0% rgb(250, 250, 250) ! important;">
		</div>
		
		<div class="col-md-1">
			<a id="cancel_user_change_photo" title="Cancel uploading photo." onclick="do_user_photo_div('hide')" style="cursor:pointer;">İptal</a>
		</div>
		
	</div>
 
  <input type="submit" name="submit" value="Güncelle" class="btn bg-primary  exam-histry-btn" />
  
  </form>
  
 </div>
 
 
 </div>
   
    </div>
  </div>
  
  <?php } }?>
   
   
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
			$.validator.addMethod("lettersonly",function(a,b){return this.optional(b)||/^[a-z ]+$/i.test(a)},"Geçerli bir ad girin.");
						
			$.validator.addMethod("phoneNumber", function(uid, element) {
				return (this.optional(element) || uid.match(/^([0-9]*)$/));
			},"Geçerli bir sayı girin.");			
			
			//form validation rules
            $("#user_profile_form").validate({
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
					email: {
                        required: true,
                        email: true
                    },                    
					phone: {
                        required: true,
						phoneNumber: true,
						rangelength: [10, 11]
                    },
					image: {
                        required: true,
						accept: "jpg|jpeg|png"
                    }
                },
				
				messages: {
					first_name: {
                        required: "Lütfen Adınızı yazın."
                    },
					last_name: {
                        required: "Lütfen Soyadınızı yazın"
                    },
					email: {
                        required: "E-Posta Adresi girin."
                    },                    
					phone: {
                        required: "Telefon numarası girin."
                    },
					image: {
                        required: "Lütfen Resim Yükleyin.",
						accept: "Uygun jpg / jpeg / png resim formatları."
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
   