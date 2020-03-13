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
    <script src="law_library/law.js"></script>
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
          <div id="senClick" class="chamberBttn senChamber">
            Senate
          </div>
          <div id="repClick" class="chamberBttn repChamber">
            House of Representatives
          </div>
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
          <div id="senLawClick" class='menuOption senOption'>
            LAWS
          </div>
          <div id="senCommitteeClick" class='menuOption senOption'>
            COMMITTEES
          </div>
          <div id="senMemberClick" class='menuOption senOption'>
            MEET THE SENATORS
          </div>
        </div>
        <div class="bothTopBttns senBothTopBttns">
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
            <div class="selectTitle senSelectTitle">SEARCH BY STATUS</div>
            <div class="selectBox senSelectBox">
              <div id="currentSenSelect" class="currentSelect currentSenSelect">ALL</div>
              <div class="selectList senSelectList">
                <div class="selectOption senSelectOption" data-sensubid='0'>ALL</div>
                <?php
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
              <!-- This is where the selected bills are listed -->
            </div>
          </div>
          <div class='topBttn senTopBttn'>- TOP -</div>
          <div id="senLawBox" class="lawBox senLawBox">
            <div class="moduleTitle senModTitle">LAWS</div>
            <div id="viewSenBillClick" class="question senQuestion">
              + <i>How do bills become laws?</i>
            </div>
            <div id="viewSenBillBox" class="answer senAnswer">
              Within the Buckeye Boys State, a bill becomes a law after two steps:
              <ol>
                <li>
                  Voted in favor by the majority of both Senate and the House of Representatives
                </li>
                <li>
                  Either a) signed into law by the governor, or b) the chambers vote to override the governor's veto
                </li>
            </div>
            <div id="viewSenReadClick" class="question senQuestion">
              + <i>How can I read a law?</i>
            </div>
            <div id="viewSenReadBox" class="answer senAnswer">
              To view a law, scroll through the below list and search for the desired title or bill number. Click the title, and that law's details will appear below or beside the list.
            </div>
            <div class="lawTotal senLawTotal">
              <div class="leftHalf">
                <div class="lawListTitle senLawListTitle">
                  <div>Title & Approval</div>
                </div>
                <div id="senLawList" class="senLawList lawList">
                  <?php
                    while ($oneSenLaw = $senLawListStmt->fetch(PDO::FETCH_ASSOC)) {
                      echo("
                        <div class='oneLaw oneSenLaw'>
                          <div class='oneLawTitle oneSenLawTitle' data-postid='".$oneSenLaw['post_id']."'>
                            ".$oneSenLaw['title']."
                          </div>
                          <div class='oneLawApproval oneSenLawApproval' data-postid='".$oneSenLaw['post_id']."'>
                            ".$oneSenLaw['subtype_name']."
                          </div>
                        </div>");
                    };
                  ?>
                </div>
              </div>
              <div class="rightHalf">
                <div class="lawContent senLawContent">
                  <!-- This is where the selected law's details are listed -->
                  <div class="startEmpty" style='text-align:center'>
                    <i>-- SELECT A LAW --</i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class='topBttn senTopBttn'>- TOP -</div>
          <div id="senCommitteeBox" class="senCommitteeBox committeeBox">
            <div class="moduleTitle senModTitle">COMMITTEES</div>
            <div id="viewSenCommClick" class="question senQuestion">
              + <i>What does a committee do?</i>
            </div>
            <div id="viewSenCommBox" class="answer senAnswer">
              Committees are an essential part of the legislative process. They monitor on-going governmental operations, identify issues suitable for legislative review, gather and evaluate information, and recommend courses of action to their respective chambers.
            </div>
            <div class="allComm senAllComm">
              <?php
                while ($oneSenComm = $senCommStmt->fetch(PDO::FETCH_ASSOC)) {
                  echo("
                    <div class='oneComm senOneComm'>
                      <div class='commTitle senCommTitle' data-dptid='".$oneSenComm['dpt_id']."'>
                        ".$oneSenComm['dpt_name']."
                      </div>
                      <div class='commContent senCommContent' data-dptid='".$oneSenComm['dpt_id']."'>
                        <div class='commPurpose'>
                          ".$oneSenComm['purpose']."
                        </div>
                        <div class='commHead'>
                          <div><u>".$oneSenComm['job_name']."</u></div>
                          <div>
                            ".$oneSenComm['first_name']." ".$oneSenComm['last_name']."
                          </div>
                        </div>
                      </div>
                    </div>");
                };
              ?>
            </div>
          </div>
          <div class='topBttn senTopBttn'>- TOP -</div>
          <div id="senMemberBox" class="senMemberBox memberBox">
            <div class="moduleTitle senModTitle">KNOW YOUR SENATOR</div>
            <div class="allMember senAllMembers">
              <?php
                $currentCity = "";
                $initCity = true;
                for ($oneSenNum = 0; $oneSenNum < count($senMemList); $oneSenNum++) {
                  if ($currentCity != $senMemList[$oneSenNum]['section_name']) {
                    if ($initCity == false) {
                      echo("</div>");
                    } else {
                      $initCity = false;
                    }
                    echo("
                      <div class='oneCity oneSenCity'>
                        <div class='cityName senCityName'>
                          ".$senMemList[$oneSenNum]['section_name']." City
                        </div>");
                    $currentCity = $senMemList[$oneSenNum]['section_name'];
                  };
                  echo("
                    <div class='oneCongressman oneSenator'>
                      <div class='oneCongName oneSenName'>
                        ".$senMemList[$oneSenNum]['first_name']." ".$senMemList[$oneSenNum]['last_name']."
                      </div>
                      <div class='oneCongHome oneSenHome'>
                        ".$senMemList[$oneSenNum]['hometown'].", OH
                      </div>
                    </div>");
                };
              ?>
              </div>
            </div>
          </div>
          <div class='topBttn senTopBttn'>- TOP -</div>
        </div>
      </div>
      <div class='houseBox'>
        <div class='menu repMenu'>
          <div class='menuOption repOption'>
            LEADERSHIP
          </div>
          <div id="repMajClick" class='repSubOption'>
            + Majority Leaders
          </div>
          <div id="repMinClick" class='repSubOption'>
            + Minority Leaders
          </div>
          <div id="repBillClick" class='menuOption repOption'>
            BILLS
          </div>
          <div id="repLawClick" class='menuOption repOption'>
            LAWS
          </div>
          <div id="repCommitteeClick" class='menuOption repOption'>
            COMMITTEES
          </div>
          <div id="repMemberClick" class='menuOption repOption'>
            MEET THE REPRESENTATIVES
          </div>
        </div>
        <div class="bothTopBttns repBothTopBttns">
          <img id="repMenuClick" src="../../img/menu_gold.png" />
          <img id="repToCenter" style="transform: rotate(180deg)" src="../../img/back_arrow_gold.png" />
        </div>
        <div class="repContent">
          This is the House of Representatives
        </div>
      </div>
    </div>
  </body>
</html>
