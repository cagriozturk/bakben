<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/designs/css/jquery.dataTables.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/designs/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/designs/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
   $(document).ready(function() {
   	$('#example').dataTable();
   });
</script>
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
<div class="col-md-12 padd">
   <div class="bradcome-menu">
      <ul>
         <li><a href="<?php echo base_url();?>user">Anasayfa</a></li>
         <li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
         <li><a href="#">   Sınav </a></li>
      </ul>
   </div>
</div>
<div class="row">
   <?php echo validation_errors();
      echo $this->session->flashdata('message');
      ?>
</div>
<div class="row">
   <div class="col-md-12">
      <table id="example" class="cell-border" cellspacing="0" width="100%">
         <thead>
            <tr>
             <th>S.No.</th>
               <th>Sınav Adı</th>
               <th>Maliyet</th>
               <th>Payer Adı</th>
               <th>Payer E-Posta</th>
			   <th>İşlem Id</th>
			   <th>Abone Tarihi</th>
			    <th>Geçerlilik </th>
                <th>Kalan</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>S.No.</th>
               <th>Sınav Adı</th>
               <th>Maliyet</th>
               <th>Payer Adı</th>
               <th>Payer E-Posta</th>
			   <th>İşlem Id</th>
			   <th>Abone Tarihi</th>
			    <th>Geçerlilik </th>
                <th>Kalan</th>
              
            </tr>
         </tfoot>
         <tbody>
            <?php if (count($records)>0) { 
					$i=1;
					foreach ($records as $r) {
               ?>
            <tr>
               <td><?php echo $i++;?></td>
               <td><?php echo $r->quizname;?></td>
               <td><?php echo $r->cost;?></td>
               <td><?php echo $r->payer_name;?></td>
               <td><?php echo $r->payer_email;?></td>
			   <td><?php echo $r->transaction_id;?></td>
			   <td><?php echo date('d-m-Y',strtotime($r->dateofsubscription));?></td>
			   <td><?php echo $r->validityvalue ." ".$r->validitytype;?></td>
			   <td><?php 
			   if ($r->validitytype=='Attempts') {
				if ($r->remainingattempts==0) {
						echo "<code> Tamamlanan</code>";
				}
				else {
					echo "<code class='naresh-code'>".$r->remainingattempts." Attempts</code>";
				}
			   }
			   else {
					 
						$datetime1 = date_create(date('Y-m-d'));
						$datetime2 = date_create($r->expirydate);
						$interval = date_diff($datetime1, $datetime2);
						$days = $interval->format('%R%a');
						 
						if($days>0)
							echo "<code class='naresh-code'>".$days . " Days</code>";
						else
							echo "<code> Tamamlanan</code>";
					
				}
			   
			   ?></td>
			   
             
            </tr>
            <?php } 
			} 
			else "<tr><td colspan='4'>Mevcut Veri Yok.</td></tr>"; 
			?>
         </tbody>
      </table>
   </div>
</div>

