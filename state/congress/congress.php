<?php

  session_start();
  require_once("../../pdo.php");
  require_once("../../lockdown.php");
  require_once("congress_lead.php");

  // echo("<pre>");
  // var_dump($senateLdrList);
  // echo("</pre>");

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
    <script src="bill_library/bill.js"></script>
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
          <div id="repClick" style="background-color: #8C130E" class="chamberBttn">House of Representatives</div>
        </div>
      </div>
      <div class='senateBox'>
        <div class='menu senMenu'>
          <div class='menuOption senOption'>
            LEADERSHIP
          </div>
          <div id="senMajClick" class='senSubOption'>
            + Majority Leaders
          </div>
          <div id="senMinClick" class='senSubOption'>
            + Minority Leaders
          </div>
          <div id="senBillClick" class='menuOption senOption'>
            BILLS
          </div>
          <div class='menuOption senOption'>
            LAWS
          </div>
          <div class='menuOption senOption'>
            COMMITTEES
          </div>
          <div class='menuOption senOption'>
            MEET THE SENATORS
          </div>
        </div>
        <div class="bothTopBttns">
            <img id="senateToCenter" src="../../img/back_arrow_gold.png" />
            <img id="senMenuClick" src="../../img/menu_gold.png" />
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
          <div class="leaderBox">
            <div class="moduleTitle senModTitle">
              LEADERSHIP
            </div>
            <div id="senMajBox" class="majorityBox">
              <div class="senMajTitle">MAJORITY LEADERS</div>
              <?php
                for ($ldrNum = 0; $ldrNum < 4; $ldrNum++) {
                  echo("
                  <div class='oneLdr majorityLdrs senLdrs'>
                    <div class='ldrTitle senLdrTitle'>".$senateLdrList[$ldrNum]['job_name']."</div>
                    <div class='ldrName senLdrName'>
                      ".$senateLdrList[$ldrNum]['first_name']." ".$senateLdrList[$ldrNum]['last_name']."
                    </div>");
                    if ($senateLdrList[$ldrNum]['delegate_id'] != "0" && $senateLdrList[$ldrNum]['approved'] == "1") {
                      echo("
                      <img src='".$senateLdrList[$ldrNum]['section_path']."crop_".$senateLdrList[$ldrNum]['filename'].".".$senateLdrList[$ldrNum]['extension']."'>");
                    } else {
                      echo("
                        <img src='../../img/default_photo.png'>");
                    };
                    echo("
                    <div class='ldrDescription senLdrDescription'>".$senateLdrList[$ldrNum]['description']."</div>
                    <div class='topBttn senTopBttn'>- TOP -</div>
                  </div>");
                };
              ?>
            </div>
            <div id="senMinBox"
             class="minorityBox">
              <div class="senMinTitle">MINORITY LEADERS</div>
              <?php
                for ($ldrNum = 4; $ldrNum < 8; $ldrNum++) {
                  echo("
                  <div class='oneLdr minorityLdr senLdrs'>
                    <div class='ldrTitle senLdrTitle'>".$senateLdrList[$ldrNum]['job_name']."</div>
                    <div class='ldrName senLdrName'>
                      ".$senateLdrList[$ldrNum]['first_name']." ".$senateLdrList[$ldrNum]['last_name']."
                    </div>");
                    if ($senateLdrList[$ldrNum]['delegate_id'] != "0" && $senateLdrList[$ldrNum]['approved'] == "1") {
                      echo("
                      <img src='".$senateLdrList[$ldrNum]['section_path']."/".$senateLdrList[$ldrNum]['filename'].".".$senateLdrList[$ldrNum]['extension']."'>");
                    } else {
                      echo("
                      <img src='../../img/default_photo.png'>");
                    };
                    echo("
                    <div class='ldrDescription senLdrDescription'>".$senateLdrList[$ldrNum]['description']."</div>
                    <div class='topBttn senTopBttn'>- TOP -</div>
                  </div>");
                };
              ?>
            </div>
          </div>
          <div id="senBillBox" class="billBox">
            <div class="moduleTitle senModTitle">BILLS</div>
            <!-- Add JSON file to get all of the bill #'s, names, and statuses (maybe by senator that made it, too, in the future)-->
            <!-- Use JS to make a simple search engine by bill # or keywords(?) -->
            <!-- Or, someone can select a specific status -->
            <div class="selectTitle senSelectTitle">SEARCH BY STATUS</div>
            <div class="selectBox senSelectBox">
              <div id="currentSenSelect" class="currentSelect currentSenSelect">ALL</div>
              <div class="selectList senSelectList">
                <div class="selectOption senSelectOption" data-sensubid='0'>ALL</div>
                <?php
                  $senStatusStmt = $pdo->prepare("SELECT * FROM Subtype WHERE type_id=12");
                  $senStatusStmt->execute();
                  while ($oneStatus = $senStatusStmt->fetch(PDO::FETCH_ASSOC)) {
                    echo("
                      <div
                        class='selectOption senSelectOption'
                        data-sensubid='".$oneStatus['subtype_id']."'>
                          ".$oneStatus['subtype_name']."
                      </div>
                    ");
                  };
                ?>
              </div>
            </div>
            <div id="senBillDirectory" class="billDirectory">

            </div>
          </div>
          <div class='topBttn senTopBttn'>- TOP -</div>
        </div>
      </div>
      <div class='houseBox'>
        <div class="bothTopBttns">
          <a class="returnHome">
            <img src="../../img/menu_gold.png" />
          </a>
          <a id="repToCenter" class="returnHome">
            <img style="transform: rotate(180deg)" src="../../img/back_arrow_gold.png" />
          </a>
        </div>
        <div class="repContent">
          This is the House of Representatives
        </div>
      </div>
    </div>
  </body>
</html>
