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
        <div style="border-top:3px solid gold"></div>
        <div class="bottomMain">
          <div>SUPREME</div>
          <div>COURT</div>
        </div>
      </div>
      <div class="courtLogo"></div>
    </div>
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
    <div class="mainContent">
      <div class="welcome">
        <?php echo($intro); ?>
      </div>
    </div>
  </body>
</html>
