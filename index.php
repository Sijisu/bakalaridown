<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <title>BakalariDown</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <?php
  require('config.php');
  $db = dbconnect();
  $stmt = $db->prepare('SELECT ID FROM bakalaridown WHERE `Answer` = 1');
  $stmt->execute();
  $up = $stmt->rowCount();
  $stmt = $db->prepare('SELECT ID FROM bakalaridown WHERE `Answer` = 0');
  $stmt->execute();
  $down = $stmt->rowCount();
  $sum = $up + $down;
  $stmt = $db->prepare('SELECT * FROM bakalaridown ORDER BY Time');
  $stmt->execute();
   ?>
  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart','table']});
      google.charts.setOnLoadCallback(startChars);
      function startChars() {
        drawChart();
        drawTable();
      }
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Up/Down (sum <? echo $sum?>)', 'times'],
          ['Up', <? echo $up?>],
          ['Down',     <? echo $down?>]
        ]);

        var options = {
          title: 'Total availability:',
          is3D: false
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
      function drawTable() {
        var data = new google.visualization.DataTable();
        //data.addColumn('number', 'ID');
        data.addColumn('string', 'Time');
        data.addColumn('boolean', 'Online?');
        data.addRows([
          <?php
          foreach ($stmt as $row) {
            $answer = ($row['Answer'] == 1 ? 'true' : 'false');
            //echo "[".$row['ID'].", '".$row['Time']."', ".$answer."],";
            echo "['".$row['Time']."', ".$answer."],";
          } ?>
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '40%'});
      }

    </script>

</head>
<body>
  <div class="container">
  <div class="row" style="margin-left: -15px;margin-right: -15px;">
  <div class="col-md-12 text-center">
    <h1>BakalářiDown</h1>
    <p>Monitoring availability of gbl's baka server.</p>
  </div>
  <div class="col-md-4 col-md-offset-4">
    <hr />
  </div>
  <div class="clearfix"></div>
  <div class="col-md-6">
    <div id="piechart" style="width: 100%; min-height: 450px;"></div>
  </div>
  <div class="col-md-6">
    <div id="table_div" style="width: 100%; min-height: 450px;"></div>
  </div>
</div>
</div>
</body>
</html>
