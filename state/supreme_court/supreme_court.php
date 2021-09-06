<?php

  session_start();
  require_once("../../pdo.php");
  require_once("../../lockdown.php");
  require_once("supreme_court_lead.php");

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS | Supreme Court</title>
    <meta property="og:title" content="Supreme Court | BBS" />
    <meta property="og:image" content="../../img/ohio_flag_bbs.jpg" />
    <meta property="og:description" content="Welcome to BBS Supreme Court. Here is where you can quickly find all of our important, up-to-date, state-level legal information." />
    <link rel="stylesheet" type="text/css" href="../../style/required.css" />
    <!-- Width: 0px to 360px (Default CSS) -->
    <link rel="stylesheet" type="text/css" href="style/court_360.css" />
    <!-- Width: 361px to 375px -->
    <link rel="stylesheet" media="screen and (min-width: 361px) and (max-width: 375px)" href="style/court_375.css"/>
    <!-- Width: 376px to 414px -->
    <link rel="stylesheet" media="screen and (min-width: 376px) and (max-width: 414px)" href="style/court_414.css"/>
    <!-- Width: 415px to 768px -->
    <link rel="stylesheet" media="screen and (min-width: 415px) and (max-width: 768px)" href="style/court_768.css"/>
    <!-- Width: 769px to 1366px -->
    <link rel="stylesheet" media="screen and (min-width: 769px) and (max-width: 1366px)" href="style/court_1366.css"/>
    <!-- Width: 1367px to 1440px -->
    <link rel="stylesheet" media="screen and (min-width: 1367px) and (max-width: 1440px)" href="style/court_1440.css"/>
    <!-- Width: 1441px and above -->
    <link rel="stylesheet" media="screen and (min-width: 1441px)" href="style/court_1920.css"/>
    <link rel="icon" type="image/x-icon" href="../../img/favicon.ico"/>
    <link href="https://fonts.googleapis.com/css?family=Ibarra+Real+Nova:600&display=swap" rel="stylesheet">
    <script src=<?php
      if ($isLocal == true) {
        echo("../../".$jquery);
      } else {
        echo($jquery);
      };?>></script>
    <script src="main.js"></script>
    <script src="case_library/cases.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PEVZ2L2FBZ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-PEVZ2L2FBZ');
    </script>
    <!-- End of gtag -->
  </head>
  <body>
    <div class="wholePage">
      <div class="arrowAndTitle">
        <!-- <a class="backArrow" href="../../index.php">
          <img src="../../img/home_gold.png" />
        </a> -->
        <div class="bothTopBttns">
          <a href="../../index.php">
            <img src="../../img/home_gold.png" />
          </a>
          <img id="menuBttn" class="showMenu" src="../../img/menu_gold.png" />
        </div>
        <div class="mainTitle">
          <div class="courtLogo"></div>
          <div class="mainTitleText">
            <div class="topMain">BUCKEYE BOYS STATE</div>
            <div class="titleDivide"></div>
            <div class="bottomMain">
              <div>SUPREME</div>
              <div>COURT</div>
            </div>
          </div>
        </div>
      </div>
      <div class="menuContent">
        <div class="allOptions">
          <div id="justiceLink" class="optionBttn">JUSTICES</div>
          <div id="caseLink" class="optionBttn">COURT CASES</div>
          <div id="minutesLink" class="optionBttn">BAR ASSOCIATION MINUTES</div>
          <div id="resultsLink" class="optionBttn">BAR MEMBERS</div>
        </div>
      </div>
      <div class="mainContent">
        <div class="welcome">
          <?php echo html_entity_decode($intro); ?>
        </div>
        <!-- The Justice bios start here -->
        <a id="justiceTop">
          <div class="tagTitle">Supreme Court Justices</div>
          <div class="allJustices">
            <?php
            while($oneJustice = $justiceInfoStmt->fetch(PDO::FETCH_ASSOC)) {
              echo html_entity_decode("
              <div class='justiceBox'>
                <div class='justiceTitle'>
                  <div>".$oneJustice['first_name']."</br>".$oneJustice['last_name']."</div>
                  <div>".$oneJustice['job_name']."</div>
                </div>");
                if ($oneJustice['approved'] == 1 && $oneJustice['delegate_id'] != 0) {
                  if ($oneJustice['flickr_url'] == null || $oneJustice['flickr_url'] == '') {
                    echo html_entity_decode("<img class='justiceImg' src='".$oneJustice['section_path']."crop_".$oneJustice['filename'].".".$oneJustice['extension']."?t=".time()."' />");
                  } else {
                    echo html_entity_decode("<img class='justiceImg' src='".$oneJustice['flickr_url']."' />");
                  }
                } else {
                  echo html_entity_decode("<img class='justiceImg' src='../../img/default_photo.png' />");
                };
                echo html_entity_decode("<div class='justiceBio'>
                  <div class='cityHeader'>BBS City:</div>
                  <div class='cityContent'>".$oneJustice['section_name']."</div>
                  <div class='cityHeader'>Hometown:</div>
                  <div class='cityContent'>".$oneJustice['hometown']."</div>
                </div>
              </div>");
            };
            ?>
          </div>
        </a>

        <div class="upArrow">
          <div class="goTop">
            - TOP -
          </div>
        </div>

        <!-- The directory of cases -->
        <a id="caseTop">
          <div class="tagTitle">Court Cases</div>
        </a>
        <div class="caseBox">
          <div class="subtypeSelectBox">
            <div class="subtypeSelect">
              <div>CHOOSE TYPE:</div>
              <div id="selectBox" data-subtypeid="0">---</div>
            </div>
            <div id="subtypeBttnList" class="subtypeBttnList">
              <!-- This is where you select the type of case -->
            </div>
          </div>
          <div class="caseBttnBox">
            <div>CHOOSE CASE:</div>
            <div id="caseBttnList" class="caseBttnList">
              <!-- The titles of the selected cases are shown here -->
              <i>-- No case found --</i>
            </div>
          </div>
          <div class="caseDetailBox">
            <div>CASE DETAILS</div>
            <div id="caseContent" class="caseContent">
              <!-- The details about the selected case show up here -->
              <i>-- No case selected --</i>
            </div>
          </div>
        </div>

        <div class="upArrow">
          <div class="goTop">
            - TOP -
          </div>
        </div>

        <!-- The "Bar Association Minutes" start here -->
        <a id="minutesTop">
          <div class="tagTitle">Bar Association Minutes</div>
          <div class="minuteBox">
            <div class="allMinuteBttns">
              <div id="minute1" data-day="1">1</div>
              <div id="minute2" data-day="2">2</div>
              <div id="minute3" data-day="3">3</div>
              <div id="minute4" data-day="4">4</div>
              <div id="minute5" data-day="5">5</div>
            </div>
            <div class="minuteCnt">
              <?php
                $cntNum = 1;
                while ($oneMinute = $minuteStmt->fetch(PDO::FETCH_ASSOC)) {
                  $month = substr($oneMinute['timestamp'],5,2);
                  $day = substr($oneMinute['timestamp'],8,2);
                  $year = substr($oneMinute['timestamp'],0,4);
                  echo html_entity_decode("
                  <div id='minuteCnt".$cntNum."' class='allMinuteCnt'>
                    <div class='minuteDate'>".$month."/".$day."/".$year."</div>
                    <div class='minuteTitle'>".$oneMinute['title']."</div>
                    <div class='minuteMain'>".$oneMinute['content']."</div>
                  </div>");
                  $cntNum++;
                };
              ?>
            </div>
          </div>
        </a>

        <div class="upArrow">
          <div class="goTop">
            - TOP -
          </div>
        </div>

        <!-- The Bar Exam Results -->
        <a id="resultsTop">
          <div class="tagTitle">Bar Members</div>
          <div class="barBox">
            <div class="fullBarIntro">
              <div class="barIntro">
                <div style='margin-bottom:5px'><i><b>Who are bar members?</b></i></div>
                All members of the BBS Bar Association are citizens that have passed the bar exam and are registered attorneys within our state. Current members are listed below.
              </div>
              <div class="barIntro">
                <div style='margin-bottom:5px'><i><b>When is membership required?</b></i></div>
                Only bar members can act as attorneys in Buckey Boys State. Certain  elected BBS officials are required to be bar members. These positions include judges, the state attorney general, and county/city directors of law.
              </div>
            </div>
            <?php
              if ((int)$countMember > 0) {
                echo("<div class='allMembers'>");
                while ($oneMember = $memberListStmt->fetch(PDO::FETCH_ASSOC)) {
                  echo html_entity_decode("
                  <div class='memberBox'>
                    <div class='memberName'>".$oneMember['last_name'].", ".$oneMember['first_name']."</div>
                    <div class='memberHomeBox'>
                      <div class='cityColumn bothCities'>
                        <div class='bothTitles'>BBS City</div>
                        <div>".$oneMember['section_name']."</div>
                      </div>
                      <div class='hometownColumn bothCities'>
                        <div class='bothTitles'>Hometown</div>
                        <div>".$oneMember['hometown']."</div>
                      </div>
                    </div>
                  </div>
                  ");
                };
                echo("</div>");
              } else {
                echo("
                <div class='noMemberBox'>
                  <i>Sorry, there are no bar members at this time.</i>
                </div>
                ");
              };
            ?>
          </div>
        </a>

        <div class="upArrow">
          <div class="goTop">
            - TOP -
          </div>
        </div>

        <div class="footer">
          <div>
            Want to attend Buckeye Boys State next year?
          </div>
          <a href="http://www.ohiobuckeyeboysstate.com/">
            <u>CLICK HERE!</u>
          </a>
        </div>

      </div>
    </div>
  </body>
</html>
