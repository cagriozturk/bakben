<!--	DON'T DELETE ANY DIV	-->
<div class="col-md-2 padd">
   <ul class="dropdown-menu sid-sub-menu" role="menu" aria-labelledby="dropdownMenu" >
      <li class="dropdown-submenu "> <a href="<?php echo base_url();?>">Anasayfa</a> </li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="dashboard") echo "active";?>"> <a href="<?php echo base_url();?>moderator">Gösterge Paneli</a> </li>
      
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="questions") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/questionsindex">Sorular</a></li>
      <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="quiz") echo "active";?>"> 
	  <a href="<?php echo base_url();?>admin/quiz">Bilgi Yarışması</a></li>
	  <li class="dropdown-submenu <?php if(isset($active_menu) && $active_menu=="change_password") echo "active";?>"> 
		  <a  href="<?php echo base_url();?>auth/change_password">Şifreyi Değiştir</a> </li>
	 
   </ul>
   <div class="clearfix"></div>
</div>
<div class="col-md-10 content">
<!--	DON'T DELETE ANY DIV	-->
