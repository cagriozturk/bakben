
 <!-- Bootstrap -->
    
	<link href="<?php echo base_url();?>assets/designs/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/designs/css/font-awesome.min.css" rel="stylesheet"> 
    <link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/designs/css/editor.css" type="text/css" rel="stylesheet"/>
	
	<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready( function() {
            
         $("#txtEditor").Editor();                    
         
    });
	</script>

   	<script src="<?php echo base_url();?>assets/designs/js/editor.js"></script>
	<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>

	
	
	
<div class="col-md-12 padd">

<div class="bradcome-menu">
 <ul>
<li><a href="<?php echo base_url();?>admin">Anasayfa</a></li>
<li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
<li><a href="#">PDF İçeriği Güncelleme</a></li>
 </ul>
 </div>

 </div>
 
 <div class="row">
 <div class="col-md-8">
	<div style="color:#FF0000; font-size:12px; padding-left:10px;"><?php echo validation_errors();
			   echo $this->session->flashdata('message');
			   ?>
	</div>
 <form method="POST" action="<?php echo base_url();?>admin/aboutusContent" id="aboutus_content_form" enctype="multipart/form-data">
        <?php if(count($data)>0)
				$data=$data[0];
		?>
		
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        
		<div class="form-group">
            <label for="inputEmail">PDF sayfası İçin İçerik</label>
			
			<?php 
				$val = '';
					if( ( $this->input->post( 'content' ) ) )
					{
					$val = $this->input->post( 'content' );
					}
					elseif(count($data))
					{
						$val = $data->content;
					}
	
			?>
						
            <textarea class="editors" id="editor1" name="content" placeholder="Type Content for Aboutus Page" ><?php echo $val;?></textarea>
        </div>

		<div class="form-group">
            <label for="inputEmail">İçerik Değiştirilme Tarihi</label>
			
			<?php 
				$val = '';
					if( ( $this->input->post( 'date_modified' ) ) )
					{
					$val = $this->input->post( 'date_modified' );
					}
					elseif(count($data))
					{
						$val = date('d-m-Y',strtotime($data->date_modified));
					}
	
			?>
						
            <input type="text" class="form-control" name="date_modified" value="<?php echo $val;?>" readonly />
        </div>
		
		<input type="hidden" name="id" value="<?php if(isset($id)) echo $id;?>">
		
        <button type="submit" class="btn btn-primary wnm-user">Güncelle</button>
		
  </form>

 
 </div>
  </div>
  
  
 
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
	<script type="text/javascript"> 
		
	(function($,W,D) {
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {			
			//form validation rules
            $("#aboutus_content_form").validate({
                
				ignore: "", //To validate hidden fields
				rules: {
					content: {
						required: true
					}
					
                },
				
				messages: {
					content: {
						required: " PDF Sayfa için içerik girin lütfen ."
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
  
  