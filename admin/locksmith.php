<?php

  session_start();
  require_once("../pdo.php");
  require_once("leads/locksmith.php");

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Key Box</title>
    <link rel="stylesheet" type="text/css" href="../style/admin/locksmith.css" />
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

          </div>
        ");
      };
    ?>
  </body>
</html>
