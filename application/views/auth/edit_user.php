<!--PAGE CONTENT -->
<div id="content">
<div class="inner" style="min-height: 700px;">
<div class="row">
   <div class="col-lg-12">
      <h2><?php if(isset($header_messsag))echo $header_messsag; else echo "EDIT PROFILE";?></h2>
   </div>
</div>
<hr />
<?php $msg =  $this->session->flashdata('message'); if(isset($msg)) echo $msg;?>
<?php echo validation_errors(); ?>		
<!--BLOCK SECTION -->
<div class="row">
   <div class="col-lg-12">
      <div style="text-align: center;">
         <!--Edit User Start -->
         <div id="infoMessage"><?php echo $message;?></div>
         <?php echo form_open(uri_string(),'class="form-signin"');?>
         <div class="well well-lg col-lg-6"  >
            <div class="form-group ">
               <label><?php echo lang('edit_user_fname_label', 'first_name');?> </label>
               <?php echo form_input($first_name);?>
            </div>
            <div class="form-group ">
               <label><?php echo lang('edit_user_lname_label', 'last_name');?> </label>
               <?php echo form_input($last_name);?>
            </div>
            <div class="form-group ">
               <label><?php echo lang('edit_user_company_label', 'company');?> </label>
               <?php echo form_input($company);?>
            </div>
            <div class="form-group ">
               <label><?php echo lang('edit_user_phone_label', 'phone');?> </label>
               <?php echo form_input($phone);?>
            </div>
            <div class="form-group ">
               <label><?php echo lang('edit_user_password_label', 'password');?> </label>
               <?php echo form_input($password);?>
            </div>
            <div class="form-group ">
               <label><?php echo lang('edit_user_password_confirm_label', 'password_confirm');?></label>
               <?php echo form_input($password_confirm);?>
            </div>
            <?php if ($this->ion_auth->is_admin()): ?>
            <h3><?php echo lang('edit_user_groups_heading');?></h3>
            <?php foreach ($groups as $group):?>
            <label class="checkbox">
            <?php
               $gID=$group['id'];
               $checked = null;
               $item = null;
               foreach($currentGroups as $grp) {
                   if ($gID == $grp->id) {
                       $checked= ' checked="checked"';
                   break;
                   }
               }
               ?>
            <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
            <?php echo $group['name'];?>
            </label>
            <?php endforeach?>
            <?php endif ?>
            <?php echo form_hidden('id', $user->id);?>
            <?php echo form_hidden($csrf); ?>
            <div class="form-group "><?php echo form_submit('submit', lang('edit_user_submit_btn'),'class="btn text-muted text-center btn-danger"');?></div>
         </div>
         <?php echo form_close();?>
         <!--Edit User End -->
      </div>
   </div>
</div>
<!--END BLOCK SECTION -->
<hr />

