<?php

  session_start();
  require_once("../../pdo.php");
  require_once("lead_locksmith.php");
  require_once("../../lockdown.php");

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Key Box</title>
    <link rel="stylesheet" type="text/css" href="style/locksmith.css" />
  </head>
  <body>
    <form method="POST">
      <button style="border:1px solid black">
        <input type="submit" name="logout" value="LOGOUT" />
      </button>
    </form>
    <div class="mainTitle">Key Box</div>
    <?php
      if (isset($_SESSION['message']) && $_SERVER['REQUEST_METHOD'] == "GET") {
        echo("<div class='message'>".$_SESSION['message']."</div>");
        unset($_SESSION['message']);
      };
      for ($indexNum = 0; $indexNum < $totalSec; $indexNum++) {
        if ($secList[$indexNum]['couns_num'] >= 5) {
          $attemptColor = "red";
        } else {
          $attemptColor = "green";
        };
        if ($secList[$indexNum]['section_id'] != 0) {
        echo("
          <div class='secBox'>
            <div class='secName'>".$secList[$indexNum]['section_name']."</div>
            <div class='rowPasswords'>
              <form method='POST'>
                <div>
                  <div class='typeTitle'>DELEGATE</div>
                  <input type='hidden' name='typeId' value='delegate'>
                  <input type='hidden' name='secId' value='".$secList[$indexNum]['section_id']."'>
                  <input type='hidden' name='secName' value='".$secList[$indexNum]['section_name']."'>
                  <div><input class='inputPasswords' type='text' name='newPw' placeholder='new password' /></div>
                  <div><input class='inputPasswords' type='text' name='confPw' placeholder='confirm password' /></div>
                  <div class='changeBttn'><input type='submit' name='changePw' value='ENTER'></div>
                </div>
              </form>
              <form method='POST'>
                <div>
                  <div class='typeTitle'>COUNSELOR</div>
                  <input type='hidden' name='typeId' value='counselor'>
                  <input type='hidden' name='secId' value='".$secList[$indexNum]['section_id']."'>
                  <input type='hidden' name='secName' value='".$secList[$indexNum]['section_name']."'>
                  <div><input class='inputPasswords' type='text' name='newPw' placeholder='new password' /></div>
                  <div><input class='inputPasswords' type='text' name='confPw' placeholder='confirm password' /></div>
                  <div class='changeBttn'><input type='submit' name='changePw' value='ENTER'></div>
                </div>
              </form>
            </div>
            <div class='lockReset'>
              <div>
                Failed Logins: <span style='color:".$attemptColor."'>".$secList[$indexNum]['del_num']."</span>
              </div>
              <div>
                <form method='POST'>
                  <input type='hidden' name='secId' value='".$secList[$indexNum]['section_id']."' />
                  <input style='border:1px solid black' type='submit' name='resetNum' value='UNLOCK' />
                </form>
              </div>
            </div>");
            if ($secList[$indexNum]['failed_IP'] != null) {
              echo("
              <div class='lockReset lastIP'>
                <div><u>Last Failed IP Address:</u></div>
                <div>".$secList[$indexNum]['failed_IP']."</div>
              </div>");
            };
            echo("
          </div>
        ");
        };
      };
    ?>
    <div class='lockdownBox'>
      <div class='lockTitle'>
        LOCKDOWN
      </div>
      <div class='lockDescribe'>
        <u>WARNING</u>: When 'locked', no user will be able to enter any of the site's pages, <b>to include the 'Login' page</b>. To 'unlock' it, you must log into this page with the Login page's direct URL.
      </div>
      <div class='lockStatus'>
        <u>STATUS</u>:
        <?php
          if ($checkLock == 0) {
            echo("<b style='color:green'>UNLOCKED</b>");
          } else {
            echo("<b style='color:red'>LOCKED</b>");
          };
        ?>
      </div>
      <div>
        <form class='allLockBttns' method='POST'>
          <input class='oneLockBttn' style='background-color:red' type='submit' name='lockSite' value='LOCK' />
          <input class='oneLockBttn' style='background-color:green' type='submit' name='unlockSite' value='UNLOCK' />
        </form>
      </div>
    </div>
  </body>
</html>
