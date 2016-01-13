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

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>