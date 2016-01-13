
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/designs/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/designs/font.css" rel="stylesheet">

<?php if(count($details)) {

		foreach($details as $d) {

?>
	
	
 <div class="col-md-12 padd">

<div class="bradcome-menu">
 <ul>
<li><a href="<?php echo base_url();?>admin">Anasayfa</a></li>
<li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
<li><a href="<?php echo base_url();?>admin/viewAllUsers">Kullanıcılar</a></li>
<li><img  src="<?php echo base_url();?>assets/designs/images/arrow.png"></li>
<li><a href="#">  Profil <?php echo $d->username;?> </a></li>
 </ul>
 </div>

 </div>
   <div class="row margin">
   
   <?php echo $this->session->flashdata('message');
   

	$imgSRC = base_url()."assets/uploads/images(200x200)/"."dflt-user-icn.png";;
	if($d->image!='')
		$imgSRC = base_url()."assets/uploads/images(200x200)/".$d->image;
	
	
   
   
   ?>
   
 <div class="col-md-12">
 <div class="col-md-2"><img src="<?php echo $imgSRC;?>"  class="img-responsive thumbnail"></div>
 <div class="col-md-9">
  <div class="col-md-4 padd">
 <div class="sectin-hed">
 Kişisel Bilgiler <?php echo $d->username;?>
 </div>
 </div>
 <div class="col-md-8">
 <div class="hed-line"> </div>
 </div>
 
 <div class="col-md-12 padd">

 <div class="details">
 
 <strong>Tam Ad </strong>: <?php echo $d->username;?>
 </div>
   <div class="details">
 
 <strong>E-Posta</strong> : <?php echo $d->email;?>
 </div>
  <div class="details">
 <strong> Telefon </strong>: <?php echo $d->phone;?>
 </div>

  <?php if($d->active==1) { ?>
 
  <a href="<?php echo base_url();?>admin/blockUser/<?php echo $d->id;?>" onclick="return confirm('Bu kullanıcıyı engellemek istediğinizden emin misiniz?')"><div class="btn bg-primary  exam-histry-btn">Engelle</div></a>
  
   <?php } else { ?>
   
	<a href="<?php echo base_url();?>admin/activateUser/<?php echo $d->id;?>" onclick="return confirm('Bu kullanıcıyı aktifleştirmek istiyor musunuz?')"><div class="btn bg-primary  exam-histry-btn">Kullanıcı Etkinleştir</div></a>
   
   <?php } ?>
   
  
 </div>
 
 
 </div>
   
    </div>
  </div>
  
  <?php } }?>
   
   
   
         <script src="<?php echo base_url();?>assets/designs/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>assets/designs/js/bootstrap.min.js"></script>
   