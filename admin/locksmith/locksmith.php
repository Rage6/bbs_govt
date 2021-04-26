<?php

  session_start();
  require_once("../../pdo.php");
  require_once("../../lockdown.php");
  require_once("lead_locksmith.php");

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Key Box</title>
    <link rel="stylesheet" type="text/css" href="style/locksmith.css" />
    <link rel="icon" type="image/x-icon" href="../../img/favicon.ico"/>
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
        if ($secList[$indexNum]['section_id'] != 0) {
        echo("
          <div class='secBox'>
            <div class='secName'>".$secList[$indexNum]['section_name']."</div>
            <div>
              <form method='POST'>");
                if ($secList[$indexNum]['is_city'] != 0 || $secList[$indexNum]['is_city'] == NULL || $secList[$indexNum]['is_county'] != 0 || $secList[$indexNum]['is_county'] == NULL) {
                  echo("
                    <input type='hidden' name='newNameId' value='".$secList[$indexNum]['section_id']."'>
                    <input type='text' name='newName' value='".$secList[$indexNum]['section_name']."'></br>
                    <select name='newSectStatus'>
                      <option value='1'>ACTIVE</option>
                      <option value='0'>INACTIVE</option>
                    </select></br>
                    <input type='submit' name='changeSectionName' value='CHANGE STATUS'></br>
                  ");
                };
              echo("
              </form>
            </div>
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
            ");
            if ($secList[$indexNum]['is_county'] > 0) {
              if ($secList[$indexNum]['is_city'] > 0) {
                $flagBkColor = "yellow";
                $flagColor = "black";
                echo("
                  <form method='POST'>
                    <div class='flagAdjust' style='background-color:green'>
                      <input type='hidden' name='popId' value='".$secList[$indexNum]['section_id']."' />
                      <div>
                        Population: <input type='number' name='popNum' value='".$secList[$indexNum]['population']."' min='0' />
                      </div>
                      <div class='flagBttn' style='background-color:lightgrey'>
                        <input type='submit' name='popUpdate' value='UPDATE POPULATION' />
                      </div>
                    </div>
                  </form>");
              } else {
                $flagBkColor = "red";
                $flagColor = "white";
              };
              echo("
                <form method='POST'>
                  <div class='flagAdjust' style='color:".$flagColor.";background-color:".$flagBkColor."'>
                    <input type='hidden' name='flagSecNum' value='".$secList[$indexNum]['section_id']."'>
                    <div>
                      Flag #: <input type='number' name='flagNum' value='".$secList[$indexNum]['flags']."' min='0' max='5'>
                    </div>
                    <div>
                      <input class='flagBttn' type='submit' name='flagUpdate' value='UPDATE FLAGS'>
                    </div>
                  </div>
                </form>
              ");
            };
            echo("
          </div>
        ");
        };
      };
    ?>
    <div class='blacklistBox'>
      <div class='blacklistTitle'>BLACKLIST</div>
      <div class='blacklistContent'>
        <div class='listSubtitle'>
          <div>Cookie</div>
          <div>Time</div>
          <div>Action</div>
        </div>
        <?php
          if (count($blacklist) > 0) {
            for ($listNum = 0; $listNum < count($blacklist); $listNum++) {
              echo("
                <form method='POST'>
                  <div class='listRow'>
                    <input type='hidden' name='cookie' value='".$blacklist[$listNum]['error_cookie']."' />
                    <div>".$blacklist[$listNum]['error_cookie']."</div>
                    <div>".$blacklist[$listNum]['time_stamp']."</div>
                    <div>
                      <input type='submit' name='deleteCookie' value='DELETE' />
                    </div>
                  </div>
                </form>");
            };
          } else {
            echo("
              <div class='listRow'>
                NO USERS ON BLACKLIST AT THIS TIME
              </div>");
          };
        ?>
      </div>
    </div>
    <div class="dateBox">
      <div class="dateTitle">START & END</div>
      <form method='POST'>
        <div class="dateRow">
          <div style="background-color:lightgreen">
            <div style="text-align:center"><u>START</u></div>
            <div>
              YEAR: <input type='text' name='startYear' value='<?php echo($startArray[2]) ?>' />
            </div>
            <div>
              MONTH:
              <select name="startMonth">
                <option value="<?php echo($startArray[0]) ?>"><?php echo($startArray[0]) ?></option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
              </select>
            </div>
            <div>
              DAY: <input type='text' name='startDay' value='<?php echo($startArray[1]) ?>' />
            </div>
            <div>
              TIME: <input type='text' name='startTime' value='<?php echo($startArray[3]) ?>' />
            </div>
            <div>
              AM/PM:
              <select name='startAmPm'>
                <?php
                  if ($startArray[4] == "PM") {
                    $startValueOne = "PM";
                    $startValueTwo = "AM";
                  } else {
                    $startValueOne = "AM";
                    $startValueTwo = "PM";
                  };
                ?>
                <option value="<?php echo($startValueOne) ?>"><?php echo($startValueOne) ?></option>
                <option value="<?php echo($startValueTwo) ?>"><?php echo($startValueTwo) ?></option>
              </select>
            </div>
          </div>
          <div style="background-color:lightblue">
            <div style="text-align:center"><u>END</u></div>
            <div>
              YEAR: <input type='text' name='endYear' value='<?php echo($endArray[2]) ?>' />
            </div>
            <div>
              MONTH:
              <select name="endMonth">
                <option value="<?php echo($endArray[0]) ?>"><?php echo($startArray[0]) ?></option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
              </select>
            </div>
            <div>
              DAY: <input type='text' name='endDay' value='<?php echo($endArray[1]) ?>' />
            </div>
            <div>
              TIME: <input type='text' name='endTime' value='<?php echo($endArray[3]) ?>' />
            </div>
            <div>
              AM/PM:
              <select name='endAmPm'>
                <?php
                  if ($endArray[4] == "PM") {
                    $valueOne = "PM";
                    $valueTwo = "AM";
                  } else {
                    $valueOne = "AM";
                    $valueTwo = "PM";
                  };
                ?>
                <option value="<?php echo($valueOne) ?>"><?php echo($valueOne) ?></option>
                <option value="<?php echo($valueTwo) ?>"><?php echo($valueTwo) ?></option>
              </select>
            </div>
          </div>
        </div>
        <input style='background-color:lightgrey;border:1px solid black' type='submit' name='changeDates' value='UPDATE' />
      </form>
    </div>
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
