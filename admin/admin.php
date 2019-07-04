<?php

  session_start();
  require_once("../pdo.php");
  require_once("leads/admin.php");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS | Admin Center</title>
    <link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
  </head>
  <body>
    <div class="menuTop">
      <?php
        if ($_SESSION['adminType'] == "counselor") {
          echo("<div style='background-color:blue'>STATUS: COUNSELOR</div>");
        } else {
          echo("<div style='background-color:green'>STATUS: DELEGATE</div>");
        };
      ?>
      <form method="POST">
        <input style="border:1px solid black" type="submit" name="logout" value="LOGOUT" />
      </form>
    </div>
    <div class="titleTop">BUCKEYE BOYS STATE</div>
    <div class="titleBottom">Administrative Center</div>
    <?php
      if (isset($_SESSION['message']) && $_SERVER['REQUEST_METHOD'] == "GET") {
        echo($_SESSION['message']);
        unset($_SESSION['message']);
      };
    ?>
    <div class="sectionName">
      <?php
        // Adds these to the city or county titles for the page
        if ($secInfo['is_city'] == "1") {
          $titleSuffix = " City";
        } elseif ($secInfo['is_county'] == "1") {
          $titleSuffix = " County";
        } else {
          $titleSuffix = "";
        };
        // Displays which section you are working on
        echo($secInfo['section_name'].$titleSuffix);
      ?>
    </div>
    <div style="display:flex">
      <div class="belowTab"></div>
      <div class="belowTab"></div>
    </div>
  </body>
</html>
