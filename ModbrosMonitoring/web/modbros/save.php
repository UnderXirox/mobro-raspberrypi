<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ModBros Monitoring Setup</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link href="../bootstrap.min.css" rel="stylesheet"/>
</head>
<body>

<div id="container" class="container">

  <div class="card mt-3">
    <div class="card-header">
      <h3 class="m-0">ModBros Monitoring</h3>
    </div>

    <div class="card-body">
      <p>
        You Raspberry Pi will now close this access point and start trying to connect to:
      </p>
      <p>
          <?php
          $ssid = $_POST['ssid'];
          echo '<b>' . $ssid . '</b>';
          ?>
      </p>
      <p>
        This might take some time.<br>
        Once connected, it will try and locate your instance of the ModBros Monitoring application using the provided
        connection key:
      </p>
      <p class="m-0">
          <?php
          $key = $_POST['key'];
          echo '<b>' . $key . '</b>';
          ?>
      </p>
    </div>
  </div>

  <div class="card mt-3">
    <div class="card-header">
      <h3 class="m-0">Output:</h3>
    </div>

    <div class="card-body">
      <pre>
          <?php
          if (isset($_POST['pw']) && isset($_POST['key']) && (isset($_POST['ssid']) || isset($_POST['ssid_manual']))) {
              $ssid = (empty($_POST['ssid_manual']) ? $_POST['ssid'] : $_POST['ssid_manual']);
              $pw = $_POST['pw'];
              $key = $_POST['key'];
              $updated = time();
              $data = $ssid . "\n" . $pw . "\n" . $key . "\n" . $updated;
              $ret = file_put_contents('/home/modbros/ModbrosMonitoring/data/wifi.txt', $data, LOCK_EX);
              if ($ret === false) {
                  echo('There was an error saving the access data!');
              } else {
                  echo "wifi access data successfully saved \n($ret bytes written)\n";
                  echo "trying to connect to network '" . $ssid . "' using the provided password...\n";
              }
          } else {
              echo('Error! Missing data!');
          }
          ?>
      </pre>
    </div>
  </div>


  <a href="index.php" class="previous btn btn-primary mt-3">&laquo; Back</a>

  <hr/>

  <footer>
    <p>
      Created with &#9829; in Austria by: &#169; ModBros 2019<br/>
      Contact: <a href="https://mod-bros.com">mod-bros.com</a><br/>
    </p>
  </footer>
</div>

</body>
</html>