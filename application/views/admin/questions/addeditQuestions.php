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
         <li><a href="<?php echo base_url();?>admin/questionsindex<?php if(isset($subject_id)) echo "/subject_wise/".$subject_id;?>">Sorular</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#"> <?php if(count($data)>0) echo "Güncel Sorular"; else echo "Soru Ekle";?></a></li>
      </ul>
   </div>
</div>
<div class="row">
   <div class="col-md-8">
      <div style="color:#FF0000; font-size:12px; padding-left:10px;"><?php 
         echo $this->session->flashdata('message');
         ?>
      </div>
      <form method="POST" action="<?php echo base_url();?>admin/addeditQuestions" id="questions_form">
         <?php if(count($data)>0)
            $data=$data[0];
            ?>
			
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			
         <div class="form-group">
            <label for="inputEmail">Konu</label>
            <?php 
               $val = '';
               	if ($this->input->post( 'subjectid' )) {
					$val = $this->input->post('subjectid');
               	}
               	elseif (count($data)) {
               		$val = $data->subjectid;
               	}
               
               echo form_dropdown('subjectid', $subjects, $val,'class="form-control"');
               ?>
         </div>
         <div class="form-group">
            <label for="inputEmail">Soru Türü</label>
            <?php 
               $val = 'TekCevap';
               	if ($this->input->post( 'questiontype' )) {
					$val = $this->input->post('questiontype');
               	}
               	elseif (count($data)) {
               		$val = $data->questiontype;
               	}
               echo form_dropdown('questiontype', $questtypes, $val,'class="form-control"');
               ?>
         </div>
         <div class="form-group">
            <label for="inputEmail">Toplam Cevaplar</label>
            <?php 
               $val = '';
               	if($this->input->post( 'totalanswers' )) {
               	$val = $this->input->post('totalanswers');
               	}
               	elseif (count($data)) {
               		$val = $data->totalanswers;
               	}
               echo form_dropdown('totalanswers', $totans, $val,'class="form-control" id="totalanswers"');
               ?>
         </div>
         <div class="form-group">
            <label for="inputEmail">Soru</label>
            <?php 
               $val = '';
               	if($this->input->post('question')) {
					$val = $this->input->post( 'question' );
               	}
               	elseif (count($data)) {
               		$val = $data->question;
               	}
            ?>
            <textarea class="editors" id="editor1" name="question" value="<?php echo $val;?>" placeholder="Enter Question"><?php echo $val;?></textarea>
         </div>
         <div class="form-group">
            <label for="inputEmail">Cevap1</label>
            <?php 
               $val = '';
               	if ($this->input->post( 'answer1' )) {
					$val = $this->input->post( 'answer1' );
               	}
               	elseif (count($data)) {
               		$val = $data->answer1;
               	}
               ?>
            <textarea class="editors" id="editor2" name="answer1" value="<?php echo $val;?>" placeholder="Enter Answer1"><?php echo $val;?></textarea>
         </div>
         <div class="form-group">
            <label for="inputEmail">Cevap2</label>
            <?php 
               $val = '';
               	if ($this->input->post( 'answer2' )) {
					$val = $this->input->post( 'answer2' );
               	}
               	elseif (count($data)) {
               		$val = $data->answer2;
               	}
               ?>
            <textarea class="editors" id="editor3" name="answer2" value="<?php echo $val;?>" placeholder="Enter Answer2"><?php echo $val;?></textarea>
         </div>
         <div class="form-group">
            <label for="inputEmail">Cevap3</label>
            <?php 
               $val = '';
               	if ($this->input->post( 'answer3' )) {
					$val = $this->input->post( 'answer3' );
               	}
               	elseif (count($data)) {
               		$val = $data->answer3;
               	}
               ?>
            <textarea class="editors" id="editor4" name="answer3" value="<?php echo $val;?>" placeholder="Enter Answer3"><?php echo $val;?></textarea>
         </div>
         <div class="form-group">
            <label for="inputEmail">Cevap4</label>
            <?php 
               $val = '';
               	if ($this->input->post('answer4' )) {
               	$val = $this->input->post( 'answer4' );
               	}
               	elseif (count($data)) {
               		$val = $data->answer4;
               	}
               ?>
            <textarea class="editors" id="editor5" name="answer4" value="<?php echo $val;?>" placeholder="Enter Answer4"><?php echo $val;?></textarea>
         </div>
         <div class="form-group" id="answer5Div" <?php if(count($data) && $data->answer5=='') echo "style='display:none;'";?>>
            <label for="inputEmail">Cevap5</label>
            <?php 
               $val = '';
               	if ($this->input->post( 'answer5' )) {
               	$val = $this->input->post( 'answer5' );
               	}
               	elseif (count($data)) {
               		$val = $data->answer5;
               	}
               ?>
            <textarea class="editors" id="editor6" name="answer5" value="<?php echo $val;?>" placeholder="Enter Answer5"><?php echo $val;?></textarea>
         </div>
         <div class="form-group">
            <label for="inputEmail">Doğru Cevap</label>
            <?php 
               $val = '';
               	if ($this->input->post( 'correctanswer' )) {
					$val = $this->input->post( 'correctanswer' );
               	}
               	elseif (count($data)) {
               		$val = $data->correctanswer;
               	}
               ?>
            <input type="text" class="form-control" id="correctanswer" name="correctanswer" value="<?php echo $val;?>" placeholder="Doğru şık Cevap1 ise (Örneğin sadece 1 yazın.)." >
         </div>
         <div class="form-group">
            <label for="inputEmail">Zorluk Seviyesi</label>
            <?php 
               $val = 'Orta';
               	if ($this->input->post('difficultylevel')) {
               	$val = $this->input->post( 'difficultylevel' );
               	}
               	elseif (count($data)) {
               		$val = $data->difficultylevel;
               	}
               echo form_dropdown('difficultylevel', $difficultylevels, $val,'class="form-control"');
               ?>
         </div>
         <div class="form-group">
            <label for="inputEmail">Durum</label>
            <?php 
               $val = '';
               	if ($this->input->post('status')) {
               	$val = $this->input->post( 'status' );
               	}
               	elseif (count($data)) {
               		$val = $data->status;
               	}
               echo form_dropdown('status',  $element, $val, 'class="form-control"');
               ?>
         </div>
         <input type="hidden" name="id" value="<?php if(isset($id)) echo $id;?>">
         <button type="submit" class="btn btn-primary wnm-user"><?php if(count($data)>0) echo "Güncelle"; else echo "Ekle";?></button>
      </form>
   </div>
</div>
<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
   
   	if($('#totalanswers option:selected').val()==4)
   	{
   		$('#answer5Div').hide();
   	}	
   	
   	
   	$('#totalanswers').change(function() {
   	
   		if($(this).val()==5)
   		{
   			$('#answer5Div').fadeIn();
   		}
   		else
   		{
   			$('#answer5Div').fadeOut();
   		}
   	
   	});
   
   
   });
   
   function set(val)
   {
   	alert(val);
   	$('#contentarea').text(val);
   }
</script>
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
<script src="<?php echo base_url();?>assets/general/js/jquery.validate.min.js"></script>
<script type="text/javascript"> 
   (function($,W,D)
   {
      var JQUERY4U = {};
   
      JQUERY4U.UTIL =
      {
          setupFormValidation: function()
          {
   		//form validation rules
              $("#questions_form").validate({
                  
   			ignore: "", //To validate hidden fields
   			rules: {
                      subjectid: {
   					required: true
   				},
   				question: {
   					required: true
   				},
   				answer1: {
   					required: true
   				},
   				answer2: {
   					required: true
   				},
   				answer3: {
   					required: true
   				},
   				answer4: {
   					required: true
   				},
   				correctanswer: {
   					required: true
   				}
   				
                  },
   			
   			messages: {
   				subjectid: {
   					required: "Konu Seçin."
   				},
   				question: {
   					required: "Soru Girin."
   				},
   				answer1: {
   					required: "Lütfen cevap1 girin."
   				},
   				answer2: {
   					required: "Lütfen cevap2 girin."
   				},
   				answer3: {
   					required: "Lütfen cevap3 girin."
   				},
   				answer4: {
   					required: "Lütfen cevap4 girin."
   				},
   				correctanswer: {
   					required: "Doğru cevabı girin."
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

