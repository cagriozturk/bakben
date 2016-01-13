<div class="col-md-4">
   <h1 class="inner-hed">Hızlı Bağlantılar</h1>
   <div class="notif">
      <ul>
         <li><a href="<?php echo base_url();?>">Anasayfa</a></li>
         <?php $this->load->library('ion_auth');		
            if ($this->ion_auth->logged_in() && !$this->ion_auth->is_admin())
            {
            ?>
         <li><a href="<?php echo base_url();?>user">Panelim</a></li>
         <li><a href="<?php echo base_url();?>user/profile">Profil</a></li>
         <li><a href="<?php echo base_url();?>user/quiz_history">Sınav Tarihi</a></li>
         <?php } else if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { ?>
         <li><a href="<?php echo base_url();?>admin">Panelim</a></li>
         <li><a href="<?php echo base_url();?>admin/profile">Profil</a></li>
         <?php } else { ?>
         <li><a href="<?php echo base_url(); ?>auth/login">Giriş </a>  </li>
         <li><a href="<?php echo base_url(); ?>auth/create_user">Kayıt Ol</a>  </li>
         <?php } ?>
         <li><a href="<?php echo base_url(); ?>welcome/contact"> İletişim </a> </li>
         <li><a href="<?php echo base_url(); ?>welcome/termsConditions"> Kullanım Şartları </a> </li>
      </ul>
   </div>
   
</div>

