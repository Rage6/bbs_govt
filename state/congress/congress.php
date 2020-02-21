<?php

  session_start();
  require_once("../../pdo.php");
  require_once("../../lockdown.php");
  require_once("congress_lead.php");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS | General Assembly</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans+Condensed:300|Playfair+Display&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="../../style/required.css" />
    <!-- Width: 0px to 360px (Default CSS) -->
    <link rel="stylesheet" type="text/css" href="style/congress_360.css"/>
    <!-- Width: 361px to 375px -->
    <link rel="stylesheet" media="screen and (min-width: 361px) and (max-width: 375px)" href="style/congress_375.css"/>
    <!-- Width: 376px to 414px -->
    <link rel="stylesheet" media="screen and (min-width: 376px) and (max-width: 414px)" href="style/congress_414.css"/>
    <!-- Width: 415px to 768px -->
    <link rel="stylesheet" media="screen and (min-width: 415px) and (max-width: 768px)" href="style/congress_768.css"/>
    <!-- Width: 769px to 1366px -->
    <link rel="stylesheet" media="screen and (min-width: 769px) and (max-width: 1366px)" href="style/congress_1366.css"/>
    <!-- Width: 1367px to 1440px -->
    <link rel="stylesheet" media="screen and (min-width: 1367px) and (max-width: 1440px)" href="style/congress_1440.css"/>
    <!-- Width: 1441px and above -->
    <link rel="stylesheet" media="screen and (min-width: 1441px)" href="style/congress_1920.css"/>
    <!-- <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script> -->
    <script src=<?php
      if ($isLocal == true) {
        echo("../../".$jquery);
      } else {
        echo($jquery);
      };?>></script>
    <script src="main.js"></script>
  </head>
  <body>
    <div class='wholeBox'>
      <div class='entranceBox'>
        <a class="entranceBackArrow" href="../../index.php">
          <img src="../../img/home_blue.png" />
        </a>
        <div class='entranceTitle'>
          <div>Buckeye Boys State</div>
          <div>GENERAL ASSEMBLY</div>
        </div>
        <div class="bothChambers">
          <div class="chooseHouse">SELECT A HOUSE:</div>
          <div id="senClick" style="background-color:#00467f" class="chamberBttn">Senate</div>
          <div class="chooseHouse">- OR -</div>
          <div id="repClick" style="background-color:#dc2121" class="chamberBttn">House of Representatives</div>
        </div>
      </div>
      <div class='senateBox'>
        <!-- <span id="senateToCenter" class="senateToCenter bothTabs">
          <span>H</span>
          <span>O</span>
          <span>U</span>
          <span>S</span>
          <span>E</span>
        </span> -->
        <div class="bothTopBttns">
          <a id="senateToCenter" class="returnHome">
            <img src="../../img/home_gold.png" />
          </a>
          <a class="returnHome" >
            <img src="../../img/menu_gold.png" />
          </a>
        </div>
        <div class="senContent">
          <div class="senTitle">
            <div class="senText">
              <div class="bbsTitle">
                BUCKEYE BOYS STATE
              </div>
              SENATE
            </div>
          </div>
          <div class="senIntro">
            <?php
              echo($senIntro['content']);
            ?>
          </div>
        </div>
      </div>
      <div class='houseBox'>
        <!-- <span id="repToCenter" class="repToCenter bothTabs">
          <span>S</span>
          <span>E</span>
          <span>N</span>
          <span>A</span>
          <span>T</span>
          <span>E</span>
        </span> -->
        <div class="bothTopBttns">
          <a class="returnHome">
            <img src="../../img/menu_gold.png" />
          </a>
          <a id="repToCenter" class="returnHome">
            <img src="../../img/home_gold.png" />
          </a>
        </div>
        <div class="repContent">
          This is the House of Representatives
        </div>
      </div>
    </div>
  </body>
</html>