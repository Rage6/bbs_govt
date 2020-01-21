<?php
  session_start();
  require_once("../../pdo.php");
  require_once("../../lockdown.php");
  require_once("supreme_court_lead.php");

  // Redirects to 'default.html' if lockdown in place
  if ($checkLock > 0) {
    header('Location: ../../default.html');
    return true;
  };

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS | State Supreme Court</title>
    <!-- Width: 0px to 360px (Default CSS) -->
    <link rel="stylesheet" type="text/css" href="style/court_360.css" />
    <link href="https://fonts.googleapis.com/css?family=Ibarra+Real+Nova:600&display=swap" rel="stylesheet">
  <script src=<?php
    if ($isLocal == true) {
      echo("../../".$jquery);
    } else {
      echo($jquery);
    };?>></script>
    <script src="main.js"></script>
  </head>
  <body>
    <div class="mainTitle">
      <div>
        <div class="topMain">BUCKEYE BOYS STATE</div>
        <div style="border-top:3px solid #fec231"></div>
        <div class="bottomMain">
          <div>SUPREME</div>
          <div>COURT</div>
        </div>
      </div>
      <div class="courtLogo"></div>
    </div>
    <div class="menuContent">
      <div class="menuBttn" id="mainMenu">MENU</div>
      <div class="allOptions">
        <div class="optionBttn">JUSTICES</div>
        <div class="optionBttn">COURT CASES</div>
        <div class="optionBttn">BAR ASSOCIATION MINUTES</div>
        <div class="optionBttn">BAR EXAM RESULTS</div>
        <a href="../../index.php">
          <div class="optionBttn returnBttn"><< BACK</div>
        </a>
      </div>
    </div>
    <div class="mainContent">
      <div class="welcome">
        <?php echo($intro); ?>
      </div>
      <a id="minuteTop">
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
                echo("
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
        <a href="#menuTag">
          - TOP -
        </a>
      </div>
    </div>
  </body>
</html>
