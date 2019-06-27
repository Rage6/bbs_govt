<?php
  require_once("../pdo.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS | State Government</title>
    <link rel="stylesheet" type="text/css" href="../style/required.css" />
    <link rel="stylesheet" type="text/css" href="../style/level.css" />
  </head>
  <body>
    <div class="homeTitle">
      <div>BBS <?php echo($currentYear) ?></div>
      <span>State Level</span>
    </div>
    <div class="homeContent">
      <a href="./governor.php">
        <div class="branchButton">
          <img class="branchImg" src="../img/state/governor.jpg" />
          <div class="branchTitle">Office of the Governor</div>
        </div>
      </a>
      <a href="">
        <div class="branchButton">
          <img class="branchImg" src="../img/state/senate.jpg" />
          <div class="branchTitle">BBS Senate</div>
        </div>
      </a>
      <a href="">
        <div class="branchButton">
          <img class="branchImg" src="../img/state/HoR.jpg" />
          <div class="branchTitle">BBS House of Representatives</div>
        </div>
      </a>
      <a href="">
        <div class="branchButton">
          <img class="branchImg" src="../img/state/supreme_court.jpg" />
          <div class="branchTitle">Supreme Court of BBS</div>
        </div>
      </a>
    </div>
  </body>
</html>
