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
         <li><a href="<?php echo base_url();?>admin/testimonials"> Görüşler</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#"> <?php if(count($data)>0) echo "Referans Güncelle"; else echo "Referans Ekle";?></a></li>
      </ul>
   </div>
</div>
<div class="row">
   <div class="col-md-8">
      <div style="color:#FF0000; font-size:12px; padding-left:10px;"><?php 
         echo $this->session->flashdata('message');
         ?>
      </div>
      <form method="POST" action="<?php echo base_url();?>admin/addeditTestimonials" id="testimonials_form" enctype="multipart/form-data">
         <?php if (count($data) > 0) 
            $data=$data[0];
            ?> 

		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			
         <div class="form-group">
            <label for="inputEmail">Yazar</label>
            <?php 
               $val = '';
               	if ($this->input->post('author')) {
					$val = $this->input->post( 'author' );
               	}
               	elseif (count($data)) {
               		$val = $data->author;
               	}
            ?>
            <input type="text" class="form-control" id="author" name="author" value="<?php echo $val;?>" placeholder="Referans Yazar Adı Girin" >
         </div>
         <div class="form-group">
            <label for="inputEmail">Resim</label>
            <input type="file" id="author_photo" name="author_photo">
         </div>
         <div class="form-group">
            <label for="inputEmail">Açıklama</label>
            <?php 
               $val = '';
               	if ($this->input->post('description')) {
					$val = $this->input->post( 'description' );
               	}
               	elseif (count($data)) {
               		$val = $data->description;
               	}
            ?>
            <textarea class="editors" id="editor1" name="description" value="<?php echo $val;?>" placeholder="Referans Açıklaması"><?php echo $val;?></textarea>
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
         <button type="submit" class="btn btn-primary wnm-user"><?php if(count($data)>0) echo "Güncelle"; else echo "Ekle";?></button>
      </form>
   </div>
</div>
<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
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
   		$.validator.addMethod("dateFormat",function(value, element) { return value.match(/^(0[1-9]|[12][0-9]|3[01])[-](0[1-9]|1[012])[-](20)\d\d$/); }, "Lütfen Tarih ve Saati giriniz dd-mm-yyyy (e.g., 31-06-2014).");			
   		
   		//form validation rules
              $("#testimonials_form").validate({
                  
   			ignore: "", //To validate hidden fields
   			rules: {
                      author: {
   					required: true,
   					rangelength: [2, 30]
   				},
   				description: {
   					required: true
   				},
				author_photo: {
				
					accept: "jpg|jpeg|png"
				
				}
   				
                  },
   			
   			messages: {
   				author: {
                          required: "Referans yazar adı."
                      },
   				description: {
   					required: "Referans Açıklaması."
   				},
				author_photo: {
				
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

