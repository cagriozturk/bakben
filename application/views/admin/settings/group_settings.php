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
         <li><a href="#">   Ayarlar </a></li>
      </ul>
   </div>
</div>
<div class="row">
   <?php echo validation_errors();
      echo $this->session->flashdata('message');
      ?>
   <div class="col-md-5">
      <div class="ga">
         <div class="btn-group ga1">
            <a href="<?php echo base_url();?>admin/add_group" class="btn btn-default dropdown-toggle ga-btn">
            Grup Ekle
            </a>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <table id="example" class="cell-border" cellspacing="0" width="100%">
         <thead>
            <tr>
               <th>S.No.</th>
			    <th>Grup ID</th>
               <th>Grup Adı</th>
               <th>Durum</th>
               <th>Eylem</th>
            </tr>
         </thead>
         <tfoot>
            <tr>
               <th>S.No.</th>
			    <th>Grup ID</th>
               <th>Grup Adı</th>
               <th>Durum</th>
               <th>Eylem</th>
            </tr>
         </tfoot>
         <tbody>
            <?php if (count($records)>0) { 
               $i=1;
               foreach ($records as $r) {
            ?>
            <tr>
               <td><?php echo $i++;?></td>
               <td><?php echo $r->id;?></td>
               <td><?php echo $r->group_name;?></td>
               <td><?php echo $r->status;?></td>
               <td>
                  <a href="<?php echo base_url();?>admin/add_group/<?php echo $r->id;?>/<?php echo $r->group_name;?>" class="btn bg-primary wnm-user"> <i class="fa fa-edit"></i> Değiştir</a>
                  <a href="<?php echo base_url();?>admin/group_settings/<?php echo $r->id;?>" onclick="return confirm('Are you sure you want to delete this record?')" class="btn bg-primary wnm-user"><i class="fa fa-times-circle"></i> Sil</a>
               </td>
            </tr>
            <?php } 
			} 
			else "<tr><td colspan='5'>No Data Available.</td></tr>"; 
			?>
         </tbody>
      </table>
   </div>
</div>

