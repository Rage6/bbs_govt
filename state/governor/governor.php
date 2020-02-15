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
    <a name="topTag"></a>
    <div class="govTitle">
      <div><?php echo($govInfo['first_name']." ".$govInfo['last_name']) ?></div>
      <div class="divider"></div>
      <div>Governor of Buckeye Boys State</div>
    </div>
    <div id="menuClick" class="menuBar">
      MENU
    </div>
    <div class="fullContent">
      <div id="menuContent" class="menuList">
        <div class="menuBox">
          <!-- <a href="#governorTag"> -->
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
          <a href="../../index.php">
            <div id="hoverLink" class="menuButton backButton">
              < BACK
            </div>
          </a>
        </div>
      </div>
      <div class="govContent">
        <?php
          if ($govInfo['approved'] == 1) {
            echo("<img id='img_0' src='".$imgPrefix.$govInfo['image_path']."crop_".$govInfo['filename'].".".$govInfo['extension']."?t=".time()."' />");
          } else {
            echo("<img id='img_0' src='".$imgPrefix."\default_photo.png' />");
          };
        ?>

        <div class="slideshow">
          <div class="slideFilm">
            <div id="img_1_A" class="oneFrame"
              <?php
                if ($govInfo['approved'] == 1) {
                  echo("style=background-image:url('".$imgPrefix.$govInfo['image_path']."crop_".$govInfo['filename'].".".$govInfo['extension']."?t=".time()."')");
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
              if ($govInfo['approved'] == 1) {
                echo("style=background-image:url('".$imgPrefix.$govInfo['image_path']."crop_".$govInfo['filename'].".".$govInfo['extension']."?t=".time()."')");
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
        <a id="govTop">
          <div id="govTop" class="govBox">
            <div class="govSubtitle">GOVERNOR</div>
            <div class="forFlex">
              <div class="nameAndPic">
                <div class="govName"><?php echo($govInfo["first_name"]." ".$govInfo["last_name"]) ?></div>
                <?php
                  if ($govInfo['approved'] == 1) {
                    echo("<img src='".$imgPrefix.$govInfo['section_path']."crop_".$govInfo['filename'].".".$govInfo['extension']."?t=".time()."' />");
                  } else {
                    echo("<img src='".$imgPrefix."\default_photo.png' />");
                  };
                ?>
              </div>
              <div class="govBio">
                As governor of Buckeye Boys State, <?php echo($govInfo['first_name']." ".$govInfo['last_name']) ?> governor is the head of the executive branch of the state’s government, as well as the commander-in-chief of the state’s military. He is also responsible for making the state budget, as well as either approving or vetoing potential state laws.
              </div>
            </div>
            <div class="upArrow">
              <a href="#topTag">
                - TOP -
              </a>
            </div>
          </div>
          <div class="govBox">
            <div class="govSubtitle">LT GOVERNOR</div>
            <div class="forFlex">
              <div class="nameAndPic">
                <div class="govName"><?php echo($ltgovInfo['first_name'])." ".$ltgovInfo['last_name'] ?></div>
                <?php
                  if ($ltgovInfo['approved'] == 1) {
                    echo("<img src='".$imgPrefix.$ltgovInfo['section_path']."crop_".$ltgovInfo['filename'].".".$ltgovInfo['extension']."?t=".time()."' />");
                  } else {
                    echo("<img src='".$imgPrefix."\default_photo.png' />");
                  };
                ?>
              </div>
              <div class="govBio">
                <b>Lieutenant Governor <?php echo($ltgovInfo['last_name']) ?></b> is an elected officer, the second ranking officer of the executive branch, and the first officer in line to succeed the Governor.
              </div>
            </div>
            <div class="upArrow">
              <a href="#topTag">
                - TOP -
              </a>
            </div>
          </div>
        </a>
        <a id="electedTop">
          <div class="tagTitle">ELECTED OFFICIALS</div>
          <div style="margin-top:0px" class="govBox">
            <div class="firstBox govSubtitle">ATTORNEY GENERAL</div>
            <div class="forFlex">
              <div class="nameAndPic">
                <div class="govName"><?php echo($attGenInfo['first_name']." ".$attGenInfo['last_name']) ?></div>
                <?php
                  if ($attGenInfo['approved'] == 1) {
                    echo("<img src='".$imgPrefix.$attGenInfo['section_path']."crop_".$attGenInfo['filename'].".".$attGenInfo['extension']."?t=".time()."' />");
                  } else {
                    echo("<img src='".$imgPrefix."\default_photo.png' />");
                  };
                ?>
              </div>
              <div class="govBio">
                 <b>Attorney General <?php echo($treasInfo['last_name']) ?></b> is the chief law officer of and chief legal advisor to Buckeye Boys State. He is responsible for protecting the citizens from crimes that range from predatory financial practices to abuse of power.
              </div>
            </div>
            <div class="upArrow">
              <a href="#topTag">
                - TOP -
              </a>
            </div>
          </div>
          <div class="govBox">
            <div class="govSubtitle">TREASURER OF STATE</div>
            <div class="forFlex">
              <div class="nameAndPic">
                <div class="govName"><?php echo($treasInfo['first_name']." ".$treasInfo['last_name']) ?></div>
                <?php
                  if ($treasInfo['approved'] == 1) {
                    echo("<img src='".$imgPrefix.$treasInfo['section_path']."crop_".$treasInfo['filename'].".".$treasInfo['extension']."?t=".time()."' />");
                  } else {
                    echo("<img src='".$imgPrefix."\default_photo.png' />");
                  };
                ?>
              </div>
              <div class="govBio">
                The treasurer of Buckeye Boys State, <?php echo($treasInfo['first_name']." ".$treasInfo['last_name']) ?>, is responsible for collecting and safeguarding taxes and fees, as well as managing state investments.
              </div>
            </div>
            <div class="upArrow">
              <a href="#topTag">
                - TOP -
              </a>
            </div>
          </div>
          <div class="govBox">
            <div class="govSubtitle">AUDITOR OF STATE</div>
            <div class="forFlex">
              <div class="nameAndPic">
                <div class="govName"><?php echo($auditInfo['first_name']." ".$auditInfo['last_name']) ?></div>
                <?php
                  if ($auditInfo['approved'] == 1) {
                    echo("<img src='".$imgPrefix.$auditInfo['section_path']."crop_".$auditInfo['filename'].".".$auditInfo['extension']."?t=".time()."' />");
                  } else {
                    echo("<img src='".$imgPrefix."\default_photo.png' />");
                  };
                ?>
              </div>
              <div class="govBio">
                As the chief compliance officer of the state, the <b>Auditor <?php echo($auditInfo['last_name']) ?></b> makes Buckeye Boys State's government more efficient, effective and transparent. He does this by placing checks and balances on state and local governments, all for the sake of the taxpayers.
              </div>
            </div>
            <div class="upArrow">
              <a href="#topTag">
                - TOP -
              </a>
            </div>
          </div>
          <div class="govBox">
            <div class="govSubtitle">SECRETARY OF STATE</div>
            <div class="forFlex">
              <div class="nameAndPic">
                <div class="govName">
                  <?php echo($secInfo['first_name']." ".$secInfo['last_name']) ?>
                </div>
                <?php
                  if ($secInfo['approved'] == 1) {
                    echo("<img src='".$imgPrefix.$secInfo['section_path']."crop_".$secInfo['filename'].".".$secInfo['extension']."?t=".time()."' />");
                  } else {
                    echo("<img src='".$imgPrefix."\default_photo.png' />");
                  };
                ?>
              </div>
              <div class="govBio">
                <b>Secretary <?php echo($secInfo["last_name"]) ?></b> was elected statewide in Buckeye Boys State. His official responsibilities include: overseeing elections in the state; registering business entities (corporations, etc.); granting those businesses the authority to work within the state; registering secured transactions; and granting access to public documents.
              </div>
            </div>
            <div class="upArrow">
              <a href="#topTag">
                - TOP -
              </a>
            </div>
          </div>
        </a>
        <a id="goalTop">
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
                    $policyStmt = $pdo->prepare("SELECT * FROM Post WHERE type_id=2 AND section_id=$secId AND approved=1 ORDER BY post_order ASC");
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
                    $goalStmt = $pdo->prepare("SELECT * FROM Post WHERE type_id=1 AND section_id=$secId AND approved=1 ORDER BY post_order ASC");
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
    <div class="footer">
      Want to attend Buckeye Boys State next year?<br/>
      <a href="http://www.ohiobuckeyeboysstate.com/">
        <u>CLICK HERE!</u>
      </a>
    </div>
  </body>
</html>
