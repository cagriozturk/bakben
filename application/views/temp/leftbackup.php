<!--	DON'T DELETE ANY DIV	-->
<div class="col-md-2 padd">
   <ul class="dropdown-menu sid-sub-menu" role="menu" aria-labelledby="dropdownMenu" >
      <li class="dropdown-submenu "> <a href="<?php echo base_url();?>">Anasayfa</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="dashboard") echo "active";?>"> <a href="<?php echo base_url();?>admin">Gösterge Paneli</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="categories") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/categories">Kategoriler</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="subcategories") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/subcategories">Alt Kategoriler</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="subjects") echo "active";?>"> 
	  <a  href="<?php echo base_url();?>admin/subjects">Konular</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="questions") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/questionsindex">Sorular</a></li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="quiz") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/quiz">Bilgi Yarışması</a></li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="notifications") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/notifications">Bildirimler</a></li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="testimonials") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/testimonials">Referanslar</a></li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="settings") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/settings">Ayarlar</a></li>
	  <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="email-settings") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/emailSettings">E-Posta Ayarları</a></li>
	  <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="change_password") echo "active";?>"> 
	  <a  href="<?php echo base_url();?>auth/change_password">Şifreyi Değiştir</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="aboutus_content") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/aboutusContent">Aboutus Content</a></li>
   </ul>
   <div class="clearfix"></div>
</div>
<div class="col-md-10 content">
<!--	DON'T DELETE ANY DIV	-->

