<?php

  session_start();
  require_once("../../pdo.php");
  require_once("../../lockdown.php");
  require_once("congress_lead.php");
  require_once("static_values.php");

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
    <link rel="stylesheet" media="screen and (min-width: 1441px)" type="text/css" href="../../style/required_1920.css" />
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
        <div class="bothTopBttns">
        </div>
        <a class="entranceBackArrow" href="../../index.php">
          <img src="../../img/home_blue.png" />
        </a>
        <div class='entranceTitle'>
          <div>Buckeye Boys State</div>
          <div class="titleDivider"></div>
          <div>GENERAL ASSEMBLY</div>
        </div>
        <div class="chooseHouse">SELECT A HOUSE</div>
        <div class="bothChambers">
          <div id="senClick" class="chamberBttn senChamber">
            <div class="senChamberText">
              Senate
            </div>
            <div class="chamberDivide forWide"></div>
            <div class="chamberImg senChamberImg forWide"></div>
          </div>
          <div id="repClick" class="chamberBttn repChamber">
            <div class="repChamberText">
              House of Representatives
            </div>
            <div class="chamberDivide forWide"></div>
            <div class="chamberImg repChamberImg forWide"></div>
          </div>
        </div>
      </div>
      <div class='senateBox'>
        <div class='firstTest menu senMenu secondTest'>
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
        <div class="senContent bothContent">
          <div class="bothTitle senTitle">
            <div class="bothText senText">
              <div class="bbsTitle">
                BUCKEYE BOYS STATE
              </div>
              SENATE
            </div>
            <div class="wideTitleImg senTitleImg"></div>
          </div>
          <div class="bothIntro senIntro">
            <?php
              echo($senIntro['content']);
            ?>
          </div>
          <div class="leaderBox">
            <div class="moduleTitle senModTitle">
              LEADERSHIP
            </div>
            <div id="senMajBox" class="majorityBox">
              <div class="bothMajTitle senMajTitle">MAJORITY LEADERS</div>
              <div class="ldrList">
              <?php
                for ($ldrNum = 0; $ldrNum < 4; $ldrNum++) {
                  echo("
                  <div class='oneLdr majorityLdrs senLdrs'>
                    <div class='ldrTitle'>".$senateLdrList[$ldrNum]['job_name']."</div>
                    <div class='ldrName'>
                      ".$senateLdrList[$ldrNum]['first_name']." ".$senateLdrList[$ldrNum]['last_name']."
                    </div>");
                    if ($senateLdrList[$ldrNum]['delegate_id'] != "0" && $senateLdrList[$ldrNum]['approved'] == "1") {
                      echo("
                      <img src='".$senateLdrList[$ldrNum]['section_path']."crop_".$senateLdrList[$ldrNum]['filename'].".".$senateLdrList[$ldrNum]['extension']."?t=".time()."' />");
                    } else {
                      echo("
                        <img src='../../img/default_photo.png' />");
                    };
                    echo("
                    <div class='ldrDescription'>
                      ".$senateLdrList[$ldrNum]['description']."
                    </div>
                    <div class='topBttn senTopBttn'>- TOP -</div>
                  </div>");
                };
              ?>
              </div>
            </div>
            <div id="senMinBox" class="minorityBox">
              <div class="bothMinTitle senMinTitle">MINORITY LEADERS</div>
              <div class="ldrList">
              <?php
                for ($ldrNum = 4; $ldrNum < 8; $ldrNum++) {
                  echo("
                  <div class='oneLdr minorityLdr senLdrs'>
                    <div class='ldrTitle'>".$senateLdrList[$ldrNum]['job_name']."</div>
                    <div class='ldrName'>
                      ".$senateLdrList[$ldrNum]['first_name']." ".$senateLdrList[$ldrNum]['last_name']."
                    </div>");
                    if ($senateLdrList[$ldrNum]['delegate_id'] != "0" && $senateLdrList[$ldrNum]['approved'] == "1") {
                      echo("
                      <img src='".$senateLdrList[$ldrNum]['section_path']."/".$senateLdrList[$ldrNum]['filename'].".".$senateLdrList[$ldrNum]['extension']."?t=".time()."' />");
                    } else {
                      echo("
                      <img src='../../img/default_photo.png' />");
                    };
                    echo("
                    <div class='ldrDescription'>
                      ".$senateLdrList[$ldrNum]['description']."
                    </div>
                    <div class='topBttn senTopBttn'>- TOP -</div>
                  </div>");
                };
              ?>
              </div>
            </div>
          </div>
          <div id="senBillBox" class="billBox">
            <div class="moduleTitle senModTitle">BILLS</div>
            <div class="billContent">
              <div class="billNameList">
                <div class="selectTitle senSelectTitle">SEARCH BY STATUS</div>
                <div class="selectBox senSelectBox">
                  <div id="currentSenSelect" class="currentSelect currentSenSelect">ALL</div>
                  <div class="selectList senSelectList">
                    <div class="selectOption senSelectOption" data-sensubid='0'>
                      ALL
                    </div>
                    <?php
                      while ($oneSenStatus = $senStatusStmt->fetch(PDO::FETCH_ASSOC)) {
                        echo("
                          <div
                            class='selectOption senSelectOption'
                            data-sensubid='".$oneSenStatus['subtype_id']."'>
                              ".$oneSenStatus['subtype_name']."
                          </div>
                        ");
                      };
                    ?>
                  </div>
                </div>
              </div>
              <div id="senBillDirectory" class="billDirectory senBillDirectory">
                <!-- This is where the selected bills are listed -->
              </div>
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
              </ol>
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
                    $senLawListStmt->execute();
                    while ($oneSenLaw = $senLawListStmt->fetch(PDO::FETCH_ASSOC)) {
                      echo("
                        <div class='oneLaw oneSenLaw'>
                          <div
                            class='oneLawTitle oneSenLawTitle'
                            data-postid='".$oneSenLaw['post_id']."'
                            data-chamber='senate'>
                              ".$oneSenLaw['title']."
                          </div>
                          <div
                            class='oneLawApproval oneSenLawApproval'
                            data-postid='".$oneSenLaw['post_id']."'
                            data-chamber='senate'>
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
                      <div
                        class='commTitle senCommTitle'
                        data-dptid='".$oneSenComm['dpt_id']."'
                        data-chambertype='senate'>
                          ".$oneSenComm['dpt_name']."
                      </div>
                      <div
                        class='commContent senCommContent'
                        data-dptid='".$oneSenComm['dpt_id']."'
                        data-chambertype='senate'>
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
                for ($oneSenNum = 0; $oneSenNum < count($senMemList); $oneSenNum++) {
                  if ($currentCity != $senMemList[$oneSenNum]['section_name']) {
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
                  $nextSenNum = $oneSenNum + 1;
                  if ($nextSenNum != count($senMemList)) {
                    if ($currentCity != $senMemList[$nextSenNum]['section_name']) {
                      echo("</div>");
                    };
                  } else {
                    echo("</div>");
                  };
                };
              ?>
            </div>
          </div>
          <div class='topBttn senTopBttn'>- TOP -</div>
        </div>
        <div class='footer senLegionLink'>
          Want to attend Buckeye Boys State next year?<br>
          <a href="http://www.ohiobuckeyeboysstate.com/">
            <u>CLICK HERE!</u>
          </a>
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
            KNOW YOUR REPRESENTATIVE
          </div>
        </div>
        <div class="bothTopBttns repBothTopBttns">
          <img id="repMenuClick" src="../../img/menu_gold.png" />
          <img id="repToCenter" style="transform: rotate(180deg)" src="../../img/back_arrow_gold.png" />
        </div>
        <div class="repContent bothContent">
          <div class="bothTitle repTitle">
            <div class="bothText repText">
              <div class="bbsTitle">
                BUCKEYE BOYS STATE
              </div>
              HOUSE OF REPRESENTATIVES
            </div>
            <div class="wideTitleImg repTitleImg"></div>
          </div>
          <div class="bothIntro repIntro">
            <?php
              echo($senIntro['content']);
            ?>
          </div>
          <div class="leaderBox">
            <div class="moduleTitle repModTitle">
              LEADERSHIP
            </div>
            <div id="repMajBox" class="majorityBox">
              <div class="bothMajTitle repMajTitle">MAJORITY LEADERS</div>
              <div class="ldrList">
              <?php
                for ($repLdrNum = 0; $repLdrNum < 6; $repLdrNum++) {
                  echo("
                  <div class='oneLdr majorityLdrs repLdrs'>
                    <div class='ldrTitle'>".$repLdrList[$repLdrNum]['job_name']."</div>
                    <div class='ldrName'>
                      ".$repLdrList[$repLdrNum]['first_name']." ".$repLdrList[$repLdrNum]['last_name']."
                    </div>");
                    if ($repLdrList[$repLdrNum]['delegate_id'] != "0" && $repLdrList[$repLdrNum]['approved'] == "1") {
                      echo("
                      <img src='".$repLdrList[$repLdrNum]['section_path']."crop_".$repLdrList[$repLdrNum]['filename'].".".$repLdrList[$repLdrNum]['extension']."?t=".time()."'>");
                    } else {
                      echo("
                        <img src='../../img/default_photo.png'>");
                    };
                    echo("
                    <div class='ldrDescription'>".$repLdrList[$repLdrNum]['description']."</div>
                    <div class='topBttn repTopBttn'>- TOP -</div>
                  </div>");
                };
              ?>
              </div>
            </div>
            <div id="repMinBox"
             class="minorityBox">
              <div class="bothMinTitle repMinTitle">MINORITY LEADERS</div>
              <div class="ldrList">
              <?php
                for ($repLdrNum = 6; $repLdrNum < 10; $repLdrNum++) {
                  echo("
                  <div class='oneLdr minorityLdr repLdrs'>
                    <div class='ldrTitle'>".$repLdrList[$repLdrNum]['job_name']."</div>
                    <div class='ldrName'>
                      ".$repLdrList[$repLdrNum]['first_name']." ".$repLdrList[$repLdrNum]['last_name']."
                    </div>");
                    if ($repLdrList[$repLdrNum]['delegate_id'] != "0" && $repLdrList[$repLdrNum]['approved'] == "1") {
                      echo("
                      <img src='".$repLdrList[$repLdrNum]['section_path']."/".$repLdrList[$repLdrNum]['filename'].".".$repLdrList[$repLdrNum]['extension']."?t=".time()."'>");
                    } else {
                      echo("
                      <img src='../../img/default_photo.png'>");
                    };
                    echo("
                    <div class='ldrDescription'>".$repLdrList[$repLdrNum]['description']."</div>
                    <div class='topBttn repTopBttn'>- TOP -</div>
                  </div>");
                };
              ?>
              </div>
            </div>
          </div>
          <div id="repBillBox" class="billBox">
            <div class="moduleTitle repModTitle">BILLS</div>
            <div class="billContent">
              <div class="billNameList">
                <div class="selectTitle repSelectTitle">SEARCH BY STATUS</div>
                <div class="selectBox repSelectBox">
                  <div id="currentRepSelect" class="currentSelect currentRepSelect">ALL</div>
                  <div class="selectList repSelectList">
                    <div class="selectOption repSelectOption" data-repsubid='0'>
                      ALL
                    </div>
                    <?php
                      while ($oneRepStatus = $repStatusStmt->fetch(PDO::FETCH_ASSOC)) {
                        echo("
                          <div
                            class='selectOption repSelectOption'
                            data-repsubid='".$oneRepStatus['subtype_id']."'>
                              ".$oneRepStatus['subtype_name']."
                          </div>
                        ");
                      };
                    ?>
                  </div>
                </div>
              </div>
              <div id="repBillDirectory" class="billDirectory repBillDirectory">
                <!-- This is where the selected bills are listed -->
              </div>
            </div>
          </div>
          <div class='topBttn repTopBttn'>- TOP -</div>
          <div id="repLawBox" class="lawBox repLawBox">
            <div class="moduleTitle repModTitle">LAWS</div>
            <div id="viewRepBillClick" class="question repQuestion">
              + <i>How do bills become laws?</i>
            </div>
            <div id="viewRepBillBox" class="answer repAnswer">
              Within the Buckeye Boys State, a bill becomes a law after two steps:
              <ol>
                <li>
                  Voted in favor by the majority of both Senate and the House of Representatives
                </li>
                <li>
                  Either a) signed into law by the governor, or b) the chambers vote to override the governor's veto
                </li>
              </ol>
            </div>
            <div id="viewRepReadClick" class="question repQuestion">
              + <i>How can I read a law?</i>
            </div>
            <div id="viewRepReadBox" class="answer repAnswer">
              To view a law, scroll through the below list and search for the desired title or bill number. Click the title, and that law's details will appear below or beside the list.
            </div>
            <div class="lawTotal repLawTotal">
              <div class="leftHalf">
                <div class="lawListTitle repLawListTitle">
                  <div>Title & Approval</div>
                </div>
                <div id="repLawList" class="repLawList lawList">
                  <?php
                    $senLawListStmt->execute();
                    while ($oneSenLaw = $senLawListStmt->fetch(PDO::FETCH_ASSOC)) {
                      echo("
                        <div class='oneLaw oneRepLaw'>
                          <div class='oneLawTitle oneRepLawTitle' data-postid='".$oneSenLaw['post_id']."' data-chamber='house'>
                            ".$oneSenLaw['title']."
                          </div>
                          <div class='oneLawApproval oneRepLawApproval' data-postid='".$oneSenLaw['post_id']."' data-chamber='house'>
                            ".$oneSenLaw['subtype_name']."
                          </div>
                        </div>");
                    };
                  ?>
                </div>
              </div>
              <div class="rightHalf">
                <div class="lawContent repLawContent">
                  <!-- This is where the selected law's details are listed -->
                  <div class="startEmpty" style='text-align:center'>
                    <i>-- SELECT A LAW --</i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class='topBttn repTopBttn'>- TOP -</div>
          <div id="repCommitteeBox" class="repCommitteeBox committeeBox">
            <div class="moduleTitle repModTitle">COMMITTEES</div>
            <div id="viewRepCommClick" class="question repQuestion">
              + <i>What does a committee do?</i>
            </div>
            <div id="viewRepCommBox" class="answer repAnswer">
              Committees are an essential part of the legislative process. They monitor on-going governmental operations, identify issues suitable for legislative review, gather and evaluate information, and recommend courses of action to their respective chambers.
            </div>
            <div class="allComm repAllComm">
              <?php
                while ($oneRepComm = $repCommStmt->fetch(PDO::FETCH_ASSOC)) {
                  echo("
                    <div class='oneComm repOneComm'>
                      <div class='commTitle repCommTitle' data-dptid='".$oneRepComm['dpt_id']."' data-chambertype='house'>
                        ".$oneRepComm['dpt_name']."
                      </div>
                      <div class='commContent repCommContent' data-dptid='".$oneRepComm['dpt_id']."' data-chambertype='house'>
                        <div class='commPurpose'>
                          ".$oneRepComm['purpose']."
                        </div>
                        <div class='commHead'>
                          <div><u>".$oneRepComm['job_name']."</u></div>
                          <div>
                            ".$oneRepComm['first_name']." ".$oneRepComm['last_name']."
                          </div>
                        </div>
                      </div>
                    </div>");
                };
              ?>
            </div>
          </div>
          <div class='topBttn repTopBttn'>- TOP -</div>
          <div id="repMemberBox" class="repMemberBox memberBox">
            <div class="moduleTitle repModTitle">KNOW YOUR REPRESENTATIVE</div>
            <div class="allMember repAllMembers">
              <?php
                $currentCity = "";
                for ($oneRepNum = 0; $oneRepNum < count($repMemList); $oneRepNum++) {
                  if ($currentCity != $repMemList[$oneRepNum]['section_name']) {
                    echo("
                      <div class='oneCity oneRepCity'>
                        <div class='cityName repCityName'>
                          ".$repMemList[$oneRepNum]['section_name']." City
                        </div>");
                    $currentCity = $repMemList[$oneRepNum]['section_name'];
                  };
                  echo("
                    <div class='oneCongressman oneRepresentative'>
                      <div class='oneCongName oneRepName'>
                        ".$repMemList[$oneRepNum]['first_name']." ".$repMemList[$oneRepNum]['last_name']."
                      </div>
                      <div class='oneCongHome oneRepHome'>
                        ".$repMemList[$oneRepNum]['hometown'].", OH
                      </div>
                    </div>");
                  $nextRepNum = $oneRepNum + 1;
                  if ($nextRepNum != count($repMemList)) {
                    if ($currentCity != $repMemList[$nextRepNum]['section_name']) {
                      echo("</div>");
                    };
                  } else {
                    echo("</div>");
                  };
                };
              ?>
            </div>
          </div>
        </div>
        <div class='topBttn repTopBttn'>- TOP -</div>
        <div class='footer repLegionLink'>
          Want to attend Buckeye Boys State next year?<br>
          <a href="http://www.ohiobuckeyeboysstate.com/">
            <u>CLICK HERE!</u>
          </a>
        </div>
      </div>
    </div>
  </body>
</html>
