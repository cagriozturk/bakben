

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
<li><a href="<?php echo base_url();?>admin">Anasayfa</a></li>
<li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
<li><a href="#">   Genel Kullanıcılar </a></li>
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
						<th>Resim</th>
						<th>Üye Adı</th>
						<th>E-Posta</th>
						<th>Telefon</th>
						<th>Kayıt Tarihi</th>
						<th>Durum</th>
						<th>Eylem</th>
						
					</tr>
				</thead>

				<tfoot>
					<tr>
						<th>S.No.</th>
						<th>Resim</th>
						<th>Üye Adı</th>
						<th>E-Posta</th>
						<th>Telefon</th>
						<th>Kayıt Tarihi</th>
						<th>Durum</th>
						<th>Eylem</th>
						
					</tr>
				</tfoot>

				<tbody>
				
				<?php if(count($allUsers)>0) { 
					$i=1;
					foreach($allUsers as $r)
					{
				
				?>
				
					<tr>
						<td><?php echo $i++;?></td>
						<td><img style="height:45px;width:60px;" src="<?php echo base_url();?>assets/uploads/images(200x200)/<?php 
						if(isset($r->image)&&$r->image!='')echo $r->image; else echo "dflt-user-icn.png";?>"></td>
						<td><?php echo $r->username;?></td>
						<td><?php echo $r->email;?></td>
						<td><?php echo $r->phone;?></td>
						<td><?php echo $r->date_of_registration;?></td>
						<td><?php if($r->active==1) echo "Aktif"; else echo "Pasif";?></td>
						<td>
							 <a href="<?php echo base_url();?>admin/viewUserProfile/<?php echo $r->id;?>"><div class="btn bg-primary wnm-user">Görünüm</div></a>
	 
							 <?php if($r->active==1) { ?>
							 
								<a href="<?php echo base_url();?>admin/blockUser/<?php echo $r->id;?>" onclick="return confirm('Kullanıcıyı Engellemek İstiyormusunuz?')"><div class="btn bg-primary wnm-user">Engelle</div></a>
							 
							 <?php } else {?>
							 
								<a href="<?php echo base_url();?>admin/activateUser/<?php echo $r->id;?>" onclick="return confirm('Kullanıcıyı Aktif Etmek İstiyormusunuz?')"><div class="btn bg-primary wnm-user">Etkinleştir</div></a>
							 
							 <?php } ?>
							 
							 <a href="<?php echo base_url();?>admin/deleteUser/<?php echo $r->id;?>/general_user"><div class="btn bg-primary wnm-user" onclick="return confirm('Kullanıcıyı Silmek İstiyormusunuz?')">Sil</div></a>
							 
						</td>
					</tr>
					
				<?php } } else "<tr><td colspan='4'>Mevcut Veri Yok.</td></tr>"; ?>
					
				</tbody>
			</table>
 </div>
  </div>
 