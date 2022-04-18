<?php
  $currentYear = 2019;
  $currentHost = $_SERVER['HTTP_HOST'];

  if ($_GET['year']) {
    $prior_year_pdo = '_'.$_GET['year'];
    $prior_year_href = '?year='.$_GET['year'];
  } else {
    $prior_year_pdo = '';
    $prior_year_href = '';
  };

  // Retrieves the data from...
  if ($currentHost == "localhost:8888") {
    $isLocal = true;
    // ...the current year
    // if ($prior_year_pdo == '') {
      // $pdo = new PDO('mysql:host=localhost;port=8888;dbname=BBS_government','Nick','Ike');
    // ...a past year
    // } else {
      $pdo = new PDO('mysql:host=localhost;port=8888;dbname=BBS_government'.$prior_year_pdo,'Nick','Ike');
    // };
    $rootURL = $currentHost."/Buckeye_Boys_State/bbs_govt/";
    $jquery = "../../jquery.js";
  } else {
    $isLocal = false;
    if ($_ENV["PASSWORD"] && $_ENV["USERNAME"]) {
      $pdo = new PDO('mysql:host='.$_ENV["HOST"].';port=3306;dbname='.$_ENV["DB_NAME"],$_ENV["USERNAME"],$_ENV["PASSWORD"]);
    } else {
      require_once("config.php");
      $pdo = new PDO('mysql:host='.$host.';port=3306;dbname='.$dB_name,$username,$password);
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
    if ($_ENV["PASSWORD"] && $_ENV["USERNAME"]) {
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
