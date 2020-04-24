<?php

  session_start();
  require_once("../../pdo.php");
  require_once("../../lockdown.php");
  require_once("gov_lead.php");

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS | Governor</title>
    <meta property="og:title" content="Office of the Governor | BBS" />
    <meta property="og:image" content="../../img/ohio_flag_bbs.jpg" />
    <meta property="og:description" content="Welcome to the Office of the Governor. Here is where you can find all of the progress occurring within both Senate and the House of Representatives" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans+Condensed:300|Playfair+Display&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="../../style/required.css" />
    <!-- Width: 0px to 360px (Default CSS) -->
    <link rel="stylesheet" type="text/css" href="style/gov_360.css"/>
    <!-- Width: 361px to 375px -->
    <link rel="stylesheet" media="screen and (min-width: 361px) and (max-width: 375px)" href="style/gov_375.css"/>
    <!-- Width: 376px to 414px -->
    <link rel="stylesheet" media="screen and (min-width: 376px) and (max-width: 414px)" href="style/gov_414.css"/>
    <!-- Width: 415px to 768px -->
    <link rel="stylesheet" media="screen and (min-width: 415px) and (max-width: 768px)" href="style/gov_768.css"/>
    <!-- Width: 769px to 1366px -->
    <link rel="stylesheet" media="screen and (min-width: 769px) and (max-width: 1366px)" href="style/gov_1366.css"/>
    <!-- Width: 1367px to 1440px -->
    <link rel="stylesheet" media="screen and (min-width: 1367px) and (max-width: 1440px)" href="style/gov_1440.css"/>
    <!-- Width: 1441px and above -->
    <link rel="stylesheet" media="screen and (min-width: 1441px)" href="style/gov_1920.css"/>
    <link rel="icon" type="image/x-icon" href="../../img/favicon.ico"/>
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
    <div class="wholePage">
      <a name="topTag"></a>
      <div class="bothTopBttns">
        <a href="../../index.php">
          <img src="../../img/home_gold.png" />
        </a>
        <img id="menuBttn" class="showMenu" src="../../img/menu_gold.png" />
      </div>
      <div class="govTitle">
        <div>
          <?php
            echo($govStaffList[0]['first_name']
            ."</br> ".
            $govStaffList[0]['last_name'])
          ?>
        </div>
        <div class="divider"></div>
        <div>Governor of <span class="titleBreak"></br></span>Buckeye Boys State</div>
      </div>
      <div class="fullContent">
        <div id="menuContent" class="menuList">
          <div class="menuBox">
            <a id="govLink">
              <div id="hoverLink" class="menuButton">
                > Governor & Lt. Governor
              </div>
            </a>
            <a id="electedLink">
              <div id="hoverLink" class="menuButton">
                > Elected Officials
              </div>
            </a>
            <a id="goalLink">
              <div id="hoverLink" class="menuButton">
                > Policies & Goals
              </div>
            </a>
            <a id="agencyLink">
              <div id="hoverLink" class="menuButton">
                > Departments & Agencies
              </div>
            </a>
            <a id="reportLink">
              <div id="hoverLink" class="menuButton">
                > Daily Report of Activities
              </div>
            </a>
          </div>
        </div>
        <div class="govContent">
          <?php
            if ($govStaffList[0]['approved'] == 1) {
              echo("<img id='img_0' src='".$imgPrefix.$govStaffList[0]['image_path']."crop_".$govStaffList[0]['filename'].".".$govStaffList[0]['extension']."?t=".time()."' />");
            } else {
              echo("<img id='img_0' src='".$imgPrefix."\default_photo.png' />");
            };
          ?>

          <div class="slideshow">
            <div class="slideFilm">
              <div id="img_1_A" class="oneFrame"
                <?php
                  if ($govStaffList[0]['approved'] == 1) {
                    echo("style=background-image:url('".$imgPrefix.$govStaffList[0]['image_path']."crop_".$govStaffList[0]['filename'].".".$govStaffList[0]['extension']."?t=".time()."')");
                  } else {
                    echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                  };
                ?>
              ></div>
              <div
                id="img_2_A" class="oneFrame"
                <?php
                  if ($bannerOne['approved'] == 1) {
                    echo("style=background-image:url('".$imgPrefix.$bannerOne['image_path']."crop_".$bannerOne['filename'].".".$bannerOne['extension']."?t=".time()."')");
                  } else {
                    echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                  };
                ?>
              ></div>
              <div id="img_3_A" class="oneFrame"
                <?php
                  if ($bannerTwo['approved'] == 1) {
                    echo("style=background-image:url('".$imgPrefix.$bannerTwo['image_path']."crop_".$bannerTwo['filename'].".".$bannerTwo['extension']."?t=".time()."')");
                  } else {
                    echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                  };
                ?>
              ></div>
              <div id="img_4_A" class="oneFrame"
                <?php
                  if ($bannerThree['approved'] == 1) {
                    echo("style=background-image:url('".$imgPrefix.$bannerThree['image_path']."crop_".$bannerThree['filename'].".".$bannerThree['extension']."?t=".time()."')");
                  } else {
                    echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                  };
                ?>
              ></div>
              <div id="img_5_A" class="oneFrame"
                <?php
                  if ($bannerFour['approved'] == 1) {
                    echo("style=background-image:url('".$imgPrefix.$bannerFour['image_path']."crop_".$bannerFour['filename'].".".$bannerFour['extension']."?t=".time()."')");
                  } else {
                    echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                  };
                ?>
              ></div>
              <div id="img_6_A" class="oneFrame"
                <?php
                  if ($bannerFive['approved'] == 1) {
                    echo("style=background-image:url('".$imgPrefix.$bannerFive['image_path']."crop_".$bannerFive['filename'].".".$bannerFive['extension']."?t=".time()."')");
                  } else {
                    echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                  };
                ?>
              ></div>
              <div id="img_7_A" class="oneFrame"
                <?php
                  if ($bannerSix['approved'] == 1) {
                    echo("style=background-image:url('".$imgPrefix.$bannerSix['image_path']."crop_".$bannerSix['filename'].".".$bannerSix['extension']."?t=".time()."')");
                  } else {
                    echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                  };
                ?>
              ></div>
              <div id="img_1_B" class="oneFrame"
              <?php
                if ($govStaffList[0]['approved'] == 1) {
                  echo("style=background-image:url('".$imgPrefix.$govStaffList[0]['image_path']."crop_".$govStaffList[0]['filename'].".".$govStaffList[0]['extension']."?t=".time()."')");
                } else {
                  echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                };
              ?>
              ></div>
              <div id="img_2_B" class="oneFrame"
                <?php
                  if ($bannerOne['approved'] == 1) {
                    echo("style=background-image:url('".$imgPrefix.$bannerOne['image_path']."crop_".$bannerOne['filename'].".".$bannerOne['extension']."?t=".time()."')");
                  } else {
                    echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                  };
                ?>
              ></div>
              <div id="img_3_B" class="oneFrame"
                <?php
                  if ($bannerTwo['approved'] == 1) {
                    echo("style=background-image:url('".$imgPrefix.$bannerTwo['image_path']."crop_".$bannerTwo['filename'].".".$bannerTwo['extension']."?t=".time()."')");
                  } else {
                    echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                  };
                ?>
              ></div>
              <div id="img_4_B" class="oneFrame"
                <?php
                  if ($bannerThree['approved'] == 1) {
                    echo("style=background-image:url('".$imgPrefix.$bannerThree['image_path']."crop_".$bannerThree['filename'].".".$bannerThree['extension']."?t=".time()."')");
                  } else {
                    echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                  };
                ?>
              ></div>
              <div id="img_5_B" class="oneFrame"
                <?php
                  if ($bannerFour['approved'] == 1) {
                    echo("style=background-image:url('".$imgPrefix.$bannerFour['image_path']."crop_".$bannerFour['filename'].".".$bannerFour['extension']."?t=".time()."')");
                  } else {
                    echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                  };
                ?>
              ></div>
              <div id="img_6_B" class="oneFrame"
                <?php
                  if ($bannerFive['approved'] == 1) {
                    echo("style=background-image:url('".$imgPrefix.$bannerFive['image_path']."crop_".$bannerFive['filename'].".".$bannerFive['extension']."?t=".time()."')");
                  } else {
                    echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                  };
                ?>
              ></div>
              <div id="img_7_B" class="oneFrame"
                <?php
                  if ($bannerSix['approved'] == 1) {
                    echo("style=background-image:url('".$imgPrefix.$bannerSix['image_path']."crop_".$bannerSix['filename'].".".$bannerSix['extension']."?t=".time()."')");
                  } else {
                    echo("style=background-image:url('".$imgPrefix."/default_photo.png')");
                  };
                ?>
              ></div>
            </div>
          </div>
          <div class="govIntro">
            <?php
              if ($introContent['approved'] == 1) {
                echo($introContent['content']);
              };
            ?>
          </div>
          <!-- Governor, Lt. Governor -->
          <a id="govTop">
            <?php
              for ($govNum = 0; $govNum < 2; $govNum++) {
                echo("
                <div id='govTop' class='govBox'>
                  <div class='govSubtitle'>".$govStaffList[$govNum]["job_name"]."</div>
                  <div class='forFlex'>
                    <div class='nameAndPic'>
                      <div class='govWords'>
                        <div class='govName'>
                          ".$govStaffList[$govNum]["first_name"]." ".$govStaffList[$govNum]["last_name"]."
                        </div>
                        <div class='govHometown'>".$govStaffList[$govNum]["hometown"].", OH</div>
                      </div>");
                      if ($govStaffList[$govNum]['approved'] == 1) {
                        echo("<img src='".$imgPrefix.$govStaffList[$govNum]['section_path']."crop_".$govStaffList[$govNum]['filename'].".".$govStaffList[$govNum]['extension']."?t=".time()."' />");
                      } else {
                        echo("<img src='".$imgPrefix."\default_photo.png' />");
                      };
                    echo("
                    </div>
                    <div class='govBio'>".$govStaffList[$govNum]['description']."</div>
                  </div>
                  <div class='upArrow'>
                    <a href='#topTag'>
                      - TOP -
                    </a>
                  </div>
                </div>");
              };
            ?>
          </a>
          <!-- Attorney General, State Treasurer, State Auditor, Secretary of State -->
          <a id="electedTop">
            <div class="tagTitle">ELECTED OFFICIALS</div>
            <?php
              $firstBox = true;
              for ($electNum = 2; $electNum < 6; $electNum++) {
                if ($firstBox == true) {
                  echo("
                  <div style='margin-top:0px' class='govBox'>
                    <div class='firstBox govSubtitle'>".$govStaffList[$electNum]['job_name']."</div>");
                  $firstBox = false;
                } else {
                  echo("
                  <div class='govBox'>
                    <div class='govSubtitle'>".$govStaffList[$electNum]['job_name']."</div>");
                };
                echo("
                <div class='forFlex'>
                  <div class='nameAndPic'>
                    <div class='govWords'>
                      <div class='govName'>
                        ".$govStaffList[$electNum]['first_name']." ".$govStaffList[$electNum]['last_name']."
                      </div>
                      <div class='govHometown'>".$govStaffList[$electNum]['hometown'].", OH</div>
                    </div>");
                      if ($govStaffList[$electNum]['approved'] == 1) {
                        echo("<img src='".$imgPrefix.$govStaffList[$electNum]['section_path']."crop_".$govStaffList[$electNum]['filename'].".".$govStaffList[$electNum]['extension']."?t=".time()."' />");
                      } else {
                        echo("<img src='".$imgPrefix."\default_photo.png' />");
                      };
                  echo("
                  </div>
                  <div class='govBio'>".$govStaffList[$electNum]['description']."</div>
                </div>
                <div class='upArrow'>
                  <a href='#topTag'>
                    - TOP -
                  </a>
                </div>
              </div>");
              };
            ?>
          </a>
          <!-- Policies & Goals -->
          <a id="goalTop">
            <div class="tagTitle">POLICIES & GOALS</div>
            <div class="goalBox">
              <div class="goalIntro">
                Gov. <?php echo($govStaffList[0]['last_name']) ?>, Lt. Gov. <?php echo($govStaffList[1]['last_name']) ?> and their team are dedicated to leading their state in the right direction.
              </div>
              <div class="bothList">
                <div class="policyList">
                  <div class="listTitle">POLICIES</div>
                  <ul>
                    <?php
                      // For collecting all of their policies
                      $policyStmt = $pdo->prepare("SELECT * FROM Post WHERE type_id=2 AND approved=1 ORDER BY post_order ASC");
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
                      $goalStmt = $pdo->prepare("SELECT * FROM Post WHERE type_id=1 AND approved=1 ORDER BY post_order ASC");
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
                - TOP -
              </a>
            </div>
          </a>
          <!-- Departments & Agencies -->
          <a id="agencyTop">
            <div class="tagTitle">Departments & Agencies</div>
            <div style="margin-top:0px" class="govBox agencyBox">
              <?php
                $agencyNum = 0;
                $agencyStmt = $pdo->prepare("SELECT DISTINCT * FROM Department INNER JOIN Job INNER JOIN Delegate WHERE Department.section_id=$secId AND Department.job_id=Job.job_id AND Job.delegate_id=Delegate.delegate_id AND Department.active=1 ORDER BY Department.dpt_id ASC");
                $agencyStmt->execute();
                while ($oneAgency = $agencyStmt->fetch(PDO::FETCH_ASSOC)) {
                  echo("
                  <div class='oneAgency'>
                    <div class='agencySubtitle' id='agencyBtn".$agencyNum."'>".$oneAgency['dpt_name']."</div>
                    <div class='agencyContent' id='agencyCnt".$agencyNum."'>
                      <div class='purpose'>".$oneAgency['purpose']."</div>
                      <div class='directorRow'>
                        <div class='director'>"
                          .$oneAgency['job_name'].
                        ":</div>
                        <div class='directorName'>"
                          .$oneAgency['first_name']." ".$oneAgency['last_name'].
                        "</div>
                      </div>
                    </div>
                  </div>
                  ");
                  $agencyNum++;
                };
              ?>
            </div>
            <div class="upArrow" style="margin-top:20px">
              <a href="#topTag">
                - TOP -
              </a>
            </div>
          </a>
          <!-- Daily Reports -->
          <a id="reportTop">
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
                - TOP -
              </a>
            </div>
          </a>
        </div>
      </div>
      <div class="footer govLegionLink">
        Want to attend Buckeye Boys State next year?<br/>
        <a href="http://www.ohiobuckeyeboysstate.com/">
          <u>CLICK HERE!</u>
        </a>
      </div>
    </div>
  </div>
  </body>
</html>
