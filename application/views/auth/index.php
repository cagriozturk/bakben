

<h1><?php echo $this->lang->line('index_heading');?></h1>
<p><?php echo $this->lang->line('index_subheading');?></p>
<div id="infoMessage"><?php echo $message;?></div>
<table cellpadding=0 cellspacing=10>
   <tr>
      <th><?php echo $this->lang->line('index_fname_th');?></th>
      <th><?php echo $this->lang->line('index_lname_th');?></th>
      <th><?php echo $this->lang->line('index_email_th');?></th>
      <th><?php echo $this->lang->line('index_groups_th');?></th>
      <th><?php echo $this->lang->line('index_status_th');?></th>
      <th><?php echo $this->lang->line('index_action_th');?></th>
   </tr>
   <?php foreach ($users as $user):?>
   <tr>
      <td><?php echo $user->first_name;?></td>
      <td><?php echo $user->last_name;?></td>
      <td><?php echo $user->email;?></td>
      <td>
         <?php foreach ($user->groups as $group):?>
         <?php echo anchor("auth/edit_group/".$group->id, $group->name) ;?><br />
         <?php endforeach?>
      </td>
      <td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, $this->lang->line('index_active_link')) : anchor("auth/activate/". $user->id, $this->lang->line('index_inactive_link'));?></td>
      <td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
   </tr>
   <?php endforeach;?>
</table>
<p><?php echo anchor('auth/create_user', $this->lang->line('index_create_user_link'))?> | <?php echo anchor('auth/create_group', $this->lang->line('index_create_group_link'))?></p>

