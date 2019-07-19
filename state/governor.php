<?php
  session_start();
  require_once("../pdo.php");
  require_once("./leads/gov_lead.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS | Governor</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans+Condensed:300|Playfair+Display&display=swap" rel="stylesheet"/>
    <!-- Width: 0px to 360px (Default CSS) -->
    <link rel="stylesheet" type="text/css" href="../style/state/governor/gov_360.css"/>
    <!-- Width: 361px to 375px -->
    <link rel="stylesheet" media="screen and (min-width: 361px) and (max-width: 375px)" href="../style/state/governor/gov_375.css"/>
    <!-- Width: 376px to 414px -->
    <link rel="stylesheet" media="screen and (min-width: 376px) and (max-width: 414px)" href="../style/state/governor/gov_414.css"/>
    <!-- Width: 415px to 768px -->
    <link rel="stylesheet" media="screen and (min-width: 415px) and (max-width: 768px)" href="../style/state/governor/gov_768.css"/>
    <!-- Width: 769px to 1366px -->
    <link rel="stylesheet" media="screen and (min-width: 769px) and (max-width: 1366px)" href="../style/state/governor/gov_1366.css"/>
    <!-- Width: 1367px to 1440px -->
    <link rel="stylesheet" media="screen and (min-width: 1367px) and (max-width: 1440px)" href="../style/state/governor/gov_1440.css"/>
    <!-- Width: 1441px and above -->
    <link rel="stylesheet" media="screen and (min-width: 1441px)" href="../style/state/governor/gov_1920.css"/>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script src="../main.js"></script>
  </head>
  <body>
    <a name="topTag"></a>
    <div class="govTitle">
      <div><?php echo($govInfo['first_name']." ".$govInfo['last_name']) ?></div>
      <div class="divider"></div>
      <div>Governor of Buckeye Boys State</div>
    </div>
    <div id="menuClick" class="menuBar">
      MENU
    </div>
    <div id="menuContent" class="menuList">
      <a href="#governorTag">
        <div class="menuButton">
          > Governor & Lt. Governor
        </div>
      </a>
      <a href="#electedTag">
        <div class="menuButton">
          > Elected Officials
        </div>
      </a>
      <a href="#goalTag">
        <div class="menuButton">
          > Policies & Goals
        </div>
      </a>
      <a href="#agencyTag">
        <div class="menuButton">
          > Departments & Agencies
        </div>
      </a>
      <a href="#reportTag">
        <div class="menuButton">
          > Daily Report of Activities
        </div>
      </a>
    </div>
    <div class="govContent">
      <img id="img_0" src="../img/state/governor/bbs_gov.jpg">
      <div class="slideshow">
        <div class="slideFilm">
          <div id="img_1_A" class="oneFrame"></div>
          <div id="img_2_A" class="oneFrame"></div>
          <div id="img_3_A" class="oneFrame"></div>
          <div id="img_4_A" class="oneFrame"></div>
          <div id="img_5_A" class="oneFrame"></div>
          <div id="img_6_A" class="oneFrame"></div>
          <div id="img_7_A" class="oneFrame"></div>
          <div id="img_1_B" class="oneFrame"></div>
          <div id="img_2_B" class="oneFrame"></div>
          <div id="img_3_B" class="oneFrame"></div>
          <div id="img_4_B" class="oneFrame"></div>
          <div id="img_5_B" class="oneFrame"></div>
          <div id="img_6_B" class="oneFrame"></div>
          <div id="img_7_B" class="oneFrame"></div>
        </div>
      </div>

      <div class="govIntro">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </div>
      <a name="governorTag">
        <div class="govBox">
          <div class="govSubtitle">GOVERNOR</div>
          <div class="forFlex">
            <div class="nameAndPic">
              <div class="govName"><?php echo($govInfo["first_name"]." ".$govInfo["last_name"]) ?></div>
              <img src="../img/state/governor/bbs_gov.jpg"/>
            </div>
            <div class="govBio">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl purus in mollis nunc. Non tellus orci ac auctor augue.
            </div>
          </div>
          <div class="upArrow">
            <a href="#topTag">
              <img src="../img/state/up_arrow.png" />
            </a>
          </div>
        </div>
        <div class="govBox">
          <div class="govSubtitle">LT GOVERNOR</div>
          <div class="forFlex">
            <div class="nameAndPic">
              <div class="govName"><?php echo($ltgovInfo['first_name'])." ".$ltgovInfo['last_name'] ?></div>
              <img src="../img/state/governor/bbs_gov.jpg"/>
            </div>
            <div class="govBio">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl purus in mollis nunc. Non tellus orci ac auctor augue.
            </div>
          </div>
          <div class="upArrow">
            <a href="#topTag">
              <img src="../img/state/up_arrow.png" />
            </a>
          </div>
        </div>
      </a>
      <a name="electedTag">
        <div class="tagTitle">ELECTED OFFICIALS</div>
        <div style="margin-top:0px" class="govBox">
          <div class="firstBox govSubtitle">ATTORNEY GENERAL</div>
          <div class="forFlex">
            <div class="nameAndPic">
              <div class="govName"><?php echo($attGenInfo['first_name']." ".$attGenInfo['last_name']) ?></div>
              <img src="../img/state/governor/bbs_gov.jpg"/>
            </div>
            <div class="govBio">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl purus in mollis nunc. Non tellus orci ac auctor augue.
            </div>
          </div>
          <div class="upArrow">
            <a href="#topTag">
              <img src="../img/state/up_arrow.png" />
            </a>
          </div>
        </div>
        <div class="govBox">
          <div class="govSubtitle">TREASURER OF STATE</div>
          <div class="forFlex">
            <div class="nameAndPic">
              <div class="govName"><?php echo($treasInfo['first_name']." ".$treasInfo['last_name']) ?></div>
              <img src="../img/state/governor/bbs_gov.jpg"/>
            </div>
            <div class="govBio">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl purus in mollis nunc. Non tellus orci ac auctor augue.
            </div>
          </div>
          <div class="upArrow">
            <a href="#topTag">
              <img src="../img/state/up_arrow.png" />
            </a>
          </div>
        </div>
        <div class="govBox">
          <div class="govSubtitle">AUDITOR OF STATE</div>
          <div class="forFlex">
            <div class="nameAndPic">
              <div class="govName"><?php echo($auditInfo['first_name']." ".$auditInfo['last_name']) ?></div>
              <img src="../img/state/governor/bbs_gov.jpg"/>
            </div>
            <div class="govBio">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl purus in mollis nunc. Non tellus orci ac auctor augue.
            </div>
          </div>
          <div class="upArrow">
            <a href="#topTag">
              <img src="../img/state/up_arrow.png" />
            </a>
          </div>
        </div>
        <div class="govBox">
          <div class="govSubtitle">SECRETARY OF STATE</div>
          <div class="forFlex">
            <div class="nameAndPic">
              <div class="govName"><?php echo($secInfo['first_name']." ".$secInfo['last_name']) ?></div>
              <img src="../img/state/governor/bbs_gov.jpg"/>
            </div>
            <div class="govBio">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl purus in mollis nunc. Non tellus orci ac auctor augue.
            </div>
          </div>
          <div class="upArrow">
            <a href="#topTag">
              <img src="../img/state/up_arrow.png" />
            </a>
          </div>
        </div>
      </a>
      <a name="goalTag">
        <div class="tagTitle">POLICIES & GOALS</div>
        <div class="goalBox">
          <div class="goalIntro">
            Gov. <?php echo($govInfo['last_name']) ?>, Lt. Gov. <?php echo($ltgovInfo['last_name']) ?> and their team are dedicated to leading their state in the right direction.
          </div>
          <div class="bothList">
            <div class="policyList">
              <div class="listTitle">POLICIES</div>
              <ul>
                <?php
                  // For collecting all of their policies
                  $policyStmt = $pdo->prepare("SELECT * FROM Post WHERE type_id=2 AND section_id=9 AND approved=1 ORDER BY post_order ASC");
                  $policyStmt->execute();
                  while ($onePolicy = $policyStmt->fetch(PDO::FETCH_ASSOC)) {
                    echo("<li class='listSpacing'>
                      <div class='itemTitle'>".$onePolicy['title']."</div>
                      <div class='itemContent'>".$onePolicy['content']."</div>
                    </li>");
                  };
                ?>
              </ul>
            </div>
            <div class="goalDivider"></div>
            <div class="goalList">
              <div class="listTitle">GOALS</div>
              <ul>
                <?php
                  // For collecting all of their goals
                  $goalStmt = $pdo->prepare("SELECT * FROM Post WHERE type_id=1 AND section_id=9 AND approved=1 ORDER BY post_order ASC");
                  $goalStmt->execute();
                  while ($oneGoal = $goalStmt->fetch(PDO::FETCH_ASSOC)) {
                    echo("<li class='listSpacing'>
                      <div class='itemTitle'>".$oneGoal['title']."</div>
                      <div class='itemContent'>".$oneGoal['content']."</div>
                    </li>");
                  };
                ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="upArrow" style="margin-top:20px">
          <a href="#topTag">
            <img src="../img/state/up_arrow.png" />
          </a>
        </div>
      </a>
      <a name="agencyTag">
        <div class="tagTitle">Departments & Agencies</div>
        <div style="margin-top:0px" class="govBox agencyBox">
          <?php
            $agencyNum = 0;
            $agencyStmt = $pdo->prepare("SELECT DISTINCT * FROM Department INNER JOIN Job INNER JOIN Delegate WHERE Department.section_id=9 AND Department.job_id=Job.job_id AND Job.delegate_id=Delegate.delegate_id AND Department.active=1 ORDER BY Department.dpt_id ASC");
            $agencyStmt->execute();
            while ($oneAgency = $agencyStmt->fetch(PDO::FETCH_ASSOC)) {
              echo("
              <div class='oneAgency'>
                <div class='agencySubtitle' id='agencyBtn".$agencyNum."'>".$oneAgency['dpt_name']."</div>
                <div class='agencyContent' id='agencyCnt".$agencyNum."'>
                  <div class='purpose'>".$oneAgency['purpose']."</div>
                  <div class='director'>Director: ".$oneAgency['first_name']." ".$oneAgency['last_name']."</div>
                </div>
              </div>
              ");
              $agencyNum++;
            };
          ?>
        </div>
        <div class="upArrow" style="margin-top:20px">
          <a href="#topTag">
            <img src="../img/state/up_arrow.png" />
          </a>
        </div>
      </a>
      <a name="reportTag">
        <div class="tagTitle">DAILY REPORT OF ACTIVITIES</div>
        <div class="reportBox">
          <div class="allReportBtns">
            <div id="report1" data-day="1">1</div>
            <div id="report2" data-day="2">2</div>
            <div id="report3" data-day="3">3</div>
            <div id="report4" data-day="4">4</div>
            <div id="report5" data-day="5">5</div>
          </div>
          <div class="reportCnt">
            <?php
              $cntNum = 1;
              while ($oneReport = $reportStmt->fetch(PDO::FETCH_ASSOC)) {
                $month = substr($oneReport['timestamp'],5,2);
                $day = substr($oneReport['timestamp'],8,2);
                $year = substr($oneReport['timestamp'],0,4);
                echo("
                <div id='reportCnt".$cntNum."' class='allReportCnt'>
                  <div class='reportDate'>".$month."/".$day."/".$year."</div>
                  <div class='reportTitle'>".$oneReport['title']."</div>
                  <div class='reportMain'>".$oneReport['content']."</div>
                </div>");
                $cntNum++;
              };
            ?>
          </div>
        </div>
        <div class="upArrow" style="margin-top:20px">
          <a href="#topTag">
            <img src="../img/state/up_arrow.png" />
          </a>
        </div>
      </a>
    </div>
      <div class="footer">
        Want to attend Buckeye Boys State next year?<br/>
        <a href="http://www.ohiobuckeyeboysstate.com/">
          <u>CLICK HERE!</u>
        </a>
      </div>
    </div>
  </body>
</html>
