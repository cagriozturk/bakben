<link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/designs/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/designs/css/TableBarChart.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/designs/css/TableBarChart.css" />
<script>
   function isChecked()
   {
   	if (document.getElementById("exam_chkbox").checked == true) {
   		window.location = '<?php echo base_url();?>exam/startexam/<?php echo $exams[0]->quizid;?>';
   	}
   	else {
   		alert("Talimatları Kontrol Ediniz.");
   		return false; 
   	}
   }
   
</script>
<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url();?>user">Anasayfa</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#"> Bilgilendirme</a></li>
      </ul>
   </div>
</div>

<?php 
   $message = $this->session->flashdata('message');
   if(isset($message)) echo $message;?>

<div class="row margin">
   <div class="col-md-12">
      <div class="col-md-2 padd">
         <div class="sectin-hed">
           Sınav Adı
         </div>
      </div>
      <div class="col-md-10">
         <div class="hed-line"> </div>
      </div>
      <div class="col-md-12 padd">
         <p><?php $record =$exams[0]; 
            echo $record->name;
            ?> </p>
         <center><em><strong>Aşağıdaki Talimatları dikkatlice okuyun</strong></em></center>
      </div>
      <div class="col-md-12 padd">
         <div class="sectin-hed">
            Genel Talimatlar: 
         </div>
      </div>
      <ol>
         <li>Toplam <?php echo $record->deauration;?> tüm soruların dakika ve süreleri verilecektir. <?php if($record->negativemarkstatus == "Active") echo "İşaretleri her yanlış cevap için ".$record->negativemark."eksi ceza uygulanır."; ?></li>
         <li>Ekranın sağ üst köşesindeki geri sayım sayacı sınavı tamamlamak için kalan süreyi gösterir. Varsayılan saat sınavı bitirmeye ya da sınavı sonlandırmak için gereklidir. </li>
         <li>
            Ekranın sağ tarafındaki renkli kutulardan her biri aşağıdaki durumlardan birini gösterir : 
            <br><br>
            <table width="100%" border="0">
               <tr>
                  <td>
                     <div class="btn bg-primary not-visited"> <i class="fa fa-eye-slash"></i> </div>
                  </td>
                  <td>Sorunuzu hala ziyaret etmediyseniz .</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td>
                     <div class="btn bg-primary not-answered"> <i class="fa fa-times-circle"></i> </div>
                  </td>
                  <td>Soruya cevap vermediniz.</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td>
                     <div class="btn bg-primary answered"> <i class="fa fa-check-square-o"></i> </div>
                  </td>
                  <td>Soruya doğru cevap verdin. </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td>
                     <div class="btn bg-primary review"> <i class="fa fa-bolt"></i> </div>
                  </td>
                  <td>Sen soruyu yanıtladı ama inceleme için soru işareti var.</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
               </tr>
            </table>
         </li>
      </ol>
	  
	<div class="infor-mation"> 
	<?php if ($is_authorized){
			if ($record->quiztype == 'Paid') { 
					$cnt='';
					if($record->validitytype=='Days') {
						$date1 = new DateTime(date('Y-m-d'));
						$date2 = new DateTime($payment_info[0]->expirydate);
						$cnt = $date2->diff($date1)->format("%a");
					}
					else {
						$cnt=$payment_info[0]->remainingattempts;
					}
			?>
			<strong>	kaldı <?php echo $cnt ." ". $record->validitytype;  ?> bu sınavı kullanmak</strong>
	<?php	}
	?> 
	
	<?php } 
		  elseif ($record->quiztype == 'Paid') { 
		  $currency = $this->base_model->fetch_single_column_value('paypal','currency_code');
		 
		  ?>
				<strong>Bu sınavıda al lütfen <?php echo $record->quizcost." ".$currency; ?>  for <?php echo $record->validityvalue ." ". $record->validitytype; ?> </strong>
		  
		  <?php } ?>
	 <div class="row">
         <div class="col-md-12">
            <br>
            <table width="100%" border="0">
			<?php if ($is_authorized) { ?>
               <tr>
                  <td width="4%">
                     <form name="form1" method="post" action="">
                        <input type="checkbox" name="checkbox" id="exam_chkbox" >
                        <label for="checkbox"></label>
                     </form>
                  </td>
                  <td colspan="2">Yukarıda verilen talimatları okuyup anladım.</td>
               </tr>
			   <?php } ?>
               <tr>
                  <td>&nbsp;</td>
                  <td colspan="2">
				  <?php if ($is_authorized) { ?>
                     <a style="cursor:pointer;" onclick="isChecked(); return false;">
                        <div class="btn bg-primary wnm-user rig-ht"> <i class="fa fa-sign-in"></i> Sınav Başlangıç</div>
                     </a>
				 <?php } 
						else { ?>
						<a style="cursor:pointer;" target="_blank" href="<?php echo base_url();?>user/payment/paypal/<?php echo $record->quizid."/".$record->quizcost;?>">
                        <div class="btn bg-primary wnm-user rig-ht"> <i class="fa fa-sign-in"></i> Ödemeye Git</div>
                     </a>
					 
										
						<?php }?>
					 
                  </td>
                  
               </tr>
            </table>
         </div>
      </div>
	
	
	</div>
     
   </div>
</div>