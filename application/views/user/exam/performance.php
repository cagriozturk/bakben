<html>
   <head>
      <script type="text/javascript" src="<?php echo base_url();?>assets/designs/js/line-chart.js"></script>
      <script type="text/javascript">
         google.load("visualization", "1", {packages:["corechart"]});
         google.setOnLoadCallback(drawChart);
         function drawChart() {
           var data = google.visualization.arrayToDataTable([
             <?php echo $result;?>
           ]);
           var options = {
             title: '<?php echo $info;?>'
           };
           var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
           chart.draw(data, options);
         }
      </script>
	  <style>
	  body{ background:#2d3c4d ;   margin:0px !important; clear:both;}
	  .video{ float:left; background:#fff; border-radius:5px !important; padding:1em; width:500px; margin-top:6em; margin-left:26em;}
	    .fluid-hedder {
background: #384145;
border-bottom: 3px solid #ffffff;
z-index: 999999;   float:left; width:100%;
}
.logo {
background: #437ba3;
padding: 0; float:left;
}
 
	  </style>
   </head>
   <body>
   <div class=" fluid-hedder ">
         <div class="logo"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/designs/images/logo.png" width="100%" height="50"></a></div>
         
      </div>	 
   <div class="video">
   
   <div id="chart_div" style="height:400px"></div>
   </div>
   
   </body>
</html>
