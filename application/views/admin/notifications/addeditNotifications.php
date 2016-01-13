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
         <li><a href="<?php echo base_url();?>admin/notifications"> Bildirimler</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#"> <?php if(count($data)>0) echo "Güncel Bildirimler"; else echo "Bildirim Ekle";?></a></li>
      </ul>
   </div>
</div>
<div class="row">
   <div class="col-md-8">
      <div style="color:#FF0000; font-size:12px; padding-left:10px;"><?php 
         echo $this->session->flashdata('message');
         ?>
      </div>
      <form method="POST" action="<?php echo base_url();?>admin/addeditNotifications" id="notifications_form">
         <?php if(count($data)>0)
            $data=$data[0];
            ?>  
			
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			
         <div class="form-group">
            <label for="inputEmail">Başlık</label>
            <?php 
               $val = '';
               	if (( $this->input->post('title' ))) {
               	$val = $this->input->post('title');
               	}
               	elseif (count($data)) {
               		$val = $data->title;
               	}
               ?>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $val;?>" placeholder="Enter Title of Notification" >
         </div>
         <div class="form-group">
            <label for="inputEmail">Açıklama</label>
            <?php 
               $val = '';
               	if(($this->input->post('description'))) {
               	$val = $this->input->post('description');
               	}
               	elseif (count($data)) {
               		$val = $data->description;
               	}
               
               ?>
            <textarea class="editors" id="editor1" name="description" value="<?php echo $val;?>" placeholder="Enter Description for Notification"><?php echo $val;?></textarea>
         </div>
         <div class="form-group">
            <label for="inputEmail">Yazılan Tarih</label>
            <?php 
               $val = '';
               	if($this->input->post( 'post_date' )) {
               	$val = $this->input->post( 'post_date' );
               	}
               	elseif (count($data)){
               		$val = date('d-m-Y',strtotime($data->post_date));
               	}
               ?>
            <input type="text" class="form-control" id="post_date" name="post_date" value="<?php echo $val;?>" placeholder="Enter Post Date (mm/dd/yyyy)" >
         </div>
         <div class="form-group">
            <label for="inputEmail">Son Tarih</label>
            <?php 
               $val = '';
               	if(($this->input->post( 'last_date' ))) {
               	$val = $this->input->post( 'last_date' );
               	}
               	elseif (count($data)) {
               		$val = date('d-m-Y',strtotime($data->last_date));
               	}
               ?>
            <input type="text" class="form-control" id="last_date" name="last_date" value="<?php echo $val;?>" placeholder="Enter Last Date of Notification (mm/dd/yyyy)" >
         </div>
         <div class="form-group">
            <label for="inputEmail">Durumu</label>
            <?php 
               $val = '';
               	if($this->input->post( 'status' )) {
					$val = $this->input->post('status');
               	}
               	elseif (count($data)) {
               		$val = $data->status;
               	}
               echo form_dropdown('status', $element, $val,'class="form-control"');
               ?>
         </div>
         <input type="hidden" name="id" value="<?php if(isset($id)) echo $id;?>">
         <button type="submit" class="btn btn-primary wnm-user"><?php if(count($data)>0) echo "Güncelle"; else echo "Ekle";?></button>
      </form>
   </div>
</div>
<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/designs/js/editor.js"></script>
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script>
   $(function() {
   $( "#post_date" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   numberOfMonths: 3,
   onClose: function( selectedDate ) {
   $( "#last_date" ).datepicker( "option", "minDate", selectedDate );
   }
   });
   $( "#last_date" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   numberOfMonths: 3,
   onClose: function( selectedDate ) {
   $( "#post_date" ).datepicker( "option", "maxDate", selectedDate );
   }
   });
   });
</script>
<!-- CK EDITOR -->
<script src="<?php echo base_url();?>assets/designs/ckeditor.js"></script>
<script>
   $(function() {
   	$('.editors').each(function(){
   	
   		CKEDITOR.replace($(this).attr('id'), { 
   	/*
   	 * Ensure that htmlwriter plugin, which is required for this sample, is loaded.
   	 */
   	extraPlugins: 'htmlwriter',
   	
   	/*
   	 * Style sheet for the contents
   	 */
   	contentsCss: 'body {color:#000; background-color#:FFF;}',
   
   	/*
   	 * Simple HTML5 doctype
   	 */
   	docType: '<!DOCTYPE HTML>',
   
   	/*
   	 * Allowed content rules which beside limiting allowed HTML
   	 * will also take care of transforming styles to attributes
   	 * (currently only for img - see transformation rules defined below).
   	 *
   	 * Read more: http://docs.ckeditor.com/#!/guide/dev_advanced_content_filter
   	 */
   	allowedContent:
   		'h1 h2 h3 p pre[align]; ' +
   		'blockquote code kbd samp var del ins cite q b i u strike ul ol li hr table tbody tr td th caption; ' +
   		'img[!src,alt,align,width,height]; font[!face]; font[!family]; font[!color]; font[!size]; font{!background-color}; a[!href]; a[!name]',
   
   	/*
   	 * Core styles.
   	 */
   	coreStyles_bold: { element: 'b' },
   	coreStyles_italic: { element: 'i' },
   	coreStyles_underline: { element: 'u' },
   	coreStyles_strike: { element: 'strike' },
   
   	/*
   	 * Font face.
   	 */
   
   	// Define the way font elements will be applied to the document.
   	// The "font" element will be used.
   	font_style: {
   		element: 'font',
   		attributes: { 'face': '#(family)' }
   	},
   
   	/*
   	 * Font sizes.
   	 */
   	fontSize_sizes: 'xx-small/1;x-small/2;small/3;medium/4;large/5;x-large/6;xx-large/7',
   	fontSize_style: {
   		element: 'font',
   		attributes: { 'size': '#(size)' }
   	},
   
   	/*
   	 * Font colors.
   	 */
   
   	colorButton_foreStyle: {
   		element: 'font',
   		attributes: { 'color': '#(color)' }
   	},
   
   	colorButton_backStyle: {
   		element: 'font',
   		styles: { 'background-color': '#(color)' }
   	},
   
   	/*
   	 * Styles combo.
   	 */
   	stylesSet: [
   		{ name: 'Computer Code', element: 'code' },
   		{ name: 'Keyboard Phrase', element: 'kbd' },
   		{ name: 'Sample Text', element: 'samp' },
   		{ name: 'Variable', element: 'var' },
   		{ name: 'Deleted Text', element: 'del' },
   		{ name: 'Inserted Text', element: 'ins' },
   		{ name: 'Cited Work', element: 'cite' },
   		{ name: 'Inline Quotation', element: 'q' }
   	],
   
   	on: {
   		pluginsLoaded: configureTransformations,
   		loaded: configureHtmlWriter
   	}
   });
   });
   
   
   
   });
   
   /*
    * Add missing content transformations.
    */
   function configureTransformations( evt ) {
   	var editor = evt.editor;
   
   	editor.dataProcessor.htmlFilter.addRules( {
   		attributes: {
   			style: function( value, element ) {
   				// Return #RGB for background and border colors
   				return CKEDITOR.tools.convertRgbToHex( value );
   			}
   		}
   	} );
   
   	// Default automatic content transformations do not yet take care of
   	// align attributes on blocks, so we need to add our own transformation rules.
   	function alignToAttribute( element ) {
   		if ( element.styles[ 'text-align' ] ) {
   			element.attributes.align = element.styles[ 'text-align' ];
   			delete element.styles[ 'text-align' ];
   		}
   	}
   	editor.filter.addTransformations( [
   		[ { element: 'p',	right: alignToAttribute } ],
   		[ { element: 'h1',	right: alignToAttribute } ],
   		[ { element: 'h2',	right: alignToAttribute } ],
   		[ { element: 'h3',	right: alignToAttribute } ],
   		[ { element: 'pre',	right: alignToAttribute } ]
   	] );
   }
   
   /*
    * Adjust the behavior of htmlWriter to make it output HTML like FCKeditor.
    */
   function configureHtmlWriter( evt ) {
   	var editor = evt.editor,
   		dataProcessor = editor.dataProcessor;
   
   	// Out self closing tags the HTML4 way, like <br>.
   	dataProcessor.writer.selfClosingEnd = '>';
   
   	// Make output formatting behave similar to FCKeditor.
   	var dtd = CKEDITOR.dtd;
   	for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) ) {
   		dataProcessor.writer.setRules( e, {
   			indent: true,
   			breakBeforeOpen: true,
   			breakAfterOpen: false,
   			breakBeforeClose: !dtd[ e ][ '#' ],
   			breakAfterClose: true
   		});
   	}
   }
   
</script>
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
   		$.validator.addMethod("dateFormat",function(value, element) { return value.match(/^(0[1-9]|1[012])[\/](0[1-9]|[12][0-9]|3[01])[\/](20)\d\d$/); }, "Tarih Girin lütfen mm/dd/yyyy (e.g., 06/31/2014).");			
   		
   		//form validation rules
              $("#notifications_form").validate({
                  
   			ignore: "", //To validate hidden fields
   			rules: {
                      title: {
   					required: true,
   					rangelength: [2, 300]
   				},
   				
   				post_date: {
   					required: true,
   					dateFormat: true
   				},
   				last_date: {
   					required: true,
   					dateFormat: true
   				}
   				
                  },
   			
   			messages: {
   				title: {
                          required: "Bildirim için başlık girin."
                      },
   				description: {
   					required: "Bildirim için açıklama gşr."
   				},
   				post_date: {
   					required: "Mesaj sonrası bildirim tarihi girin."
   				},
   				last_date: {
   					required: "Bildirim son tarihini girin."
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

