<?php
  $currentYear = 2019;
  $currentHost = $_SERVER['HTTP_HOST'];

  if ($currentHost == "localhost:8888") {
    $pdo = new PDO('mysql:host=localhost;port=8888;dbname=BBS_government','Nick','Ike');
    $hostStatus = "Using laptop database";
    $rootURL = $currentHost."/Buckeye_Boys_State/bbs_govt/";
  } else {
    // remote dB connection goes here
    $hostStatus = "Using remote server";
    // actual URL goes here
  };

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
