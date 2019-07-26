<?php
  $currentYear = 2019;
  $currentHost = $_SERVER['HTTP_HOST'];

  if ($currentHost == "localhost:8888") {
    $pdo = new PDO('mysql:host=localhost;port=8888;dbname=BBS_government','Nick','Ike');
    $rootURL = $currentHost."/Buckeye_Boys_State/bbs_govt/";
  } else {
    $pdo = new PDO('mysql:host=us-cdbr-iron-east-02.cleardb.net;port=3306;dbname=heroku_9f89bb0196fa398','bb859affb4aa30','*passwrd_goes_here*');
    $rootURL = $currentHost;
  };

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
