<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/designs/css/bootstrap.css" 
   rel="stylesheet">
<link href=
   "<?php echo base_url();?>assets/designs/css/font-awesome.min.css" rel=
   "stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel=
   "stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel=
   "stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/editor.css" rel=
   "stylesheet" type="text/css">
<script src=
   "<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready( function() {
           
        $("#txtEditor").Editor();                    
        
   });
</script>
<script src="<?php echo base_url();?>assets/designs/js/editor.js"></script>
<script src=
   "<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
</head>
<body>
   <div class="col-md-12 padd bradcome-menu">
      <ul>
         <li>
            <a href="<?php echo base_url();?>admin">Anasayfa</a>
         </li>
         <li><img src=
            "<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li>
            <a href=
               "<?php echo base_url();?>admin/subcategories">Alt 
			   Kategoriler</a>
         </li>
         <li><img src=
            "<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li>
            <a href=
               "#"><?php if(count($data)>0) echo "Alt Kategoriyi Güncelle"; else echo "Alt Kategori Ekle";?></a>
         </li>
      </ul>
   </div>
   <div class="row col-md-8">
      <div style="color:#FF0000; font-size:12px; padding-left:10px;">
         <?php echo validation_errors();
            echo $this->session->flashdata('message');
            ?>
      </div>
      <form action=
         "<?php echo base_url();?>admin/addeditSubCategories" id=
         "subcategories_form" method="post" name="subcategories_form">
         <?php if(count($data)>0)
            $data=$data[0];
            ?>
			
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			
			
         <div class="form-group">
            <label for="inputEmail">Kategori Adı</label> <?php 
               $val = '';
                   if ($this->input->post( 'catid' )) {
                   $val = $this->input->post( 'catid' );
                   }
                   elseif (count($data)) {
                       $val = $data->catid;
                   }
               
               echo form_dropdown('catid', $categories, $val,'class="form-control"');
               ?>
         </div>
         <div class="form-group">
            <label for="inputEmail">Alt Kategori Adı</label> <?php 
               $val = '';
                   if ($this->input->post( 'name' )) {
                   $val = $this->input->post( 'name' );
                   }
                   elseif (count($data)) {
                       $val = $data->name;
                   }
               
               ?> <input class="form-control" id="name" name=
               "name" placeholder="Enter Sub Category Name" type="text" value=
               "<?php echo $val;?>">
         </div>
         <div class="form-group">
            <label for="inputEmail">Durumu</label> <?php 
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
         <input name="id" type="hidden" value=
            "<?php if(isset($id)) echo $id;?>"> <button class=
            "btn btn-primary wnm-user" type=
            "submit"><?php if(count($data)>0) echo "Güncelle"; else echo "Ekle";?></button>
      </form>
   </div>
   <!-- Validations -->
   <script src=
      "<?php echo base_url();?>assets/designs/js/jquery.validate.min.js"></script> <script type="text/javascript">
      (function($,W,D)
      {
      var JQUERY4U = {};
      
      JQUERY4U.UTIL =
      {
          setupFormValidation: function()
          {       
              //form validation rules
              $("#subcategories_form").validate({
                  rules: {
                      catid: {
                          required: true
                      },
                      name: {
                          required: true,
                          rangelength: [2, 300]
                      }
                      
                  },
                  
                  messages: {                 
                      catid: {
                          required: "Kategori Seçin."
                      },
                      name: {
                          required: "Lütfen Alt Kategori Adı Girin."
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

