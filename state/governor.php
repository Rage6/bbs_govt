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
    <link rel="stylesheet" type="text/css" href="../style/state/governor.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../style/required.css"/> -->
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
      <div class="menuButton">
        > Agencies
      </div>
      <div class="menuButton">
        > Daily Report of Activities
      </div>
    </div>
    <div class="govContent">
      <img src="../img/state/governor/bbs_gov.jpg">
      <div class="govIntro">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </div>
      <a name="governorTag">
        <div class="govBox">
          <div class="govSubtitle">GOVERNOR</div>
          <div class="nameAndPic">
            <div class="govName"><?php echo($govInfo["first_name"]." ".$govInfo["last_name"]) ?></div>
            <img src="../img/state/governor/bbs_gov.jpg"/>
          </div>
          <div class="govBio">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl purus in mollis nunc. Non tellus orci ac auctor augue.
          </div>
          <div class="upArrow">
            <a href="#topTag">
              <img src="../img/state/up_arrow.png" />
            </a>
          </div>
        </div>
        <div class="govBox">
          <div class="govSubtitle">LT GOVERNOR</div>
          <div class="nameAndPic">
            <div class="govName"><?php echo($ltgovInfo['first_name'])." ".$ltgovInfo['last_name'] ?></div>
            <img src="../img/state/governor/bbs_gov.jpg"/>
          </div>
          <div class="govBio">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl purus in mollis nunc. Non tellus orci ac auctor augue.
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
          <div class="firstBox govSubtitle">
            ATTORNEY GENERAL</div>
          <div class="nameAndPic">
            <div class="govName"><?php echo($attGenInfo['first_name']." ".$attGenInfo['last_name']) ?></div>
            <img src="../img/state/governor/bbs_gov.jpg"/>
          </div>
          <div class="govBio">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl purus in mollis nunc. Non tellus orci ac auctor augue.
          </div>
          <div class="upArrow">
            <a href="#topTag">
              <img src="../img/state/up_arrow.png" />
            </a>
          </div>
        </div>
        <div class="govBox">
          <div class="govSubtitle">TREASURER OF STATE</div>
          <div class="nameAndPic">
            <div class="govName"><?php echo($treasInfo['first_name']." ".$treasInfo['last_name']) ?></div>
            <img src="../img/state/governor/bbs_gov.jpg"/>
          </div>
          <div class="govBio">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl purus in mollis nunc. Non tellus orci ac auctor augue.
          </div>
          <div class="upArrow">
            <a href="#topTag">
              <img src="../img/state/up_arrow.png" />
            </a>
          </div>
        </div>
        <div class="govBox">
          <div class="govSubtitle">AUDITOR OF STATE</div>
          <div class="nameAndPic">
            <div class="govName"><?php echo($auditInfo['first_name']." ".$auditInfo['last_name']) ?></div>
            <img src="../img/state/governor/bbs_gov.jpg"/>
          </div>
          <div class="govBio">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl purus in mollis nunc. Non tellus orci ac auctor augue.
          </div>
          <div class="upArrow">
            <a href="#topTag">
              <img src="../img/state/up_arrow.png" />
            </a>
          </div>
        </div>
        <div class="govBox">
          <div class="govSubtitle">SECRETARY OF STATE</div>
          <div class="nameAndPic">
            <div class="govName"><?php echo($secInfo['first_name']." ".$secInfo['last_name']) ?></div>
            <img src="../img/state/governor/bbs_gov.jpg"/>
          </div>
          <div class="govBio">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl purus in mollis nunc. Non tellus orci ac auctor augue.
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
          <div>
            Gov. <?php echo($govInfo['last_name']) ?>, Lt. Gov. <?php echo($ltgovInfo['last_name']) ?> and their team are dedicated to leading their state in the right direction.
          </div>
          <div class="policyList">
            <div class="listTitle">POLICIES</div>
            <ul>
              <?php
                // For collecting all of their policies
                $policyStmt = $pdo->prepare("SELECT * FROM Post WHERE type_id=2 AND section_id=9 AND approved=1 ORDER BY post_order ASC");
                $policyStmt->execute();
                while ($onePolicy = $policyStmt->fetch(PDO::FETCH_ASSOC)) {
                  echo("<li class='listSpacing'>
                    <u>".$onePolicy['title']."</u>
                    <div>".$onePolicy['content']."</div>
                  </li>");
                };
              ?>
            </ul>
          </div>
          <div class="goalList">
            <div class="listTitle">GOALS</div>
            <ul>
              <?php
                // For collecting all of their goals
                $goalStmt = $pdo->prepare("SELECT * FROM Post WHERE type_id=1 AND section_id=9 AND approved=1 ORDER BY post_order ASC");
                $goalStmt->execute();
                while ($oneGoal = $goalStmt->fetch(PDO::FETCH_ASSOC)) {
                  echo("<li class='listSpacing'>
                    <u>".$oneGoal['title']."</u>
                    <div>".$oneGoal['content']."</div>
                  </li>");
                };
              ?>
            </ul>
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
