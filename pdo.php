<?php
  $currentYear = 2019;
  $currentHost = $_SERVER['HTTP_HOST'];

  // Will determine where to retrieve the data from
  if ($currentHost == "localhost:8888") {
    $isLocal = true;
    $pdo = new PDO('mysql:host=localhost;port=8888;dbname=BBS_government','Nick','Ike');
    $rootURL = $currentHost."/Buckeye_Boys_State/bbs_govt/";
    $jquery = "../../jquery.js";
  } else {
    $isLocal = false;
    if ($_ENV["CLEARDB_PASSWORD"] && $_ENV["CLEARDB_USERNAME"]) {
      $pdo = new PDO('mysql:host=us-cdbr-iron-east-02.cleardb.net;port=3306;dbname=heroku_9f89bb0196fa398',$_ENV["CLEARDB_USERNAME"],$_ENV["CLEARDB_PASSWORD"]);
    } else {
      require_once("config.php");
      $pdo = new PDO('mysql:host=us-cdbr-iron-east-02.cleardb.net;port=3306;dbname=heroku_9f89bb0196fa398',$username,$password);
    };
    $rootURL = $currentHost;
    $jquery = '"https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"';
  };

  // Will set up the absolute path to all of the images
  if ($currentHost == "localhost:8888") {
    $imgPrefix = "http://localhost:8888/Buckeye_Boys_State/bbs_govt/img";
  } else {
    if ($_ENV["CLEARDB_PASSWORD"] && $_ENV["CLEARDB_USERNAME"]) {
      $imgPrefix = "https://buckeye-boys-state.herokuapp.com/img";
    } else {
      $imgPrefix = "https://www.weareohiobbs.com/img";
    };
  };

  // Starting date
  $startDateStmt = $pdo->prepare("SELECT starting_date FROM Maintenance WHERE locksmith_name='Maintenance'");
  $startDateStmt->execute();
  $startDate = $startDateStmt->fetch(PDO::FETCH_ASSOC)['starting_date'];
  $startArray = explode("-",$startDate);
  $startDate = $startArray[0]." ".$startArray[1].", ".$startArray[2];

  // Ending date
  $endDateStmt = $pdo->prepare("SELECT ending_date FROM Maintenance WHERE locksmith_name='Maintenance'");
  $endDateStmt->execute();
  $endDate = $endDateStmt->fetch(PDO::FETCH_ASSOC)['ending_date'];
  $endArray = explode("-",$endDate);
  $endDate = $endArray[0]." ".$endArray[1].", ".$endArray[2];

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
