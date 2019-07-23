<?php

  session_start();
  require_once("../../pdo.php");
  require_once("lead_login.php");

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS | Admin Login</title>
    <link rel="stylesheet" type="text/css" href="style/login_360.css" />
  </head>
  <body>
    <a href="../../index.php">
      <div>
        H
      </div>
    </a>
    <div class="infoBox">
      <div class="allTitle">
        <div class="upperTitle">
          Buckeye Boys State
        </div>
        <div class="lowerTitle">
          Administrative Center
        </div>
      </div>
      <div class="explain">
        Before adding, updating, or deleting information from the BBS website, you must first select your desired Section and enter the correct password.
      </div>
    </div>
    <?php
      if (isset($_SESSION['message']) && $_SERVER['REQUEST_METHOD'] == "GET") {
        echo("<div class='message'>".$_SESSION['message']."</div>");
        unset($_SESSION['message']);
      };
    ?>
    <div class="formBox">
      <form method="POST">
        <div>Select your desired section, county, or city</div>
        <select style='background-color:lightgrey' name='sectionId'>
          <option value=''>Choose A Section</option>
          <?php
            for ($sectNum = 0; $sectNum < count($sectList); $sectNum++) {
              if ($sectList[$sectNum]['is_city'] == 1) {
                $sectionName = "City of ".$sectList[$sectNum]['section_name'];
              } elseif ($sectList[$sectNum]['is_county'] == 1) {
                $sectionName = "County of ".$sectList[$sectNum]['section_name'];
              } else {
                $sectionName = $sectList[$sectNum]['section_name'];
              };
              echo("<option value='".$sectList[$sectNum]['section_id']."'>".$sectionName."</option>");
            };
            if (isset($_GET['maintenance'])) {
              echo("<option value='999'>Maintenance</option>");
            };
          ?>
        </select>
        <div>Enter your password</div>
        <input type="password" name="sectionPw" />
        <div class="formBttn">
          <input type="submit" name="sectionLogin" value="ENTER" />
        </div>
        </table>
      </form>
    </div>
  </body>
</html>
