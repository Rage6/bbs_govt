<?php

  session_start();
  require_once("../../pdo.php");
  require_once("lead_login.php");

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS | Admin Login</title>
    <!-- Width: 0px to 360px (Default CSS) -->
    <link rel="stylesheet" type="text/css" href="style/login_360.css" />
    <!-- Width: 361px to 375px -->
    <link rel="stylesheet" media="screen and (min-width: 361px) and (max-width: 375px)" href="style/login_375.css"/>
    <!-- Width: 376px to 414px -->
    <link rel="stylesheet" media="screen and (min-width: 376px) and (max-width: 414px)" href="style/login_414.css"/>
    <!-- Width: 415px to 768px -->
    <link rel="stylesheet" media="screen and (min-width: 415px) and (max-width: 768px)" href="style/login_768.css"/>
    <!-- Width: 769px to 1366px -->
    <link rel="stylesheet" media="screen and (min-width: 769px) and (max-width: 1366px)" href="style/login_1366.css"/>
    <!-- Width: 1367px to 1440px -->
    <link rel="stylesheet" media="screen and (min-width: 1367px) and (max-width: 1440px)" href="style/login_1440.css"/>
    <!-- Width: 1441px and above -->
    <link rel="stylesheet" media="screen and (min-width: 1441px)" href="style/login_1920.css"/>
    <link rel="icon" type="image/x-icon" href="../../img/favicon.ico"/>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script src="main.js"></script>
  </head>
  <body>
    <div class="returnArrow">
      <a href="../../index.php">
        <img src="../../img/return_arrow_left.png" />
      </a>
    </div>
    <div class="infoBox">
      <div class="allTitle">
        <div class="upperTitle">
          Buckeye Boys State
        </div>
        <div class="lowerTitle">
          Administrative Center
        </div>
      </div>
      <div class="explain">
        Welcome! The Administrative Center is where counselors and delegates can update information in their state, county, or city's webpage.
      </div>
    </div>
    <?php
      if (isset($_SESSION['message']) && $_SERVER['REQUEST_METHOD'] == "GET") {
        echo("<div class='message'>".$_SESSION['message']."</div>");
        unset($_SESSION['message']);
      };
    ?>
    <div id="formBox" class="formBox">
      <form method="POST">
        <div>Select your desired section, county, or city</div>
        <select name='sectionId'>
          <option value=''>Choose A Section</option>
          <?php
            for ($sectNum = 0; $sectNum < count($sectList); $sectNum++) {
              if ($sectList[$sectNum]['section_id'] != 0) {
                if ($sectList[$sectNum]['is_city'] == 1) {
                  $sectionName = "City of ".$sectList[$sectNum]['section_name'];
                } elseif ($sectList[$sectNum]['section_id'] == $sectList[$sectNum]['is_county']) {
                  $sectionName = "County of ".$sectList[$sectNum]['section_name'];
                } else {
                  $sectionName = $sectList[$sectNum]['section_name'];
                };
                echo("<option value='".$sectList[$sectNum]['section_id']."'>".$sectionName."</option>");
              };
            };
            if (isset($_GET['maintenance'])) {
              echo("<option value='999'>Maintenance</option>");
            };
          ?>
        </select>
        <div>
          <div>
            Enter your password
          </div>
          <input type="password" name="sectionPw" />
        </div>
        <input class="formBttn" type="submit" name="sectionLogin" value="ENTER" />
        </table>
      </form>
    </div>
    <div class="lockedBox">
      <div id="lockedBttn" class="lockedBttn">
        Locked Out?
      </div>
      <div id="lockedInfo" class="lockedInfo">
        To prevent hacking, a section account is "locked" if a user makes 5 failed login attempts in a row. To "unlock" it, contact a counselor or the BBS IT staff.
      </div>
    </div>
  </body>
</html>
